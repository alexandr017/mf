<?php

namespace Database\Seeders;

use App\Models\Tickets\Ticket;
use App\Models\Tickets\TicketMessage;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TicketsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Начинаем создание 200 тикетов и 5000 сообщений...');
        
        $totalTickets = 200;
        $totalMessages = 5000;
        $chunkSize = 50; // Обрабатываем по 50 тикетов за раз
        $processedTickets = 0;

        // Получаем всех пользователей
        $userIds = User::pluck('id')->toArray();

        if (empty($userIds)) {
            $this->command->error('Нет пользователей в базе данных. Сначала запустите UsersSeeder.');
            return;
        }

        // Статусы и приоритеты
        $statuses = ['open', 'in_progress', 'closed', 'resolved'];
        $priorities = ['low', 'medium', 'high', 'urgent'];

        // Создаем тикеты
        $ticketIds = [];
        for ($i = 0; $i < $totalTickets; $i += $chunkSize) {
            $currentBatchSize = min($chunkSize, $totalTickets - $i);
            $batch = [];

            for ($j = 0; $j < $currentBatchSize; $j++) {
                $createdByUserId = fake()->randomElement($userIds);
                // 70% тикетов имеют назначенного пользователя
                $assignedToUserId = fake()->boolean(70) ? fake()->randomElement($userIds) : null;
                
                $status = fake()->randomElement($statuses);
                $priority = fake()->randomElement($priorities);
                
                // Если статус closed или resolved, устанавливаем closed_at
                $closedAt = in_array($status, ['closed', 'resolved']) 
                    ? fake()->dateTimeBetween('-3 months', 'now') 
                    : null;

                // Случайная дата создания в диапазоне последних 6 месяцев
                $createdAt = fake()->dateTimeBetween('-6 months', 'now');

                $batch[] = [
                    'subject' => fake()->sentence(rand(3, 8)),
                    'status' => $status,
                    'priority' => $priority,
                    'created_by_user_id' => $createdByUserId,
                    'assigned_to_user_id' => $assignedToUserId,
                    'closed_at' => $closedAt,
                    'created_at' => $createdAt,
                    'updated_at' => $createdAt,
                ];
            }

            // Batch insert для производительности
            // Сохраняем максимальный ID до вставки
            $maxIdBefore = DB::table('tickets')->max('id') ?? 0;
            
            DB::table('tickets')->insert($batch);
            
            // Получаем ID созданных тикетов через запрос
            $insertedIds = DB::table('tickets')
                ->where('id', '>', $maxIdBefore)
                ->orderBy('id')
                ->pluck('id')
                ->toArray();
            
            $ticketIds = array_merge($ticketIds, $insertedIds);
            
            $processedTickets += $currentBatchSize;
            $this->command->info("Создано тикетов: {$processedTickets} / {$totalTickets}");
        }

        $this->command->info('Начинаем создание сообщений...');

        // Создаем сообщения для тикетов
        $messagesPerTicket = intval($totalMessages / $totalTickets); // Среднее количество сообщений на тикет
        $remainingMessages = $totalMessages % $totalTickets; // Остаток для распределения

        $processedMessages = 0;
        $messageChunkSize = 500;

        foreach ($ticketIds as $index => $ticketId) {
            // Определяем количество сообщений для этого тикета
            $messagesCount = $messagesPerTicket;
            if ($index < $remainingMessages) {
                $messagesCount++; // Распределяем остаток
            }

            $ticket = Ticket::find($ticketId);
            if (!$ticket) {
                continue;
            }

            $messages = [];
            $ticketCreatedAt = $ticket->created_at;
            
            for ($m = 0; $m < $messagesCount; $m++) {
                // Первое сообщение всегда от создателя тикета
                if ($m === 0) {
                    $userId = $ticket->created_by_user_id;
                    $isAdmin = false;
                } else {
                    // Остальные сообщения могут быть от разных пользователей
                    // 30% сообщений от админа (assigned_to_user_id или случайный пользователь)
                    if ($ticket->assigned_to_user_id && fake()->boolean(30)) {
                        $userId = $ticket->assigned_to_user_id;
                        $isAdmin = true;
                    } else {
                        $userId = fake()->randomElement($userIds);
                        $isAdmin = false;
                    }
                }

                // Сообщения создаются после создания тикета
                $messageCreatedAt = fake()->dateTimeBetween($ticketCreatedAt, 'now');

                $messages[] = [
                    'ticket_id' => $ticketId,
                    'user_id' => $userId,
                    'message' => fake()->paragraph(rand(1, 5)),
                    'is_admin' => $isAdmin,
                    'created_at' => $messageCreatedAt,
                    'updated_at' => $messageCreatedAt,
                ];

                // Вставляем батчами для производительности
                if (count($messages) >= $messageChunkSize) {
                    DB::table('ticket_messages')->insert($messages);
                    $processedMessages += count($messages);
                    $this->command->info("Создано сообщений: {$processedMessages} / {$totalMessages}");
                    $messages = [];
                }
            }

            // Вставляем оставшиеся сообщения
            if (!empty($messages)) {
                DB::table('ticket_messages')->insert($messages);
                $processedMessages += count($messages);
            }
        }

        $this->command->info("Все сообщения созданы: {$processedMessages} / {$totalMessages}");
        $this->command->info('Все тикеты и сообщения созданы успешно!');
    }
}


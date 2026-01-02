<?php

namespace App\Http\Controllers\Site\Tickets;

use App\Http\Requests\Site\Tickets\TicketRequest;
use App\Http\Requests\Site\Tickets\TicketMessageRequest;
use App\Models\Tickets\Ticket;
use App\Models\Tickets\TicketMessage;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketsController
{
    public function index(): View
    {
        $user = Auth::user();
        
        $tickets = Ticket::where('created_by_user_id', $user->id)
            ->with(['latestMessage', 'assignedTo'])
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('site.v1.templates.account.tickets.index', compact('tickets'));
    }

    public function create(): View
    {
        return view('site.v1.templates.account.tickets.create');
    }

    public function store(TicketRequest $request): RedirectResponse
    {
        $user = Auth::user();
        
        $ticket = new Ticket([
            'subject' => $request->input('subject'),
            'status' => 'open',
            'priority' => $request->input('priority', 'medium'),
            'created_by_user_id' => $user->id,
        ]);
        
        $ticket->save();
        
        // Создаем первое сообщение
        if ($request->filled('message')) {
            $message = new TicketMessage([
                'ticket_id' => $ticket->id,
                'user_id' => $user->id,
                'message' => $request->input('message'),
                'is_admin' => false,
            ]);
            $message->save();
        }
        
        return redirect()
            ->route('account.tickets.show', $ticket->id)
            ->with('success', 'Тикет успешно создан!');
    }

    public function show(string $id): View
    {
        $user = Auth::user();
        
        $ticket = Ticket::where('id', $id)
            ->where('created_by_user_id', $user->id)
            ->with(['messages.user', 'assignedTo', 'createdBy'])
            ->firstOrFail();
        
        // Помечаем сообщения как прочитанные (если нужно)
        // Можно добавить поле is_read в ticket_messages
        
        return view('site.v1.templates.account.tickets.show', compact('ticket'));
    }

    public function addMessage(TicketMessageRequest $request, string $id): RedirectResponse
    {
        $user = Auth::user();
        
        $ticket = Ticket::where('id', $id)
            ->where('created_by_user_id', $user->id)
            ->firstOrFail();
        
        // Проверяем, что тикет не закрыт
        if (in_array($ticket->status, ['closed', 'resolved'])) {
            return redirect()
                ->route('account.tickets.show', $ticket->id)
                ->with('error', 'Нельзя добавить сообщение в закрытый тикет.');
        }
        
        $message = new TicketMessage([
            'ticket_id' => $ticket->id,
            'user_id' => $user->id,
            'message' => $request->input('message'),
            'is_admin' => false,
        ]);
        
        $message->save();
        
        // Если тикет был в статусе in_progress и пользователь отвечает, можно оставить как есть
        // или изменить статус на open (по желанию)
        
        return redirect()
            ->route('account.tickets.show', $ticket->id)
            ->with('success', 'Сообщение добавлено!');
    }

    /**
     * Проверка наличия новых сообщений в тикете (AJAX)
     */
    public function checkNewMessages(Request $request, string $id): \Illuminate\Http\JsonResponse
    {
        $user = Auth::user();
        
        $ticket = Ticket::where('id', $id)
            ->where('created_by_user_id', $user->id)
            ->firstOrFail();
        
        // Получаем количество сообщений в тикете
        $totalMessages = $ticket->messages()->count();
        
        // Получаем количество сообщений, которое было при последней загрузке страницы
        $lastMessageCount = $request->input('last_message_count', 0);
        
        // Проверяем, есть ли новые сообщения
        $hasNewMessages = $totalMessages > $lastMessageCount;
        
        return response()->json([
            'has_new_messages' => $hasNewMessages,
            'total_messages' => $totalMessages,
            'last_message_count' => $lastMessageCount,
        ]);
    }
}


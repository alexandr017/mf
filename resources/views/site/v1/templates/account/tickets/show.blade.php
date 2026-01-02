@extends('site.v1.layouts.account')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="bg-white rounded-xl shadow-lg p-6 md:p-8 mb-6">
        <div class="mb-6">
            <a href="{{ route('account.tickets.index') }}" class="text-primary hover:text-opacity-80 flex items-center gap-2 mb-4">
                <i class="ri-arrow-left-line"></i>
                <span>Назад к списку тикетов</span>
            </a>
            
            <div class="flex justify-between items-start mb-4">
                <div>
                    <h1 class="heading-font text-3xl text-gray-900 mb-2">#{{ $ticket->id }} - {{ $ticket->subject }}</h1>
                    <div class="flex gap-2 flex-wrap">
                        @php
                            $statusColors = [
                                'open' => 'bg-blue-100 text-blue-800',
                                'in_progress' => 'bg-yellow-100 text-yellow-800',
                                'closed' => 'bg-gray-100 text-gray-800',
                                'resolved' => 'bg-green-100 text-green-800',
                            ];
                            $statusLabels = [
                                'open' => 'Открыт',
                                'in_progress' => 'В работе',
                                'closed' => 'Закрыт',
                                'resolved' => 'Решен',
                            ];
                            $priorityColors = [
                                'low' => 'bg-gray-100 text-gray-800',
                                'medium' => 'bg-blue-100 text-blue-800',
                                'high' => 'bg-orange-100 text-orange-800',
                                'urgent' => 'bg-red-100 text-red-800',
                            ];
                            $priorityLabels = [
                                'low' => 'Низкий',
                                'medium' => 'Средний',
                                'high' => 'Высокий',
                                'urgent' => 'Срочный',
                            ];
                        @endphp
                        <span class="px-3 py-1 text-sm font-semibold rounded-full {{ $statusColors[$ticket->status] ?? 'bg-gray-100 text-gray-800' }}">
                            {{ $statusLabels[$ticket->status] ?? $ticket->status }}
                        </span>
                        <span class="px-3 py-1 text-sm font-semibold rounded-full {{ $priorityColors[$ticket->priority] ?? 'bg-gray-100 text-gray-800' }}">
                            {{ $priorityLabels[$ticket->priority] ?? $ticket->priority }}
                        </span>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm text-gray-600 mb-6">
                <div>
                    <span class="font-medium">Создан:</span> {{ $ticket->created_at->format('d.m.Y H:i') }}
                </div>
                @if($ticket->assignedTo)
                    <div>
                        <span class="font-medium">Назначен:</span> {{ $ticket->assignedTo->name }}
                    </div>
                @endif
                @if($ticket->closed_at)
                    <div>
                        <span class="font-medium">Закрыт:</span> {{ $ticket->closed_at->format('d.m.Y H:i') }}
                    </div>
                @endif
            </div>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <!-- Сообщения -->
        <div class="space-y-4 mb-6">
            <h2 class="text-xl font-semibold text-gray-900 mb-4">История сообщений</h2>
            
            @foreach($ticket->messages as $message)
                <div class="border rounded-lg p-4 {{ $message->is_admin ? 'bg-blue-50 border-blue-200' : 'bg-gray-50 border-gray-200' }}">
                    <div class="flex justify-between items-start mb-2">
                        <div class="flex items-center gap-2">
                            <strong class="text-gray-900">{{ $message->user->name }}</strong>
                            @if($message->is_admin)
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                    Администратор
                                </span>
                            @endif
                        </div>
                        <span class="text-sm text-gray-500">{{ $message->created_at->format('d.m.Y H:i') }}</span>
                    </div>
                    <div class="text-gray-700 whitespace-pre-wrap">{{ $message->message }}</div>
                </div>
            @endforeach
        </div>

        <!-- Форма добавления сообщения -->
        @if(!in_array($ticket->status, ['closed', 'resolved']))
            <div class="border-t pt-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Добавить сообщение</h3>
                
                @if($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('account.tickets.add-message', $ticket->id) }}" method="POST">
                    @csrf
                    
                    <div class="mb-4">
                        <textarea name="message" 
                                  rows="5"
                                  required
                                  minlength="5"
                                  maxlength="5000"
                                  class="w-full px-4 py-3 border border-gray-300 rounded-button focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent @error('message') border-red-500 @enderror"
                                  placeholder="Введите ваше сообщение...">{{ old('message') }}</textarea>
                        <div class="flex justify-between items-center mt-1">
                            @error('message')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @else
                                <p class="text-sm text-gray-500">Минимум 5 символов, максимум 5000</p>
                            @enderror
                            <span id="message-counter" class="text-sm text-gray-500">0 / 5000</span>
                        </div>
                    </div>

                    <button type="submit" class="px-6 py-3 bg-primary text-gray-900 rounded-button font-medium hover:bg-opacity-80 transition-colors">
                        <div class="flex items-center gap-2">
                            <i class="ri-send-plane-line"></i>
                            <span>Отправить сообщение</span>
                        </div>
                    </button>
                </form>
            </div>
        @else
            <div class="bg-gray-100 border border-gray-300 rounded-lg p-4 text-center text-gray-600">
                <i class="ri-lock-line text-2xl mb-2"></i>
                <p>Этот тикет закрыт. Вы не можете добавлять новые сообщения.</p>
            </div>
        @endif
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const messageTextarea = document.querySelector('textarea[name="message"]');
    const messageCounter = document.getElementById('message-counter');
    
    if (messageTextarea && messageCounter) {
        function updateCounter() {
            const length = messageTextarea.value.length;
            messageCounter.textContent = length + ' / 5000';
            
            if (length > 5000) {
                messageCounter.classList.add('text-red-500');
                messageCounter.classList.remove('text-gray-500');
            } else {
                messageCounter.classList.remove('text-red-500');
                messageCounter.classList.add('text-gray-500');
            }
        }
        
        messageTextarea.addEventListener('input', updateCounter);
        updateCounter(); // Инициализация
    }
    
    // Автоматическая проверка новых сообщений каждые 25 секунд
    const ticketId = {{ $ticket->id }};
    const initialMessageCount = {{ $ticket->messages->count() }};
    let lastMessageCount = initialMessageCount;
    let checkInterval;
    
    function checkForNewMessages() {
        fetch(`{{ route('account.tickets.check-messages', $ticket->id) }}?last_message_count=${lastMessageCount}`, {
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.has_new_messages) {
                // Если есть новые сообщения, перезагружаем страницу
                console.log('Обнаружены новые сообщения, перезагружаем страницу...');
                window.location.reload();
            }
            // Обновляем счетчик (на случай, если пользователь отправил сообщение)
            lastMessageCount = data.total_messages;
        })
        .catch(error => {
            console.error('Ошибка при проверке новых сообщений:', error);
        });
    }
    
    // Запускаем проверку каждые 25 секунд
    checkInterval = setInterval(checkForNewMessages, 25000);
    
    // Останавливаем проверку, если пользователь покидает страницу
    window.addEventListener('beforeunload', function() {
        if (checkInterval) {
            clearInterval(checkInterval);
        }
    });
    
    // Также останавливаем проверку, если страница не активна (опционально)
    document.addEventListener('visibilitychange', function() {
        if (document.hidden) {
            if (checkInterval) {
                clearInterval(checkInterval);
            }
        } else {
            // Возобновляем проверку при возврате на страницу
            checkInterval = setInterval(checkForNewMessages, 25000);
            // Сразу проверяем при возврате
            checkForNewMessages();
        }
    });
});
</script>
@endsection


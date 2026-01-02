@extends('site.v1.layouts.account')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="bg-white rounded-xl shadow-lg p-6 md:p-8 mb-6">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="heading-font text-3xl text-gray-900 mb-2">Мои тикеты</h1>
                <p class="text-gray-600">Обращения в службу поддержки</p>
            </div>
            <a href="{{ route('account.tickets.create') }}" class="bg-primary hover:bg-opacity-80 text-gray-900 font-bold px-6 py-3 !rounded-button whitespace-nowrap">
                <div class="flex items-center gap-2">
                    <i class="ri-add-line"></i>
                    <span>Создать тикет</span>
                </div>
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if($tickets->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Тема</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Статус</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Приоритет</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Назначен</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Создан</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Действия</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($tickets as $ticket)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                #{{ $ticket->id }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-900">{{ $ticket->subject }}</div>
                                @if($ticket->latestMessage)
                                    <div class="text-sm text-gray-500 mt-1">
                                        Последнее сообщение: {{ $ticket->latestMessage->created_at->format('d.m.Y H:i') }}
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
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
                                @endphp
                                <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $statusColors[$ticket->status] ?? 'bg-gray-100 text-gray-800' }}">
                                    {{ $statusLabels[$ticket->status] ?? $ticket->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @php
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
                                <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $priorityColors[$ticket->priority] ?? 'bg-gray-100 text-gray-800' }}">
                                    {{ $priorityLabels[$ticket->priority] ?? $ticket->priority }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $ticket->assignedTo ? $ticket->assignedTo->name : 'Не назначен' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $ticket->created_at->format('d.m.Y H:i') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('account.tickets.show', $ticket->id) }}" class="text-primary hover:text-opacity-80">
                                    <i class="ri-eye-line mr-1"></i> Открыть
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-12">
                <i class="ri-inbox-line text-6xl text-gray-300 mb-4"></i>
                <p class="text-gray-500 text-lg">У вас пока нет тикетов</p>
                <p class="text-gray-400 text-sm mt-2">Создайте тикет, если у вас есть вопросы или проблемы</p>
                <a href="{{ route('account.tickets.create') }}" class="mt-4 inline-block bg-primary hover:bg-opacity-80 text-gray-900 font-bold px-6 py-3 !rounded-button">
                    Создать тикет
                </a>
            </div>
        @endif
    </div>
</div>
@endsection


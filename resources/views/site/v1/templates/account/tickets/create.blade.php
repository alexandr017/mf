@extends('site.v1.layouts.account')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-xl shadow-lg p-6 md:p-8 mb-6">
        <div class="mb-6">
            <a href="{{ route('account.tickets.index') }}" class="text-primary hover:text-opacity-80 flex items-center gap-2 mb-4">
                <i class="ri-arrow-left-line"></i>
                <span>Назад к списку тикетов</span>
            </a>
            <h1 class="heading-font text-3xl text-gray-900 mb-2">Создать тикет</h1>
            <p class="text-gray-600">Опишите вашу проблему или вопрос, и мы поможем вам</p>
        </div>

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('account.tickets.store') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">
                    Тема тикета <span class="text-red-500">*</span>
                </label>
                <input type="text" 
                       id="subject" 
                       name="subject" 
                       value="{{ old('subject') }}"
                       required
                       maxlength="255"
                       class="w-full px-4 py-3 border border-gray-300 rounded-button focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent @error('subject') border-red-500 @enderror"
                       placeholder="Кратко опишите проблему или вопрос">
                @error('subject')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="priority" class="block text-sm font-medium text-gray-700 mb-2">
                    Приоритет <span class="text-red-500">*</span>
                </label>
                <select id="priority" 
                        name="priority" 
                        required
                        class="w-full px-4 py-3 border border-gray-300 rounded-button focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent @error('priority') border-red-500 @enderror">
                    <option value="">Выберите приоритет</option>
                    <option value="low" {{ old('priority') === 'low' ? 'selected' : '' }}>Низкий</option>
                    <option value="medium" {{ old('priority') === 'medium' ? 'selected' : '' }}>Средний</option>
                    <option value="high" {{ old('priority') === 'high' ? 'selected' : '' }}>Высокий</option>
                    <option value="urgent" {{ old('priority') === 'urgent' ? 'selected' : '' }}>Срочный</option>
                </select>
                @error('priority')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
                <p class="text-sm text-gray-500 mt-1">
                    <strong>Низкий</strong> - общие вопросы<br>
                    <strong>Средний</strong> - стандартные проблемы<br>
                    <strong>Высокий</strong> - важные вопросы<br>
                    <strong>Срочный</strong> - критичные проблемы, требующие немедленного решения
                </p>
            </div>

            <div>
                <label for="message" class="block text-sm font-medium text-gray-700 mb-2">
                    Сообщение <span class="text-red-500">*</span>
                </label>
                <textarea id="message" 
                          name="message" 
                          rows="8"
                          required
                          minlength="10"
                          maxlength="5000"
                          class="w-full px-4 py-3 border border-gray-300 rounded-button focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent @error('message') border-red-500 @enderror"
                          placeholder="Подробно опишите вашу проблему или вопрос. Укажите все необходимые детали, чтобы мы могли быстрее помочь вам.">{{ old('message') }}</textarea>
                <div class="flex justify-between items-center mt-1">
                    @error('message')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @else
                        <p class="text-sm text-gray-500">Минимум 10 символов, максимум 5000</p>
                    @enderror
                    <span id="message-counter" class="text-sm text-gray-500">0 / 5000</span>
                </div>
            </div>

            <div class="flex justify-end gap-4 pt-4">
                <a href="{{ route('account.tickets.index') }}" class="px-6 py-3 text-gray-700 bg-gray-100 rounded-button font-medium hover:bg-gray-200 transition-colors">
                    Отмена
                </a>
                <button type="submit" class="px-6 py-3 bg-primary text-gray-900 rounded-button font-medium hover:bg-opacity-80 transition-colors">
                    <div class="flex items-center gap-2">
                        <i class="ri-send-plane-line"></i>
                        <span>Создать тикет</span>
                    </div>
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const messageTextarea = document.getElementById('message');
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
});
</script>
@endsection


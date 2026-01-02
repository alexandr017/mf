@extends('site.v1.layouts.account')

@section('content')

<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-xl shadow-lg p-6 md:p-8 mb-6">
        <h1 class="heading-font text-3xl text-gray-900 mb-2">Настройки</h1>
        <p class="text-gray-600 mb-8">Управление личной информацией и настройками аккаунта</p>

        @if(session('success'))
            <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('account.options.save') }}" method="POST" enctype="multipart/form-data" id="options-form">
            @csrf
            @method('POST')

            <!-- Profile Picture -->
            <div class="flex items-start space-x-6 mb-8">
                <div class="relative">
                    <div class="w-24 h-24 rounded-full overflow-hidden border-4 border-primary bg-gray-300 flex items-center justify-center">
                        @if(auth()->user()->avatar)
                            <img src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="Avatar" class="w-full h-full object-cover object-top" id="avatar-preview">
                        @elseif(auth()->user()->name)
                            <span class="text-4xl font-bold text-gray-600" id="avatar-placeholder">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                        @else
                            <i class="ri-user-line text-4xl text-gray-400" id="avatar-placeholder"></i>
                        @endif
                    </div>
                    <label for="avatar" class="absolute -bottom-2 -right-2 w-8 h-8 bg-primary rounded-full flex items-center justify-center text-gray-900 hover:bg-opacity-80 transition-colors cursor-pointer">
                        <div class="w-4 h-4 flex items-center justify-center">
                            <i class="ri-camera-line text-sm"></i>
                        </div>
                    </label>
                    <input type="file" id="avatar" name="avatar" accept="image/jpeg,image/png,image/jpg,image/gif,image/webp" class="hidden" onchange="previewAvatar(this)">
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Фото профиля</h3>
                    <p class="text-sm text-gray-600 mb-4">Загрузите новое фото профиля. Рекомендуемый размер: 400x400px. Максимальный размер: 5MB</p>
                    <button type="button" onclick="document.getElementById('avatar').click()" class="bg-gray-100 text-gray-700 px-4 py-2 rounded-button text-sm font-medium hover:bg-gray-200 transition-colors cursor-pointer whitespace-nowrap">
                        Изменить фото
                    </button>
                    @error('avatar')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Player Information Form -->
            <div class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Имя</label>
                        <input type="text" id="name" name="name" value="{{ old('name', auth()->user()->name) }}" required class="w-full px-4 py-3 border border-gray-300 rounded-button focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent @error('name') border-red-500 @enderror">
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="nickname" class="block text-sm font-medium text-gray-700 mb-2">Никнейм</label>
                        <input type="text" id="nickname" name="nickname" value="{{ old('nickname', auth()->user()->nickname) }}" class="w-full px-4 py-3 border border-gray-300 rounded-button focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent @error('nickname') border-red-500 @enderror">
                        @error('nickname')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                        <p class="text-xs text-gray-500 mt-1">Уникальный никнейм для вашего профиля</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email', auth()->user()->email) }}" required class="w-full px-4 py-3 border border-gray-300 rounded-button focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent @error('email') border-red-500 @enderror">
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="preferred_position" class="block text-sm font-medium text-gray-700 mb-2">Предпочитаемая позиция</label>
                        <select id="preferred_position" name="preferred_position" class="w-full px-4 py-3 border border-gray-300 rounded-button focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent @error('preferred_position') border-red-500 @enderror">
                            <option value="">Выберите позицию</option>
                            @foreach(\App\Models\User::getPositions() as $key => $label)
                                <option value="{{ $key }}" {{ old('preferred_position', auth()->user()->preferred_position) === $key ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                        @error('preferred_position')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="hometown_city_id" class="block text-sm font-medium text-gray-700 mb-2">Родной город</label>
                        <select id="hometown_city_id" name="hometown_city_id" class="w-full px-4 py-3 border border-gray-300 rounded-button focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent @error('hometown_city_id') border-red-500 @enderror">
                            <option value="">Выберите город</option>
                            @php
                                $cities = \App\Models\Cities\City::orderBy('name')->get();
                            @endphp
                            @foreach($cities as $city)
                                <option value="{{ $city->id }}" {{ old('hometown_city_id', auth()->user()->hometown_city_id) == $city->id ? 'selected' : '' }}>
                                    {{ $city->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('hometown_city_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="show_hometown" class="block text-sm font-medium text-gray-700 mb-2">Отображать город в профиле</label>
                        <select id="show_hometown" name="show_hometown" class="w-full px-4 py-3 border border-gray-300 rounded-button focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent @error('show_hometown') border-red-500 @enderror">
                            <option value="0" {{ old('show_hometown', auth()->user()->show_hometown) == 0 ? 'selected' : '' }}>Нет</option>
                            <option value="1" {{ old('show_hometown', auth()->user()->show_hometown) == 1 ? 'selected' : '' }}>Да</option>
                        </select>
                        @error('show_hometown')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="border-t border-gray-200 pt-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Изменить пароль</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label for="current_password" class="block text-sm font-medium text-gray-700 mb-2">Текущий пароль</label>
                            <input type="password" id="current_password" name="current_password" class="w-full px-4 py-3 border border-gray-300 rounded-button focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent @error('current_password') border-red-500 @enderror">
                            @error('current_password')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Новый пароль</label>
                            <input type="password" id="password" name="password" class="w-full px-4 py-3 border border-gray-300 rounded-button focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent @error('password') border-red-500 @enderror">
                            @error('password')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Подтвердите пароль</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="w-full px-4 py-3 border border-gray-300 rounded-button focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                        </div>
                    </div>
                </div>

                <div class="flex justify-end space-x-4">
                    <a href="{{ route('account') }}" class="px-6 py-3 text-gray-700 bg-gray-100 rounded-button font-medium hover:bg-gray-200 transition-colors cursor-pointer whitespace-nowrap">
                        Отмена
                    </a>
                    <button type="submit" class="px-6 py-3 bg-primary text-gray-900 rounded-button font-medium hover:bg-opacity-80 transition-colors cursor-pointer whitespace-nowrap">
                        Сохранить изменения
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
function previewAvatar(input) {
    if (input.files && input.files[0]) {
        const file = input.files[0];

        // Проверка размера файла (5MB)
        if (file.size > 5 * 1024 * 1024) {
            alert('Размер файла не должен превышать 5MB');
            input.value = '';
            return;
        }

        // Проверка типа файла
        const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/webp'];
        if (!allowedTypes.includes(file.type)) {
            alert('Разрешены только изображения: JPEG, PNG, JPG, GIF, WEBP');
            input.value = '';
            return;
        }

        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById('avatar-preview');
            const placeholder = document.getElementById('avatar-placeholder');

            if (preview) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            } else {
                const img = document.createElement('img');
                img.id = 'avatar-preview';
                img.src = e.target.result;
                img.className = 'w-full h-full object-cover object-top';
                img.alt = 'Avatar';

                const container = input.closest('.relative').querySelector('.w-24');
                if (placeholder) {
                    placeholder.remove();
                }
                container.appendChild(img);
            }

            if (placeholder && placeholder.parentNode) {
                placeholder.style.display = 'none';
            }
        };
        reader.readAsDataURL(file);
    }
}
</script>

@endsection

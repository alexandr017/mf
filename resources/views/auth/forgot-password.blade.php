@extends('site.v1.layouts.default')

@section('title', 'Восстановление пароля - Pircl')

@section('content')
<style>
    .hero-bg {
        background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
    }
    .login-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }
    .floating-animation {
        animation: float 6s ease-in-out infinite;
    }
    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-20px); }
    }
    .pulse-glow {
        animation: pulse-glow 2s infinite;
    }
    @keyframes pulse-glow {
        0%, 100% { box-shadow: 0 0 20px rgba(127, 255, 0, 0.4); }
        50% { box-shadow: 0 0 30px rgba(127, 255, 0, 0.6); }
    }
</style>

<div class="min-h-screen flex items-center justify-center px-4 sm:px-6 lg:px-8 relative overflow-hidden py-12 hero-bg">
    <!-- Background Graphics -->
    <div class="absolute inset-0 z-0">
        <div class="absolute top-10 left-10 w-32 h-32 bg-primary opacity-10 rounded-full floating-animation"></div>
        <div class="absolute top-1/3 right-20 w-24 h-24 bg-secondary opacity-10 rounded-full floating-animation" style="animation-delay: -2s;"></div>
        <div class="absolute bottom-20 left-1/4 w-40 h-40 bg-primary opacity-5 rounded-full floating-animation" style="animation-delay: -4s;"></div>
        <div class="absolute bottom-1/3 right-1/3 w-28 h-28 bg-secondary opacity-8 rounded-full floating-animation" style="animation-delay: -1s;"></div>
    </div>

    <!-- Main Content -->
    <div class="max-w-md w-full space-y-8 z-10 relative">
        <!-- Header -->
        <div class="text-center">
            <div class="flex justify-center mb-6">
                <span class="text-5xl font-['Pacifico'] text-primary pulse-glow">logo</span>
            </div>
            <h1 class="heading-font text-4xl text-gray-900 mb-2">Забыли пароль?</h1>
            <p class="text-lg text-gray-600">Введите ваш email и мы отправим вам ссылку для восстановления пароля</p>
        </div>

        <!-- Forgot Password Form -->
        <div class="login-card rounded-xl shadow-2xl p-8">
            @if (session('status'))
                <div class="mb-4 p-4 bg-green-50 border border-green-200 rounded-button">
                    <p class="text-sm text-green-600">{{ session('status') }}</p>
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-button">
                    <ul class="list-disc list-inside text-sm text-red-600">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form class="space-y-6" method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email Field -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email адрес</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <div class="w-5 h-5 flex items-center justify-center">
                                <i class="ri-mail-line text-gray-400 text-sm"></i>
                            </div>
                        </div>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-button focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent text-sm" placeholder="Введите ваш email">
                    </div>
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full bg-primary text-gray-900 py-3 px-4 rounded-button font-semibold hover:bg-opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-all duration-200 transform hover:scale-105 cursor-pointer whitespace-nowrap">
                    Отправить ссылку для восстановления
                </button>

                <!-- Back to Login Link -->
                <div class="text-center">
                    <p class="text-sm text-gray-600">
                        Вспомнили пароль?
                        <a href="{{ route('login') }}" class="text-primary hover:text-opacity-80 font-medium cursor-pointer">Войти</a>
                    </p>
                </div>
            </form>
        </div>

        <!-- Info Box -->
        <div class="bg-blue-50 border border-blue-200 rounded-xl p-6">
            <div class="flex items-start">
                <div class="w-8 h-8 mr-3 flex items-center justify-center flex-shrink-0">
                    <i class="ri-information-line text-blue-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-blue-900 mb-2">Важная информация</h3>
                    <ul class="text-xs text-blue-800 space-y-1">
                        <li>• Ссылка для восстановления пароля действительна в течение 24 часов</li>
                        <li>• Если письмо не пришло в течение 10 минут, проверьте папку "Спам"</li>
                        <li>• Убедитесь, что вы ввели правильный email адрес</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

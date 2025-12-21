@extends('site.v1.layouts.default')

@section('title', 'Сброс пароля - Pircl')

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
    .password-toggle:hover {
        background-color: rgba(127, 255, 0, 0.1);
    }
    .strength-meter {
        height: 4px;
        border-radius: 2px;
        transition: all 0.3s ease;
    }
    .strength-weak { background: #ef4444; width: 25%; }
    .strength-fair { background: #f59e0b; width: 50%; }
    .strength-good { background: #10b981; width: 75%; }
    .strength-strong { background: #059669; width: 100%; }
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
            <h1 class="heading-font text-4xl text-gray-900 mb-2">Сброс пароля</h1>
            <p class="text-lg text-gray-600">Введите новый пароль для вашего аккаунта</p>
        </div>

        <!-- Reset Password Form -->
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

            <form class="space-y-6" method="POST" action="{{ route('password.store') }}">
                @csrf

                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- Email Address -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email адрес</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <div class="w-5 h-5 flex items-center justify-center">
                                <i class="ri-mail-line text-gray-400 text-sm"></i>
                            </div>
                        </div>
                        <input type="email" id="email" name="email" value="{{ old('email', $request->email) }}" required autofocus class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-button focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent text-sm" placeholder="Введите ваш email">
                    </div>
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password Field -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Новый пароль</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <div class="w-5 h-5 flex items-center justify-center">
                                <i class="ri-lock-line text-gray-400 text-sm"></i>
                            </div>
                        </div>
                        <input type="password" id="password" name="password" required class="w-full pl-10 pr-12 py-3 border border-gray-300 rounded-button focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent text-sm" placeholder="Введите новый пароль">
                        <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center password-toggle rounded-r-button cursor-pointer">
                            <div class="w-5 h-5 flex items-center justify-center">
                                <i class="ri-eye-line text-gray-400 text-sm password-icon"></i>
                            </div>
                        </button>
                    </div>
                    <div class="mt-2">
                        <div class="flex items-center justify-between mb-1">
                            <span class="text-xs text-gray-500">Надёжность пароля</span>
                            <span class="text-xs text-gray-500 strength-text">Слабый</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-1">
                            <div class="strength-meter bg-gray-300 rounded-full"></div>
                        </div>
                    </div>
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password Field -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Подтвердите пароль</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <div class="w-5 h-5 flex items-center justify-center">
                                <i class="ri-shield-check-line text-gray-400 text-sm"></i>
                            </div>
                        </div>
                        <input type="password" id="password_confirmation" name="password_confirmation" required class="w-full pl-10 pr-12 py-3 border border-gray-300 rounded-button focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent text-sm" placeholder="Подтвердите новый пароль">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <div class="w-5 h-5 flex items-center justify-center password-match-status hidden">
                                <i class="ri-check-line text-green-500 text-sm"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full bg-primary text-gray-900 py-3 px-4 rounded-button font-semibold hover:bg-opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-all duration-200 transform hover:scale-105 cursor-pointer whitespace-nowrap">
                    Сбросить пароль
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
    </div>
</div>

<script>
    // Password toggle
    document.addEventListener('DOMContentLoaded', function() {
        const passwordInput = document.getElementById('password');
        const passwordToggle = document.querySelector('.password-toggle');
        const passwordIcon = document.querySelector('.password-icon');

        if (passwordToggle && passwordInput && passwordIcon) {
            passwordToggle.addEventListener('click', function() {
                const isPassword = passwordInput.type === 'password';
                passwordInput.type = isPassword ? 'text' : 'password';
                passwordIcon.className = isPassword ? 'ri-eye-off-line text-gray-400 text-sm password-icon' : 'ri-eye-line text-gray-400 text-sm password-icon';
            });
        }

        // Password strength
        const strengthMeter = document.querySelector('.strength-meter');
        const strengthText = document.querySelector('.strength-text');
        const confirmPasswordInput = document.getElementById('password_confirmation');
        const passwordMatchStatus = document.querySelector('.password-match-status');

        function calculateStrength(password) {
            let score = 0;
            if (password.length >= 8) score += 1;
            if (password.match(/[a-z]/)) score += 1;
            if (password.match(/[A-Z]/)) score += 1;
            if (password.match(/[0-9]/)) score += 1;
            if (password.match(/[^a-zA-Z0-9]/)) score += 1;
            return score;
        }

        function updateStrengthDisplay(strength) {
            strengthMeter.className = 'strength-meter';
            switch (strength) {
                case 0:
                case 1:
                    strengthMeter.classList.add('strength-weak');
                    strengthText.textContent = 'Слабый';
                    break;
                case 2:
                    strengthMeter.classList.add('strength-fair');
                    strengthText.textContent = 'Средний';
                    break;
                case 3:
                case 4:
                    strengthMeter.classList.add('strength-good');
                    strengthText.textContent = 'Хороший';
                    break;
                case 5:
                    strengthMeter.classList.add('strength-strong');
                    strengthText.textContent = 'Надёжный';
                    break;
            }
        }

        if (passwordInput && strengthMeter && strengthText) {
            passwordInput.addEventListener('input', function() {
                const strength = calculateStrength(this.value);
                updateStrengthDisplay(strength);
            });
        }

        // Password match check
        if (confirmPasswordInput && passwordInput && passwordMatchStatus) {
            confirmPasswordInput.addEventListener('input', function() {
                const password = passwordInput.value;
                const confirmPassword = this.value;

                if (confirmPassword && password === confirmPassword) {
                    passwordMatchStatus.classList.remove('hidden');
                } else {
                    passwordMatchStatus.classList.add('hidden');
                }
            });
        }
    });
</script>
@endsection

@extends('site.v1.layouts.default')

@section('title', 'Регистрация - Pircl')

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
            <h1 class="heading-font text-4xl text-gray-900 mb-2">Присоединяйтесь к лиге!</h1>
            <p class="text-lg text-gray-600">Создайте аккаунт в Pircl</p>
        </div>

        <!-- Register Form -->
        <div class="login-card rounded-xl shadow-2xl p-8">
            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-button">
                    <ul class="list-disc list-inside text-sm text-red-600">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form class="space-y-6" id="register-form" method="POST" action="{{ route('register') }}">
                @csrf
                <!-- Скрытое поле для реферального кода -->
                @if(isset($referralCode) && $referralCode)
                    <input type="hidden" name="referral_code" id="referral_code" value="{{ $referralCode }}">
                @else
                    <input type="hidden" name="referral_code" id="referral_code" value="">
                @endif
                <!-- Full Name Field -->
                <div>
                    <label for="fullName" class="block text-sm font-medium text-gray-700 mb-2">Полное имя</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <div class="w-5 h-5 flex items-center justify-center">
                                <i class="ri-user-line text-gray-400 text-sm"></i>
                            </div>
                        </div>
                        <input type="text" id="fullName" name="name" required class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-button focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent text-sm" placeholder="Введите ваше полное имя">
                    </div>
                </div>

                <!-- Username Field -->
                <div>
                    <label for="username" class="block text-sm font-medium text-gray-700 mb-2">Никнейм</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <div class="w-5 h-5 flex items-center justify-center">
                                <i class="ri-at-line text-gray-400 text-sm"></i>
                            </div>
                        </div>
                        <input type="text" id="username" name="username" class="w-full pl-10 pr-12 py-3 border border-gray-300 rounded-button focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent text-sm" placeholder="Выберите никнейм (необязательно)">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <div class="w-5 h-5 flex items-center justify-center username-status hidden">
                                <i class="ri-check-line text-green-500 text-sm"></i>
                            </div>
                        </div>
                    </div>
                    <div class="text-xs text-gray-500 mt-1">Никнейм должен содержать 3-20 символов, только буквы и цифры</div>
                </div>

                <!-- Email Field -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email адрес</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <div class="w-5 h-5 flex items-center justify-center">
                                <i class="ri-mail-line text-gray-400 text-sm"></i>
                            </div>
                        </div>
                        <input type="email" id="email" name="email" required class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-button focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent text-sm" placeholder="Введите ваш email">
                    </div>
                </div>

                <!-- Password Field -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Пароль</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <div class="w-5 h-5 flex items-center justify-center">
                                <i class="ri-lock-line text-gray-400 text-sm"></i>
                            </div>
                        </div>
                        <input type="password" id="password" name="password" required class="w-full pl-10 pr-12 py-3 border border-gray-300 rounded-button focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent text-sm" placeholder="Создайте пароль">
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
                </div>

                <!-- Confirm Password Field -->
                <div>
                    <label for="confirmPassword" class="block text-sm font-medium text-gray-700 mb-2">Подтвердите пароль</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <div class="w-5 h-5 flex items-center justify-center">
                                <i class="ri-shield-check-line text-gray-400 text-sm"></i>
                            </div>
                        </div>
                        <input type="password" id="confirmPassword" name="password_confirmation" required class="w-full pl-10 pr-12 py-3 border border-gray-300 rounded-button focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent text-sm" placeholder="Подтвердите ваш пароль">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <div class="w-5 h-5 flex items-center justify-center password-match-status hidden">
                                <i class="ri-check-line text-green-500 text-sm"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Terms and Privacy -->
                <div class="flex items-start">
                    <input type="checkbox" id="terms" name="terms" required class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded mt-1">
                    <label for="terms" class="ml-3 block text-sm text-gray-700 cursor-pointer">
                        Я согласен с <a href="/terms" target="_blank" class="text-primary hover:text-opacity-80 font-medium">Условиями использования</a> и <a href="/policy" target="_blank" class="text-primary hover:text-opacity-80 font-medium">Политикой конфиденциальности</a>
                    </label>
                </div>

                <!-- Newsletter Subscription -->
                <div class="flex items-center">
                    <input type="checkbox" id="newsletter" name="newsletter" class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded">
                    <label for="newsletter" class="ml-3 block text-sm text-gray-700 cursor-pointer">
                        Подписаться на рассылку для получения обновлений и эксклюзивного контента
                    </label>
                </div>

                <!-- Register Button -->
                <button type="submit" class="w-full bg-primary text-gray-900 py-3 px-4 rounded-button font-semibold hover:bg-opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-all duration-200 transform hover:scale-105 cursor-pointer whitespace-nowrap">
                    Создать аккаунт
                </button>

                <!-- Divider -->
                <div class="relative my-6">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-300"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-4 bg-white text-gray-500">Или зарегистрируйтесь через</span>
                    </div>
                </div>

                <!-- Social Login Buttons -->
                <div class="grid grid-cols-2 gap-4">
                    <a href="{{ route('social.redirect', 'google') }}" class="flex items-center justify-center px-4 py-3 border border-gray-300 rounded-button bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-primary transition-colors cursor-pointer whitespace-nowrap">
                        <div class="w-5 h-5 flex items-center justify-center mr-3">
                            <i class="ri-google-fill text-red-500"></i>
                        </div>
                        <span class="text-sm font-medium text-gray-700">Google</span>
                    </a>
                    <a href="{{ route('social.redirect', 'facebook') }}" class="flex items-center justify-center px-4 py-3 border border-gray-300 rounded-button bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-primary transition-colors cursor-pointer whitespace-nowrap">
                        <div class="w-5 h-5 flex items-center justify-center mr-3">
                            <i class="ri-facebook-fill text-blue-600"></i>
                        </div>
                        <span class="text-sm font-medium text-gray-700">Facebook</span>
                    </a>
                    <a href="{{ route('social.redirect', 'vk') }}" class="flex items-center justify-center px-4 py-3 border border-gray-300 rounded-button bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-primary transition-colors cursor-pointer whitespace-nowrap">
                        <div class="w-5 h-5 flex items-center justify-center mr-3">
                            <i class="ri-vk-fill text-blue-700"></i>
                        </div>
                        <span class="text-sm font-medium text-gray-700">VK</span>
                    </a>
                    <a href="{{ route('social.redirect', 'yandex') }}" class="flex items-center justify-center px-4 py-3 border border-gray-300 rounded-button bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-primary transition-colors cursor-pointer whitespace-nowrap">
                        <div class="w-5 h-5 flex items-center justify-center mr-3">
                            <span class="text-red-600 font-bold text-sm">Я</span>
                        </div>
                        <span class="text-sm font-medium text-gray-700">Yandex</span>
                    </a>
                    <a href="{{ route('social.redirect', 'odnoklassniki') }}" class="flex items-center justify-center px-4 py-3 border border-gray-300 rounded-button bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-primary transition-colors cursor-pointer whitespace-nowrap col-span-2">
                        <div class="w-5 h-5 flex items-center justify-center mr-3">
                            <i class="ri-odnoklassniki-fill text-orange-500"></i>
                        </div>
                        <span class="text-sm font-medium text-gray-700">Odnoklassniki</span>
                    </a>
                </div>

                <!-- Sign In Link -->
                <div class="text-center">
                    <p class="text-sm text-gray-600">
                        Уже есть аккаунт?
                        <a href="{{ route('login') }}" class="text-primary hover:text-opacity-80 font-medium cursor-pointer">Войти здесь</a>
                    </p>
                </div>
            </form>
        </div>

        @include('site.v1.modules.auth-features.auth-features')
    </div>

    <!-- Loading Overlay -->
    <div id="loading-overlay" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-xl p-8 max-w-sm w-full mx-4">
            <div class="text-center">
                <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-primary mx-auto mb-4"></div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Создание аккаунта...</h3>
                <p class="text-gray-600 text-sm">Пожалуйста, подождите, пока мы настраиваем ваш профиль</p>
            </div>
        </div>
    </div>

    <script id="referral-handler">
        document.addEventListener('DOMContentLoaded', function() {
            // Получаем реферальный код из URL
            const urlParams = new URLSearchParams(window.location.search);
            const refCode = urlParams.get('ref');

            // Если есть реферальный код в URL, сохраняем его в localStorage
            if (refCode) {
                localStorage.setItem('referral_code', refCode);
                // Устанавливаем значение в скрытое поле
                const referralInput = document.getElementById('referral_code');
                if (referralInput) {
                    referralInput.value = refCode;
                }
            } else {
                // Если нет в URL, проверяем localStorage
                const storedRefCode = localStorage.getItem('referral_code');
                if (storedRefCode) {
                    const referralInput = document.getElementById('referral_code');
                    if (referralInput) {
                        referralInput.value = storedRefCode;
                    }
                }
            }

            // При отправке формы сохраняем реферальный код
            const registerForm = document.getElementById('register-form');
            if (registerForm) {
                registerForm.addEventListener('submit', function() {
                    const refCode = document.getElementById('referral_code')?.value;
                    if (refCode) {
                        // Сохраняем в localStorage на случай, если форма не отправится
                        localStorage.setItem('referral_code', refCode);
                    }
                });

                // После успешной отправки формы очищаем localStorage
                registerForm.addEventListener('submit', function(e) {
                    // Очистка произойдет после успешной регистрации
                    // (можно добавить через событие успешной регистрации)
                });
            }

            // Показываем уведомление, если пользователь пришел по реферальной ссылке
            const referralInput = document.getElementById('referral_code');
            if (referralInput && referralInput.value) {
                const notification = document.createElement('div');
                notification.className = 'mb-4 p-4 bg-primary bg-opacity-10 border border-primary rounded-button';
                notification.innerHTML = `
                    <div class="flex items-center">
                        <i class="ri-gift-line text-primary text-xl mr-3"></i>
                        <div>
                            <p class="text-sm font-medium text-gray-900">Вы регистрируетесь по реферальной ссылке!</p>
                            <p class="text-xs text-gray-600 mt-1">Вы получите бонусы после регистрации</p>
                        </div>
                    </div>
                `;
                const form = document.getElementById('register-form');
                if (form && form.parentNode) {
                    form.parentNode.insertBefore(notification, form);
                }
            }
        });
    </script>
</div>
@endsection

@section('additional-scripts')
<script id="password-toggle">
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
    });
</script>

<script id="password-strength">
    document.addEventListener('DOMContentLoaded', function() {
        const passwordInput = document.getElementById('password');
        const strengthMeter = document.querySelector('.strength-meter');
        const strengthText = document.querySelector('.strength-text');

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

        passwordInput.addEventListener('input', function() {
            const strength = calculateStrength(this.value);
            updateStrengthDisplay(strength);
        });
    });
</script>

<script id="form-validation">
    document.addEventListener('DOMContentLoaded', function() {
        const registerForm = document.getElementById('register-form');
        const fullNameInput = document.getElementById('fullName');
        const usernameInput = document.getElementById('username');
        const emailInput = document.getElementById('email');
        const passwordInput = document.getElementById('password');
        const confirmPasswordInput = document.getElementById('confirmPassword');
        const termsCheckbox = document.getElementById('terms');
        const loadingOverlay = document.getElementById('loading-overlay');
        const usernameStatus = document.querySelector('.username-status');
        const passwordMatchStatus = document.querySelector('.password-match-status');

        const existingUsernames = ['admin', 'user', 'test', 'messi', 'ronaldo', 'player1'];

        function validateEmail(email) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }

        function validateUsername(username) {
            const usernameRegex = /^[a-zA-Z0-9]{3,20}$/;
            return usernameRegex.test(username) && !existingUsernames.includes(username.toLowerCase());
        }

        function showError(input, message) {
            removeError(input);
            const errorDiv = document.createElement('div');
            errorDiv.className = 'text-red-500 text-xs mt-1 error-message';
            errorDiv.textContent = message;
            input.parentNode.appendChild(errorDiv);
            input.classList.add('border-red-500', 'focus:ring-red-500', 'focus:border-red-500');
            input.classList.remove('border-gray-300', 'focus:ring-primary', 'focus:border-transparent');
        }

        function removeError(input) {
            const errorDiv = input.parentNode.querySelector('.error-message');
            if (errorDiv) {
                errorDiv.remove();
            }
            input.classList.remove('border-red-500', 'focus:ring-red-500', 'focus:border-red-500');
            input.classList.add('border-gray-300', 'focus:ring-primary', 'focus:border-transparent');
        }

        function showNotification(message, type = 'success') {
            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 px-6 py-3 rounded-button shadow-lg z-50 ${type === 'success' ? 'bg-primary text-gray-900' : 'bg-red-500 text-white'}`;
            notification.textContent = message;
            document.body.appendChild(notification);

            setTimeout(() => {
                notification.remove();
            }, 3000);
        }

        fullNameInput.addEventListener('input', function() {
            if (this.value.trim().length >= 2) {
                removeError(this);
            }
        });

        usernameInput.addEventListener('input', function() {
            const username = this.value.trim();
            if (username.length >= 3) {
                if (validateUsername(username)) {
                    removeError(this);
                    usernameStatus.classList.remove('hidden');
                    usernameStatus.innerHTML = '<i class="ri-check-line text-green-500 text-sm"></i>';
                } else {
                    usernameStatus.classList.add('hidden');
                    if (existingUsernames.includes(username.toLowerCase())) {
                        showError(this, 'Никнейм уже занят');
                    } else {
                        showError(this, 'Никнейм должен содержать 3-20 символов, только буквы и цифры');
                    }
                }
            } else {
                usernameStatus.classList.add('hidden');
                if (username.length > 0) {
                    showError(this, 'Никнейм должен содержать минимум 3 символа');
                }
            }
        });

        emailInput.addEventListener('input', function() {
            if (this.value.trim() && validateEmail(this.value.trim())) {
                removeError(this);
            }
        });

        confirmPasswordInput.addEventListener('input', function() {
            const password = passwordInput.value;
            const confirmPassword = this.value;

            if (confirmPassword && password === confirmPassword) {
                removeError(this);
                passwordMatchStatus.classList.remove('hidden');
                passwordMatchStatus.innerHTML = '<i class="ri-check-line text-green-500 text-sm"></i>';
            } else {
                passwordMatchStatus.classList.add('hidden');
                if (confirmPassword && password !== confirmPassword) {
                    showError(this, 'Пароли не совпадают');
                }
            }
        });

        registerForm.addEventListener('submit', function(e) {
            let isValid = true;

            const fullName = fullNameInput.value.trim();
            const username = usernameInput.value.trim();
            const email = emailInput.value.trim();
            const password = passwordInput.value.trim();
            const confirmPassword = confirmPasswordInput.value.trim();
            const termsAccepted = termsCheckbox.checked;

            if (!fullName || fullName.length < 2) {
                e.preventDefault();
                showError(fullNameInput, 'Полное имя обязательно (минимум 2 символа)');
                isValid = false;
            }

            if (username && !validateUsername(username)) {
                e.preventDefault();
                showError(usernameInput, existingUsernames.includes(username.toLowerCase()) ? 'Никнейм уже занят' : 'Неверный формат никнейма');
                isValid = false;
            }

            if (!email) {
                e.preventDefault();
                showError(emailInput, 'Email адрес обязателен');
                isValid = false;
            } else if (!validateEmail(email)) {
                e.preventDefault();
                showError(emailInput, 'Пожалуйста, введите корректный email адрес');
                isValid = false;
            }

            if (!password) {
                e.preventDefault();
                showError(passwordInput, 'Пароль обязателен');
                isValid = false;
            } else if (password.length < 6) {
                e.preventDefault();
                showError(passwordInput, 'Пароль должен содержать минимум 6 символов');
                isValid = false;
            }

            if (!confirmPassword) {
                e.preventDefault();
                showError(confirmPasswordInput, 'Пожалуйста, подтвердите пароль');
                isValid = false;
            } else if (password !== confirmPassword) {
                e.preventDefault();
                showError(confirmPasswordInput, 'Пароли не совпадают');
                isValid = false;
            }

            if (!termsAccepted) {
                e.preventDefault();
                showNotification('Пожалуйста, примите Условия использования и Политику конфиденциальности', 'error');
                isValid = false;
            }

            // Если валидация прошла, форма отправится стандартным способом
            if (isValid) {
                loadingOverlay.classList.remove('hidden');
            }
        });

        const socialButtons = document.querySelectorAll('button[type="button"]');
        socialButtons.forEach(button => {
            if (button.textContent.includes('Google') || button.textContent.includes('Facebook')) {
                button.addEventListener('click', function() {
                    const provider = this.textContent.includes('Google') ? 'Google' : 'Facebook';
                    showNotification(`${provider} registration coming soon!`, 'error');
                });
            }
        });
    });
</script>

<script id="interactive-enhancements">
    document.addEventListener('DOMContentLoaded', function() {
        const inputs = document.querySelectorAll('input[type="text"], input[type="email"], input[type="password"]');

        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentNode.classList.add('ring-2', 'ring-primary', 'ring-opacity-50');
            });

            input.addEventListener('blur', function() {
                this.parentNode.classList.remove('ring-2', 'ring-primary', 'ring-opacity-50');
            });
        });

    });
</script>
@endsection

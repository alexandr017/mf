@extends('site.v1.layouts.default')

@section('content')
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
            <h1 class="heading-font text-4xl text-gray-900 mb-2">С возвращением!</h1>
            <p class="text-lg text-gray-600">Войдите в свой аккаунт Pircl</p>
        </div>

        <!-- Login Form -->
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

            <form class="space-y-6" id="login-form" method="POST" action="{{ route('login') }}">
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
                        <input type="password" id="password" name="password" required class="w-full pl-10 pr-12 py-3 border border-gray-300 rounded-button focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent text-sm" placeholder="Введите ваш пароль">
                        <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center password-toggle rounded-r-button cursor-pointer">
                            <div class="w-5 h-5 flex items-center justify-center">
                                <i class="ri-eye-line text-gray-400 text-sm password-icon"></i>
                            </div>
                        </button>
                    </div>
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input type="checkbox" id="remember" name="remember" class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded">
                        <label for="remember" class="ml-2 block text-sm text-gray-700 cursor-pointer">Запомнить меня</label>
                    </div>
                    <a href="{{ route('password.request') }}" class="text-sm text-primary hover:text-opacity-80 font-medium cursor-pointer">
                        Забыли пароль?
                    </a>
                </div>

                <!-- Login Button -->
                <button type="submit" class="w-full bg-primary text-gray-900 py-3 px-4 rounded-button font-semibold hover:bg-opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-all duration-200 transform hover:scale-105 cursor-pointer whitespace-nowrap">
                    Войти
                </button>

                <!-- Divider -->
                <div class="relative my-6">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-300"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-4 bg-white text-gray-500">Или войдите через</span>
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

                <!-- Sign Up Link -->
                <div class="text-center">
                    <p class="text-sm text-gray-600">
                        Нет аккаунта?
                        <a href="{{ route('register') }}" class="text-primary hover:text-opacity-80 font-medium cursor-pointer">Зарегистрируйтесь здесь</a>
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
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Вход в систему...</h3>
                <p class="text-gray-600 text-sm">Пожалуйста, подождите, пока мы проверяем ваши данные</p>
            </div>
        </div>
    </div>

</div>


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

<script id="form-validation">
    document.addEventListener('DOMContentLoaded', function() {
        const loginForm = document.getElementById('login-form');
        const emailInput = document.getElementById('email');
        const passwordInput = document.getElementById('password');
        const loadingOverlay = document.getElementById('loading-overlay');

        function validateEmail(email) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
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

        emailInput.addEventListener('input', function() {
            if (this.value) {
                removeError(this);
            }
        });

        passwordInput.addEventListener('input', function() {
            if (this.value) {
                removeError(this);
            }
        });

        loginForm.addEventListener('submit', function(e) {
            let isValid = true;

            const email = emailInput.value.trim();
            const password = passwordInput.value.trim();

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

            // Если валидация прошла, форма отправится стандартным способом
            if (isValid) {
                loadingOverlay.classList.remove('hidden');
            }
        });

        const socialButtons = document.querySelectorAll('[type="button"]');
        socialButtons.forEach(button => {
            if (button.textContent.includes('Google') || button.textContent.includes('Facebook')) {
                button.addEventListener('click', function() {
                    const provider = this.textContent.includes('Google') ? 'Google' : 'Facebook';
                    showNotification(`${provider} authentication coming soon!`, 'error');
                });
            }
        });
    });
</script>

<script id="interactive-enhancements">
    document.addEventListener('DOMContentLoaded', function() {
        const inputs = document.querySelectorAll('input[type="email"], input[type="password"]');

        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentNode.classList.add('ring-2', 'ring-primary', 'ring-opacity-50');
            });

            input.addEventListener('blur', function() {
                this.parentNode.classList.remove('ring-2', 'ring-primary', 'ring-opacity-50');
            });
        });

        const rememberCheckbox = document.getElementById('remember-me');
        if (rememberCheckbox) {
            rememberCheckbox.addEventListener('change', function() {
                if (this.checked) {
                    localStorage.setItem('rememberLogin', 'true');
                } else {
                    localStorage.removeItem('rememberLogin');
                }
            });

            if (localStorage.getItem('rememberLogin') === 'true') {
                rememberCheckbox.checked = true;
            }
        }

        const forgotPasswordLink = document.querySelector('a[href="#"]:not([class*="text-primary"]):not([href="#"]):first-of-type');
        if (forgotPasswordLink && forgotPasswordLink.textContent.includes('Forgot')) {
            forgotPasswordLink.addEventListener('click', function(e) {
                e.preventDefault();

                const email = document.getElementById('email').value.trim();
                if (!email) {
                    document.getElementById('email').focus();
                    showNotification('Пожалуйста, сначала введите ваш email адрес', 'error');
                    return;
                }

                const modal = document.createElement('div');
                modal.className = 'fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50';
                modal.innerHTML = `
<div class="bg-white rounded-xl p-8 max-w-md w-full mx-4">
<div class="text-center">
<div class="w-16 h-16 bg-primary bg-opacity-20 rounded-full flex items-center justify-center mx-auto mb-4">
<div class="w-8 h-8 flex items-center justify-center">
<i class="ri-mail-send-line text-primary text-xl"></i>
</div>
</div>
<h3 class="text-xl font-semibold text-gray-900 mb-2">Сброс пароля</h3>
<p class="text-gray-600 mb-6">Мы отправим ссылку для сброса пароля на <strong>${email}</strong></p>
<div class="flex space-x-4">
<button type="button" class="flex-1 px-4 py-2 bg-gray-100 text-gray-700 rounded-button font-medium hover:bg-gray-200 transition-colors cursor-pointer whitespace-nowrap modal-close">
Отмена
</button>
<button type="button" class="flex-1 px-4 py-2 bg-primary text-gray-900 rounded-button font-medium hover:bg-opacity-90 transition-colors cursor-pointer whitespace-nowrap reset-confirm">
Отправить ссылку
</button>
</div>
</div>
</div>
`;

                document.body.appendChild(modal);

                modal.querySelector('.modal-close').addEventListener('click', function() {
                    modal.remove();
                });

                modal.querySelector('.reset-confirm').addEventListener('click', function() {
                    modal.remove();
                    showNotification(`Ссылка для сброса пароля отправлена на ${email}`);
                });

                modal.addEventListener('click', function(e) {
                    if (e.target === modal) {
                        modal.remove();
                    }
                });
            });
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
    });
</script>

@endsection

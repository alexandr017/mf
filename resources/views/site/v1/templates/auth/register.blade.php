
<!DOCTYPE html>
<html lang="en">
<head><script src="https://static.readdy.ai/static/e.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Meme Football League</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bangers&family=Rubik:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css">
    <script src="https://cdn.tailwindcss.com/3.4.16"></script>
    <script>tailwind.config={theme:{extend:{colors:{primary:'#7FFF00',secondary:'#FF355E'},borderRadius:{'none':'0px','sm':'4px',DEFAULT:'8px','md':'12px','lg':'16px','xl':'20px','2xl':'24px','3xl':'32px','full':'9999px','button':'8px'}}}}</script>
    <style>
        :where([class^="ri-"])::before { content: "\f3c2"; }
        body {
            font-family: 'Rubik', sans-serif;
        }
        .heading-font {
            font-family: 'Bangers', cursive;
            letter-spacing: 1px;
        }
        .hero-bg {
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
        }
        .login-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .gradient-text {
            background: linear-gradient(135deg, #7FFF00 0%, #32CD32 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
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
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
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
</head>
<body class="min-h-screen hero-bg">
<div class="min-h-screen flex items-center justify-center px-4 sm:px-6 lg:px-8 relative overflow-hidden py-12">
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
            <h1 class="heading-font text-4xl text-gray-900 mb-2">Join the League!</h1>
            <p class="text-lg text-gray-600">Create your Meme Football League account</p>
        </div>

        <!-- Register Form -->
        <div class="login-card rounded-xl shadow-2xl p-8">
            <form class="space-y-6" id="register-form">
                <!-- Full Name Field -->
                <div>
                    <label for="fullName" class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <div class="w-5 h-5 flex items-center justify-center">
                                <i class="ri-user-line text-gray-400 text-sm"></i>
                            </div>
                        </div>
                        <input type="text" id="fullName" name="fullName" required class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-button focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent text-sm" placeholder="Enter your full name">
                    </div>
                </div>

                <!-- Username Field -->
                <div>
                    <label for="username" class="block text-sm font-medium text-gray-700 mb-2">Username</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <div class="w-5 h-5 flex items-center justify-center">
                                <i class="ri-at-line text-gray-400 text-sm"></i>
                            </div>
                        </div>
                        <input type="text" id="username" name="username" required class="w-full pl-10 pr-12 py-3 border border-gray-300 rounded-button focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent text-sm" placeholder="Choose a username">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <div class="w-5 h-5 flex items-center justify-center username-status hidden">
                                <i class="ri-check-line text-green-500 text-sm"></i>
                            </div>
                        </div>
                    </div>
                    <div class="text-xs text-gray-500 mt-1">Username must be 3-20 characters, letters and numbers only</div>
                </div>

                <!-- Email Field -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <div class="w-5 h-5 flex items-center justify-center">
                                <i class="ri-mail-line text-gray-400 text-sm"></i>
                            </div>
                        </div>
                        <input type="email" id="email" name="email" required class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-button focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent text-sm" placeholder="Enter your email">
                    </div>
                </div>

                <!-- Password Field -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <div class="w-5 h-5 flex items-center justify-center">
                                <i class="ri-lock-line text-gray-400 text-sm"></i>
                            </div>
                        </div>
                        <input type="password" id="password" name="password" required class="w-full pl-10 pr-12 py-3 border border-gray-300 rounded-button focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent text-sm" placeholder="Create a password">
                        <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center password-toggle rounded-r-button cursor-pointer">
                            <div class="w-5 h-5 flex items-center justify-center">
                                <i class="ri-eye-line text-gray-400 text-sm password-icon"></i>
                            </div>
                        </button>
                    </div>
                    <div class="mt-2">
                        <div class="flex items-center justify-between mb-1">
                            <span class="text-xs text-gray-500">Password strength</span>
                            <span class="text-xs text-gray-500 strength-text">Weak</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-1">
                            <div class="strength-meter bg-gray-300 rounded-full"></div>
                        </div>
                    </div>
                </div>

                <!-- Confirm Password Field -->
                <div>
                    <label for="confirmPassword" class="block text-sm font-medium text-gray-700 mb-2">Confirm Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <div class="w-5 h-5 flex items-center justify-center">
                                <i class="ri-shield-check-line text-gray-400 text-sm"></i>
                            </div>
                        </div>
                        <input type="password" id="confirmPassword" name="confirmPassword" required class="w-full pl-10 pr-12 py-3 border border-gray-300 rounded-button focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent text-sm" placeholder="Confirm your password">
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
                        I agree to the <a href="#" class="text-primary hover:text-opacity-80 font-medium">Terms of Service</a> and <a href="#" class="text-primary hover:text-opacity-80 font-medium">Privacy Policy</a>
                    </label>
                </div>

                <!-- Newsletter Subscription -->
                <div class="flex items-center">
                    <input type="checkbox" id="newsletter" name="newsletter" class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded">
                    <label for="newsletter" class="ml-3 block text-sm text-gray-700 cursor-pointer">
                        Subscribe to newsletter for updates and exclusive content
                    </label>
                </div>

                <!-- Register Button -->
                <button type="submit" class="w-full bg-primary text-gray-900 py-3 px-4 rounded-button font-semibold hover:bg-opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-all duration-200 transform hover:scale-105 cursor-pointer whitespace-nowrap">
                    Create Account
                </button>

                <!-- Divider -->
                <div class="relative my-6">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-300"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-4 bg-white text-gray-500">Or sign up with</span>
                    </div>
                </div>

                <!-- Social Login Buttons -->
                <div class="grid grid-cols-2 gap-4">
                    <button type="button" class="flex items-center justify-center px-4 py-3 border border-gray-300 rounded-button bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-primary transition-colors cursor-pointer whitespace-nowrap">
                        <div class="w-5 h-5 flex items-center justify-center mr-3">
                            <i class="ri-google-fill text-red-500"></i>
                        </div>
                        <span class="text-sm font-medium text-gray-700">Google</span>
                    </button>
                    <button type="button" class="flex items-center justify-center px-4 py-3 border border-gray-300 rounded-button bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-primary transition-colors cursor-pointer whitespace-nowrap">
                        <div class="w-5 h-5 flex items-center justify-center mr-3">
                            <i class="ri-facebook-fill text-blue-600"></i>
                        </div>
                        <span class="text-sm font-medium text-gray-700">Facebook</span>
                    </button>
                </div>

                <!-- Sign In Link -->
                <div class="text-center">
                    <p class="text-sm text-gray-600">
                        Already have an account?
                        <a href="#" class="text-primary hover:text-opacity-80 font-medium cursor-pointer">Sign in here</a>
                    </p>
                </div>
            </form>
        </div>

        <!-- Features Preview -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mt-12">
            <div class="text-center p-4 bg-white bg-opacity-60 rounded-button backdrop-filter backdrop-blur-sm">
                <div class="w-12 h-12 bg-primary bg-opacity-20 rounded-full flex items-center justify-center mx-auto mb-3">
                    <div class="w-6 h-6 flex items-center justify-center">
                        <i class="ri-trophy-line text-primary"></i>
                    </div>
                </div>
                <h3 class="font-semibold text-gray-900 text-sm mb-1">Compete</h3>
                <p class="text-xs text-gray-600">Join matches and climb rankings</p>
            </div>
            <div class="text-center p-4 bg-white bg-opacity-60 rounded-button backdrop-filter backdrop-blur-sm">
                <div class="w-12 h-12 bg-secondary bg-opacity-20 rounded-full flex items-center justify-center mx-auto mb-3">
                    <div class="w-6 h-6 flex items-center justify-center">
                        <i class="ri-team-line text-secondary"></i>
                    </div>
                </div>
                <h3 class="font-semibold text-gray-900 text-sm mb-1">Team Up</h3>
                <p class="text-xs text-gray-600">Build your dream team roster</p>
            </div>
            <div class="text-center p-4 bg-white bg-opacity-60 rounded-button backdrop-filter backdrop-blur-sm">
                <div class="w-12 h-12 bg-primary bg-opacity-20 rounded-full flex items-center justify-center mx-auto mb-3">
                    <div class="w-6 h-6 flex items-center justify-center">
                        <i class="ri-bar-chart-line text-primary"></i>
                    </div>
                </div>
                <h3 class="font-semibold text-gray-900 text-sm mb-1">Track Stats</h3>
                <p class="text-xs text-gray-600">Monitor your performance</p>
            </div>
        </div>
    </div>

    <!-- Loading Overlay -->
    <div id="loading-overlay" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-xl p-8 max-w-sm w-full mx-4">
            <div class="text-center">
                <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-primary mx-auto mb-4"></div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Creating Account...</h3>
                <p class="text-gray-600 text-sm">Please wait while we set up your profile</p>
            </div>
        </div>
    </div>
    <script>
        !function (t, e) { var o, n, p, r; e.__SV || (window.posthog = e, e._i = [], e.init = function (i, s, a) { function g(t, e) { var o = e.split("."); 2 == o.length && (t = t[o[0]], e = o[1]), t[e] = function () { t.push([e].concat(Array.prototype.slice.call(arguments, 0))) } } (p = t.createElement("script")).type = "text/javascript", p.crossOrigin = "anonymous", p.async = !0, p.src = s.api_host.replace(".i.posthog.com", "-assets.i.posthog.com") + "/static/array.js", (r = t.getElementsByTagName("script")[0]).parentNode.insertBefore(p, r); var u = e; for (void 0 !== a ? u = e[a] = [] : a = "posthog", u.people = u.people || [], u.toString = function (t) { var e = "posthog"; return "posthog" !== a && (e += "." + a), t || (e += " (stub)"), e }, u.people.toString = function () { return u.toString(1) + ".people (stub)" }, o = "init capture register register_once register_for_session unregister unregister_for_session getFeatureFlag getFeatureFlagPayload isFeatureEnabled reloadFeatureFlags updateEarlyAccessFeatureEnrollment getEarlyAccessFeatures on onFeatureFlags onSessionId getSurveys getActiveMatchingSurveys renderSurvey canRenderSurvey getNextSurveyStep identify setPersonProperties group resetGroups setPersonPropertiesForFlags resetPersonPropertiesForFlags setGroupPropertiesForFlags resetGroupPropertiesForFlags reset get_distinct_id getGroups get_session_id get_session_replay_url alias set_config startSessionRecording stopSessionRecording sessionRecordingStarted captureException loadToolbar get_property getSessionProperty createPersonProfile opt_in_capturing opt_out_capturing has_opted_in_capturing has_opted_out_capturing clear_opt_in_out_capturing debug".split(" "), n = 0; n < o.length; n++)g(u, o[n]); e._i.push([i, s, a]) }, e.__SV = 1) }(document, window.posthog || []);
        posthog.init('phc_t9tkQZJiyi2ps9zUYm8TDsL6qXo4YmZx0Ot5rBlAlEd', {
            api_host: 'https://us.i.posthog.com',
            autocapture: false,
            capture_pageview: false,
            capture_pageleave: false,
            capture_performance: {
                web_vitals: false,
            },
            rageclick: false,
        })
        window.shareKey = 'Ej3SlcduvYPavZjFDe05VA';
        window.host = 'readdy.ai';
    </script>
    <script src="https://static.readdy.ai/static/share.js"></script></body>

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
                    strengthText.textContent = 'Weak';
                    break;
                case 2:
                    strengthMeter.classList.add('strength-fair');
                    strengthText.textContent = 'Fair';
                    break;
                case 3:
                case 4:
                    strengthMeter.classList.add('strength-good');
                    strengthText.textContent = 'Good';
                    break;
                case 5:
                    strengthMeter.classList.add('strength-strong');
                    strengthText.textContent = 'Strong';
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
                        showError(this, 'Username already taken');
                    } else {
                        showError(this, 'Username must be 3-20 characters, letters and numbers only');
                    }
                }
            } else {
                usernameStatus.classList.add('hidden');
                if (username.length > 0) {
                    showError(this, 'Username must be at least 3 characters');
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
                    showError(this, 'Passwords do not match');
                }
            }
        });

        registerForm.addEventListener('submit', function(e) {
            e.preventDefault();
            let isValid = true;

            const fullName = fullNameInput.value.trim();
            const username = usernameInput.value.trim();
            const email = emailInput.value.trim();
            const password = passwordInput.value.trim();
            const confirmPassword = confirmPasswordInput.value.trim();
            const termsAccepted = termsCheckbox.checked;

            if (!fullName || fullName.length < 2) {
                showError(fullNameInput, 'Full name is required (minimum 2 characters)');
                isValid = false;
            }

            if (!username) {
                showError(usernameInput, 'Username is required');
                isValid = false;
            } else if (!validateUsername(username)) {
                showError(usernameInput, existingUsernames.includes(username.toLowerCase()) ? 'Username already taken' : 'Invalid username format');
                isValid = false;
            }

            if (!email) {
                showError(emailInput, 'Email address is required');
                isValid = false;
            } else if (!validateEmail(email)) {
                showError(emailInput, 'Please enter a valid email address');
                isValid = false;
            }

            if (!password) {
                showError(passwordInput, 'Password is required');
                isValid = false;
            } else if (password.length < 6) {
                showError(passwordInput, 'Password must be at least 6 characters');
                isValid = false;
            }

            if (!confirmPassword) {
                showError(confirmPasswordInput, 'Please confirm your password');
                isValid = false;
            } else if (password !== confirmPassword) {
                showError(confirmPasswordInput, 'Passwords do not match');
                isValid = false;
            }

            if (!termsAccepted) {
                showNotification('Please accept the Terms of Service and Privacy Policy', 'error');
                isValid = false;
            }

            if (isValid) {
                loadingOverlay.classList.remove('hidden');

                setTimeout(() => {
                    loadingOverlay.classList.add('hidden');
                    showNotification('Account created successfully! Welcome to Meme Football League!');

                    setTimeout(() => {
                        window.location.href = '/dashboard';
                    }, 2000);
                }, 2500);
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

        const termsLinks = document.querySelectorAll('a[href="#"]');
        termsLinks.forEach(link => {
            if (link.textContent.includes('Terms') || link.textContent.includes('Privacy')) {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const isTerms = this.textContent.includes('Terms');

                    const modal = document.createElement('div');
                    modal.className = 'fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50 p-4';
                    modal.innerHTML = `
<div class="bg-white rounded-xl p-6 max-w-2xl w-full max-h-96 overflow-y-auto">
<div class="flex items-center justify-between mb-4">
<h3 class="text-xl font-semibold text-gray-900">${isTerms ? 'Terms of Service' : 'Privacy Policy'}</h3>
<button type="button" class="text-gray-400 hover:text-gray-600 cursor-pointer modal-close">
<div class="w-6 h-6 flex items-center justify-center">
<i class="ri-close-line"></i>
</div>
</button>
</div>
<div class="text-sm text-gray-600 space-y-4">
${isTerms ? `
<p><strong>1. Acceptance of Terms</strong><br>
By creating an account with Meme Football League, you agree to abide by these terms and conditions.</p>
<p><strong>2. User Accounts</strong><br>
You are responsible for maintaining the confidentiality of your account credentials and for all activities under your account.</p>
<p><strong>3. Fair Play</strong><br>
All users must engage in fair play. Cheating, exploiting, or any form of unsportsmanlike conduct is prohibited.</p>
<p><strong>4. Content Guidelines</strong><br>
Users must not post offensive, inappropriate, or copyrighted content. We reserve the right to moderate all user-generated content.</p>
` : `
<p><strong>Information We Collect</strong><br>
We collect information you provide directly, such as your name, email, and gaming statistics.</p>
<p><strong>How We Use Your Information</strong><br>
Your information is used to provide our services, improve user experience, and communicate important updates.</p>
<p><strong>Information Sharing</strong><br>
We do not sell or share your personal information with third parties except as required by law.</p>
<p><strong>Data Security</strong><br>
We implement appropriate security measures to protect your personal information against unauthorized access.</p>
`}
</div>
<div class="mt-6 flex justify-end">
<button type="button" class="px-6 py-2 bg-primary text-gray-900 rounded-button font-medium hover:bg-opacity-90 transition-colors cursor-pointer whitespace-nowrap modal-close">
Close
</button>
</div>
</div>
`;

                    document.body.appendChild(modal);

                    modal.querySelectorAll('.modal-close').forEach(closeBtn => {
                        closeBtn.addEventListener('click', function() {
                            modal.remove();
                        });
                    });

                    modal.addEventListener('click', function(e) {
                        if (e.target === modal) {
                            modal.remove();
                        }
                    });
                });
            }
        });

        const signInLink = document.querySelector('a[href="#"]:last-of-type');
        if (signInLink && signInLink.textContent.includes('Sign in')) {
            signInLink.addEventListener('click', function(e) {
                e.preventDefault();
                window.location.href = '/login';
            });
        }
    });
</script>

</html>

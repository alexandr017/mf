@php
    $currentPath = request()->path();
    $isActive = function($path) use ($currentPath) {
        if ($path === '/') {
            // Для главной страницы проверяем, что путь пустой
            return $currentPath === '';
        }
        $pathWithoutSlash = ltrim($path, '/');
        // Проверяем точное совпадение или что текущий путь начинается с пути ссылки
        return $currentPath === $pathWithoutSlash || str_starts_with($currentPath, $pathWithoutSlash . '/');
    };
@endphp

<nav class="bg-white shadow-md sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <a href="/" class="flex-shrink-0 flex items-center">
                    <span class="text-3xl font-['Pacifico'] text-primary">logo</span>
                </a>
                <div class="hidden sm:ml-10 sm:flex sm:space-x-8">
                    <a href="/" class="{{ $isActive('/') ? 'border-primary text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">Главная</a>
                    <a href="/ratings" class="{{ $isActive('/ratings') ? 'border-primary text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">Клубный рейтинг</a>
                    <a href="/tournaments" class="{{ $isActive('/tournaments') ? 'border-primary text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">Турниры</a>
                    <a href="/teams" class="{{ $isActive('/teams') ? 'border-primary text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">Команды</a>
                    <a href="/players" class="{{ $isActive('/players') ? 'border-primary text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">Игроки</a>
                    <a href="/upcoming-games" class="{{ $isActive('/upcoming-games') ? 'border-primary text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">Ближайшие матчи</a>
                    <a href="/rules" class="{{ $isActive('/rules') ? 'border-primary text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">Правила</a>
                    <a href="/blog" class="{{ $isActive('/blog') ? 'border-primary text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">Новости</a>
                </div>
            </div>


            @auth
                <div class="flex items-center space-x-3">
                    <!-- Уведомления -->
                    <div class="relative group">
                        <button id="notifications-button" class="relative p-2 text-gray-600 hover:text-gray-900 transition-colors">
                            <i class="ri-notification-3-line text-2xl"></i>
                            <span id="notifications-badge" class="absolute top-0 right-0 bg-red-500 text-white text-xs font-bold rounded-full w-5 h-5 flex items-center justify-center hidden">0</span>
                        </button>
                        <div id="notifications-dropdown" class="absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-lg z-50 opacity-0 invisible transition-all duration-200" style="max-height: 400px; overflow-y: auto;">
                            <div class="p-4 border-b border-gray-200 flex justify-between items-center">
                                <h3 class="font-semibold text-gray-900">Уведомления</h3>
                                <button id="mark-all-read-btn" class="text-sm text-primary hover:text-opacity-80">Отметить все как прочитанные</button>
                            </div>
                            <div id="notifications-list" class="divide-y divide-gray-200">
                                <div class="p-4 text-center text-gray-500">Загрузка...</div>
                            </div>
                            <div class="p-3 border-t border-gray-200 text-center">
                                <a href="{{ route('account') }}" class="text-sm text-primary hover:text-opacity-80">Показать все уведомления</a>
                            </div>
                        </div>
                    </div>

                    <!-- Профиль -->
                    <div class="relative group">
                        <a href="{{ route('account') }}" class="flex items-center space-x-3 hover:opacity-80 transition-opacity cursor-pointer">
                            <div class="w-10 h-10 rounded-full overflow-hidden bg-gray-300 flex items-center justify-center">
                                @if(auth()->user()->email)
                                    <span class="text-gray-600 font-semibold text-sm">{{ strtoupper(substr(auth()->user()->email, 0, 1)) }}</span>
                                @else
                                    <img src="/v1/images/demo/photo.jpg" alt="User Avatar" class="w-full h-full object-cover object-top">
                                @endif
                            </div>
                            <div class="hidden sm:block">
                                <div class="text-sm font-medium text-gray-900">{{ auth()->user()->name }}</div>
                            </div>
                        </a>
                        <div class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-1 z-50 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
                            <a href="{{ route('account') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Личный кабинет</a>
                            @if(in_array(auth()->id(), config('admins', [])))
                                <a href="{{ route('admin.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Админ-панель</a>
                            @endif
                            <form method="POST" action="{{ route('logout') }}" class="block">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Выход</button>
                            </form>
                        </div>
                    </div>
                </div>
            @else
                <div class="hidden sm:ml-6 sm:flex sm:items-center">
                    <div class="flex items-center space-x-3">
                        <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-900 px-3 py-2 text-sm font-medium">Вход</a>
                        <a href="{{ route('register') }}" class="bg-primary hover:bg-opacity-80 text-gray-900 px-4 py-2 !rounded-button whitespace-nowrap text-sm font-medium">Регистрация</a>
                    </div>
                </div>
            @endauth



            <div class="flex items-center sm:hidden">
                <button type="button" id="mobile-menu-button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-primary">
                    <div class="w-6 h-6 flex items-center justify-center">
                        <i class="ri-menu-line ri-lg" id="menu-icon"></i>
                    </div>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu -->
    <div id="mobile-menu" class="hidden sm:hidden bg-white border-t border-gray-200">
        <div class="px-2 pt-2 pb-3 space-y-1">
            <a href="/" class="{{ $isActive('/') ? 'bg-primary text-white' : 'text-gray-700 hover:bg-gray-100' }} block px-3 py-2 rounded-md text-base font-medium">Главная</a>
            <a href="/ratings" class="{{ $isActive('/ratings') ? 'bg-primary text-white' : 'text-gray-700 hover:bg-gray-100' }} block px-3 py-2 rounded-md text-base font-medium">Клубный рейтинг</a>
            <a href="/tournaments" class="{{ $isActive('/tournaments') ? 'bg-primary text-white' : 'text-gray-700 hover:bg-gray-100' }} block px-3 py-2 rounded-md text-base font-medium">Турниры</a>
            <a href="/teams" class="{{ $isActive('/teams') ? 'bg-primary text-white' : 'text-gray-700 hover:bg-gray-100' }} block px-3 py-2 rounded-md text-base font-medium">Команды</a>
            <a href="/players" class="{{ $isActive('/players') ? 'bg-primary text-white' : 'text-gray-700 hover:bg-gray-100' }} block px-3 py-2 rounded-md text-base font-medium">Игроки</a>
            <a href="/upcoming-games" class="{{ $isActive('/upcoming-games') ? 'bg-primary text-white' : 'text-gray-700 hover:bg-gray-100' }} block px-3 py-2 rounded-md text-base font-medium">Ближайшие матчи</a>
            <a href="/rules" class="{{ $isActive('/rules') ? 'bg-primary text-white' : 'text-gray-700 hover:bg-gray-100' }} block px-3 py-2 rounded-md text-base font-medium">Правила</a>
            <a href="/blog" class="{{ $isActive('/blog') ? 'bg-primary text-white' : 'text-gray-700 hover:bg-gray-100' }} block px-3 py-2 rounded-md text-base font-medium">Новости</a>
            @guest
                <a href="{{ route('login') }}" class="text-gray-700 hover:bg-gray-100 block px-3 py-2 rounded-md text-base font-medium">Вход</a>
                <a href="{{ route('register') }}" class="bg-primary hover:bg-opacity-80 text-white block px-3 py-2 rounded-md text-base font-medium text-center mt-2">Регистрация</a>
            @endguest
        </div>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const menuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        const menuIcon = document.getElementById('menu-icon');

        if (menuButton && mobileMenu) {
            menuButton.addEventListener('click', function() {
                const isHidden = mobileMenu.classList.contains('hidden');

                if (isHidden) {
                    mobileMenu.classList.remove('hidden');
                    menuIcon.classList.remove('ri-menu-line');
                    menuIcon.classList.add('ri-close-line');
                } else {
                    mobileMenu.classList.add('hidden');
                    menuIcon.classList.remove('ri-close-line');
                    menuIcon.classList.add('ri-menu-line');
                }
            });
        }
    });
</script>

@auth
<script>
document.addEventListener('DOMContentLoaded', function() {
    const notificationsButton = document.getElementById('notifications-button');
    const notificationsDropdown = document.getElementById('notifications-dropdown');
    const notificationsList = document.getElementById('notifications-list');
    const notificationsBadge = document.getElementById('notifications-badge');
    const markAllReadBtn = document.getElementById('mark-all-read-btn');
    
    let notificationsCheckInterval;
    
    // Загрузка уведомлений
    function loadNotifications() {
        fetch('{{ route("notifications.index") }}', {
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
            }
        })
        .then(response => response.json())
        .then(data => {
            updateNotificationsList(data.notifications);
            updateBadge(data.unread_count);
        })
        .catch(error => {
            console.error('Error loading notifications:', error);
        });
    }
    
    // Обновление списка уведомлений
    function updateNotificationsList(notifications) {
        if (notifications.length === 0) {
            notificationsList.innerHTML = '<div class="p-4 text-center text-gray-500">Нет уведомлений</div>';
            return;
        }
        
        notificationsList.innerHTML = notifications.map(notification => {
            const readClass = notification.is_read ? 'bg-gray-50' : 'bg-blue-50';
            return `
                <div class="p-4 ${readClass} hover:bg-gray-100 transition-colors cursor-pointer notification-item" data-id="${notification.id}">
                    <div class="flex justify-between items-start">
                        <div class="flex-1">
                            <h4 class="font-semibold text-gray-900 text-sm">${notification.title}</h4>
                            <p class="text-sm text-gray-600 mt-1">${notification.message}</p>
                            <p class="text-xs text-gray-500 mt-2">${notification.created_at_human}</p>
                        </div>
                        ${!notification.is_read ? '<div class="w-2 h-2 bg-blue-500 rounded-full ml-2 mt-1"></div>' : ''}
                    </div>
                </div>
            `;
        }).join('');
        
        // Добавляем обработчики клика
        document.querySelectorAll('.notification-item').forEach(item => {
            item.addEventListener('click', function() {
                const notificationId = this.dataset.id;
                markAsRead(notificationId);
            });
        });
    }
    
    // Обновление badge
    function updateBadge(count) {
        if (count > 0) {
            notificationsBadge.textContent = count > 99 ? '99+' : count;
            notificationsBadge.classList.remove('hidden');
        } else {
            notificationsBadge.classList.add('hidden');
        }
    }
    
    // Отметить как прочитанное
    function markAsRead(notificationId) {
        fetch(`/notifications/${notificationId}/read`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                updateBadge(data.unread_count);
                loadNotifications();
            }
        })
        .catch(error => {
            console.error('Error marking notification as read:', error);
        });
    }
    
    // Отметить все как прочитанные
    if (markAllReadBtn) {
        markAllReadBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            fetch('{{ route("notifications.mark-all-read") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    updateBadge(0);
                    loadNotifications();
                }
            })
            .catch(error => {
                console.error('Error marking all as read:', error);
            });
        });
    }
    
    // Открытие/закрытие dropdown
    if (notificationsButton && notificationsDropdown) {
        notificationsButton.addEventListener('click', function(e) {
            e.stopPropagation();
            const isVisible = notificationsDropdown.classList.contains('opacity-100');
            if (isVisible) {
                notificationsDropdown.classList.remove('opacity-100', 'visible');
                notificationsDropdown.classList.add('opacity-0', 'invisible');
            } else {
                notificationsDropdown.classList.remove('opacity-0', 'invisible');
                notificationsDropdown.classList.add('opacity-100', 'visible');
                loadNotifications();
            }
        });
        
        // Закрытие при клике вне
        document.addEventListener('click', function(e) {
            if (!notificationsButton.contains(e.target) && !notificationsDropdown.contains(e.target)) {
                notificationsDropdown.classList.remove('opacity-100', 'visible');
                notificationsDropdown.classList.add('opacity-0', 'invisible');
            }
        });
    }
    
    // Автоматическая проверка каждые 30 секунд
    notificationsCheckInterval = setInterval(function() {
        loadNotifications();
    }, 30000);
    
    // Загружаем сразу
    loadNotifications();
});
</script>
@endauth

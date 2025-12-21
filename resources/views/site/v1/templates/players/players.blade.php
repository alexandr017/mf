@extends('site.v1.layouts.default')

@section('content')

<div class="min-h-screen">
    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="heading-font text-4xl text-gray-900 mb-2">Рейтинг игроков</h1>
            <p class="text-gray-600 mb-6">Откройте для себя лучших игроков всех команд в Meme Football League</p>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">
                <!-- Total Players -->
                <div class="stat-card rounded-xl p-4 md:p-6 card-hover transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs md:text-sm font-medium text-gray-500">Всего игроков</p>
                            <p class="text-xl md:text-2xl font-bold text-primary">{{ number_format($totalPlayers, 0, ',', ' ') }}</p>
                            <p class="text-xs md:text-sm text-green-600">+{{ $thisMonthRegistrations }} в этом месяце</p>
                        </div>
                        <div class="w-10 h-10 md:w-12 md:h-12 bg-primary bg-opacity-20 rounded-full flex items-center justify-center flex-shrink-0">
                            <div class="w-5 h-5 md:w-6 md:h-6 flex items-center justify-center">
                                <i class="ri-group-line text-primary text-lg md:text-xl"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Active Players -->
                <div class="stat-card rounded-xl p-4 md:p-6 card-hover transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs md:text-sm font-medium text-gray-500">Активные игроки</p>
                            <p class="text-xl md:text-2xl font-bold text-secondary">{{ number_format($activePlayers, 0, ',', ' ') }}</p>
                            <p class="text-xs md:text-sm text-green-600">За последний год</p>
                        </div>
                        <div class="w-10 h-10 md:w-12 md:h-12 bg-secondary bg-opacity-20 rounded-full flex items-center justify-center flex-shrink-0">
                            <div class="w-5 h-5 md:w-6 md:h-6 flex items-center justify-center">
                                <i class="ri-user-star-line text-secondary text-lg md:text-xl"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Top Scorer -->
                <div class="stat-card rounded-xl p-4 md:p-6 card-hover transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div class="min-w-0 flex-1">
                            <p class="text-xs md:text-sm font-medium text-gray-500">Лучший бомбардир</p>
                            <p class="text-base md:text-xl font-bold text-yellow-600 truncate">{{ $topScorer?->name ?? 'Нет данных' }}</p>
                            <p class="text-xs md:text-sm text-green-600">{{ $topScorer?->goals ?? 0 }} голов</p>
                        </div>
                        <div class="w-10 h-10 md:w-12 md:h-12 bg-yellow-100 rounded-full flex items-center justify-center flex-shrink-0 ml-2">
                            <div class="w-5 h-5 md:w-6 md:h-6 flex items-center justify-center">
                                <i class="ri-football-line text-yellow-600 text-lg md:text-xl"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Highest Rated -->
                <div class="stat-card rounded-xl p-4 md:p-6 card-hover transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div class="min-w-0 flex-1">
                            <p class="text-xs md:text-sm font-medium text-gray-500">Высший рейтинг</p>
                            <p class="text-base md:text-xl font-bold text-purple-600 truncate">{{ $highestRated?->name ?? 'Нет данных' }}</p>
                            <p class="text-xs md:text-sm text-green-600">Рейтинг {{ number_format($highestRated?->rating ?? 0, 1) }}</p>
                        </div>
                        <div class="w-10 h-10 md:w-12 md:h-12 bg-purple-100 rounded-full flex items-center justify-center flex-shrink-0 ml-2">
                            <div class="w-5 h-5 md:w-6 md:h-6 flex items-center justify-center">
                                <i class="ri-trophy-line text-purple-600 text-lg md:text-xl"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Filters and Sorting -->
        <div class="mb-8">
            <div class="bg-white rounded-xl shadow-lg p-4 md:p-6">
                <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
                    <!-- Sort Options - слева -->
                    <div class="flex items-center space-x-4 w-full md:w-auto">
                        <span class="text-sm font-medium text-gray-700 whitespace-nowrap">Сортировать по:</span>
                        <select class="border border-gray-300 rounded-button px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent pr-8 cursor-pointer w-full md:w-auto" id="sort-select">
                            <option value="rating">Рейтинг игрока</option>
                            <option value="matches">Сыграно матчей</option>
                            <option value="goals">Забито голов</option>
                            <option value="assists">Голевых передач</option>
                        </select>
                    </div>
                    <!-- Search - справа -->
                    <div class="relative w-full md:w-auto md:flex-shrink-0">
                        <input type="text" placeholder="Поиск игроков..." class="border border-gray-300 rounded-button px-4 py-2 pl-10 text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent w-full md:w-64" id="player-search">
                        <div class="absolute left-3 top-1/2 transform -translate-y-1/2 w-4 h-4 flex items-center justify-center">
                            <i class="ri-search-line text-gray-400 text-sm"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Player Rankings Table -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden" id="rankings-table">
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-3 md:px-6 py-3 md:py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Место</th>
                        <th class="px-3 md:px-6 py-3 md:py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Игрок</th>
                        <th class="px-3 md:px-6 py-3 md:py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden md:table-cell">Команда</th>
                        <th class="px-3 md:px-6 py-3 md:py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Рейтинг</th>
                        <th class="px-3 md:px-6 py-3 md:py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden sm:table-cell">Матчи</th>
                        <th class="px-3 md:px-6 py-3 md:py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Голы</th>
                        <th class="px-3 md:px-6 py-3 md:py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden lg:table-cell">Передачи</th>
                        <th class="px-3 md:px-6 py-3 md:py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden lg:table-cell">Позиция</th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200" id="player-rows">
                        <!-- Данные загружаются через AJAX -->
                        <tr>
                            <td colspan="8" class="px-6 py-12 text-center text-gray-500">
                                <div class="flex flex-col items-center">
                                    <i class="ri-loader-4-line text-4xl animate-spin text-primary mb-4"></i>
                                    <p>Загрузка данных...</p>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Pagination -->
        <div class="flex flex-col sm:flex-row items-center justify-between mt-6 bg-white rounded-xl shadow-lg p-4 md:p-6 gap-4" id="pagination-container">
            <div class="text-sm text-gray-500" id="pagination-info">
                Загрузка...
            </div>
            <div class="flex items-center space-x-2" id="pagination-buttons">
                <!-- Кнопки пагинации загружаются через AJAX -->
            </div>
        </div>
    </main>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let currentPage = 1;
    let currentSort = 'rating';
    let currentSearch = '';
    let isLoading = false;
    let abortController = null;
    let requestedPage = 1; // Отслеживаем запрошенную страницу

    const playerRows = document.getElementById('player-rows');
    const paginationInfo = document.getElementById('pagination-info');
    const paginationButtons = document.getElementById('pagination-buttons');
    const sortSelect = document.getElementById('sort-select');
    const searchInput = document.getElementById('player-search');

    // Функция для получения данных
    function loadPlayers(page = 1) {
        // Отменяем предыдущий запрос, если он еще выполняется
        if (abortController) {
            abortController.abort();
        }

        // Создаем новый контроллер для отмены
        abortController = new AbortController();
        requestedPage = page; // Сохраняем запрошенную страницу
        isLoading = true;

        const params = new URLSearchParams({
            page: page,
            sort_by: currentSort,
            search: currentSearch
        });

        // Показываем индикатор загрузки
        playerRows.innerHTML = `
            <tr>
                <td colspan="8" class="px-6 py-12 text-center text-gray-500">
                    <div class="flex flex-col items-center">
                        <i class="ri-loader-4-line text-4xl animate-spin text-primary mb-4"></i>
                        <p>Загрузка данных...</p>
                    </div>
                </td>
            </tr>
        `;

        fetch(`{{ route('players.api') }}?${params.toString()}`, {
            signal: abortController.signal
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                // Проверяем, что ответ соответствует запрошенной странице
                if (data.current_page !== requestedPage) {
                    console.log('Игнорируем устаревший ответ для страницы', data.current_page);
                    return;
                }

                isLoading = false;
                currentPage = data.current_page; // Обновляем только после успешного ответа
                renderPlayers(data.data);
                renderPagination(data);
                abortController = null; // Очищаем контроллер после успешного ответа
            })
            .catch(error => {
                // Игнорируем ошибки отмены запроса
                if (error.name === 'AbortError') {
                    console.log('Запрос отменен');
                    return;
                }
                
                isLoading = false;
                abortController = null;
                console.error('Ошибка загрузки данных:', error);
                playerRows.innerHTML = `
                    <tr>
                        <td colspan="8" class="px-6 py-12 text-center text-red-500">
                            <p>Ошибка загрузки данных. Пожалуйста, обновите страницу.</p>
                        </td>
                    </tr>
                `;
            });
    }

    // Функция для отображения игроков
    function renderPlayers(players) {
        if (players.length === 0) {
            playerRows.innerHTML = `
                <tr>
                    <td colspan="8" class="px-6 py-12 text-center text-gray-500">
                        <p>Игроки не найдены</p>
                    </td>
                </tr>
            `;
            return;
        }

        playerRows.innerHTML = players.map((player, index) => {
            const rank = (currentPage - 1) * 50 + index + 1;
            const rankColors = [
                'from-yellow-400 to-yellow-600',
                'from-gray-400 to-gray-600',
                'from-orange-400 to-orange-600',
                'from-blue-400 to-blue-600',
                'from-indigo-400 to-indigo-600'
            ];
            const rankColor = rankColors[rank - 1] || 'from-gray-400 to-gray-600';
            
            const team = player.current_team || null;
            const teamName = team ? team.name : 'Без команды';
            const teamLogo = team && team.logo ? team.logo : '/v1/images/demo/photo.jpg';
            
            const userInitial = player.name ? player.name.charAt(0).toUpperCase() : '?';
            const userAvatar = player.avatar || null;
            
            const matchesCount = player.matches_count || 0;
            const goals = player.goals || 0;
            const assists = player.assists || 0;
            const rating = parseFloat(player.rating || 0).toFixed(1);

            return `
                <tr class="hover:bg-gray-50 transition-colors duration-200 player-row">
                    <td class="px-3 md:px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="w-8 h-8 bg-gradient-to-r ${rankColor} rounded-full flex items-center justify-center text-white font-bold text-sm">
                                ${rank}
                            </div>
                        </div>
                    </td>
                    <td class="px-3 md:px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="h-10 w-10 md:h-12 md:w-12 flex-shrink-0">
                                ${userAvatar ? 
                                    `<img class="h-10 w-10 md:h-12 md:w-12 rounded-full object-cover object-top" src="${userAvatar}" alt="${player.name}">` :
                                    `<div class="h-10 w-10 md:h-12 md:w-12 rounded-full bg-gray-300 flex items-center justify-center">
                                        <span class="text-gray-600 font-semibold text-sm md:text-base">${userInitial}</span>
                                    </div>`
                                }
                            </div>
                            <div class="ml-2 md:ml-4 min-w-0">
                                <div class="text-sm font-medium text-gray-900 truncate">
                                    <a href="/players/${player.alias || player.id}" class="hover:text-primary transition-colors">
                                        ${player.name || 'Без имени'}
                                    </a>
                                </div>
                                <div class="text-xs md:text-sm text-gray-500 hidden md:block">Игрок</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-3 md:px-6 py-4 whitespace-nowrap hidden md:table-cell">
                        <div class="flex items-center">
                            ${team ? `
                                <a href="/teams/${team.alias || team.id}" class="flex items-center hover:opacity-80 transition-opacity">
                                    <div class="w-6 h-6 md:w-8 md:h-8 rounded-full overflow-hidden mr-2 md:mr-3 flex-shrink-0">
                                        <img src="${teamLogo}" alt="${teamName}" class="w-full h-full object-cover object-top">
                                    </div>
                                    <span class="text-sm text-gray-900 truncate">${teamName}</span>
                                </a>
                            ` : `
                                <div class="flex items-center">
                                    <div class="w-6 h-6 md:w-8 md:h-8 rounded-full overflow-hidden mr-2 md:mr-3 flex-shrink-0 bg-gray-200"></div>
                                    <span class="text-sm text-gray-500 truncate">${teamName}</span>
                                </div>
                            `}
                        </div>
                    </td>
                    <td class="px-3 md:px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <span class="text-base md:text-lg font-bold text-primary">${rating}</span>
                        </div>
                    </td>
                    <td class="px-3 md:px-6 py-4 whitespace-nowrap text-sm text-gray-900 hidden sm:table-cell">${matchesCount}</td>
                    <td class="px-3 md:px-6 py-4 whitespace-nowrap text-sm text-gray-900">${goals}</td>
                    <td class="px-3 md:px-6 py-4 whitespace-nowrap text-sm text-gray-900 hidden lg:table-cell">${assists}</td>
                    <td class="px-3 md:px-6 py-4 whitespace-nowrap hidden lg:table-cell">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">Игрок</span>
                    </td>
                </tr>
            `;
        }).join('');
    }

    // Функция для отображения пагинации
    function renderPagination(data) {
        const { current_page, last_page, total, from, to } = data;
        // currentPage уже обновлен в loadPlayers

        // Информация о странице
        paginationInfo.textContent = `Показано ${from || 0}-${to || 0} из ${total || 0} игроков`;

        // Кнопки пагинации
        let buttons = '';

        // Кнопка "Предыдущая"
        buttons += `
            <button 
                class="px-3 py-2 text-sm bg-gray-100 hover:bg-gray-200 rounded-button cursor-pointer disabled:opacity-50 disabled:cursor-not-allowed" 
                ${current_page === 1 ? 'disabled' : ''}
                onclick="loadPage(${current_page - 1})"
            >
                Назад
            </button>
        `;

        // Номера страниц
        const maxVisible = 5;
        let startPage = Math.max(1, current_page - Math.floor(maxVisible / 2));
        let endPage = Math.min(last_page, startPage + maxVisible - 1);

        if (endPage - startPage < maxVisible - 1) {
            startPage = Math.max(1, endPage - maxVisible + 1);
        }

        if (startPage > 1) {
            buttons += `<button class="px-3 py-2 text-sm bg-gray-100 hover:bg-gray-200 rounded-button cursor-pointer" onclick="loadPage(1)">1</button>`;
            if (startPage > 2) {
                buttons += `<span class="px-3 py-2 text-sm text-gray-500">...</span>`;
            }
        }

        for (let i = startPage; i <= endPage; i++) {
            buttons += `
                <button 
                    class="px-3 py-2 text-sm rounded-button cursor-pointer ${i === current_page ? 'bg-primary text-gray-900' : 'bg-gray-100 hover:bg-gray-200'}" 
                    onclick="loadPage(${i})"
                >
                    ${i}
                </button>
            `;
        }

        if (endPage < last_page) {
            if (endPage < last_page - 1) {
                buttons += `<span class="px-3 py-2 text-sm text-gray-500">...</span>`;
            }
            buttons += `<button class="px-3 py-2 text-sm bg-gray-100 hover:bg-gray-200 rounded-button cursor-pointer" onclick="loadPage(${last_page})">${last_page}</button>`;
        }

        // Кнопка "Следующая"
        buttons += `
            <button 
                class="px-3 py-2 text-sm bg-gray-100 hover:bg-gray-200 rounded-button cursor-pointer disabled:opacity-50 disabled:cursor-not-allowed" 
                ${current_page === last_page ? 'disabled' : ''}
                onclick="loadPage(${current_page + 1})"
            >
                Вперед
            </button>
        `;

        paginationButtons.innerHTML = buttons;
    }

    // Глобальная функция для загрузки страницы
    window.loadPage = function(page) {
        if (page < 1) return;
        loadPlayers(page);
        window.scrollTo({ top: 0, behavior: 'smooth' });
    };

    // Обработчики событий
    sortSelect.addEventListener('change', function() {
        currentSort = this.value;
        currentPage = 1;
        loadPlayers(1);
    });

    let searchTimeout;
    searchInput.addEventListener('input', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
            currentSearch = this.value;
            currentPage = 1;
            loadPlayers(1);
        }, 500);
    });

    // Загружаем первую страницу
    loadPlayers(1);
});
</script>

@endsection

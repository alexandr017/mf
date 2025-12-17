@extends('site.v1.layouts.default')
{{--@section ('title', Shortcode::compile($page->title))--}}
{{--@section ('meta_description', Shortcode::compile($page->meta_description))--}}

@section('content')
    <section class="bg-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="heading-font text-4xl md:text-5xl text-gray-900 mb-4">Meet Our Ridiculous Teams</h1>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">From muddy underdogs to champions of chaos, these are the teams that make our league uniquely absurd.</p>
            </div>

            <!-- Search and Filter -->
            <div class="mt-8 flex flex-col md:flex-row gap-4 items-center justify-between">
                <div class="relative flex-1 max-w-lg">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <div class="w-5 h-5 text-gray-400">
                            <i class="ri-search-line"></i>
                        </div>
                    </div>
                    <input type="text" id="searchInput" class="block w-full pl-10 pr-3 py-2 border-none rounded-lg bg-gray-100 focus:bg-white focus:ring-2 focus:ring-primary text-sm" placeholder="Поиск команд по названию или городу...">
                </div>
                <div class="flex gap-4 flex-wrap">
                    <select id="cityFilter" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 !rounded-button pr-8 appearance-none cursor-pointer">
                        <option value="">Все города</option>
                        @php
                            $cities = $teams->pluck('city_name')->filter(function($city) {
                                return !empty($city);
                            })->unique()->sort()->values();
                        @endphp
                        @foreach($cities as $city)
                            <option value="{{ strtolower(trim($city)) }}">{{ $city }}</option>
                        @endforeach
                    </select>
                    <select id="sortSelect" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 !rounded-button pr-8 appearance-none cursor-pointer">
                        <option value="name-asc">По названию (А-Я)</option>
                        <option value="name-desc">По названию (Я-А)</option>
                        <option value="city-asc">По городу (А-Я)</option>
                        <option value="city-desc">По городу (Я-А)</option>
                    </select>
                </div>
            </div>

            <!-- Results Count -->
            <div id="resultsCount" class="mt-4 text-gray-600 text-sm">
                Найдено команд: <span id="countNumber">{{ count($teams) }}</span>
            </div>

            <!-- Teams Grid -->
            <div id="teamsGrid" class="mt-12 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

                @foreach($teams as $team)
                    <a href="/teams/{{$team->alias}}" class="team-card bg-white rounded-lg shadow-lg overflow-hidden border-2 border-gray-100 hover:border-primary transition-all duration-300 card-hover"
                       data-name="{{ strtolower($team->name) }}"
                       data-city="{{ strtolower($team->city_name ?? '') }}"
                       data-stadium="{{ strtolower($team->stadium ?? '') }}">
                        <div class="relative">
                            <div class="h-48 overflow-hidden">
                                <img src="{{$team->stadium_small_preview}}" alt="{{$team->stadium}}" class="w-full h-full object-cover object-top">
                            </div>
                            <div class="absolute top-4 right-4 bg-primary text-gray-900 px-3 py-1 rounded-full text-sm font-bold">
                                #1 в рейтинге
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center gap-4 mb-4">
                                <div class="w-20 h-20 rounded-full overflow-hidden border-4 border-primary">
                                    <img src="{{$team->logo}}" alt="{{$team->name}}" class="w-full h-full object-cover object-top">
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-gray-900">{{$team->name}}</h3>
                                    <p class="text-gray-500">{{$team->city_name}}, Россия</p>
                                </div>
                            </div>
                            <div class="space-y-3">
                                <div class="flex items-center gap-2">
                                    <div class="w-5 h-5 text-primary">
                                        <i class="ri-trophy-line"></i>
                                    </div>
                                    <span class="text-gray-600">Обладатели кубка СНГ: 0</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <div class="w-5 h-5 text-primary">
                                        <i class="ri-trophy-line"></i>
                                    </div>
                                    <span class="text-gray-600">Чемпионы страны: 0</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <div class="w-5 h-5 text-primary">
                                        <i class="ri-trophy-line"></i>
                                    </div>
                                    <span class="text-gray-600">Обладатели кубка страны: 0</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <div class="w-5 h-5 text-primary">
                                        <i class="ri-trophy-line"></i>
                                    </div>
                                    <span class="text-gray-600">Обладатели супер кубка страны: 0</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <div class="w-5 h-5 text-primary">
                                        <i class="ri-team-line"></i>
                                    </div>
                                    <span class="text-gray-600">Состав: 25 игроков</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <div class="w-5 h-5 text-primary">
                                        <i class="ri-home-4-line"></i>
                                    </div>
                                    <span class="text-gray-600">Стадион: {{$team->stadium}}</span>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

            <!-- No Results Message -->
            <div id="noResults" class="mt-12 text-center hidden">
                <div class="text-gray-500 text-lg">
                    <i class="ri-search-line text-4xl mb-4 block"></i>
                    <p>Команды не найдены</p>
                    <p class="text-sm mt-2">Попробуйте изменить параметры поиска или фильтры</p>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const cityFilter = document.getElementById('cityFilter');
            const sortSelect = document.getElementById('sortSelect');
            const teamsGrid = document.getElementById('teamsGrid');
            const resultsCount = document.getElementById('countNumber');
            const noResults = document.getElementById('noResults');

            if (!searchInput || !cityFilter || !sortSelect || !teamsGrid) {
                console.error('Не найдены необходимые элементы DOM');
                return;
            }

            let allTeams = Array.from(document.querySelectorAll('.team-card'));
            let filteredTeams = [...allTeams];

            // Функция фильтрации
            function filterTeams() {
                const searchTerm = searchInput.value.toLowerCase().trim();
                const selectedCity = cityFilter.value.toLowerCase().trim();

                filteredTeams = allTeams.filter(team => {
                    const name = (team.dataset.name || '').toLowerCase();
                    const city = (team.dataset.city || '').toLowerCase();
                    const stadium = (team.dataset.stadium || '').toLowerCase();

                    // Поиск по названию, городу или стадиону
                    const matchesSearch = !searchTerm ||
                        name.includes(searchTerm) ||
                        city.includes(searchTerm) ||
                        stadium.includes(searchTerm);

                    // Фильтр по городу
                    const matchesCity = !selectedCity || city === selectedCity;

                    return matchesSearch && matchesCity;
                });

                // Сортировка
                sortTeams();

                // Обновление отображения
                updateDisplay();
            }

            // Функция сортировки
            function sortTeams() {
                const sortValue = sortSelect.value;
                const [field, order] = sortValue.split('-');

                filteredTeams.sort((a, b) => {
                    let aValue, bValue;

                    if (field === 'name') {
                        aValue = a.dataset.name || '';
                        bValue = b.dataset.name || '';
                    } else if (field === 'city') {
                        aValue = a.dataset.city || '';
                        bValue = b.dataset.city || '';
                    } else {
                        return 0;
                    }

                    // Сравнение
                    let comparison = 0;
                    if (aValue < bValue) {
                        comparison = -1;
                    } else if (aValue > bValue) {
                        comparison = 1;
                    }

                    return order === 'asc' ? comparison : -comparison;
                });
            }

            // Функция обновления отображения
            function updateDisplay() {
                // Очистка сетки
                teamsGrid.innerHTML = '';

                // Добавление отфильтрованных команд
                filteredTeams.forEach(team => {
                    teamsGrid.appendChild(team);
                });

                // Обновление счетчика
                const count = filteredTeams.length;
                resultsCount.textContent = count;

                // Показ/скрытие сообщения "не найдено"
                if (count === 0) {
                    noResults.classList.remove('hidden');
                    teamsGrid.classList.add('hidden');
                } else {
                    noResults.classList.add('hidden');
                    teamsGrid.classList.remove('hidden');
                }
            }

            // Обработчики событий
            searchInput.addEventListener('input', filterTeams);
            cityFilter.addEventListener('change', filterTeams);
            sortSelect.addEventListener('change', filterTeams);

            // Инициализация
            filterTeams();
        });
    </script>
@endsection

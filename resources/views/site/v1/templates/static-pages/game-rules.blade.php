@extends('site.v1.layouts.default')
@section ('title', $page->title ?? 'Правила игры')
@section ('meta_description', $page->meta_description ?? 'Правила игры в футбольной лиге городов')

@section('content')

<main class="container mx-auto px-4 py-12">
    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Sidebar Navigation -->
        <div class="lg:w-1/4">
            <div class="bg-white rounded-lg shadow-sm p-6 sticky top-24">
                <h3 class="text-lg font-semibold mb-4">Содержание</h3>
                <ul class="space-y-3">
                    @if($page && $page->menu_content)
                        {!! $page->menu_content !!}
                    @else
                        <li>
                            <a href="#registration" class="flex items-center text-primary hover:text-blue-700 transition-colors">
                                <div class="w-5 h-5 flex items-center justify-center mr-2">
                                    <i class="ri-user-add-line"></i>
                                </div>
                                <span>Регистрация и команды</span>
                            </a>
                        </li>
                        <li>
                            <a href="#rating-system" class="flex items-center text-gray-700 hover:text-primary transition-colors">
                                <div class="w-5 h-5 flex items-center justify-center mr-2">
                                    <i class="ri-star-line"></i>
                                </div>
                                <span>Система рейтинга</span>
                            </a>
                        </li>
                        <li>
                            <a href="#mini-games" class="flex items-center text-gray-700 hover:text-primary transition-colors">
                                <div class="w-5 h-5 flex items-center justify-center mr-2">
                                    <i class="ri-gamepad-line"></i>
                                </div>
                                <span>Мини-игры и тренировки</span>
                            </a>
                        </li>
                        <li>
                            <a href="#matches" class="flex items-center text-gray-700 hover:text-primary transition-colors">
                                <div class="w-5 h-5 flex items-center justify-center mr-2">
                                    <i class="ri-football-line"></i>
                                </div>
                                <span>Матчи и турниры</span>
                            </a>
                        </li>
                        <li>
                            <a href="#points-system" class="flex items-center text-gray-700 hover:text-primary transition-colors">
                                <div class="w-5 h-5 flex items-center justify-center mr-2">
                                    <i class="ri-trophy-line"></i>
                                </div>
                                <span>Система начисления очков</span>
                            </a>
                        </li>
                        <li>
                            <a href="#transfers" class="flex items-center text-gray-700 hover:text-primary transition-colors">
                                <div class="w-5 h-5 flex items-center justify-center mr-2">
                                    <i class="ri-exchange-line"></i>
                                </div>
                                <span>Трансферы и сезоны</span>
                            </a>
                        </li>
                        <li>
                            <a href="#achievements" class="flex items-center text-gray-700 hover:text-primary transition-colors">
                                <div class="w-5 h-5 flex items-center justify-center mr-2">
                                    <i class="ri-award-line"></i>
                                </div>
                                <span>Достижения</span>
                            </a>
                        </li>
                    @endif
                </ul>
                <div class="mt-6 pt-6 border-t">
                    <a href="/" class="flex items-center text-gray-600 hover:text-primary transition-colors">
                        <div class="w-5 h-5 flex items-center justify-center mr-2">
                            <i class="ri-arrow-left-line"></i>
                        </div>
                        <span>Главная страница</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Main Content Area -->
        <div class="lg:w-3/4">
            @if($page && $page->content)
                {!! $page->content !!}
            @else
                <!-- Default content if page not found in DB -->
                <section id="registration" class="mb-12 scroll-mt-24">
                    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                        <div class="p-6 border-b">
                            <div class="flex items-center">
                                <div class="w-10 h-10 flex items-center justify-center bg-blue-100 text-primary rounded-full mr-4">
                                    <i class="ri-user-add-line ri-lg"></i>
                                </div>
                                <h2 class="text-2xl font-bold">Регистрация и присоединение к команде</h2>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="prose max-w-none">
                                <h3 class="text-xl font-semibold mb-4">Регистрация пользователя</h3>
                                <p class="mb-4">Любой пользователь может зарегистрироваться в системе в любой момент. При регистрации можно указать свои данные: имя, никнейм, email, предпочитаемую позицию (защитник, полузащитник, нападающий).</p>
                                
                                <h3 class="text-xl font-semibold mb-4 mt-6">Присоединение к команде</h3>
                                <ul class="list-disc list-inside space-y-2 mb-4">
                                    <li>Команды имеют лимит в <strong>100 активных игроков</strong> на текущий сезон</li>
                                    <li>Трансферное окно: с 1 июня по 31 августа (1 раз за окно для обычных пользователей)</li>
                                    <li>Премиум аккаунт позволяет менять команду неограниченное количество раз и вне трансферного окна</li>
                                    <li>Новые пользователи без команды могут присоединиться бесплатно в любое время</li>
                                    <li>Если у команды менее 15 игроков, покинуть команду невозможно</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </section>

                <section id="rating-system" class="mb-12 scroll-mt-24">
                    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                        <div class="p-6 border-b">
                            <div class="flex items-center">
                                <div class="w-10 h-10 flex items-center justify-center bg-blue-100 text-primary rounded-full mr-4">
                                    <i class="ri-star-line ri-lg"></i>
                                </div>
                                <h2 class="text-2xl font-bold">Система рейтинга</h2>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="prose max-w-none">
                                <p class="mb-4">Каждый игрок имеет индивидуальный рейтинг, который определяет его место в команде. Рейтинг повышается путем участия в мини-играх и правильных прогнозах.</p>
                                
                                <h3 class="text-xl font-semibold mb-4 mt-6">ТОП игроки команды</h3>
                                <p class="mb-4">Перед каждым матчем команда заявляет <strong>ТОП 33 игрока</strong> с наивысшим рейтингом. Только эти игроки могут участвовать в реальных матчах команды.</p>
                            </div>
                        </div>
                    </div>
                </section>

                <section id="mini-games" class="mb-12 scroll-mt-24">
                    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                        <div class="p-6 border-b">
                            <div class="flex items-center">
                                <div class="w-10 h-10 flex items-center justify-center bg-blue-100 text-primary rounded-full mr-4">
                                    <i class="ri-gamepad-line ri-lg"></i>
                                </div>
                                <h2 class="text-2xl font-bold">Мини-игры и тренировки</h2>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="prose max-w-none">
                                <h3 class="text-xl font-semibold mb-4">Тренировка пробития пенальти</h3>
                                <p class="mb-4">Игрок выбирает угол (левый, центр, правый), система случайно выбирает, куда падает вратарь. Если выбор не совпал - гол, начисляется <strong>+0.001</strong> к рейтингу.</p>
                                
                                <h3 class="text-xl font-semibold mb-4 mt-6">Прогноз матчей</h3>
                                <p class="mb-4">Пользователь угадывает исходы реальных матчей на ближайшие 7 дней. За правильный прогноз начисляется <strong>+0.001</strong> к рейтингу. Можно сделать прогноз только 1 раз на матч.</p>
                                
                                <h3 class="text-xl font-semibold mb-4 mt-6">Чеканка (Keepie Uppie)</h3>
                                <p class="mb-4">Мяч падает сверху, игрок кликает по нему, чтобы подбросить вверх. С каждым разом мяч ускоряется. За каждый набитый мяч начисляется <strong>+0.0001</strong> к рейтингу. Прокачивает навык «Полузащита».</p>
                            </div>
                        </div>
                    </div>
                </section>

                <section id="matches" class="mb-12 scroll-mt-24">
                    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                        <div class="p-6 border-b">
                            <div class="flex items-center">
                                <div class="w-10 h-10 flex items-center justify-center bg-blue-100 text-primary rounded-full mr-4">
                                    <i class="ri-football-line ri-lg"></i>
                                </div>
                                <h2 class="text-2xl font-bold">Матчи и турниры</h2>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="prose max-w-none">
                                <p class="mb-4">Топ 33 игрока команды участвуют в реальных матчах между командами из разных городов и стран. Матчи могут быть турнирными (национальные и международные турниры) или товарищескими.</p>
                                
                                <h3 class="text-xl font-semibold mb-4 mt-6">Товарищеские матчи</h3>
                                <p class="mb-4">Проводятся 2 матча в день, участвуют топ 40 команд в случайном порядке. В матчах фиксируются голы, ассисты (с минутами) и состав игроков.</p>
                            </div>
                        </div>
                    </div>
                </section>

                <section id="points-system" class="mb-12 scroll-mt-24">
                    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                        <div class="p-6 border-b">
                            <div class="flex items-center">
                                <div class="w-10 h-10 flex items-center justify-center bg-blue-100 text-primary rounded-full mr-4">
                                    <i class="ri-trophy-line ri-lg"></i>
                                </div>
                                <h2 class="text-2xl font-bold">Система начисления очков</h2>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="prose max-w-none">
                                <h3 class="text-xl font-semibold mb-4">Внутренние кубки и чемпионаты</h3>
                                <ul class="list-disc list-inside space-y-2 mb-4">
                                    <li><strong>Победа:</strong> 3 очка</li>
                                    <li><strong>Ничья:</strong> 1 очко</li>
                                    <li><strong>Поражение:</strong> 0 очков</li>
                                </ul>
                                
                                <h3 class="text-xl font-semibold mb-4 mt-6">Международные кубки</h3>
                                <ul class="list-disc list-inside space-y-2 mb-4">
                                    <li><strong>Победа:</strong> 5 очков</li>
                                    <li><strong>Ничья:</strong> 3 очка</li>
                                    <li><strong>Поражение:</strong> 0 очков</li>
                                </ul>
                                
                                <h3 class="text-xl font-semibold mb-4 mt-6">Товарищеские игры</h3>
                                <ul class="list-disc list-inside space-y-2 mb-4">
                                    <li><strong>Победа:</strong> 2 очка</li>
                                    <li><strong>Ничья:</strong> 1 очко</li>
                                    <li><strong>Поражение:</strong> 0 очков</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </section>

                <section id="transfers" class="mb-12 scroll-mt-24">
                    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                        <div class="p-6 border-b">
                            <div class="flex items-center">
                                <div class="w-10 h-10 flex items-center justify-center bg-blue-100 text-primary rounded-full mr-4">
                                    <i class="ri-exchange-line ri-lg"></i>
                                </div>
                                <h2 class="text-2xl font-bold">Трансферы и сезоны</h2>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="prose max-w-none">
                                <p class="mb-4">Сезон определяется как текущий календарный год. Трансферное окно открыто с 1 июня по 31 августа.</p>
                                
                                <ul class="list-disc list-inside space-y-2 mb-4">
                                    <li>Обычные пользователи могут сменить команду <strong>1 раз</strong> за трансферное окно</li>
                                    <li>Премиум аккаунт позволяет менять команду неограниченное количество раз и вне трансферного окна</li>
                                    <li>Новые пользователи без команды могут присоединиться бесплатно в любое время</li>
                                    <li>Если у команды менее 15 игроков, покинуть команду невозможно</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </section>

                <section id="achievements" class="mb-12 scroll-mt-24">
                    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                        <div class="p-6 border-b">
                            <div class="flex items-center">
                                <div class="w-10 h-10 flex items-center justify-center bg-blue-100 text-primary rounded-full mr-4">
                                    <i class="ri-award-line ri-lg"></i>
                                </div>
                                <h2 class="text-2xl font-bold">Достижения</h2>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="prose max-w-none">
                                <h3 class="text-xl font-semibold mb-4">Чемпионство команды</h3>
                                <p class="mb-4">По итогам сезона команда, набравшая наибольшее количество очков, становится чемпионом турнира. Игроки, входящие в состав чемпионской команды, также получают статус чемпионов.</p>
                                
                                <h3 class="text-xl font-semibold mb-4 mt-6">Индивидуальные достижения</h3>
                                <ul class="list-disc list-inside space-y-2 mb-4">
                                    <li><strong>Лучший бомбардир:</strong> Игрок, забивший наибольшее количество голов</li>
                                    <li><strong>Автор голевых передач:</strong> Игрок, сделавший наибольшее количество голевых передач</li>
                                    <li>Статистика ведется отдельно для каждого турнира и общего сезона</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </section>
            @endif
        </div>
    </div>
</main>

@endsection

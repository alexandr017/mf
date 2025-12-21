<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel (optional) -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">

            <li class="@if(Request::routeIs('admin.index')) active @endif">
                <a href="{{ route('admin.index') }}">
                    <i class="fa fa-dashboard"></i>
                    <span>Панель управления</span>
                </a>
            </li>

            <li class="header">Турниры</li>
            <li class="@if(Request::routeIs('admin.tournaments.*')) active @endif">
                <a href="{{ route('admin.tournaments.index') }}">
                    <i class="fa fa-trophy"></i>
                    <span>Турниры</span>
                </a>
            </li>
            <li class="@if(Request::routeIs('admin.tournament-templates.*')) active @endif">
                <a href="{{ route('admin.tournament-templates.index') }}">
                    <i class="fa fa-file-text-o"></i>
                    <span>Шаблоны турниров</span>
                </a>
            </li>
            <li class="@if(Request::routeIs('admin.tournament-seasons.*')) active @endif">
                <a href="{{ route('admin.tournament-seasons.index') }}">
                    <i class="fa fa-calendar"></i>
                    <span>Сезоны</span>
                </a>
            </li>
            <li class="@if(Request::routeIs('admin.matches.*')) active @endif">
                <a href="{{ route('admin.matches.index') }}">
                    <i class="fa fa-futbol-o"></i>
                    <span>Матчи</span>
                </a>
            </li>

            <li class="header">Команды</li>
            <li class="@if(Request::routeIs('admin.teams.*')) active @endif">
                <a href="{{ route('admin.teams.index') }}">
                    <i class="fa fa-users"></i>
                    <span>Команды</span>
                </a>
            </li>
            <li class="@if(Request::routeIs('admin.team-players.*')) active @endif">
                <a href="{{ route('admin.team-players.index') }}">
                    <i class="fa fa-user-plus"></i>
                    <span>Составы команд</span>
                </a>
            </li>

            <li class="header">Справочники</li>
            <li class="@if(Request::routeIs('admin.countries.*')) active @endif">
                <a href="{{ route('admin.countries.index') }}">
                    <i class="fa fa-globe"></i>
                    <span>Страны</span>
                </a>
            </li>
            <li class="@if(Request::routeIs('admin.cities.*')) active @endif">
                <a href="{{ route('admin.cities.index') }}">
                    <i class="fa fa-building"></i>
                    <span>Города</span>
                </a>
            </li>

            <li class="header">Контент</li>
            <li class="@if(Request::routeIs('admin.news.*')) active @endif">
                <a href="{{ route('admin.news.index') }}">
                    <i class="fa fa-newspaper-o"></i>
                    <span>Новости</span>
                </a>
            </li>
            <li class="@if(Request::routeIs('admin.faq.*')) active @endif">
                <a href="{{ route('admin.faq.index') }}">
                    <i class="fa fa-question-circle"></i>
                    <span>Вопросы-ответы</span>
                </a>
            </li>
            <li class="@if(Request::routeIs('admin.games.*')) active @endif">
                <a href="{{ route('admin.games.index') }}">
                    <i class="fa fa-gamepad"></i>
                    <span>Игры</span>
                </a>
            </li>
            <li class="@if(Request::routeIs('admin.game-categories.*')) active @endif">
                <a href="{{ route('admin.game-categories.index') }}">
                    <i class="fa fa-tags"></i>
                    <span>Категории игр</span>
                </a>
            </li>

            <li class="header">Пользователи</li>
            <li class="@if(Request::routeIs('admin.users.*')) active @endif">
                <a href="{{ route('admin.users.index') }}">
                    <i class="fa fa-user"></i>
                    <span>Пользователи</span>
                </a>
            </li>
            <li class="@if(Request::routeIs('admin.reports.*')) active @endif">
                <a href="{{ route('admin.reports.index') }}">
                    <i class="fa fa-flag"></i>
                    <span>Жалобы</span>
                </a>
            </li>
            <li class="@if(Request::routeIs('admin.achievements.*')) active @endif">
                <a href="{{ route('admin.achievements.index') }}">
                    <i class="fa fa-trophy"></i>
                    <span>Достижения</span>
                </a>
            </li>
            <li class="@if(Request::routeIs('admin.referrals.*')) active @endif">
                <a href="{{ route('admin.referrals.index') }}">
                    <i class="fa fa-share-alt"></i>
                    <span>Статистика рефералов</span>
                </a>
            </li>
            <li class="@if(Request::routeIs('admin.user-game-results.*')) active @endif">
                <a href="{{ route('admin.user-game-results.index') }}">
                    <i class="fa fa-bar-chart"></i>
                    <span>Результаты игр</span>
                </a>
            </li>
            <li class="@if(Request::routeIs('admin.rating-history.*')) active @endif">
                <a href="{{ route('admin.rating-history.index') }}">
                    <i class="fa fa-line-chart"></i>
                    <span>История рейтинга</span>
                </a>
            </li>
            <li class="@if(Request::routeIs('admin.tickets.*')) active @endif">
                <a href="{{ route('admin.tickets.index') }}">
                    <i class="fa fa-ticket"></i>
                    <span>Тикеты</span>
                </a>
            </li>

            <li class="header">Система</li>
            <li class="@if(Request::routeIs('admin.activity-logs.*')) active @endif">
                <a href="{{ route('admin.activity-logs.index') }}">
                    <i class="fa fa-list-alt"></i>
                    <span>Логи действий</span>
                </a>
            </li>

            <li class="header">Универсальный раздел</li>
            <li class="@if(Request::routeIs('admin.static-pages.*')) active @endif">
                <a href="{{ route('admin.static-pages.index') }}">
                    <i class="fa fa-file-text-o"></i>
                    <span>Страницы</span>
                </a>
            </li>
        </ul>

        <!-- /.sidebar-menu -->

    </section>
</aside>

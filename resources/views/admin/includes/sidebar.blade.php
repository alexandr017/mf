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

            <li class="header">Команды</li>
            <li class="@if(Request::routeIs('admin.teams.*')) active @endif">
                <a href="{{ route('admin.teams.index') }}">
                    <i class="fa fa-users"></i>
                    <span>Команды</span>
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

            <li class="header">Пользователи</li>
            <li class="@if(Request::routeIs('admin.users.*')) active @endif">
                <a href="{{ route('admin.users.index') }}">
                    <i class="fa fa-user"></i>
                    <span>Пользователи</span>
                </a>
            </li>
            <li class="@if(Request::routeIs('admin.achievements.*')) active @endif">
                <a href="{{ route('admin.achievements.index') }}">
                    <i class="fa fa-trophy"></i>
                    <span>Достижения</span>
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

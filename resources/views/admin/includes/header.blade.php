<header class="main-header">

    <a href="/" target="_blank" class="logo">
        <span class="logo-lg">PIRCL</span>
    </a>

    <nav class="navbar navbar-static-top" role="navigation">
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">{{ trans('labels.general.toggle_navigation') }}</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
{{--                        <span class="hidden-xs">{{ auth()->user()->email }}</span>--}}
                    </a>

                    <ul class="dropdown-menu">
                        <li class="user-header">
                            <p>
{{--                                 {{ auth()->user()->email }}--}}
                            </p>
                        </li>



{{--                        <li class="user-footer">--}}
{{--                            <div class="pull-left">--}}
{{--                                <a href="/" class="btn btn-default btn-flat">--}}
{{--                                    <i class="fa fa-home"></i>--}}
{{--                                    Главная--}}
{{--                                </a>--}}
{{--                            </div>--}}
{{--                            <div class="pull-right">--}}
{{--                                <a href="{!! route('logout') !!}" class="btn btn-danger btn-flat">--}}
{{--                                    <i class="fa fa-sign-out"></i>--}}
{{--                                    Выход--}}
{{--                                </a>--}}
{{--                            </div>--}}
{{--                        </li>--}}
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-custom-menu -->
    </nav>
</header>

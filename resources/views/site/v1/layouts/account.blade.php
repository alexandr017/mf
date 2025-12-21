<!DOCTYPE html>
<html prefix="og: http://ogp.me/ns# @yield('additional_og_prefix', '')" lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Личный кабинет')</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="@yield('meta_description', '')">
    <meta name="format-detection" content="telephone=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('v1/fonts/fonts.css') }}">
    <link rel="stylesheet" href="/v1/fonts/remixicon.min.css">
    <script src="{{ asset('v1/js/tailwindcss.js') }}"></script>
    <script>tailwind.config={theme:{extend:{colors:{primary:'#7FFF00',secondary:'#FF355E'},borderRadius:{'none':'0px','sm':'4px',DEFAULT:'8px','md':'12px','lg':'16px','xl':'20px','2xl':'24px','3xl':'32px','full':'9999px','button':'8px'}}}}</script>
    <link rel="stylesheet" href="{{ asset('v1/styles/general.css') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Sofia+Sans+Condensed:ital,wght@0,1..1000;1,1..1000&family=Yanone+Kaffeesatz:wght@200..700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap" rel="stylesheet">

    <style>
        body {font-family: "Manrope", sans-serif;}
        h1,h2,h3,h4,h5,h6,.heading-font{font-family: 'Yanone Kaffeesatz', sans-serif;}
        .sidebar-active {
            background-color: rgba(127, 255, 0, 0.1);
            border-right: 4px solid #7FFF00;
            color: #7FFF00;
        }
        .card-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -5px rgba(0, 0, 0, 0.04);
        }
        .stat-card {
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            border: 1px solid #e2e8f0;
        }
        @keyframes pulse-glow {
            0%, 100% {
                box-shadow: 0 0 0 0 rgba(127, 255, 0, 0.7);
            }
            50% {
                box-shadow: 0 0 0 10px rgba(127, 255, 0, 0);
            }
        }
        .account-sidebar-button {
            animation: pulse-glow 2s infinite;
        }
    </style>
</head>
<body>
@include('site.stats')
<script>const $$ = (s) => document.querySelectorAll(s); </script>

<!-- Header -->
@include('site.v1.modules.header.header')

<div class="flex min-h-screen relative">
    <!-- Mobile Sidebar Button -->
    <button id="account-sidebar-button" class="account-sidebar-button md:hidden fixed top-24 left-4 z-30 bg-primary text-gray-900 p-4 rounded-xl shadow-2xl hover:bg-opacity-90 transition-all duration-200 transform hover:scale-110 active:scale-95">
        <i class="ri-menu-line text-2xl font-bold"></i>
    </button>

    <!-- Mobile Overlay -->
    <div id="mobile-overlay" class="md:hidden fixed inset-0 bg-black bg-opacity-50 z-40 hidden"></div>

    <!-- Sidebar -->
    <aside id="account-sidebar" class="fixed md:sticky md:top-16 inset-y-0 left-0 z-50 w-64 bg-white shadow-lg transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out md:h-[calc(100vh-4rem)]">
        @include('site.v1.modules.account-menu.account-menu')
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-4 md:p-8 w-full md:w-auto">
        @include('site.v1.modules.breadcrumbs-account.breadcrumbs-account')
        @yield('content')
    </main>
</div>

@include('site.v1.modules.footer.footer')

@yield('additional-scripts')

<script>
    // Mobile sidebar toggle
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.getElementById('account-sidebar');
        const overlay = document.getElementById('mobile-overlay');
        const sidebarButton = document.getElementById('account-sidebar-button');
        const closeButton = document.getElementById('close-sidebar-button');

        function openSidebar() {
            sidebar.classList.remove('-translate-x-full');
            sidebar.classList.add('translate-x-0');
            overlay.classList.remove('hidden');
            if (sidebarButton) {
                sidebarButton.classList.add('hidden');
            }
            document.body.style.overflow = 'hidden';
        }

        function closeSidebar() {
            sidebar.classList.remove('translate-x-0');
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
            if (sidebarButton) {
                sidebarButton.classList.remove('hidden');
            }
            document.body.style.overflow = '';
        }

        if (sidebarButton) {
            sidebarButton.addEventListener('click', function(e) {
                e.stopPropagation();
                e.preventDefault();
                openSidebar();
            });
        }

        if (closeButton) {
            closeButton.addEventListener('click', closeSidebar);
        }

        if (overlay) {
            overlay.addEventListener('click', closeSidebar);
        }

        // Close sidebar when clicking on a link (mobile only)
        const sidebarLinks = sidebar.querySelectorAll('a');
        sidebarLinks.forEach(link => {
            link.addEventListener('click', function() {
                if (window.innerWidth < 768) {
                    closeSidebar();
                }
            });
        });

        // Handle window resize
        window.addEventListener('resize', function() {
            if (window.innerWidth >= 768) {
                closeSidebar();
            }
        });
    });
</script>
</body>
</html>


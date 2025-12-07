<!DOCTYPE html>
<html prefix="og: http://ogp.me/ns# @yield('additional_og_prefix', '')" lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', '')</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="@yield('meta_description', '')">
{{--    <link rel="canonical" href="{{response::getCanonical()}}">--}}
    <meta name="format-detection" content="telephone=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">



{{--    <link rel="preconnect" href="https://fonts.googleapis.com">--}}
{{--    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>--}}
{{--    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">--}}
{{--    <link href="https://fonts.googleapis.com/css2?family=Bangers&family=Russo+One&family=Rubik:wght@400;500;600;700&display=swap" rel="stylesheet">--}}
{{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css">--}}
    <link rel="stylesheet" href="/v1/fonts/fonts.css">
{{--    <script src="https://cdn.tailwindcss.com/3.4.16"></script>--}}
    <script src="/v1/js/tailwindcss.js"></script>
    <script>tailwind.config={theme:{extend:{colors:{primary:'#7FFF00',secondary:'#FF355E'},borderRadius:{'none':'0px','sm':'4px',DEFAULT:'8px','md':'12px','lg':'16px','xl':'20px','2xl':'24px','3xl':'32px','full':'9999px','button':'8px'}}}}</script>
    <link rel="stylesheet" href="/v1/styles/general.css">
</head>
<body>
@include('site.stats')
<script>const $$ = (s) => document.querySelectorAll(s); </script>
@include('site.v1.modules.header.header')

@yield('content')

{{--@include('site.v1.modules.cookies.index')--}}
@include('site.v1.modules.footer.footer')


@yield('additional-scripts')
</body>
</html>

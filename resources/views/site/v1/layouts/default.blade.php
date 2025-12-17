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
    <link rel="stylesheet" href="{{ asset('v1/fonts/fonts.css') }}">
    <link rel="stylesheet" href="/v1/fonts/remixicon.min.css">
{{--    <script src="https://cdn.tailwindcss.com/3.4.16"></script>--}}
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
    </style>

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

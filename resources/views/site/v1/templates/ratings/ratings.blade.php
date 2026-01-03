@extends('site.v1.layouts.default')
{{--@section ('title', Shortcode::compile($page->title))--}}
{{--@section ('meta_description', Shortcode::compile($page->meta_description))--}}

@section('content')

@include('site.v1.modules.tournaments-banner.tournaments-banner', ['image' => '/v1/images/ratings-banner.png'])

<section class="py-10 bg-white">
    <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8 mb-8 w-full overflow-hidden">
        <div class="bg-white shadow-lg rounded-lg overflow-hidden w-full">
            <div class="table-scroll-container w-full">
                @include('site.v1.modules.table-rating.table-rating')
            </div>
        </div>
    </div>
    
    <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white shadow-lg rounded-lg p-6">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">Система начисления очков</h2>
            <div class="prose max-w-none">
                <p class="text-gray-700 mb-4">
                    В клубном рейтинге участвуют все команды проекта. Очки начисляются командам в зависимости от типа соревнований и результата матча:
                </p>
                <ul class="list-disc list-inside space-y-2 text-gray-700 mb-4">
                    <li><strong>Внутренние кубки и чемпионаты:</strong> 3 очка за победу, 1 очко за ничью</li>
                    <li><strong>Международные кубки:</strong> 5 очков за победу, 3 очка за ничью</li>
                    <li><strong>Товарищеские игры:</strong> 2 очка за победу, 1 очко за ничью</li>
                </ul>
                <p class="text-gray-600 text-sm">
                    При равенстве очков команды ранжируются по разнице мячей, затем по количеству побед.
                </p>
            </div>
        </div>
    </div>
</section>

<style>
    /* Контейнер для скролла таблицы */
    .table-scroll-container {
        overflow-x: auto;
        overflow-y: visible;
        -webkit-overflow-scrolling: touch;
        width: 100%;
        max-width: 100%;
        position: relative;
    }
    
    /* Стили для красивого скроллбара таблицы */
    .table-scroll-container::-webkit-scrollbar {
        height: 8px;
    }
    
    .table-scroll-container::-webkit-scrollbar-track {
        background: #f7fafc;
        border-radius: 4px;
    }
    
    .table-scroll-container::-webkit-scrollbar-thumb {
        background: #cbd5e0;
        border-radius: 4px;
    }
    
    .table-scroll-container::-webkit-scrollbar-thumb:hover {
        background: #a0aec0;
    }
    
    /* Для Firefox */
    .table-scroll-container {
        scrollbar-width: thin;
        scrollbar-color: #cbd5e0 #f7fafc;
    }
    
    /* Улучшение sticky колонок */
    .table-scroll-container table thead th.sticky,
    .table-scroll-container table tbody td.sticky {
        box-shadow: 2px 0 5px -2px rgba(0, 0, 0, 0.1);
    }
    
    /* Убеждаемся, что таблица не выходит за границы */
    .table-scroll-container table {
        margin: 0;
        width: 100%;
        display: table;
        table-layout: auto;
    }
    
    /* Предотвращаем горизонтальный скролл на уровне body и html */
    html, body {
        overflow-x: hidden !important;
        max-width: 100vw !important;
        position: relative;
    }
    
    /* Убеждаемся, что все контейнеры ограничивают ширину */
    .max-w-7xl {
        max-width: 100%;
        box-sizing: border-box;
    }
    
    /* Убеждаемся, что section не создает overflow */
    section {
        overflow-x: hidden;
        max-width: 100%;
    }
</style>
@endsection

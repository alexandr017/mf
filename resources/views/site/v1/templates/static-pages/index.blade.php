@extends('site.v1.layouts.default')
@section ('title', $page->title)
@section ('meta_description', $page->meta_description)

@section('content')

    @include('site.v1.modules.index-banner.index-banner')

    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="heading-font text-4xl text-gray-900 mb-8">Последние игры</h2>
            <div class="flex overflow-x-auto pb-4 gap-6 hide-scrollbar">
                @for($i = 0; $i < 5; $i++)
                    @include('site.v1.modules.recent-game.recent-game')
                @endfor
            </div>
            <a href="/ratings" class="text-primary hover:text-primary-dark font-medium flex items-center">
                Смотреть все
                <div class="w-5 h-5 ml-1 flex items-center justify-center">
                    <i class="ri-arrow-right-line"></i>
                </div>
            </a>
        </div>
    </section>

    <!-- Upcoming Matches -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="heading-font text-4xl text-gray-900 mb-8">Предстоящие матчи</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @for($i = 0; $i < 3; $i++)
                @include('site.v1.modules.upcoming-match.upcoming-match')
                @endfor
            </div>
            <a href="/ratings" class="text-primary hover:text-primary-dark font-medium flex items-center">
                Смотреть все
                <div class="w-5 h-5 ml-1 flex items-center justify-center">
                    <i class="ri-arrow-right-line"></i>
                </div>
            </a>
        </div>
    </section>

    <!-- Club Rankings -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="heading-font text-4xl text-gray-900 mb-8">Клубный рейтинг</h2>
            <div class="overflow-x-auto">
                @include('site.v1.modules.table-rating.table-rating')
            </div>
            <a href="/ratings" class="text-primary hover:text-primary-dark font-medium flex items-center">
                Смотреть все
                <div class="w-5 h-5 ml-1 flex items-center justify-center">
                    <i class="ri-arrow-right-line"></i>
                </div>
            </a>
        </div>
    </section>

    <!-- Rules Block -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow-lg overflow-hidden border-2 border-dashed border-primary">
                <div class="p-8">
                    <h2 class="heading-font text-4xl text-gray-900 mb-6 flex items-center">
                        <div class="w-8 h-8 mr-2 flex items-center justify-center text-primary">
                            <i class="ri-file-list-3-line ri-lg"></i>
                        </div>
                        Правила игры
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <ul class="space-y-4">
                                <li class="flex">
                                    <div class="w-6 h-6 mr-2 flex items-center justify-center text-primary flex-shrink-0 mt-0.5">
                                        <i class="ri-checkbox-circle-line"></i>
                                    </div>
                                    <span>Teams must have ridiculous names related to disgusting things, diseases, or bodily functions.</span>
                                </li>
                                <li class="flex">
                                    <div class="w-6 h-6 mr-2 flex items-center justify-center text-primary flex-shrink-0 mt-0.5">
                                        <i class="ri-checkbox-circle-line"></i>
                                    </div>
                                    <span>Matches are played in the worst possible conditions: mud, rain, garbage dumps, or abandoned factories.</span>
                                </li>
                                <li class="flex">
                                    <div class="w-6 h-6 mr-2 flex items-center justify-center text-primary flex-shrink-0 mt-0.5">
                                        <i class="ri-checkbox-circle-line"></i>
                                    </div>
                                    <span>Each team must have at least one "mascot" that represents their name (e.g., Perm Pimples have a person in a giant zit costume).</span>
                                </li>
                            </ul>
                        </div>
                        <div>
                            <ul class="space-y-4">
                                <li class="flex">
                                    <div class="w-6 h-6 mr-2 flex items-center justify-center text-primary flex-shrink-0 mt-0.5">
                                        <i class="ri-checkbox-circle-line"></i>
                                    </div>
                                    <span>Standard football rules apply, except the referee can randomly add "challenge rounds" where players must perform ridiculous tasks.</span>
                                </li>
                                <li class="flex">
                                    <div class="w-6 h-6 mr-2 flex items-center justify-center text-primary flex-shrink-0 mt-0.5">
                                        <i class="ri-checkbox-circle-line"></i>
                                    </div>
                                    <span>Teams earn 3 points for a win, 1 for a draw, and 0 for a loss. The team with the most points at the end of the season wins the "Golden Toilet" trophy.</span>
                                </li>
                                <li class="flex">
                                    <div class="w-6 h-6 mr-2 flex items-center justify-center text-primary flex-shrink-0 mt-0.5">
                                        <i class="ri-checkbox-circle-line"></i>
                                    </div>
                                    <span>Fans are encouraged to dress up in theme with their team and bring absurd props to matches.</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="mt-8 text-center">
                        <button class="bg-primary hover:bg-opacity-80 text-gray-900 font-bold px-6 py-3 !rounded-button whitespace-nowrap">
                            <div class="flex items-center gap-2">
                                <div class="w-5 h-5 flex items-center justify-center">
                                    <i class="ri-book-open-line"></i>
                                </div>
                                <span>Читать все правила</span>
                            </div>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Create Your Team -->
    @include('site.v1.modules.create-team.create-team')

    <!-- How to Join Section -->
    @include('site.v1.modules.how-to-join.how-to-join')

    <!-- News Section -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-8">
                <h2 class="heading-font text-4xl text-gray-900">Последние новости</h2>
                <a href="/blog" class="text-primary hover:text-primary-dark font-medium flex items-center">
                    Все новости
                    <div class="w-5 h-5 ml-1 flex items-center justify-center">
                        <i class="ri-arrow-right-line"></i>
                    </div>
                </a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($posts as $post)
                    @include('site.v1.modules.news.news', compact('post'))
                @endforeach
            </div>
        </div>
    </section>

@endsection

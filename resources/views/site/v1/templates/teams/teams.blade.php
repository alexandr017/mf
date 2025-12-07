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
                    <input type="text" class="block w-full pl-10 pr-3 py-2 border-none rounded-lg bg-gray-100 focus:bg-white focus:ring-2 focus:ring-primary text-sm" placeholder="Search teams by name or city...">
                </div>
                <div class="flex gap-4">
                    <button class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 !rounded-button whitespace-nowrap">
                        <div class="flex items-center gap-2">
                            <div class="w-5 h-5 flex items-center justify-center">
                                <i class="ri-filter-3-line"></i>
                            </div>
                            <span>Сортировать</span>
                        </div>
                    </button>
                    <select class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 !rounded-button pr-8 appearance-none">
                        <option>по рейтингу</option>
                        <option>по название</option>
                        <option>по рейтингу</option>
                        <option>по титулам</option>
                    </select>
                </div>
            </div>

            <!-- Teams Grid -->
            <div class="mt-12 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

                @foreach($teams as $team)
                    <!-- Kazan Cockroaches -->
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden border-2 border-gray-100 hover:border-primary transition-all duration-300 card-hover">
                        <div class="relative">
                            <div class="h-48 overflow-hidden">
                                <img src="https://readdy.ai/api/search-image?query=A%20funny%20cartoon%20stadium%20interior%20with%20cockroach%20themed%20decorations%2C%20team%20banners%2C%20and%20enthusiastic%20fans%20in%20insect%20costumes%2C%20comic%20style%20illustration&amp;width=800&amp;height=400&amp;seq=14&amp;orientation=landscape" alt="Kazan Cockroaches Stadium" class="w-full h-full object-cover object-top">
                            </div>
                            <div class="absolute top-4 right-4 bg-primary text-gray-900 px-3 py-1 rounded-full text-sm font-bold">
                                #1 Ranked
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center gap-4 mb-4">
                                <div class="w-20 h-20 rounded-full overflow-hidden border-4 border-primary">
                                    <img src="https://readdy.ai/api/search-image?query=A%20funny%20cartoon%20logo%20for%20a%20football%20team%20called%20Kazan%20Cockroaches%20with%20insect%20theme%2C%20comic%20style&amp;width=200&amp;height=200&amp;seq=6&amp;orientation=squarish" alt="Kazan Cockroaches" class="w-full h-full object-cover object-top">
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
                                    <span class="text-gray-600">League Titles: 3 (2023, 2024, 2025)</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <div class="w-5 h-5 text-primary">
                                        <i class="ri-cup-line"></i>
                                    </div>
                                    <span class="text-gray-600">Chaos Cup: 2 (2023, 2024)</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <div class="w-5 h-5 text-primary">
                                        <i class="ri-team-line"></i>
                                    </div>
                                    <span class="text-gray-600">Squad Size: 25 Players</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <div class="w-5 h-5 text-primary">
                                        <i class="ri-home-4-line"></i>
                                    </div>
                                    <span class="text-gray-600">Стадион: {{$team->stadium}}</span>
                                </div>
                            </div>
                            <div class="mt-6 flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <div class="w-5 h-5 text-yellow-400">
                                        <i class="ri-star-fill"></i>
                                    </div>
                                    <span class="font-bold">Рейтинг: 4.8/5</span>
                                </div>
                                <a href="/teams/{{$team->alias}}" class="bg-primary hover:bg-opacity-80 text-gray-900 px-4 py-2 !rounded-button whitespace-nowrap">Подробнее</a>
                            </div>
                        </div>
                    </div>
                @endforeach


                <!-- Omsk Stream -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden border-2 border-gray-100 hover:border-primary transition-all duration-300 card-hover">
                    <div class="relative">
                        <div class="h-48 overflow-hidden">
                            <img src="https://readdy.ai/api/search-image?query=A%20funny%20cartoon%20stadium%20near%20a%20river%20with%20water%20themed%20decorations%2C%20team%20banners%2C%20and%20fans%20with%20water-related%20costumes%2C%20comic%20style%20illustration&amp;width=800&amp;height=400&amp;seq=15&amp;orientation=landscape" alt="Omsk Stream Stadium" class="w-full h-full object-cover object-top">
                        </div>
                        <div class="absolute top-4 right-4 bg-secondary text-white px-3 py-1 rounded-full text-sm font-bold">
                            #2 Ranked
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="w-20 h-20 rounded-full overflow-hidden border-4 border-primary">
                                <img src="https://readdy.ai/api/search-image?query=A%20funny%20cartoon%20logo%20for%20a%20football%20team%20called%20Omsk%20Stream%20with%20water%20theme%20elements%2C%20blue%20colors%2C%20comic%20style&amp;width=200&amp;height=200&amp;seq=2&amp;orientation=squarish" alt="Omsk Stream" class="w-full h-full object-cover object-top">
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-900">Omsk Stream 💧</h3>
                                <p class="text-gray-500">Omsk, Russia</p>
                            </div>
                        </div>
                        <div class="space-y-3">
                            <div class="flex items-center gap-2">
                                <div class="w-5 h-5 text-primary">
                                    <i class="ri-trophy-line"></i>
                                </div>
                                <span class="text-gray-600">League Titles: 2 (2021, 2022)</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <div class="w-5 h-5 text-primary">
                                    <i class="ri-cup-line"></i>
                                </div>
                                <span class="text-gray-600">Chaos Cup: 1 (2022)</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <div class="w-5 h-5 text-primary">
                                    <i class="ri-team-line"></i>
                                </div>
                                <span class="text-gray-600">Squad Size: 23 Players</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <div class="w-5 h-5 text-primary">
                                    <i class="ri-home-4-line"></i>
                                </div>
                                <span class="text-gray-600">Стадион: The Waterfall (Cap. 12,000)</span>
                            </div>
                        </div>
                        <div class="mt-6 flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <div class="w-5 h-5 text-yellow-400">
                                    <i class="ri-star-fill"></i>
                                </div>
                                <span class="font-bold">Rating: 4.6/5</span>
                            </div>
                            <a href="/teams/team-1" class="bg-primary hover:bg-opacity-80 text-gray-900 px-4 py-2 !rounded-button whitespace-nowrap">Подробнее</a>
                        </div>
                    </div>
                </div>

                <!-- Moscow Mildew -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden border-2 border-gray-100 hover:border-primary transition-all duration-300 card-hover">
                    <div class="relative">
                        <div class="h-48 overflow-hidden">
                            <img src="https://readdy.ai/api/search-image?query=A%20funny%20cartoon%20stadium%20with%20fungus%20themed%20decorations%2C%20team%20banners%2C%20and%20fans%20wearing%20mushroom%20hats%2C%20comic%20style%20illustration&amp;width=800&amp;height=400&amp;seq=16&amp;orientation=landscape" alt="Moscow Mildew Stadium" class="w-full h-full object-cover object-top">
                        </div>
                        <div class="absolute top-4 right-4 bg-gray-800 text-white px-3 py-1 rounded-full text-sm font-bold">
                            #3 Ranked
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="w-20 h-20 rounded-full overflow-hidden border-4 border-primary">
                                <img src="https://readdy.ai/api/search-image?query=A%20funny%20cartoon%20logo%20for%20a%20football%20team%20called%20Moscow%20Mildew%20with%20fungus%20theme%2C%20comic%20style&amp;width=200&amp;height=200&amp;seq=7&amp;orientation=squarish" alt="Moscow Mildew" class="w-full h-full object-cover object-top">
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-900">Moscow Mildew 🍄</h3>
                                <p class="text-gray-500">Moscow, Russia</p>
                            </div>
                        </div>
                        <div class="space-y-3">
                            <div class="flex items-center gap-2">
                                <div class="w-5 h-5 text-primary">
                                    <i class="ri-trophy-line"></i>
                                </div>
                                <span class="text-gray-600">League Titles: 1 (2020)</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <div class="w-5 h-5 text-primary">
                                    <i class="ri-cup-line"></i>
                                </div>
                                <span class="text-gray-600">Chaos Cup: 3 (2020, 2021, 2025)</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <div class="w-5 h-5 text-primary">
                                    <i class="ri-team-line"></i>
                                </div>
                                <span class="text-gray-600">Squad Size: 24 Players</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <div class="w-5 h-5 text-primary">
                                    <i class="ri-home-4-line"></i>
                                </div>
                                <span class="text-gray-600">Стадион: Fungus Field (Cap. 18,000)</span>
                            </div>
                        </div>
                        <div class="mt-6 flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <div class="w-5 h-5 text-yellow-400">
                                    <i class="ri-star-fill"></i>
                                </div>
                                <span class="font-bold">Rating: 4.5/5</span>
                            </div>
                            <a href="/teams/team-1" class="bg-primary hover:bg-opacity-80 text-gray-900 px-4 py-2 !rounded-button whitespace-nowrap">Подробнее</a>
                        </div>
                    </div>
                </div>

                <!-- More teams... -->
            </div>

            <!-- Load More Button -->
            <div class="mt-12 text-center">
                <button class="bg-white border-2 border-primary hover:bg-primary hover:text-white text-primary font-bold px-8 py-3 !rounded-button whitespace-nowrap transition-colors duration-300">
                    <div class="flex items-center gap-2">
                        <div class="w-5 h-5 flex items-center justify-center">
                            <i class="ri-refresh-line"></i>
                        </div>
                        <span>Load More Teams</span>
                    </div>
                </button>
            </div>
        </div>
    </section>
@endsection

@extends('site.v1.layouts.default')
@section ('title', $page->title)
@section ('meta_description', $page->meta_description)

@section('content')

    @include('site.v1.modules.index-banner.index-banner')

    <!-- Recent Games -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="heading-font text-4xl text-gray-900 mb-8">Recent Games</h2>
            <div class="flex overflow-x-auto pb-4 gap-6 hide-scrollbar">

                @include('site.v1.modules.recent-game.recent-game')

                <div class="bg-white rounded-lg shadow-lg p-6 min-w-[300px] border-2 border-primary card-hover transition-all duration-300">
                    <div class="flex justify-between items-center mb-4">
                        <div class="flex flex-col items-center">
                            <div class="w-16 h-16 bg-gray-200 rounded-full mb-2 flex items-center justify-center overflow-hidden">
                                <img src="https://readdy.ai/api/search-image?query=A%20funny%20cartoon%20logo%20for%20a%20football%20team%20called%20Omsk%20Stream%20with%20water%20theme%20elements%2C%20blue%20colors%2C%20comic%20style&width=200&height=200&seq=2&orientation=squarish" alt="Omsk Stream" class="object-cover w-full h-full object-top">
                            </div>
                            <span class="font-medium text-sm">Omsk Stream</span>
                        </div>
                        <div class="flex flex-col items-center">
                            <div class="bg-gray-100 px-4 py-2 rounded-lg mb-1">
                                <span class="text-2xl font-bold">3 - 2</span>
                            </div>
                            <span class="text-xs text-gray-500">June 15, 2025</span>
                        </div>
                        <div class="flex flex-col items-center">
                            <div class="w-16 h-16 bg-gray-200 rounded-full mb-2 flex items-center justify-center overflow-hidden">
                                <img src="https://readdy.ai/api/search-image?query=A%20funny%20cartoon%20logo%20for%20a%20football%20team%20called%20Perm%20Pimples%20with%20acne%20theme%2C%20red%20colors%2C%20comic%20style&width=200&height=200&seq=3&orientation=squarish" alt="Perm Pimples" class="object-cover w-full h-full object-top">
                            </div>
                            <span class="font-medium text-sm">Perm Pimples</span>
                        </div>
                    </div>
                    <div class="text-center">
                        <span class="bg-gray-100 text-gray-800 text-xs font-medium px-2.5 py-0.5 rounded">Mud Stadium</span>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-lg p-6 min-w-[300px] border-2 border-gray-200 card-hover transition-all duration-300">
                    <div class="flex justify-between items-center mb-4">
                        <div class="flex flex-col items-center">
                            <div class="w-16 h-16 bg-gray-200 rounded-full mb-2 flex items-center justify-center overflow-hidden">
                                <img src="https://readdy.ai/api/search-image?query=A%20funny%20cartoon%20logo%20for%20a%20football%20team%20called%20Snot%20FC%20with%20green%20slime%20theme%2C%20comic%20style&width=200&height=200&seq=4&orientation=squarish" alt="Snot FC" class="object-cover w-full h-full object-top">
                            </div>
                            <span class="font-medium text-sm">Snot FC</span>
                        </div>
                        <div class="flex flex-col items-center">
                            <div class="bg-gray-100 px-4 py-2 rounded-lg mb-1">
                                <span class="text-2xl font-bold">1 - 0</span>
                            </div>
                            <span class="text-xs text-gray-500">June 12, 2025</span>
                        </div>
                        <div class="flex flex-col items-center">
                            <div class="w-16 h-16 bg-gray-200 rounded-full mb-2 flex items-center justify-center overflow-hidden">
                                <img src="https://readdy.ai/api/search-image?query=A%20funny%20cartoon%20logo%20for%20a%20football%20team%20called%20Tula%20Toothaches%20with%20dental%20pain%20theme%2C%20comic%20style&width=200&height=200&seq=5&orientation=squarish" alt="Tula Toothaches" class="object-cover w-full h-full object-top">
                            </div>
                            <span class="font-medium text-sm">Tula Toothaches</span>
                        </div>
                    </div>
                    <div class="text-center">
                        <span class="bg-gray-100 text-gray-800 text-xs font-medium px-2.5 py-0.5 rounded">Swamp Arena</span>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-lg p-6 min-w-[300px] border-2 border-gray-200 card-hover transition-all duration-300">
                    <div class="flex justify-between items-center mb-4">
                        <div class="flex flex-col items-center">
                            <div class="w-16 h-16 bg-gray-200 rounded-full mb-2 flex items-center justify-center overflow-hidden">
                                <img src="https://readdy.ai/api/search-image?query=A%20funny%20cartoon%20logo%20for%20a%20football%20team%20called%20Kazan%20Cockroaches%20with%20insect%20theme%2C%20comic%20style&width=200&height=200&seq=6&orientation=squarish" alt="Kazan Cockroaches" class="object-cover w-full h-full object-top">
                            </div>
                            <span class="font-medium text-sm">Kazan Cockroaches</span>
                        </div>
                        <div class="flex flex-col items-center">
                            <div class="bg-gray-100 px-4 py-2 rounded-lg mb-1">
                                <span class="text-2xl font-bold">4 - 1</span>
                            </div>
                            <span class="text-xs text-gray-500">June 10, 2025</span>
                        </div>
                        <div class="flex flex-col items-center">
                            <div class="w-16 h-16 bg-gray-200 rounded-full mb-2 flex items-center justify-center overflow-hidden">
                                <img src="https://readdy.ai/api/search-image?query=A%20funny%20cartoon%20logo%20for%20a%20football%20team%20called%20Moscow%20Mildew%20with%20fungus%20theme%2C%20comic%20style&width=200&height=200&seq=7&orientation=squarish" alt="Moscow Mildew" class="object-cover w-full h-full object-top">
                            </div>
                            <span class="font-medium text-sm">Moscow Mildew</span>
                        </div>
                    </div>
                    <div class="text-center">
                        <span class="bg-gray-100 text-gray-800 text-xs font-medium px-2.5 py-0.5 rounded">Garbage Dump Stadium</span>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-lg p-6 min-w-[300px] border-2 border-gray-200 card-hover transition-all duration-300">
                    <div class="flex justify-between items-center mb-4">
                        <div class="flex flex-col items-center">
                            <div class="w-16 h-16 bg-gray-200 rounded-full mb-2 flex items-center justify-center overflow-hidden">
                                <img src="https://readdy.ai/api/search-image?query=A%20funny%20cartoon%20logo%20for%20a%20football%20team%20called%20Vladivostok%20Vomit%20with%20sick%20theme%2C%20comic%20style&width=200&height=200&seq=8&orientation=squarish" alt="Vladivostok Vomit" class="object-cover w-full h-full object-top">
                            </div>
                            <span class="font-medium text-sm">Vladivostok Vomit</span>
                        </div>
                        <div class="flex flex-col items-center">
                            <div class="bg-gray-100 px-4 py-2 rounded-lg mb-1">
                                <span class="text-2xl font-bold">2 - 2</span>
                            </div>
                            <span class="text-xs text-gray-500">June 8, 2025</span>
                        </div>
                        <div class="flex flex-col items-center">
                            <div class="w-16 h-16 bg-gray-200 rounded-full mb-2 flex items-center justify-center overflow-hidden">
                                <img src="https://readdy.ai/api/search-image?query=A%20funny%20cartoon%20logo%20for%20a%20football%20team%20called%20Sochi%20Stench%20with%20bad%20smell%20theme%2C%20comic%20style&width=200&height=200&seq=9&orientation=squarish" alt="Sochi Stench" class="object-cover w-full h-full object-top">
                            </div>
                            <span class="font-medium text-sm">Sochi Stench</span>
                        </div>
                    </div>
                    <div class="text-center">
                        <span class="bg-gray-100 text-gray-800 text-xs font-medium px-2.5 py-0.5 rounded">Landfill Field</span>
                    </div>
                </div>

                <div class="flex items-center justify-center min-w-[100px]">
                    <a href="#" class="text-primary hover:text-primary-dark font-medium flex items-center">
                        View All
                        <div class="w-5 h-5 ml-1 flex items-center justify-center">
                            <i class="ri-arrow-right-line"></i>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Upcoming Matches -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="heading-font text-4xl text-gray-900 mb-8">Upcoming Matches</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                @include('site.v1.modules.upcoming-match.upcoming-match')

                <div class="bg-white rounded-lg shadow-lg overflow-hidden card-hover transition-all duration-300">
                    <div class="bg-secondary bg-opacity-10 p-4 text-center">
                        <span class="text-secondary font-bold">June 20, 2025 - 18:00 MSK</span>
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-6">
                            <div class="flex flex-col items-center">
                                <div class="w-20 h-20 bg-gray-200 rounded-full mb-2 flex items-center justify-center overflow-hidden">
                                    <img src="https://readdy.ai/api/search-image?query=A%20funny%20cartoon%20logo%20for%20a%20football%20team%20called%20Perm%20Pimples%20with%20acne%20theme%2C%20red%20colors%2C%20comic%20style&width=200&height=200&seq=3&orientation=squarish" alt="Perm Pimples" class="object-cover w-full h-full object-top">
                                </div>
                                <span class="font-bold">Perm Pimples</span>
                            </div>
                            <div class="text-center">
                                <span class="text-2xl font-bold text-gray-400">VS</span>
                                <div class="countdown-timer mt-2 text-sm font-medium text-gray-500">
                                    <span id="countdown-1">1d 23h 42m</span>
                                </div>
                            </div>
                            <div class="flex flex-col items-center">
                                <div class="w-20 h-20 bg-gray-200 rounded-full mb-2 flex items-center justify-center overflow-hidden">
                                    <img src="https://readdy.ai/api/search-image?query=A%20funny%20cartoon%20logo%20for%20a%20football%20team%20called%20Kazan%20Cockroaches%20with%20insect%20theme%2C%20comic%20style&width=200&height=200&seq=6&orientation=squarish" alt="Kazan Cockroaches" class="object-cover w-full h-full object-top">
                                </div>
                                <span class="font-bold">Kazan Cockroaches</span>
                            </div>
                        </div>
                        <div class="text-center">
                            <span class="bg-gray-100 text-gray-800 text-sm font-medium px-3 py-1 rounded">Mud Stadium</span>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-lg overflow-hidden card-hover transition-all duration-300">
                    <div class="bg-secondary bg-opacity-10 p-4 text-center">
                        <span class="text-secondary font-bold">June 21, 2025 - 16:30 MSK</span>
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-6">
                            <div class="flex flex-col items-center">
                                <div class="w-20 h-20 bg-gray-200 rounded-full mb-2 flex items-center justify-center overflow-hidden">
                                    <img src="https://readdy.ai/api/search-image?query=A%20funny%20cartoon%20logo%20for%20a%20football%20team%20called%20Snot%20FC%20with%20green%20slime%20theme%2C%20comic%20style&width=200&height=200&seq=4&orientation=squarish" alt="Snot FC" class="object-cover w-full h-full object-top">
                                </div>
                                <span class="font-bold">Snot FC</span>
                            </div>
                            <div class="text-center">
                                <span class="text-2xl font-bold text-gray-400">VS</span>
                                <div class="countdown-timer mt-2 text-sm font-medium text-gray-500">
                                    <span id="countdown-2">2d 22h 12m</span>
                                </div>
                            </div>
                            <div class="flex flex-col items-center">
                                <div class="w-20 h-20 bg-gray-200 rounded-full mb-2 flex items-center justify-center overflow-hidden">
                                    <img src="https://readdy.ai/api/search-image?query=A%20funny%20cartoon%20logo%20for%20a%20football%20team%20called%20Vladivostok%20Vomit%20with%20sick%20theme%2C%20comic%20style&width=200&height=200&seq=8&orientation=squarish" alt="Vladivostok Vomit" class="object-cover w-full h-full object-top">
                                </div>
                                <span class="font-bold">Vladivostok Vomit</span>
                            </div>
                        </div>
                        <div class="text-center">
                            <span class="bg-gray-100 text-gray-800 text-sm font-medium px-3 py-1 rounded">Swamp Arena</span>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-lg overflow-hidden card-hover transition-all duration-300">
                    <div class="bg-secondary bg-opacity-10 p-4 text-center">
                        <span class="text-secondary font-bold">June 22, 2025 - 19:00 MSK</span>
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-6">
                            <div class="flex flex-col items-center">
                                <div class="w-20 h-20 bg-gray-200 rounded-full mb-2 flex items-center justify-center overflow-hidden">
                                    <img src="https://readdy.ai/api/search-image?query=A%20funny%20cartoon%20logo%20for%20a%20football%20team%20called%20Moscow%20Mildew%20with%20fungus%20theme%2C%20comic%20style&width=200&height=200&seq=7&orientation=squarish" alt="Moscow Mildew" class="object-cover w-full h-full object-top">
                                </div>
                                <span class="font-bold">Moscow Mildew</span>
                            </div>
                            <div class="text-center">
                                <span class="text-2xl font-bold text-gray-400">VS</span>
                                <div class="countdown-timer mt-2 text-sm font-medium text-gray-500">
                                    <span id="countdown-3">3d 24h 42m</span>
                                </div>
                            </div>
                            <div class="flex flex-col items-center">
                                <div class="w-20 h-20 bg-gray-200 rounded-full mb-2 flex items-center justify-center overflow-hidden">
                                    <img src="https://readdy.ai/api/search-image?query=A%20funny%20cartoon%20logo%20for%20a%20football%20team%20called%20Omsk%20Stream%20with%20water%20theme%20elements%2C%20blue%20colors%2C%20comic%20style&width=200&height=200&seq=2&orientation=squarish" alt="Omsk Stream" class="object-cover w-full h-full object-top">
                                </div>
                                <span class="font-bold">Omsk Stream</span>
                            </div>
                        </div>
                        <div class="text-center">
                            <span class="bg-gray-100 text-gray-800 text-sm font-medium px-3 py-1 rounded">Garbage Dump Stadium</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-8">
                <button class="bg-white border-2 border-primary hover:bg-primary hover:text-white text-primary font-bold px-6 py-3 !rounded-button whitespace-nowrap transition-colors duration-300">
                    <div class="flex items-center gap-2">
                        <div class="w-5 h-5 flex items-center justify-center">
                            <i class="ri-calendar-line"></i>
                        </div>
                        <span>See Full Schedule</span>
                    </div>
                </button>
            </div>
        </div>
    </section>

    <!-- Club Rankings -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="heading-font text-4xl text-gray-900 mb-8">Club Rankings</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white rounded-lg overflow-hidden">
                    <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Position</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Team</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Played</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Won</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Draw</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lost</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">GD</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Points</th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                    <tr class="bg-primary bg-opacity-10">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">1</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10 rounded-full overflow-hidden">
                                    <img src="https://readdy.ai/api/search-image?query=A%20funny%20cartoon%20logo%20for%20a%20football%20team%20called%20Kazan%20Cockroaches%20with%20insect%20theme%2C%20comic%20style&width=200&height=200&seq=6&orientation=squarish" alt="Kazan Cockroaches" class="h-full w-full object-cover object-top">
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">Kazan Cockroaches 🪳</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">15</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">10</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">3</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">+15</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">33</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">2</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10 rounded-full overflow-hidden">
                                    <img src="https://readdy.ai/api/search-image?query=A%20funny%20cartoon%20logo%20for%20a%20football%20team%20called%20Omsk%20Stream%20with%20water%20theme%20elements%2C%20blue%20colors%2C%20comic%20style&width=200&height=200&seq=2&orientation=squarish" alt="Omsk Stream" class="h-full w-full object-cover object-top">
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">Omsk Stream 💧</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">15</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">9</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">3</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">3</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">+10</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">30</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">3</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10 rounded-full overflow-hidden">
                                    <img src="https://readdy.ai/api/search-image?query=A%20funny%20cartoon%20logo%20for%20a%20football%20team%20called%20Moscow%20Mildew%20with%20fungus%20theme%2C%20comic%20style&width=200&height=200&seq=7&orientation=squarish" alt="Moscow Mildew" class="h-full w-full object-cover object-top">
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">Moscow Mildew 🍄</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">15</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">8</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">4</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">3</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">+8</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">28</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">4</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10 rounded-full overflow-hidden">
                                    <img src="https://readdy.ai/api/search-image?query=A%20funny%20cartoon%20logo%20for%20a%20football%20team%20called%20Vladivostok%20Vomit%20with%20sick%20theme%2C%20comic%20style&width=200&height=200&seq=8&orientation=squarish" alt="Vladivostok Vomit" class="h-full w-full object-cover object-top">
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">Vladivostok Vomit 🤢</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">15</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">7</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">5</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">3</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">+5</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">26</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">5</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10 rounded-full overflow-hidden">
                                    <img src="https://readdy.ai/api/search-image?query=A%20funny%20cartoon%20logo%20for%20a%20football%20team%20called%20Sochi%20Stench%20with%20bad%20smell%20theme%2C%20comic%20style&width=200&height=200&seq=9&orientation=squarish" alt="Sochi Stench" class="h-full w-full object-cover object-top">
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">Sochi Stench 🦨</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">15</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">6</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">6</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">3</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">+4</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">24</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">6</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10 rounded-full overflow-hidden">
                                    <img src="https://readdy.ai/api/search-image?query=A%20funny%20cartoon%20logo%20for%20a%20football%20team%20called%20Perm%20Pimples%20with%20acne%20theme%2C%20red%20colors%2C%20comic%20style&width=200&height=200&seq=3&orientation=squarish" alt="Perm Pimples" class="h-full w-full object-cover object-top">
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">Perm Pimples 🔴</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">15</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">5</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">6</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">4</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">+2</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">21</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">7</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10 rounded-full overflow-hidden">
                                    <img src="https://readdy.ai/api/search-image?query=A%20funny%20cartoon%20logo%20for%20a%20football%20team%20called%20Tula%20Toothaches%20with%20dental%20pain%20theme%2C%20comic%20style&width=200&height=200&seq=5&orientation=squarish" alt="Tula Toothaches" class="h-full w-full object-cover object-top">
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">Tula Toothaches 🦷</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">15</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">4</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">5</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">6</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">-3</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">17</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">8</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10 rounded-full overflow-hidden">
                                    <img src="https://readdy.ai/api/search-image?query=A%20funny%20cartoon%20logo%20for%20a%20football%20team%20called%20Snot%20FC%20with%20green%20slime%20theme%2C%20comic%20style&width=200&height=200&seq=4&orientation=squarish" alt="Snot FC" class="h-full w-full object-cover object-top">
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">Snot FC 🤧</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">15</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">1</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">3</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">11</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">-12</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">6</td>
                    </tr>
                    </tbody>
                </table>
            </div>
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
                        League Rules (Absurdly Simple)
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
                                <span>Read Full Rules</span>
                            </div>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Create Your Team -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-gray-900 rounded-lg overflow-hidden relative">
                <div style="background-image: url('https://readdy.ai/api/search-image?query=A%20surreal%20and%20humorous%20football%20field%20with%20weird%20goal%20posts%2C%20strange%20markings%2C%20and%20absurd%20obstacles.%20The%20field%20is%20muddy%20and%20chaotic%20with%20cartoon-like%20quality.%20There%20are%20funny%20team%20logos%20and%20mascots%20in%20the%20background.%20The%20scene%20is%20energetic%20and%20bizarre%20with%20a%20comic%20style.&width=1200&height=600&seq=10&orientation=landscape'); background-size: cover; background-position: center;" class="absolute inset-0 opacity-30"></div>
                <div class="relative p-8 md:p-12">
                    <div class="flex items-center mb-4">
                        <span class="bg-secondary text-white text-xs font-bold px-3 py-1 rounded-full uppercase">Coming Soon</span>
                    </div>
                    <h2 class="heading-font text-4xl md:text-5xl text-white mb-4">Create Your Own Meme Club</h2>
                    <p class="text-gray-300 text-lg mb-8 max-w-2xl">Soon, you'll be able to create your own team from any Russian town. Got a ridiculous idea? Save it – the meme war is coming!</p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <div class="relative max-w-md">
                            <input type="email" placeholder="Enter your email for early access" class="w-full px-4 py-3 border-none rounded-lg focus:outline-none focus:ring-2 focus:ring-primary text-gray-900">
                            <button class="absolute right-1 top-1 bg-primary hover:bg-opacity-80 text-gray-900 font-bold px-4 py-2 !rounded-button whitespace-nowrap">
                                Notify Me
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- News Section -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-8">
                <h2 class="heading-font text-4xl text-gray-900">Latest News</h2>
                <a href="#" class="text-primary hover:text-primary-dark font-medium flex items-center">
                    View All News
                    <div class="w-5 h-5 ml-1 flex items-center justify-center">
                        <i class="ri-arrow-right-line"></i>
                    </div>
                </a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                @foreach($posts as $post)
                    @include('site.v1.modules.news.news', compact('post'))
                @endforeach


                <div class="bg-white rounded-lg shadow-lg overflow-hidden card-hover transition-all duration-300">
                    <div class="h-48 overflow-hidden">
                        <img src="https://readdy.ai/api/search-image?query=A%20funny%20cartoon%20image%20of%20a%20football%20player%20celebrating%20a%20goal%20in%20a%20muddy%20field%2C%20wearing%20a%20ridiculous%20uniform%20with%20a%20comical%20expression%2C%20in%20a%20comic%20style&width=600&height=400&seq=11&orientation=landscape" alt="News Image" class="w-full h-full object-cover object-top">
                    </div>
                    <div class="p-6">
                        <div class="flex items-center mb-2">
                            <span class="bg-primary bg-opacity-10 text-primary text-xs font-medium px-2.5 py-0.5 rounded">Match Report</span>
                            <span class="text-gray-500 text-xs ml-2">June 16, 2025</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Snot FC Gets First Win After 12 Losses!</h3>
                        <p class="text-gray-600 mb-4">In a shocking turn of events that has football experts questioning the laws of probability, Snot FC has finally won a match after 12 consecutive losses.</p>
                        <a href="#" class="text-primary hover:text-primary-dark font-medium flex items-center">
                            Read More
                            <div class="w-5 h-5 ml-1 flex items-center justify-center">
                                <i class="ri-arrow-right-line"></i>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-lg overflow-hidden card-hover transition-all duration-300">
                    <div class="h-48 overflow-hidden">
                        <img src="https://readdy.ai/api/search-image?query=A%20funny%20cartoon%20image%20of%20a%20giant%20mascot%20shaped%20like%20a%20red%20pimple%20standing%20next%20to%20a%20football%20team%2C%20the%20mascot%20is%20oversized%20and%20ridiculous%20looking%2C%20in%20a%20comic%20style&width=600&height=400&seq=12&orientation=landscape" alt="News Image" class="w-full h-full object-cover object-top">
                    </div>
                    <div class="p-6">
                        <div class="flex items-center mb-2">
                            <span class="bg-secondary bg-opacity-10 text-secondary text-xs font-medium px-2.5 py-0.5 rounded">Team News</span>
                            <span class="text-gray-500 text-xs ml-2">June 14, 2025</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Perm Pimples Unveil New Mascot: A Giant Zit</h3>
                        <p class="text-gray-600 mb-4">Perm Pimples FC have outdone themselves with their new mascot – a 7-foot tall, squeezable zit costume that occasionally "pops" during goal celebrations.</p>
                        <a href="#" class="text-primary hover:text-primary-dark font-medium flex items-center">
                            Read More
                            <div class="w-5 h-5 ml-1 flex items-center justify-center">
                                <i class="ri-arrow-right-line"></i>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-lg overflow-hidden card-hover transition-all duration-300">
                    <div class="h-48 overflow-hidden">
                        <img src="https://readdy.ai/api/search-image?query=A%20funny%20cartoon%20image%20of%20football%20fans%20dressed%20in%20bizarre%20costumes%20with%20team%20colors%2C%20cheering%20in%20the%20stands%20of%20a%20stadium%2C%20some%20wearing%20cockroach%20antennas%2C%20in%20a%20comic%20style&width=600&height=400&seq=13&orientation=landscape" alt="News Image" class="w-full h-full object-cover object-top">
                    </div>
                    <div class="p-6">
                        <div class="flex items-center mb-2">
                            <span class="bg-gray-200 text-gray-800 text-xs font-medium px-2.5 py-0.5 rounded">Fan Zone</span>
                            <span class="text-gray-500 text-xs ml-2">June 12, 2025</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Kazan Cockroaches Fans Break Attendance Record</h3>
                        <p class="text-gray-600 mb-4">Over 10,000 fans showed up to watch Kazan Cockroaches, many dressed in full insect costumes despite the 30°C heat. Fifteen were treated for heat exhaustion.</p>
                        <a href="#" class="text-primary hover:text-primary-dark font-medium flex items-center">
                            Read More
                            <div class="w-5 h-5 ml-1 flex items-center justify-center">
                                <i class="ri-arrow-right-line"></i>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

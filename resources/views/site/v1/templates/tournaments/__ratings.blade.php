@extends('site.v1.layouts.default')
{{--@section ('title', Shortcode::compile($page->title))--}}
{{--@section ('meta_description', Shortcode::compile($page->meta_description))--}}

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-6">
    <div class="bg-white shadow-sm rounded-lg p-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h3 class="text-lg font-bold text-gray-900 mb-2">Параметры фильтра и отображения</h3>
                <div class="flex flex-wrap gap-2">
                    <button class="bg-primary text-gray-900 px-3 py-1 rounded-full text-sm font-medium">Все команды</button>
                    <button class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-3 py-1 rounded-full text-sm font-medium">Top 5</button>
                    <button class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-3 py-1 rounded-full text-sm font-medium">Bottom 3</button>
                    <button class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-3 py-1 rounded-full text-sm font-medium">Promotion Zone</button>
                    <button class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-3 py-1 rounded-full text-sm font-medium">Relegation Zone</button>
                </div>
            </div>
            <div class="flex flex-wrap gap-3">
                <div class="flex items-center">
                    <div class="custom-checkbox" id="showForm" onclick="toggleCheckbox(this)"></div>
                    <label for="showForm" class="ml-2 text-sm text-gray-700 cursor-pointer">Form</label>
                </div>
                <div class="flex items-center">
                    <div class="custom-checkbox checked" id="showGoals" onclick="toggleCheckbox(this)"></div>
                    <label for="showGoals" class="ml-2 text-sm text-gray-700 cursor-pointer">Goals</label>
                </div>
                <div class="flex items-center">
                    <div class="custom-checkbox checked" id="showPercentage" onclick="toggleCheckbox(this)"></div>
                    <label for="showPercentage" class="ml-2 text-sm text-gray-700 cursor-pointer">Win %</label>
                </div>
                <div class="flex items-center">
                    <div class="custom-checkbox" id="showCleanSheets" onclick="toggleCheckbox(this)"></div>
                    <label for="showCleanSheets" class="ml-2 text-sm text-gray-700 cursor-pointer">Clean Sheets</label>
                </div>
                <div class="flex items-center">
                    <div class="custom-checkbox" id="showTopScorer" onclick="toggleCheckbox(this)"></div>
                    <label for="showTopScorer" class="ml-2 text-sm text-gray-700 cursor-pointer">Top Scorer</label>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-8">
    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider sticky left-0 bg-gray-100 z-10">#</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider sticky left-[73px] bg-gray-100 z-10">Клуб</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Матчи</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">В</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Н</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">П</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">GF</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">GA</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">GD</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Очки</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Form</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Win %</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Clean Sheets</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                <!-- Team 1 -->
                <tr class="bg-primary bg-opacity-10 hover:bg-opacity-20">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 sticky left-0 bg-primary bg-opacity-10 z-10">1</td>
                    <td class="px-6 py-4 whitespace-nowrap sticky left-[73px] bg-primary bg-opacity-10 z-10">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10 rounded-full overflow-hidden">
                                <img src="https://readdy.ai/api/search-image?query=A%2520funny%2520cartoon%2520logo%2520for%2520a%2520football%2520team%2520called%2520Kazan%2520Cockroaches%2520with%2520insect%2520theme%252C%2520comic%2520style&amp;width=200&amp;height=200&amp;seq=6&amp;orientation=squarish" alt="Kazan Cockroaches" class="h-full w-full object-cover object-top">
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">Kazan Cockroaches 🪳</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">20</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">14</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">4</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">42</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">18</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">+24</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">46</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        <div class="flex space-x-1">
                            <span class="form-indicator form-win" title="Win"></span>
                            <span class="form-indicator form-win" title="Win"></span>
                            <span class="form-indicator form-draw" title="Draw"></span>
                            <span class="form-indicator form-win" title="Win"></span>
                            <span class="form-indicator form-win" title="Win"></span>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">70%</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">8</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                        <button class="text-primary hover:text-primary-dark">
                            <div class="w-6 h-6 flex items-center justify-center">
                                <i class="ri-information-line"></i>
                            </div>
                        </button>
                    </td>
                </tr>
                <!-- Team 2 -->
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 sticky left-0 bg-white z-10">2</td>
                    <td class="px-6 py-4 whitespace-nowrap sticky left-[73px] bg-white z-10">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10 rounded-full overflow-hidden">
                                <img src="https://readdy.ai/api/search-image?query=A%2520funny%2520cartoon%2520logo%2520for%2520a%2520football%2520team%2520called%2520Omsk%2520Stream%2520with%2520water%2520theme%2520elements%252C%2520blue%2520colors%252C%2520comic%2520style&amp;width=200&amp;height=200&amp;seq=2&amp;orientation=squarish" alt="Omsk Stream" class="h-full w-full object-cover object-top">
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">Omsk Stream 💧</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">20</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">12</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">5</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">3</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">38</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">20</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">+18</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">41</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        <div class="flex space-x-1">
                            <span class="form-indicator form-win" title="Win"></span>
                            <span class="form-indicator form-win" title="Win"></span>
                            <span class="form-indicator form-win" title="Win"></span>
                            <span class="form-indicator form-draw" title="Draw"></span>
                            <span class="form-indicator form-loss" title="Loss"></span>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">60%</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">7</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                        <button class="text-primary hover:text-primary-dark">
                            <div class="w-6 h-6 flex items-center justify-center">
                                <i class="ri-information-line"></i>
                            </div>
                        </button>
                    </td>
                </tr>
                <!-- Team 3 -->
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 sticky left-0 bg-white z-10">3</td>
                    <td class="px-6 py-4 whitespace-nowrap sticky left-[73px] bg-white z-10">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10 rounded-full overflow-hidden">
                                <img src="https://readdy.ai/api/search-image?query=A%2520funny%2520cartoon%2520logo%2520for%2520a%2520football%2520team%2520called%2520Moscow%2520Mildew%2520with%2520fungus%2520theme%252C%2520comic%2520style&amp;width=200&amp;height=200&amp;seq=7&amp;orientation=squarish" alt="Moscow Mildew" class="h-full w-full object-cover object-top">
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">Moscow Mildew 🍄</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">20</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">11</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">6</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">3</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">35</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">22</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">+13</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">39</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        <div class="flex space-x-1">
                            <span class="form-indicator form-draw" title="Draw"></span>
                            <span class="form-indicator form-win" title="Win"></span>
                            <span class="form-indicator form-win" title="Win"></span>
                            <span class="form-indicator form-draw" title="Draw"></span>
                            <span class="form-indicator form-win" title="Win"></span>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">55%</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">5</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                        <button class="text-primary hover:text-primary-dark">
                            <div class="w-6 h-6 flex items-center justify-center">
                                <i class="ri-information-line"></i>
                            </div>
                        </button>
                    </td>
                </tr>
                <!-- Team 4 -->
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 sticky left-0 bg-white z-10">4</td>
                    <td class="px-6 py-4 whitespace-nowrap sticky left-[73px] bg-white z-10">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10 rounded-full overflow-hidden">
                                <img src="https://readdy.ai/api/search-image?query=A%2520funny%2520cartoon%2520logo%2520for%2520a%2520football%2520team%2520called%2520Vladivostok%2520Vomit%2520with%2520sick%2520theme%252C%2520comic%2520style&amp;width=200&amp;height=200&amp;seq=8&amp;orientation=squarish" alt="Vladivostok Vomit" class="h-full w-full object-cover object-top">
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">Vladivostok Vomit 🤢</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">20</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">10</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">7</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">3</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">28</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">18</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">+10</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">37</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        <div class="flex space-x-1">
                            <span class="form-indicator form-draw" title="Draw"></span>
                            <span class="form-indicator form-draw" title="Draw"></span>
                            <span class="form-indicator form-win" title="Win"></span>
                            <span class="form-indicator form-win" title="Win"></span>
                            <span class="form-indicator form-draw" title="Draw"></span>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">50%</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">6</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                        <button class="text-primary hover:text-primary-dark">
                            <div class="w-6 h-6 flex items-center justify-center">
                                <i class="ri-information-line"></i>
                            </div>
                        </button>
                    </td>
                </tr>
                <!-- Team 5 -->
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 sticky left-0 bg-white z-10">5</td>
                    <td class="px-6 py-4 whitespace-nowrap sticky left-[73px] bg-white z-10">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10 rounded-full overflow-hidden">
                                <img src="https://readdy.ai/api/search-image?query=A%2520funny%2520cartoon%2520logo%2520for%2520a%2520football%2520team%2520called%2520Sochi%2520Stench%2520with%2520bad%2520smell%2520theme%252C%2520comic%2520style&amp;width=200&amp;height=200&amp;seq=9&amp;orientation=squarish" alt="Sochi Stench" class="h-full w-full object-cover object-top">
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">Sochi Stench 🦨</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">20</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">9</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">8</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">3</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">30</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">22</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">+8</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">35</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        <div class="flex space-x-1">
                            <span class="form-indicator form-draw" title="Draw"></span>
                            <span class="form-indicator form-win" title="Win"></span>
                            <span class="form-indicator form-draw" title="Draw"></span>
                            <span class="form-indicator form-win" title="Win"></span>
                            <span class="form-indicator form-draw" title="Draw"></span>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">45%</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">4</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                        <button class="text-primary hover:text-primary-dark">
                            <div class="w-6 h-6 flex items-center justify-center">
                                <i class="ri-information-line"></i>
                            </div>
                        </button>
                    </td>
                </tr>
                <!-- Team 6 -->
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 sticky left-0 bg-white z-10">6</td>
                    <td class="px-6 py-4 whitespace-nowrap sticky left-[73px] bg-white z-10">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10 rounded-full overflow-hidden">
                                <img src="https://readdy.ai/api/search-image?query=A%2520funny%2520cartoon%2520logo%2520for%2520a%2520football%2520team%2520called%2520Perm%2520Pimples%2520with%2520acne%2520theme%252C%2520red%2520colors%252C%2520comic%2520style&amp;width=200&amp;height=200&amp;seq=3&amp;orientation=squarish" alt="Perm Pimples" class="h-full w-full object-cover object-top">
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">Perm Pimples 🔴</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">20</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">8</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">7</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">5</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">25</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">20</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">+5</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">31</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        <div class="flex space-x-1">
                            <span class="form-indicator form-loss" title="Loss"></span>
                            <span class="form-indicator form-win" title="Win"></span>
                            <span class="form-indicator form-draw" title="Draw"></span>
                            <span class="form-indicator form-win" title="Win"></span>
                            <span class="form-indicator form-draw" title="Draw"></span>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">40%</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">3</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                        <button class="text-primary hover:text-primary-dark">
                            <div class="w-6 h-6 flex items-center justify-center">
                                <i class="ri-information-line"></i>
                            </div>
                        </button>
                    </td>
                </tr>
                <!-- Team 7 -->
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 sticky left-0 bg-white z-10">7</td>
                    <td class="px-6 py-4 whitespace-nowrap sticky left-[73px] bg-white z-10">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10 rounded-full overflow-hidden">
                                <img src="https://readdy.ai/api/search-image?query=A%2520funny%2520cartoon%2520logo%2520for%2520a%2520football%2520team%2520called%2520Tula%2520Toothaches%2520with%2520dental%2520pain%2520theme%252C%2520comic%2520style&amp;width=200&amp;height=200&amp;seq=5&amp;orientation=squarish" alt="Tula Toothaches" class="h-full w-full object-cover object-top">
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">Tula Toothaches 🦷</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">20</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">6</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">6</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">8</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">22</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">28</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">-6</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">24</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        <div class="flex space-x-1">
                            <span class="form-indicator form-loss" title="Loss"></span>
                            <span class="form-indicator form-loss" title="Loss"></span>
                            <span class="form-indicator form-draw" title="Draw"></span>
                            <span class="form-indicator form-win" title="Win"></span>
                            <span class="form-indicator form-draw" title="Draw"></span>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">30%</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                        <button class="text-primary hover:text-primary-dark">
                            <div class="w-6 h-6 flex items-center justify-center">
                                <i class="ri-information-line"></i>
                            </div>
                        </button>
                    </td>
                </tr>
                <!-- Team 8 -->
                <tr class="bg-red-50 hover:bg-red-100">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 sticky left-0 bg-red-50 z-10">8</td>
                    <td class="px-6 py-4 whitespace-nowrap sticky left-[73px] bg-red-50 z-10">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10 rounded-full overflow-hidden">
                                <img src="https://readdy.ai/api/search-image?query=A%2520funny%2520cartoon%2520logo%2520for%2520a%2520football%2520team%2520called%2520Snot%2520FC%2520with%2520green%2520slime%2520theme%252C%2520comic%2520style&amp;width=200&amp;height=200&amp;seq=4&amp;orientation=squarish" alt="Snot FC" class="h-full w-full object-cover object-top">
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">Snot FC 🤧</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">20</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">5</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">13</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">15</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">38</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">-23</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">11</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        <div class="flex space-x-1">
                            <span class="form-indicator form-win" title="Win"></span>
                            <span class="form-indicator form-loss" title="Loss"></span>
                            <span class="form-indicator form-loss" title="Loss"></span>
                            <span class="form-indicator form-loss" title="Loss"></span>
                            <span class="form-indicator form-draw" title="Draw"></span>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">10%</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">1</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                        <button class="text-primary hover:text-primary-dark">
                            <div class="w-6 h-6 flex items-center justify-center">
                                <i class="ri-information-line"></i>
                            </div>
                        </button>
                    </td>
                </tr>
                <!-- Team 9 -->
                <tr class="bg-gray-50 hover:bg-gray-100">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 sticky left-0 bg-gray-50 z-10">9</td>
                    <td class="px-6 py-4 whitespace-nowrap sticky left-[73px] bg-gray-50 z-10">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10 rounded-full overflow-hidden">
                                <img src="https://readdy.ai/api/search-image?query=A%2520funny%2520cartoon%2520logo%2520for%2520a%2520football%2520team%2520called%2520Yekaterinburg%2520Yeast%2520with%2520bread%2520rising%2520theme%252C%2520comic%2520style&amp;width=200&amp;height=200&amp;seq=14&amp;orientation=squarish" alt="Yekaterinburg Yeast" class="h-full w-full object-cover object-top">
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">Yekaterinburg Yeast 🍞</div>
                                <div class="text-xs text-gray-500">(Promoted from 2nd Division)</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">0</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">0</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">0</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">0</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">0</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">0</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">0</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">0</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        <div class="flex space-x-1">
                            <span class="form-indicator bg-gray-300" title="Not played"></span>
                            <span class="form-indicator bg-gray-300" title="Not played"></span>
                            <span class="form-indicator bg-gray-300" title="Not played"></span>
                            <span class="form-indicator bg-gray-300" title="Not played"></span>
                            <span class="form-indicator bg-gray-300" title="Not played"></span>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">0%</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">0</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">N/A</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                        <button class="text-primary hover:text-primary-dark">
                            <div class="w-6 h-6 flex items-center justify-center">
                                <i class="ri-information-line"></i>
                            </div>
                        </button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-gray-200 flex flex-col sm:flex-row justify-between items-center">
            <div class="text-sm text-gray-500 mb-4 sm:mb-0">
                Showing 9 teams - Last updated: June 18, 2025 at 10:15 AM
            </div>
            <div class="flex space-x-2">
                <button class="bg-white border border-gray-300 text-gray-700 px-3 py-1 rounded-lg text-sm flex items-center">
                    <div class="w-4 h-4 mr-1 flex items-center justify-center">
                        <i class="ri-file-download-line"></i>
                    </div>
                    Export CSV
                </button>
                <button class="bg-white border border-gray-300 text-gray-700 px-3 py-1 rounded-lg text-sm flex items-center">
                    <div class="w-4 h-4 mr-1 flex items-center justify-center">
                        <i class="ri-printer-line"></i>
                    </div>
                    Print
                </button>
                <button class="bg-white border border-gray-300 text-gray-700 px-3 py-1 rounded-lg text-sm flex items-center">
                    <div class="w-4 h-4 mr-1 flex items-center justify-center">
                        <i class="ri-share-line"></i>
                    </div>
                    Share
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

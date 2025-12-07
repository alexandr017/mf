@extends('site.v1.layouts.default')
{{--@section ('title', Shortcode::compile($page->title))--}}
{{--@section ('meta_description', Shortcode::compile($page->meta_description))--}}

@section('content')


<div class="min-h-screen">
    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="heading-font text-4xl text-gray-900 mb-2">Global Player Rankings</h1>
            <p class="text-gray-600 mb-6">Discover the top performers across all teams in the Meme Football League</p>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <!-- Total Players -->
                <div class="stat-card rounded-xl p-6 card-hover transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Total Players</p>
                            <p class="text-2xl font-bold text-primary">2,847</p>
                            <p class="text-sm text-green-600">+127 this month</p>
                        </div>
                        <div class="w-12 h-12 bg-primary bg-opacity-20 rounded-full flex items-center justify-center">
                            <div class="w-6 h-6 flex items-center justify-center">
                                <i class="ri-group-line text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Active Players -->
                <div class="stat-card rounded-xl p-6 card-hover transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Active Players</p>
                            <p class="text-2xl font-bold text-secondary">1,924</p>
                            <p class="text-sm text-green-600">This season</p>
                        </div>
                        <div class="w-12 h-12 bg-secondary bg-opacity-20 rounded-full flex items-center justify-center">
                            <div class="w-6 h-6 flex items-center justify-center">
                                <i class="ri-user-star-line text-secondary"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Top Scorer -->
                <div class="stat-card rounded-xl p-6 card-hover transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Top Scorer</p>
                            <p class="text-xl font-bold text-yellow-600">Marcus Silva</p>
                            <p class="text-sm text-green-600">47 goals</p>
                        </div>
                        <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center">
                            <div class="w-6 h-6 flex items-center justify-center">
                                <i class="ri-football-line text-yellow-600"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Highest Rated -->
                <div class="stat-card rounded-xl p-6 card-hover transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Highest Rated</p>
                            <p class="text-xl font-bold text-purple-600">Alessandro Romano</p>
                            <p class="text-sm text-green-600">Rating 9.8</p>
                        </div>
                        <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center">
                            <div class="w-6 h-6 flex items-center justify-center">
                                <i class="ri-trophy-line text-purple-600"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Filters and Sorting -->
        <div class="mb-8">
            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex flex-wrap items-center justify-between gap-4">
                    <!-- Season Filter -->
                    <div class="flex items-center space-x-4">
                        <span class="text-sm font-medium text-gray-700">Season:</span>
                        <div class="flex space-x-2">
                            <button class="px-4 py-2 bg-primary bg-opacity-20 text-primary rounded-button text-sm font-medium cursor-pointer season-filter active" data-season="current">2024/25</button>
                            <button class="px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-button text-sm font-medium cursor-pointer season-filter" data-season="all">All Time</button>
                        </div>
                    </div>
                    <!-- Sort Options -->
                    <div class="flex items-center space-x-4">
                        <span class="text-sm font-medium text-gray-700">Sort by:</span>
                        <select class="border border-gray-300 rounded-button px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent pr-8 cursor-pointer" id="sort-select">
                            <option value="rating">Player Rating</option>
                            <option value="matches">Matches Played</option>
                            <option value="goals">Goals Scored</option>
                            <option value="assists">Assists</option>
                        </select>
                    </div>
                    <!-- Search -->
                    <div class="relative">
                        <input type="text" placeholder="Search players..." class="border border-gray-300 rounded-button px-4 py-2 pl-10 text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent w-64" id="player-search">
                        <div class="absolute left-3 top-1/2 transform -translate-y-1/2 w-4 h-4 flex items-center justify-center">
                            <i class="ri-search-line text-gray-400 text-sm"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Player Rankings Table -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden" id="rankings-table">
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rank</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Player</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Team</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rating</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Matches</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Goals</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Assists</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Position</th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200" id="player-rows">
                    <!-- Player Row 1 -->
                    <tr class="hover:bg-gray-50 transition-colors duration-200 player-row">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-gradient-to-r from-yellow-400 to-yellow-600 rounded-full flex items-center justify-center text-white font-bold text-sm">
                                    1
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="h-12 w-12 flex-shrink-0">
                                    <img class="h-12 w-12 rounded-full object-cover object-top" src="https://readdy.ai/api/search-image?query=Professional%20football%20player%20Alessandro%20Romano%20portrait%2C%20confident%20Italian%20striker%20in%20team%20uniform%2C%20athletic%20build%20with%20determined%20expression&width=150&height=150&seq=401&orientation=squarish" alt="Alessandro Romano">
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">Alessandro Romano</div>
                                    <div class="text-sm text-gray-500">Forward</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="w-8 h-8 rounded-full overflow-hidden mr-3">
                                    <img src="https://readdy.ai/api/search-image?query=Football%20team%20logo%20AC%20Milan%20red%20and%20black%20colors%2C%20professional%20soccer%20club%20emblem%20design&width=100&height=100&seq=501&orientation=squarish" alt="Team Logo" class="w-full h-full object-cover object-top">
                                </div>
                                <span class="text-sm text-gray-900">AC Milan</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <span class="text-lg font-bold text-primary" data-rating="9.8">9.8</span>
                                <div class="ml-2 w-4 h-4 flex items-center justify-center">
                                    <i class="ri-arrow-up-line text-green-500 text-sm"></i>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900" data-matches="34">34</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900" data-goals="42">42</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900" data-assists="18">18</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">Forward</span>
                        </td>
                    </tr>
                    <!-- Player Row 2 -->
                    <tr class="hover:bg-gray-50 transition-colors duration-200 player-row">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-gradient-to-r from-gray-400 to-gray-600 rounded-full flex items-center justify-center text-white font-bold text-sm">
                                    2
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="h-12 w-12 flex-shrink-0">
                                    <img class="h-12 w-12 rounded-full object-cover object-top" src="https://readdy.ai/api/search-image?query=Professional%20football%20player%20Marcus%20Silva%20portrait%2C%20skilled%20Brazilian%20midfielder%20in%20team%20uniform%2C%20focused%20athlete%20with%20determined%20look&width=150&height=150&seq=402&orientation=squarish" alt="Marcus Silva">
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">Marcus Silva</div>
                                    <div class="text-sm text-gray-500">Midfielder</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="w-8 h-8 rounded-full overflow-hidden mr-3">
                                    <img src="https://readdy.ai/api/search-image?query=Football%20team%20logo%20Manchester%20City%20light%20blue%20colors%2C%20professional%20soccer%20club%20emblem%20design&width=100&height=100&seq=502&orientation=squarish" alt="Team Logo" class="w-full h-full object-cover object-top">
                                </div>
                                <span class="text-sm text-gray-900">Manchester City</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <span class="text-lg font-bold text-primary" data-rating="9.6">9.6</span>
                                <div class="ml-2 w-4 h-4 flex items-center justify-center">
                                    <i class="ri-arrow-up-line text-green-500 text-sm"></i>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900" data-matches="36">36</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900" data-goals="47">47</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900" data-assists="23">23</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Midfielder</span>
                        </td>
                    </tr>
                    <!-- Player Row 3 -->
                    <tr class="hover:bg-gray-50 transition-colors duration-200 player-row">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-gradient-to-r from-orange-400 to-orange-600 rounded-full flex items-center justify-center text-white font-bold text-sm">
                                    3
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="h-12 w-12 flex-shrink-0">
                                    <img class="h-12 w-12 rounded-full object-cover object-top" src="https://readdy.ai/api/search-image?query=Professional%20football%20player%20Erik%20Johnson%20portrait%2C%20strong%20Scandinavian%20defender%20in%20team%20uniform%2C%20commanding%20presence%20with%20serious%20expression&width=150&height=150&seq=403&orientation=squarish" alt="Erik Johnson">
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">Erik Johnson</div>
                                    <div class="text-sm text-gray-500">Defender</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="w-8 h-8 rounded-full overflow-hidden mr-3">
                                    <img src="https://readdy.ai/api/search-image?query=Football%20team%20logo%20Liverpool%20red%20colors%2C%20professional%20soccer%20club%20emblem%20design&width=100&height=100&seq=503&orientation=squarish" alt="Team Logo" class="w-full h-full object-cover object-top">
                                </div>
                                <span class="text-sm text-gray-900">Liverpool FC</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <span class="text-lg font-bold text-primary" data-rating="9.4">9.4</span>
                                <div class="ml-2 w-4 h-4 flex items-center justify-center">
                                    <i class="ri-arrow-down-line text-red-500 text-sm"></i>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900" data-matches="38">38</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900" data-goals="8">8</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900" data-assists="12">12</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Defender</span>
                        </td>
                    </tr>
                    <!-- Player Row 4 -->
                    <tr class="hover:bg-gray-50 transition-colors duration-200 player-row">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-gradient-to-r from-blue-400 to-blue-600 rounded-full flex items-center justify-center text-white font-bold text-sm">
                                    4
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="h-12 w-12 flex-shrink-0">
                                    <img class="h-12 w-12 rounded-full object-cover object-top" src="https://readdy.ai/api/search-image?query=Professional%20football%20player%20Diego%20Martinez%20portrait%2C%20talented%20Spanish%20goalkeeper%20in%20team%20uniform%2C%20alert%20and%20focused%20expression&width=150&height=150&seq=404&orientation=squarish" alt="Diego Martinez">
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">Diego Martinez</div>
                                    <div class="text-sm text-gray-500">Goalkeeper</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="w-8 h-8 rounded-full overflow-hidden mr-3">
                                    <img src="https://readdy.ai/api/search-image?query=Football%20team%20logo%20Real%20Madrid%20white%20and%20gold%20colors%2C%20professional%20soccer%20club%20emblem%20design&width=100&height=100&seq=504&orientation=squarish" alt="Team Logo" class="w-full h-full object-cover object-top">
                                </div>
                                <span class="text-sm text-gray-900">Real Madrid</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <span class="text-lg font-bold text-primary" data-rating="9.2">9.2</span>
                                <div class="ml-2 w-4 h-4 flex items-center justify-center">
                                    <i class="ri-arrow-up-line text-green-500 text-sm"></i>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900" data-matches="35">35</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900" data-goals="0">0</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900" data-assists="3">3</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Goalkeeper</span>
                        </td>
                    </tr>
                    <!-- Player Row 5 -->
                    <tr class="hover:bg-gray-50 transition-colors duration-200 player-row">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-gradient-to-r from-indigo-400 to-indigo-600 rounded-full flex items-center justify-center text-white font-bold text-sm">
                                    5
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="h-12 w-12 flex-shrink-0">
                                    <img class="h-12 w-12 rounded-full object-cover object-top" src="https://readdy.ai/api/search-image?query=Professional%20football%20player%20Luca%20Rossi%20portrait%2C%20dynamic%20Italian%20winger%20in%20team%20uniform%2C%20energetic%20player%20with%20confident%20smile&width=150&height=150&seq=405&orientation=squarish" alt="Luca Rossi">
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">Luca Rossi</div>
                                    <div class="text-sm text-gray-500">Winger</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="w-8 h-8 rounded-full overflow-hidden mr-3">
                                    <img src="https://readdy.ai/api/search-image?query=Football%20team%20logo%20Juventus%20black%20and%20white%20colors%2C%20professional%20soccer%20club%20emblem%20design&width=100&height=100&seq=505&orientation=squarish" alt="Team Logo" class="w-full h-full object-cover object-top">
                                </div>
                                <span class="text-sm text-gray-900">Juventus</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <span class="text-lg font-bold text-primary" data-rating="9.1">9.1</span>
                                <div class="ml-2 w-4 h-4 flex items-center justify-center">
                                    <i class="ri-subtract-line text-gray-400 text-sm"></i>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900" data-matches="32">32</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900" data-goals="29">29</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900" data-assists="31">31</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">Forward</span>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Pagination -->
        <div class="flex items-center justify-between mt-6 bg-white rounded-xl shadow-lg p-6">
            <div class="text-sm text-gray-500">
                Showing 1-5 of 2,847 players
            </div>
            <div class="flex items-center space-x-2">
                <button class="px-3 py-2 text-sm bg-gray-100 hover:bg-gray-200 rounded-button cursor-pointer disabled:opacity-50" disabled>
                    Previous
                </button>
                <button class="px-3 py-2 text-sm bg-primary text-gray-900 rounded-button cursor-pointer">1</button>
                <button class="px-3 py-2 text-sm bg-gray-100 hover:bg-gray-200 rounded-button cursor-pointer">2</button>
                <button class="px-3 py-2 text-sm bg-gray-100 hover:bg-gray-200 rounded-button cursor-pointer">3</button>
                <span class="px-3 py-2 text-sm text-gray-500">...</span>
                <button class="px-3 py-2 text-sm bg-gray-100 hover:bg-gray-200 rounded-button cursor-pointer">285</button>
                <button class="px-3 py-2 text-sm bg-gray-100 hover:bg-gray-200 rounded-button cursor-pointer">
                    Next
                </button>
            </div>
        </div>
    </main>
</div>


@endsection

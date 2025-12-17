<h1>{{ $tournament->name }} — {{ $season->year_start }}/{{ $season->year_finish }}</h1>

@foreach ($season->stages as $stage)
    <h2>{{ $stage->name }}</h2>

    @foreach ($stage->groups as $group)
        <h3>{{ $group->name }}</h3>
    @endforeach

    <ul>
        @foreach ($stage->matches as $m)
            <li>
{{--                <a href="{{ route('match.show', $m->id) }}">--}}
                    {{ $m->homeTeam->name }} - {{ $m->awayTeam->name }}
                    ({{ $m->score_1 }}:{{ $m->score_2 }})
{{--                </a>--}}
            </li>
        @endforeach
    </ul>


    <!-- Club Rankings -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="heading-font text-4xl text-gray-900 mb-8">Клубный рейтинг</h2>
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


@endforeach

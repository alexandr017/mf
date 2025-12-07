@extends('site.v1.layouts.default')
{{--@section ('title', Shortcode::compile($page->title))--}}
{{--@section ('meta_description', Shortcode::compile($page->meta_description))--}}

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-6">
    <div class="bg-white shadow-sm rounded-lg p-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
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
                    @foreach($teams as $team)
                    <tr class="bg-gray-50 hover:bg-gray-100">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 sticky left-0 bg-gray-50 z-10">{{$loop->iteration}}</td>
                        <td class="px-6 py-4 whitespace-nowrap sticky left-[73px] bg-gray-50 z-10">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10 rounded-full overflow-hidden">
                                    <a href="/teams/{{$team->alias}}" target="_blank">
                                        <img src="https://readdy.ai/api/search-image?query=A%2520funny%2520cartoon%2520logo%2520for%2520a%2520football%2520team%2520called%2520Yekaterinburg%2520Yeast%2520with%2520bread%2520rising%2520theme%252C%2520comic%2520style&amp;width=200&amp;height=200&amp;seq=14&amp;orientation=squarish" alt="Yekaterinburg Yeast" class="h-full w-full object-cover object-top">
                                    </a>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">
                                        <a href="/teams/{{$team->alias}}" target="_blank">
                                            {{$team->name}}
                                        </a>
                                    </div>
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
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection

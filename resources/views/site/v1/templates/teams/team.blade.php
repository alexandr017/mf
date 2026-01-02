@extends('site.v1.layouts.default')
@section ('title', $team->title)
@section ('meta_description', $team->meta_description)

@section('content')
    <section class="relative bg-gray-900 py-24 overflow-hidden">
        <div class="absolute inset-0">
            <img src="https://readdy.ai/api/search-image?query=A%20professional%20sports%20stadium%20at%20night%20with%20dramatic%20lighting%2C%20filled%20with%20enthusiastic%20fans%2C%20some%20dressed%20as%20cockroaches%2C%20with%20team%20banners%20and%20decorations.%20The%20atmosphere%20is%20electric%20with%20a%20mix%20of%20humor%20and%20competition.&amp;width=1920&amp;height=600&amp;seq=20&amp;orientation=landscape" alt="Stadium" class="w-full h-full object-cover opacity-30">
        </div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-center gap-8">
                <div class="w-48 h-48 rounded-full overflow-hidden border-4 border-primary">
                    <img src="https://readdy.ai/api/search-image?query=A%20funny%20cartoon%20logo%20for%20a%20football%20team%20called%20Kazan%20Cockroaches%20with%20insect%20theme%2C%20comic%20style&amp;width=200&amp;height=200&amp;seq=6&amp;orientation=squarish" alt="Kazan Cockroaches" class="w-full h-full object-cover object-top">
                </div>
                <div class="text-center md:text-left">
                    <div class="flex items-center justify-center md:justify-start gap-3 mb-4">
                        <h1 class="heading-font text-4xl md:text-6xl text-white">{{$team->name}}</h1>
                        <span class="text-4xl">🪳</span>
                    </div>
                    <p class="text-xl text-gray-300 mb-6">The Unstoppable Insects of Russian Football</p>
                    <div class="flex flex-wrap justify-center md:justify-start gap-4">
                        <div class="bg-white bg-opacity-10 rounded-lg px-4 py-2">
                            <div class="text-sm text-gray-400">Год основания</div>
                            <div class="text-xl text-white">{{$team->date_created}}</div>
                        </div>
                        <div class="bg-white bg-opacity-10 rounded-lg px-4 py-2">
                            <div class="text-sm text-gray-400">League Titles</div>
                            <div class="text-xl text-white">3</div>
                        </div>
                        <div class="bg-white bg-opacity-10 rounded-lg px-4 py-2">
                            <div class="text-sm text-gray-400">Chaos Cups</div>
                            <div class="text-xl text-white">2</div>
                        </div>
                        <div class="bg-white bg-opacity-10 rounded-lg px-4 py-2">
                            <div class="text-sm text-gray-400">Current Ranking</div>
                            <div class="text-xl text-primary font-bold">#1</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>








    <section class="bg-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Info -->
                <div class="lg:col-span-2 space-y-8">
                    <!-- About -->
                    <div class="bg-white rounded-lg shadow-lg p-6 border-2 border-gray-100">
                        <h2 class="heading-font text-2xl text-gray-900 mb-4">О команде</h2>
                        <p class="text-gray-600 mb-4">{{$team->description}}</p>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-primary bg-opacity-10 flex items-center justify-center">
                                    <div class="w-5 h-5 text-primary">
                                        <i class="ri-map-pin-line"></i>
                                    </div>
                                </div>
                                <div>
                                    <div class="text-sm text-gray-500">Город</div>
                                    <div class="font-medium">Kazan, Russia</div>
                                </div>
                            </div>
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-primary bg-opacity-10 flex items-center justify-center">
                                    <div class="w-5 h-5 text-primary">
                                        <i class="ri-home-4-line"></i>
                                    </div>
                                </div>
                                <div>
                                    <div class="text-sm text-gray-500">Стадион</div>
                                    <div class="font-medium">{{$team->stadium}}</div>
                                </div>
                            </div>
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-primary bg-opacity-10 flex items-center justify-center">
                                    <div class="w-5 h-5 text-primary">
                                        <i class="ri-team-line"></i>
                                    </div>
                                </div>
                                <div>
                                    <div class="text-sm text-gray-500">Squad Size</div>
                                    <div class="font-medium">{{ $activePlayersCount ?? 0 }} Players</div>
                                </div>
                            </div>
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-primary bg-opacity-10 flex items-center justify-center">
                                    <div class="w-5 h-5 text-primary">
                                        <i class="ri-user-star-line"></i>
                                    </div>
                                </div>
                                <div>
                                    <div class="text-sm text-gray-500">Head Coach</div>
                                    <div class="font-medium">Viktor "The Exterminator" Petrov</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Current Season Stats -->
                    <div class="bg-white rounded-lg shadow-lg p-6 border-2 border-gray-100">
                        <h2 class="heading-font text-2xl text-gray-900 mb-4">Статистика сезона 2024-25</h2>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            <div class="text-center p-4 bg-gray-50 rounded-lg">
                                <div class="text-3xl font-bold text-gray-900">0</div>
                                <div class="text-sm text-gray-500">Сыгранные матчи</div>
                            </div>
                            <div class="text-center p-4 bg-gray-50 rounded-lg">
                                <div class="text-3xl font-bold text-primary">0</div>
                                <div class="text-sm text-gray-500">Побед</div>
                            </div>
                            <div class="text-center p-4 bg-gray-50 rounded-lg">
                                <div class="text-3xl font-bold text-gray-900">0</div>
                                <div class="text-sm text-gray-500">Ничьих</div>
                            </div>
                            <div class="text-center p-4 bg-gray-50 rounded-lg">
                                <div class="text-3xl font-bold text-secondary">0</div>
                                <div class="text-sm text-gray-500">Поражений</div>
                            </div>
                        </div>
                        <div class="mt-6">
                            <div id="seasonChart" class="w-full h-64" _echarts_instance_="ec_1758053396679" style="user-select: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); position: relative;"><div style="position: relative; width: 748px; height: 256px; padding: 0px; margin: 0px; border-width: 0px; cursor: default;"><canvas data-zr-dom-id="zr_0" width="1496" height="512" style="position: absolute; left: 0px; top: 0px; width: 748px; height: 256px; user-select: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); padding: 0px; margin: 0px; border-width: 0px;"></canvas></div><div class="" style="position: absolute; display: block; border-style: solid; white-space: nowrap; z-index: 9999999; box-shadow: rgba(0, 0, 0, 0.2) 1px 2px 10px; transition: opacity 0.2s cubic-bezier(0.23, 1, 0.32, 1), visibility 0.2s cubic-bezier(0.23, 1, 0.32, 1), transform 0.4s cubic-bezier(0.23, 1, 0.32, 1); background-color: rgba(255, 255, 255, 0.9); border-width: 1px; border-radius: 4px; color: rgb(31, 41, 55); font: 14px / 21px sans-serif; padding: 10px; top: 0px; left: 0px; transform: translate3d(89px, 114px, 0px); border-color: rgb(238, 238, 238); pointer-events: none; visibility: hidden; opacity: 0;"><div style="margin: 0px 0 0;line-height:1;"><div style="margin: 0px 0 0;line-height:1;"><div style="font-size:14px;color:#1f2937;font-weight:400;line-height:1;">Match 1</div><div style="margin: 10px 0 0;line-height:1;"><div style="margin: 0px 0 0;line-height:1;"><div style="margin: 0px 0 0;line-height:1;"><span style="display:inline-block;margin-right:4px;border-radius:10px;width:10px;height:10px;background-color:#5470c6;"></span><span style="font-size:14px;color:#1f2937;font-weight:400;margin-left:2px">Points</span><span style="float:right;margin-left:20px;font-size:14px;color:#1f2937;font-weight:900">3</span><div style="clear:both"></div></div><div style="clear:both"></div></div><div style="clear:both"></div></div><div style="clear:both"></div></div><div style="clear:both"></div></div></div></div>
                        </div>
                    </div>

                    <!-- Recent Results -->
                    <div class="bg-white rounded-lg shadow-lg p-6 border-2 border-gray-100">
                        <h2 class="heading-font text-2xl text-gray-900 mb-4">Recent Results</h2>
                        <div class="space-y-4">
                            <div class="flex items-center justify-between p-4 bg-primary bg-opacity-10 rounded-lg">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-full overflow-hidden">
                                        <img src="https://readdy.ai/api/search-image?query=A%20funny%20cartoon%20logo%20for%20a%20football%20team%20called%20Moscow%20Mildew%20with%20fungus%20theme%2C%20comic%20style&amp;width=200&amp;height=200&amp;seq=7&amp;orientation=squarish" alt="Moscow Mildew" class="w-full h-full object-cover object-top">
                                    </div>
                                    <div>
                                        <div class="font-medium">vs Moscow Mildew</div>
                                        <div class="text-sm text-gray-500">June 10, 2025</div>
                                    </div>
                                </div>
                                <div class="text-xl font-bold text-primary">4 - 1</div>
                            </div>
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-full overflow-hidden">
                                        <img src="https://readdy.ai/api/search-image?query=A%20funny%20cartoon%20logo%20for%20a%20football%20team%20called%20Vladivostok%20Vomit%20with%20sick%20theme%2C%20comic%20style&amp;width=200&amp;height=200&amp;seq=8&amp;orientation=squarish" alt="Vladivostok Vomit" class="w-full h-full object-cover object-top">
                                    </div>
                                    <div>
                                        <div class="font-medium">vs Vladivostok Vomit</div>
                                        <div class="text-sm text-gray-500">June 5, 2025</div>
                                    </div>
                                </div>
                                <div class="text-xl font-bold">2 - 2</div>
                            </div>
                            <div class="flex items-center justify-between p-4 bg-primary bg-opacity-10 rounded-lg">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-full overflow-hidden">
                                        <img src="https://readdy.ai/api/search-image?query=A%20funny%20cartoon%20logo%20for%20a%20football%20team%20called%20Snot%20FC%20with%20green%20slime%20theme%2C%20comic%20style&amp;width=200&amp;height=200&amp;seq=4&amp;orientation=squarish" alt="Snot FC" class="w-full h-full object-cover object-top">
                                    </div>
                                    <div>
                                        <div class="font-medium">vs Snot FC</div>
                                        <div class="text-sm text-gray-500">June 1, 2025</div>
                                    </div>
                                </div>
                                <div class="text-xl font-bold text-primary">3 - 0</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="space-y-8">
                    @auth
                        @if(isset($currentUserTeam) && $currentUserTeam)
                            @if($canLeave && $canLeave['can_leave'])
                                <button onclick="showLeaveModal()" class="w-full bg-red-600 hover:bg-red-700 text-white font-bold px-6 py-3 !rounded-button whitespace-nowrap">
                                    <div class="flex items-center justify-center gap-2">
                                        <div class="w-5 h-5 flex items-center justify-center">
                                            <i class="ri-logout-box-line"></i>
                                        </div>
                                        <span>Покинуть команду</span>
                                    </div>
                                </button>
                            @elseif($canLeave && !$canLeave['can_leave'])
                                <div class="w-full bg-gray-100 text-gray-600 font-bold px-6 py-3 !rounded-button whitespace-nowrap text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <div class="w-5 h-5 flex items-center justify-center">
                                            <i class="ri-information-line"></i>
                                        </div>
                                        <span>{{ $canLeave['reason'] ?? 'Нельзя покинуть команду' }}</span>
                                    </div>
                                </div>
                            @endif
                        @elseif($canJoin && $canJoin['can_join'])
                            <button onclick="showJoinModal()" class="w-full bg-primary hover:bg-opacity-80 text-gray-900 font-bold px-6 py-3 !rounded-button whitespace-nowrap">
                                <div class="flex items-center justify-center gap-2">
                                    <div class="w-5 h-5 flex items-center justify-center">
                                        <i class="ri-team-line"></i>
                                    </div>
                                    <span>Присоединиться к команде</span>
                                </div>
                            </button>
                        @elseif($canJoin && !$canJoin['can_join'])
                            <div class="w-full bg-gray-100 text-gray-600 font-bold px-6 py-3 !rounded-button whitespace-nowrap text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <div class="w-5 h-5 flex items-center justify-center">
                                        <i class="ri-information-line"></i>
                                    </div>
                                    <span>{{ $canJoin['reason'] ?? 'Нельзя присоединиться' }}</span>
                                </div>
                            </div>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="w-full bg-primary hover:bg-opacity-80 text-gray-900 font-bold px-6 py-3 !rounded-button whitespace-nowrap block text-center">
                            <div class="flex items-center justify-center gap-2">
                                <div class="w-5 h-5 flex items-center justify-center">
                                    <i class="ri-team-line"></i>
                                </div>
                                <span>Войти для присоединения</span>
                            </div>
                        </a>
                    @endauth

                    <button class="w-full bg-secondary hover:bg-opacity-80 text-white font-bold px-6 py-3 !rounded-button whitespace-nowrap">
                        <div class="flex items-center justify-center gap-2">
                            <div class="w-5 h-5 flex items-center justify-center">
                                <i class="ri-ticket-line"></i>
                            </div>
                            <span>Поддержать команду</span>
                        </div>
                    </button>

                    <!-- Transfer Rules Info -->
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden border-2 border-gray-100">
                        <div class="bg-gray-900 p-4">
                            <h2 class="heading-font text-xl text-white">Правила присоединения</h2>
                        </div>
                        <div class="p-4 space-y-3 text-sm">
                            <div class="flex items-start gap-2">
                                <i class="ri-group-line text-primary mt-1"></i>
                                <div>
                                    <div class="font-semibold text-gray-900">Лимит игроков</div>
                                    <div class="text-gray-600">Максимум {{ $transferRules['max_players'] ?? 100 }} активных игроков в команде</div>
                                </div>
                            </div>
                            <div class="flex items-start gap-2">
                                <i class="ri-calendar-line text-primary mt-1"></i>
                                <div>
                                    <div class="font-semibold text-gray-900">Трансферное окно</div>
                                    <div class="text-gray-600">
                                        С {{ $transferRules['transfer_window_start'] ?? '01.06' }} по {{ $transferRules['transfer_window_end'] ?? '31.08' }}
                                        @if($transferRules['transfer_window_open'] ?? false)
                                            <span class="text-green-600 font-semibold">(Открыто)</span>
                                        @else
                                            <span class="text-red-600 font-semibold">(Закрыто)</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-start gap-2">
                                <i class="ri-exchange-line text-primary mt-1"></i>
                                <div>
                                    <div class="font-semibold text-gray-900">Смена команды</div>
                                    <div class="text-gray-600">1 раз за трансферное окно. Нельзя менять в течение сезона</div>
                                </div>
                            </div>
                            <div class="flex items-start gap-2">
                                <i class="ri-vip-crown-line text-yellow-500 mt-1"></i>
                                <div>
                                    <div class="font-semibold text-gray-900">Премиум аккаунт</div>
                                    <div class="text-gray-600">Неограниченное количество смен команды и смена вне трансферного окна</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Trophy Cabinet -->
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden border-2 border-gray-100">
                        <div class="bg-gray-900 p-4">
                            <h2 class="heading-font text-2xl text-white">Трофеи</h2>
                        </div>
                        <div class="p-6">
                            <div class="space-y-6">
                                <div class="flex items-center gap-4">
                                    <div class="w-16 h-16 flex items-center justify-center bg-primary bg-opacity-10 rounded-full">
                                        <div class="w-8 h-8 text-primary">
                                            <i class="ri-trophy-line"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="font-bold text-gray-900">Кубок СНГ</div>
                                        <div class="text-sm text-gray-500">-</div>
                                    </div>
                                </div>
                                <div class="flex items-center gap-4">
                                    <div class="w-16 h-16 flex items-center justify-center bg-primary bg-opacity-10 rounded-full">
                                        <div class="w-8 h-8 text-primary">
                                            <i class="ri-trophy-line"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="font-bold text-gray-900">Чемпионат страны</div>
                                        <div class="text-sm text-gray-500">-</div>
                                    </div>
                                </div>
                                <div class="flex items-center gap-4">
                                    <div class="w-16 h-16 flex items-center justify-center bg-primary bg-opacity-10 rounded-full">
                                        <div class="w-8 h-8 text-primary">
                                            <i class="ri-trophy-line"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="font-bold text-gray-900">Кубок страны</div>
                                        <div class="text-sm text-gray-500">-</div>
                                    </div>
                                </div>
                                <div class="flex items-center gap-4">
                                    <div class="w-16 h-16 flex items-center justify-center bg-primary bg-opacity-10 rounded-full">
                                        <div class="w-8 h-8 text-primary">
                                            <i class="ri-trophy-line"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="font-bold text-gray-900">Суперкубок страны</div>
                                        <div class="text-sm text-gray-500">-</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Key Players -->
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden border-2 border-gray-100">
                        <div class="bg-gray-900 p-4">
                            <h2 class="heading-font text-2xl text-white">Ключевые игроки</h2>
                        </div>
                        <div class="p-6">
                            <div class="space-y-6">
                                <div class="flex items-center gap-4">
                                    <div class="w-16 h-16 rounded-full overflow-hidden">
                                        <img src="https://readdy.ai/api/search-image?query=A%20portrait%20photo%20of%20a%20male%20football%20player%20in%20a%20green%20and%20black%20uniform%20with%20a%20determined%20expression%2C%20professional%20sports%20photography%20style&amp;width=200&amp;height=200&amp;seq=21&amp;orientation=squarish" alt="Player" class="w-full h-full object-cover object-top">
                                    </div>
                                    <div>
                                        <div class="font-bold text-gray-900">Igor "The Antenna" Volkov</div>
                                        <div class="text-sm text-primary">Captain &amp; Forward</div>
                                        <div class="text-sm text-gray-500">15 Goals this season</div>
                                    </div>
                                </div>
                                <div class="flex items-center gap-4">
                                    <div class="w-16 h-16 rounded-full overflow-hidden">
                                        <img src="https://readdy.ai/api/search-image?query=A%20portrait%20photo%20of%20a%20male%20football%20player%20in%20a%20green%20and%20black%20uniform%20with%20a%20confident%20smile%2C%20professional%20sports%20photography%20style&amp;width=200&amp;height=200&amp;seq=22&amp;orientation=squarish" alt="Player" class="w-full h-full object-cover object-top">
                                    </div>
                                    <div>
                                        <div class="font-bold text-gray-900">Dmitry "The Shell" Popov</div>
                                        <div class="text-sm text-primary">Defender</div>
                                        <div class="text-sm text-gray-500">Most Clean Sheets</div>
                                    </div>
                                </div>
                                <div class="flex items-center gap-4">
                                    <div class="w-16 h-16 rounded-full overflow-hidden">
                                        <img src="https://readdy.ai/api/search-image?query=A%20portrait%20photo%20of%20a%20male%20football%20player%20in%20a%20green%20and%20black%20uniform%20with%20an%20intense%20focus%2C%20professional%20sports%20photography%20style&amp;width=200&amp;height=200&amp;seq=23&amp;orientation=squarish" alt="Player" class="w-full h-full object-cover object-top">
                                    </div>
                                    <div>
                                        <div class="font-bold text-gray-900">Mikhail "The Mandible" Sokolov</div>
                                        <div class="text-sm text-primary">Midfielder</div>
                                        <div class="text-sm text-gray-500">12 Assists this season</div>
                                    </div>
                                </div>
                                <div class="flex items-center gap-4">
                                    <div class="w-16 h-16 rounded-full overflow-hidden">
                                        <img src="https://readdy.ai/api/search-image?query=A%20portrait%20photo%20of%20a%20male%20football%20player%20in%20a%20green%20and%20black%20uniform%20with%20an%20intense%20focus%2C%20professional%20sports%20photography%20style&amp;width=200&amp;height=200&amp;seq=23&amp;orientation=squarish" alt="Player" class="w-full h-full object-cover object-top">
                                    </div>
                                    <div>
                                        <div class="font-bold text-gray-900">Mikhail "The Mandible" Sokolov</div>
                                        <div class="text-sm text-primary">Midfielder</div>
                                        <div class="text-sm text-gray-500">12 Assists this season</div>
                                    </div>
                                </div>
                                <div class="flex items-center gap-4">
                                    <div class="w-16 h-16 rounded-full overflow-hidden">
                                        <img src="https://readdy.ai/api/search-image?query=A%20portrait%20photo%20of%20a%20male%20football%20player%20in%20a%20green%20and%20black%20uniform%20with%20an%20intense%20focus%2C%20professional%20sports%20photography%20style&amp;width=200&amp;height=200&amp;seq=23&amp;orientation=squarish" alt="Player" class="w-full h-full object-cover object-top">
                                    </div>
                                    <div>
                                        <div class="font-bold text-gray-900">Mikhail "The Mandible" Sokolov</div>
                                        <div class="text-sm text-primary">Midfielder</div>
                                        <div class="text-sm text-gray-500">12 Assists this season</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Join Team Modal -->
    <div id="joinTeamModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-xl shadow-2xl max-w-md w-full p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="heading-font text-2xl text-gray-900">Присоединение к команде</h3>
                <button onclick="closeJoinModal()" class="text-gray-400 hover:text-gray-600">
                    <i class="ri-close-line text-2xl"></i>
                </button>
            </div>
            
            <div class="mb-6">
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-4">
                    <div class="flex items-start gap-3">
                        <i class="ri-alert-line text-yellow-600 text-xl mt-1"></i>
                        <div>
                            <div class="font-semibold text-yellow-900 mb-2">Важно!</div>
                            <div class="text-sm text-yellow-800">
                                После завершения трансферного окна (31 августа) вы не сможете сменить команду до следующего трансферного окна (1 июня следующего года), если у вас нет премиум аккаунта.
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="space-y-2 text-sm text-gray-600">
                    <p>Вы присоединяетесь к команде <strong class="text-gray-900">{{ $team->name }}</strong></p>
                    @if(!($transferRules['transfer_window_open'] ?? false))
                        <p class="text-red-600 font-semibold">Трансферное окно закрыто. Для присоединения требуется премиум аккаунт.</p>
                    @endif
                </div>
            </div>
            
            <div class="flex gap-3">
                <button onclick="closeJoinModal()" class="flex-1 bg-gray-200 text-gray-700 font-bold px-6 py-3 rounded-button hover:bg-gray-300 transition-colors">
                    Отмена
                </button>
                <button onclick="confirmJoinTeam()" class="flex-1 bg-primary text-gray-900 font-bold px-6 py-3 rounded-button hover:bg-opacity-80 transition-colors">
                    Присоединиться
                </button>
            </div>
        </div>
    </div>

    <script>
        function showJoinModal() {
            document.getElementById('joinTeamModal').classList.remove('hidden');
        }

        function closeJoinModal() {
            document.getElementById('joinTeamModal').classList.add('hidden');
        }

        function confirmJoinTeam() {
            const button = event.target;
            const originalText = button.textContent;
            button.disabled = true;
            button.textContent = 'Обработка...';

            fetch('{{ route("teams.join", $team->alias) }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.message);
                    window.location.reload();
                } else {
                    alert(data.message || 'Ошибка при присоединении к команде');
                    button.disabled = false;
                    button.textContent = originalText;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Произошла ошибка. Попробуйте позже.');
                button.disabled = false;
                button.textContent = originalText;
            });
        }

        // Закрытие модального окна при клике вне его
        document.getElementById('joinTeamModal')?.addEventListener('click', function(e) {
            if (e.target === this) {
                closeJoinModal();
            }
        });
    </script>

    <!-- Leave Team Modal -->
    <div id="leaveTeamModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-xl shadow-2xl max-w-md w-full p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="heading-font text-2xl text-gray-900">Выход из команды</h3>
                <button onclick="closeLeaveModal()" class="text-gray-400 hover:text-gray-600">
                    <i class="ri-close-line text-2xl"></i>
                </button>
            </div>
            
            <div class="mb-6">
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-4">
                    <div class="flex items-start gap-3">
                        <i class="ri-alert-line text-yellow-600 text-xl mt-1"></i>
                        <div>
                            <div class="font-semibold text-yellow-900 mb-2">Внимание!</div>
                            <div class="text-sm text-yellow-800">
                                Вы уверены, что хотите покинуть команду <strong>{{ $team->name }}</strong>? После выхода вы сможете присоединиться к другой команде только в трансферное окно (если у вас нет премиум аккаунта).
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="flex gap-3">
                <button onclick="closeLeaveModal()" class="flex-1 bg-gray-200 text-gray-700 font-bold px-6 py-3 rounded-button hover:bg-gray-300 transition-colors">
                    Отмена
                </button>
                <button onclick="confirmLeaveTeam()" class="flex-1 bg-red-600 text-white font-bold px-6 py-3 rounded-button hover:bg-red-700 transition-colors">
                    Покинуть команду
                </button>
            </div>
        </div>
    </div>

    <script>
        function showLeaveModal() {
            document.getElementById('leaveTeamModal').classList.remove('hidden');
        }

        function closeLeaveModal() {
            document.getElementById('leaveTeamModal').classList.add('hidden');
        }

        function confirmLeaveTeam() {
            const button = event.target;
            const originalText = button.textContent;
            button.disabled = true;
            button.textContent = 'Обработка...';

            fetch('{{ route("teams.leave", $team->alias) }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.message);
                    window.location.reload();
                } else {
                    alert(data.message || 'Ошибка при выходе из команды');
                    button.disabled = false;
                    button.textContent = originalText;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Произошла ошибка. Попробуйте позже.');
                button.disabled = false;
                button.textContent = originalText;
            });
        }

        // Закрытие модального окна при клике вне его
        document.getElementById('leaveTeamModal')?.addEventListener('click', function(e) {
            if (e.target === this) {
                closeLeaveModal();
            }
        });
    </script>
@endsection

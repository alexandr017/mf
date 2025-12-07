@extends('site.v1.layouts.default')
{{--@section ('title', Shortcode::compile($page->title))--}}
{{--@section ('meta_description', Shortcode::compile($page->meta_description))--}}

@section('content')



    <script>tailwind.config={theme:{extend:{colors:{primary:'#7FFF00',secondary:'#FF355E'},borderRadius:{'none':'0px','sm':'4px',DEFAULT:'8px','md':'12px','lg':'16px','xl':'20px','2xl':'24px','3xl':'32px','full':'9999px','button':'8px'}}}}</script>

    <style>
        :where([class^="ri-"])::before { content: "\f3c2"; }
        body {
            font-family: 'Rubik', sans-serif;
        }
        .heading-font {
            font-family: 'Bangers', cursive;
            letter-spacing: 1px;
        }
        .sidebar-active {
            background-color: rgba(127, 255, 0, 0.1);
            border-right: 4px solid #7FFF00;
            color: #7FFF00;
        }
        .card-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -5px rgba(0, 0, 0, 0.04);
        }
        .stat-card {
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            border: 1px solid #e2e8f0;
        }
        .achievement-badge {
            background: linear-gradient(135deg, #7FFF00 0%, #32CD32 100%);
            animation: pulse-glow 2s infinite;
        }
        @keyframes pulse-glow {
            0%, 100% { box-shadow: 0 0 20px rgba(127, 255, 0, 0.4); }
            50% { box-shadow: 0 0 30px rgba(127, 255, 0, 0.6); }
        }
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
    </style>



<div class="flex min-h-screen">
    <!-- Sidebar -->
    @include('site.v1.modules.account-menu.account-menu')


    <!-- Main Content -->
    <main class="flex-1 p-8">
        <!-- Header Stats -->
        <div class="mb-8">
            <h1 class="heading-font text-4xl text-gray-900 mb-6">Player Dashboard</h1>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Rating Card -->
                <div class="stat-card rounded-xl p-6 card-hover transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Overall Rating</p>
                            <p class="text-3xl font-bold text-primary">87.5</p>
                            <p class="text-sm text-green-600">+2.3 this month</p>
                        </div>
                        <div class="w-12 h-12 bg-primary bg-opacity-20 rounded-full flex items-center justify-center">
                            <div class="w-6 h-6 flex items-center justify-center">
                                <i class="ri-star-fill text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Goals Card -->
                <div class="stat-card rounded-xl p-6 card-hover transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Career Goals</p>
                            <p class="text-3xl font-bold text-secondary">247</p>
                            <p class="text-sm text-green-600">+12 this season</p>
                        </div>
                        <div class="w-12 h-12 bg-secondary bg-opacity-20 rounded-full flex items-center justify-center">
                            <div class="w-6 h-6 flex items-center justify-center">
                                <i class="ri-football-fill text-secondary"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Assists Card -->
                <div class="stat-card rounded-xl p-6 card-hover transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Career Assists</p>
                            <p class="text-3xl font-bold text-yellow-600">189</p>
                            <p class="text-sm text-green-600">+8 this season</p>
                        </div>
                        <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center">
                            <div class="w-6 h-6 flex items-center justify-center">
                                <i class="ri-hand-heart-fill text-yellow-600"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Matches Card -->
                <div class="stat-card rounded-xl p-6 card-hover transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Matches Played</p>
                            <p class="text-3xl font-bold text-blue-600">156</p>
                            <p class="text-sm text-green-600">+3 this week</p>
                        </div>
                        <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                            <div class="w-6 h-6 flex items-center justify-center">
                                <i class="ri-timer-fill text-blue-600"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Career History -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="heading-font text-2xl text-gray-900">Career by Season</h2>
                        <div class="flex items-center space-x-2">
                            <button class="px-3 py-1 bg-primary bg-opacity-20 text-primary rounded-button text-sm font-medium cursor-pointer">All</button>
                            <button class="px-3 py-1 text-gray-600 hover:bg-gray-100 rounded-button text-sm font-medium cursor-pointer">2024</button>
                            <button class="px-3 py-1 text-gray-600 hover:bg-gray-100 rounded-button text-sm font-medium cursor-pointer">2023</button>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <!-- Season 2024 -->
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center space-x-4">
                                    <div class="w-12 h-12 rounded-full overflow-hidden">
                                        <img src="https://readdy.ai/api/search-image?query=Football%20team%20logo%20with%20red%20and%20white%20colors%2C%20shield%20design%20with%20bear%20mascot%2C%20professional%20sports%20emblem%20style&width=150&height=150&seq=203&orientation=squarish" alt="Team Logo" class="w-full h-full object-cover object-top">
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-gray-900">Siberian Thunder Bears</h3>
                                        <p class="text-sm text-gray-500">Forward • 2024 Season</p>
                                    </div>
                                </div>
                                <div class="text-sm text-gray-500">Current Team</div>
                            </div>
                            <div class="grid grid-cols-3 gap-4">
                                <div class="text-center">
                                    <p class="text-2xl font-bold text-primary">12</p>
                                    <p class="text-sm text-gray-500">Goals</p>
                                </div>
                                <div class="text-center">
                                    <p class="text-2xl font-bold text-secondary">8</p>
                                    <p class="text-sm text-gray-500">Assists</p>
                                </div>
                                <div class="text-center">
                                    <p class="text-2xl font-bold text-blue-600">23</p>
                                    <p class="text-sm text-gray-500">Matches</p>
                                </div>
                            </div>
                        </div>

                        <!-- Season 2023 -->
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center space-x-4">
                                    <div class="w-12 h-12 rounded-full overflow-hidden">
                                        <img src="https://readdy.ai/api/search-image?query=Football%20team%20logo%20with%20green%20and%20gold%20colors%2C%20eagle%20mascot%20design%2C%20professional%20sports%20emblem%20style&width=150&height=150&seq=204&orientation=squarish" alt="Team Logo" class="w-full h-full object-cover object-top">
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-gray-900">Moscow Mayhem Eagles</h3>
                                        <p class="text-sm text-gray-500">Forward • 2023 Season</p>
                                    </div>
                                </div>
                                <div class="achievement-badge text-xs text-white px-2 py-1 rounded-full">League Champion</div>
                            </div>
                            <div class="grid grid-cols-3 gap-4">
                                <div class="text-center">
                                    <p class="text-2xl font-bold text-primary">28</p>
                                    <p class="text-sm text-gray-500">Goals</p>
                                </div>
                                <div class="text-center">
                                    <p class="text-2xl font-bold text-secondary">15</p>
                                    <p class="text-sm text-gray-500">Assists</p>
                                </div>
                                <div class="text-center">
                                    <p class="text-2xl font-bold text-blue-600">34</p>
                                    <p class="text-sm text-gray-500">Matches</p>
                                </div>
                            </div>
                        </div>

                        <!-- Season 2022 -->
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center space-x-4">
                                    <div class="w-12 h-12 rounded-full overflow-hidden">
                                        <img src="https://readdy.ai/api/search-image?query=Football%20team%20logo%20with%20blue%20and%20silver%20colors%2C%20wolf%20mascot%20design%2C%20professional%20sports%20emblem%20style&width=150&height=150&seq=205&orientation=squarish" alt="Team Logo" class="w-full h-full object-cover object-top">
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-gray-900">Vladivostok Vodka Wolves</h3>
                                        <p class="text-sm text-gray-500">Forward • 2022 Season</p>
                                    </div>
                                </div>
                                <div class="text-sm text-gray-500">Cup Runner-up</div>
                            </div>
                            <div class="grid grid-cols-3 gap-4">
                                <div class="text-center">
                                    <p class="text-2xl font-bold text-primary">22</p>
                                    <p class="text-sm text-gray-500">Goals</p>
                                </div>
                                <div class="text-center">
                                    <p class="text-2xl font-bold text-secondary">11</p>
                                    <p class="text-sm text-gray-500">Assists</p>
                                </div>
                                <div class="text-center">
                                    <p class="text-2xl font-bold text-blue-600">29</p>
                                    <p class="text-sm text-gray-500">Matches</p>
                                </div>
                            </div>
                        </div>

                        <!-- Season 2021 -->
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center space-x-4">
                                    <div class="w-12 h-12 rounded-full overflow-hidden">
                                        <img src="https://readdy.ai/api/search-image?query=Football%20team%20logo%20with%20purple%20and%20orange%20colors%2C%20dragon%20mascot%20design%2C%20professional%20sports%20emblem%20style&width=150&height=150&seq=206&orientation=squarish" alt="Team Logo" class="w-full h-full object-cover object-top">
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-gray-900">Kazan Chaos Dragons</h3>
                                        <p class="text-sm text-gray-500">Midfielder • 2021 Season</p>
                                    </div>
                                </div>
                                <div class="text-sm text-gray-500">Rookie Season</div>
                            </div>
                            <div class="grid grid-cols-3 gap-4">
                                <div class="text-center">
                                    <p class="text-2xl font-bold text-primary">8</p>
                                    <p class="text-sm text-gray-500">Goals</p>
                                </div>
                                <div class="text-center">
                                    <p class="text-2xl font-bold text-secondary">18</p>
                                    <p class="text-sm text-gray-500">Assists</p>
                                </div>
                                <div class="text-center">
                                    <p class="text-2xl font-bold text-blue-600">26</p>
                                    <p class="text-sm text-gray-500">Matches</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Sidebar -->
            <div class="space-y-6">
                <!-- Recent Achievements -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h2 class="heading-font text-xl text-gray-900 mb-4">Recent Achievements</h2>
                    <div class="space-y-4">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-primary bg-opacity-20 rounded-full flex items-center justify-center">
                                <div class="w-5 h-5 flex items-center justify-center">
                                    <i class="ri-trophy-fill text-primary"></i>
                                </div>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-900">Hat-trick Hero</p>
                                <p class="text-xs text-gray-500">3 goals in one match</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-secondary bg-opacity-20 rounded-full flex items-center justify-center">
                                <div class="w-5 h-5 flex items-center justify-center">
                                    <i class="ri-medal-fill text-secondary"></i>
                                </div>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-900">Assist Master</p>
                                <p class="text-xs text-gray-500">10 assists milestone</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-yellow-100 rounded-full flex items-center justify-center">
                                <div class="w-5 h-5 flex items-center justify-center">
                                    <i class="ri-fire-fill text-yellow-600"></i>
                                </div>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-900">On Fire</p>
                                <p class="text-xs text-gray-500">5-match scoring streak</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Performance Chart -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h2 class="heading-font text-xl text-gray-900 mb-4">Performance Trends</h2>
                    <div class="space-y-4">
                        <div>
                            <div class="flex justify-between text-sm mb-2">
                                <span class="text-gray-600">Goals per Match</span>
                                <span class="font-bold">0.52</span>
                            </div>
                            <div class="bg-gray-200 rounded-full h-2">
                                <div class="bg-primary h-2 rounded-full" style="width: 52%"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between text-sm mb-2">
                                <span class="text-gray-600">Assists per Match</span>
                                <span class="font-bold">0.35</span>
                            </div>
                            <div class="bg-gray-200 rounded-full h-2">
                                <div class="bg-secondary h-2 rounded-full" style="width: 35%"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between text-sm mb-2">
                                <span class="text-gray-600">Match Rating</span>
                                <span class="font-bold">7.8</span>
                            </div>
                            <div class="bg-gray-200 rounded-full h-2">
                                <div class="bg-yellow-400 h-2 rounded-full" style="width: 78%"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h2 class="heading-font text-xl text-gray-900 mb-4">Quick Actions</h2>
                    <div class="space-y-3">
                        <button class="w-full bg-primary hover:bg-opacity-80 text-gray-900 font-bold py-3 px-4 !rounded-button whitespace-nowrap cursor-pointer">
                            <div class="flex items-center justify-center space-x-2">
                                <div class="w-5 h-5 flex items-center justify-center">
                                    <i class="ri-football-line"></i>
                                </div>
                                <span>Join Match</span>
                            </div>
                        </button>
                        <button class="w-full bg-white border-2 border-primary hover:bg-primary hover:text-white text-primary font-bold py-3 px-4 !rounded-button whitespace-nowrap transition-colors duration-300 cursor-pointer">
                            <div class="flex items-center justify-center space-x-2">
                                <div class="w-5 h-5 flex items-center justify-center">
                                    <i class="ri-team-line"></i>
                                </div>
                                <span>Find Team</span>
                            </div>
                        </button>
                        <button class="w-full bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 font-bold py-3 px-4 !rounded-button whitespace-nowrap cursor-pointer">
                            <div class="flex items-center justify-center space-x-2">
                                <div class="w-5 h-5 flex items-center justify-center">
                                    <i class="ri-trophy-line"></i>
                                </div>
                                <span>View Tournaments</span>
                            </div>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<script id="sidebar-navigation">
    document.addEventListener('DOMContentLoaded', function() {
        const sidebarLinks = document.querySelectorAll('aside nav a');
        sidebarLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                sidebarLinks.forEach(l => {
                    l.classList.remove('sidebar-active');
                    l.classList.add('text-gray-600', 'hover:text-gray-900', 'hover:bg-gray-100');
                });
                this.classList.add('sidebar-active');
                this.classList.remove('text-gray-600', 'hover:text-gray-900', 'hover:bg-gray-100');
            });
        });
    });
</script>

<script id="season-filter">
    document.addEventListener('DOMContentLoaded', function() {
        const filterButtons = document.querySelectorAll('.bg-primary.bg-opacity-20, .text-gray-600.hover\\:bg-gray-100');
        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                filterButtons.forEach(btn => {
                    btn.classList.remove('bg-primary', 'bg-opacity-20', 'text-primary');
                    btn.classList.add('text-gray-600', 'hover:bg-gray-100');
                });
                this.classList.add('bg-primary', 'bg-opacity-20', 'text-primary');
                this.classList.remove('text-gray-600', 'hover:bg-gray-100');
            });
        });
    });
</script>

<script id="interactive-stats">
    document.addEventListener('DOMContentLoaded', function() {
        const statCards = document.querySelectorAll('.stat-card');
        const quickActionButtons = document.querySelectorAll('button');
        statCards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-4px)';
            });
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(-2px)';
            });
        });
        quickActionButtons.forEach(button => {
            if (button.textContent.includes('Join Match') || button.textContent.includes('Find Team') || button.textContent.includes('View Tournaments')) {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    console.log('Action clicked:', this.textContent.trim());
                });
            }
        });
    });
</script>

@endsection

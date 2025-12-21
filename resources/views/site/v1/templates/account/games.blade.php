@extends('site.v1.layouts.account')

@section('title', 'Игры - Pircl')

@section('content')
        <!-- Header -->
        <div class="mb-8">
            <h1 class="heading-font text-4xl text-gray-900 mb-2">Training Games</h1>
            <p class="text-gray-600 mb-6">Play mini-games to improve your skills and boost your player rating for match selection</p>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Daily XP -->
                <div class="stat-card rounded-xl p-6 card-hover transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Daily XP Earned</p>
                            <p class="text-2xl font-bold text-primary">245</p>
                            <p class="text-sm text-green-600">+45 today</p>
                        </div>
                        <div class="w-12 h-12 bg-primary bg-opacity-20 rounded-full flex items-center justify-center">
                            <div class="w-6 h-6 flex items-center justify-center">
                                <i class="ri-lightning-fill text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Games Played -->
                <div class="stat-card rounded-xl p-6 card-hover transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Games Played</p>
                            <p class="text-2xl font-bold text-secondary">12</p>
                            <p class="text-sm text-green-600">This week</p>
                        </div>
                        <div class="w-12 h-12 bg-secondary bg-opacity-20 rounded-full flex items-center justify-center">
                            <div class="w-6 h-6 flex items-center justify-center">
                                <i class="ri-gamepad-fill text-secondary"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Win Rate -->
                <div class="stat-card rounded-xl p-6 card-hover transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Win Rate</p>
                            <p class="text-2xl font-bold text-yellow-600">73%</p>
                            <p class="text-sm text-green-600">+5% this week</p>
                        </div>
                        <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center">
                            <div class="w-6 h-6 flex items-center justify-center">
                                <i class="ri-trophy-fill text-yellow-600"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Game Categories -->
        <div class="mb-8">
            <div class="flex items-center space-x-4 mb-6">
                <button class="px-4 py-2 bg-primary bg-opacity-20 text-primary rounded-button text-sm font-medium cursor-pointer game-filter active" data-category="all">All Games</button>
                <button class="px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-button text-sm font-medium cursor-pointer game-filter" data-category="strategy">Strategy</button>
                <button class="px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-button text-sm font-medium cursor-pointer game-filter" data-category="puzzle">Puzzle</button>
                <button class="px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-button text-sm font-medium cursor-pointer game-filter" data-category="arcade">Arcade</button>
                <button class="px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-button text-sm font-medium cursor-pointer game-filter" data-category="card">Card</button>
            </div>

            <!-- Games Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6" id="games-grid">
                <!-- Football Tetris -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden card-hover transition-all duration-300 game-card" data-category="puzzle">
                    <div class="h-48 bg-gradient-to-br from-blue-400 to-purple-600 relative overflow-hidden">
                        <img src="https://readdy.ai/api/search-image?query=Colorful%20tetris%20game%20blocks%20falling%20in%20a%20football%20themed%20puzzle%20game%2C%20bright%20neon%20colors%2C%20gaming%20interface%20with%20football%20stadium%20background&width=400&height=300&seq=301&orientation=landscape" alt="Football Tetris" class="w-full h-full object-cover object-top">
                        <div class="absolute top-4 right-4">
                            <span class="bg-primary text-gray-900 px-2 py-1 rounded-full text-xs font-bold">+15 XP</span>
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="heading-font text-lg text-gray-900 mb-2">Football Tetris</h3>
                        <p class="text-sm text-gray-600 mb-3">Stack football blocks to improve your tactical thinking</p>
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center space-x-2">
                                <div class="w-4 h-4 flex items-center justify-center">
                                    <i class="ri-star-fill text-yellow-400 text-sm"></i>
                                </div>
                                <span class="text-sm text-gray-600">4.8</span>
                            </div>
                            <span class="text-xs text-gray-500">Best: 2,450</span>
                        </div>
                        <button class="w-full bg-primary hover:bg-opacity-80 text-gray-900 font-bold py-2 px-4 !rounded-button whitespace-nowrap cursor-pointer">
                            Play Now
                        </button>
                    </div>
                </div>

                <!-- Memory Match -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden card-hover transition-all duration-300 game-card" data-category="puzzle">
                    <div class="h-48 bg-gradient-to-br from-green-400 to-blue-500 relative overflow-hidden">
                        <img src="https://readdy.ai/api/search-image?query=Memory%20card%20matching%20game%20with%20football%20player%20cards%2C%20colorful%20game%20interface%20with%20grid%20layout%2C%20sports%20themed%20memory%20puzzle&width=400&height=300&seq=302&orientation=landscape" alt="Memory Match" class="w-full h-full object-cover object-top">
                        <div class="absolute top-4 right-4">
                            <span class="bg-secondary text-white px-2 py-1 rounded-full text-xs font-bold">+12 XP</span>
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="heading-font text-lg text-gray-900 mb-2">Memory Match</h3>
                        <p class="text-sm text-gray-600 mb-3">Match player cards to boost concentration</p>
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center space-x-2">
                                <div class="w-4 h-4 flex items-center justify-center">
                                    <i class="ri-star-fill text-yellow-400 text-sm"></i>
                                </div>
                                <span class="text-sm text-gray-600">4.6</span>
                            </div>
                            <span class="text-xs text-gray-500">Best: 18 moves</span>
                        </div>
                        <button class="w-full bg-primary hover:bg-opacity-80 text-gray-900 font-bold py-2 px-4 !rounded-button whitespace-nowrap cursor-pointer">
                            Play Now
                        </button>
                    </div>
                </div>

                <!-- Football Chess -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden card-hover transition-all duration-300 game-card" data-category="strategy">
                    <div class="h-48 bg-gradient-to-br from-red-400 to-pink-600 relative overflow-hidden">
                        <img src="https://readdy.ai/api/search-image?query=Chess%20board%20with%20football%20themed%20pieces%2C%20strategic%20game%20with%20soccer%20players%20as%20chess%20pieces%2C%20elegant%20wooden%20board%20with%20green%20and%20white%20squares&width=400&height=300&seq=303&orientation=landscape" alt="Football Chess" class="w-full h-full object-cover object-top">
                        <div class="absolute top-4 right-4">
                            <span class="bg-yellow-500 text-white px-2 py-1 rounded-full text-xs font-bold">+25 XP</span>
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="heading-font text-lg text-gray-900 mb-2">Football Chess</h3>
                        <p class="text-sm text-gray-600 mb-3">Master strategy with football-themed chess</p>
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center space-x-2">
                                <div class="w-4 h-4 flex items-center justify-center">
                                    <i class="ri-star-fill text-yellow-400 text-sm"></i>
                                </div>
                                <span class="text-sm text-gray-600">4.9</span>
                            </div>
                            <span class="text-xs text-gray-500">Rank: 1,247</span>
                        </div>
                        <button class="w-full bg-primary hover:bg-opacity-80 text-gray-900 font-bold py-2 px-4 !rounded-button whitespace-nowrap cursor-pointer">
                            Play Now
                        </button>
                    </div>
                </div>

                <!-- Penalty Shooter -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden card-hover transition-all duration-300 game-card" data-category="arcade">
                    <div class="h-48 bg-gradient-to-br from-orange-400 to-red-500 relative overflow-hidden">
                        <img src="https://readdy.ai/api/search-image?query=Football%20penalty%20kick%20game%20interface%2C%20goalkeeper%20in%20goal%2C%20football%20stadium%20background%2C%20action%20packed%20sports%20arcade%20game%20scene&width=400&height=300&seq=304&orientation=landscape" alt="Penalty Shooter" class="w-full h-full object-cover object-top">
                        <div class="absolute top-4 right-4">
                            <span class="bg-blue-500 text-white px-2 py-1 rounded-full text-xs font-bold">+20 XP</span>
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="heading-font text-lg text-gray-900 mb-2">Penalty Shooter</h3>
                        <p class="text-sm text-gray-600 mb-3">Practice your shooting accuracy and timing</p>
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center space-x-2">
                                <div class="w-4 h-4 flex items-center justify-center">
                                    <i class="ri-star-fill text-yellow-400 text-sm"></i>
                                </div>
                                <span class="text-sm text-gray-600">4.7</span>
                            </div>
                            <span class="text-xs text-gray-500">Best: 8/10</span>
                        </div>
                        <button class="w-full bg-primary hover:bg-opacity-80 text-gray-900 font-bold py-2 px-4 !rounded-button whitespace-nowrap cursor-pointer">
                            Play Now
                        </button>
                    </div>
                </div>

                <!-- Card Collector -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden card-hover transition-all duration-300 game-card" data-category="card">
                    <div class="h-48 bg-gradient-to-br from-purple-400 to-pink-500 relative overflow-hidden">
                        <img src="https://readdy.ai/api/search-image?query=Football%20trading%20card%20collection%20game%2C%20colorful%20player%20cards%20scattered%20on%20table%2C%20collectible%20card%20game%20interface%20with%20holographic%20effects&width=400&height=300&seq=305&orientation=landscape" alt="Card Collector" class="w-full h-full object-cover object-top">
                        <div class="absolute top-4 right-4">
                            <span class="bg-purple-500 text-white px-2 py-1 rounded-full text-xs font-bold">+18 XP</span>
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="heading-font text-lg text-gray-900 mb-2">Card Collector</h3>
                        <p class="text-sm text-gray-600 mb-3">Collect and trade football player cards</p>
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center space-x-2">
                                <div class="w-4 h-4 flex items-center justify-center">
                                    <i class="ri-star-fill text-yellow-400 text-sm"></i>
                                </div>
                                <span class="text-sm text-gray-600">4.5</span>
                            </div>
                            <span class="text-xs text-gray-500">Cards: 127</span>
                        </div>
                        <button class="w-full bg-primary hover:bg-opacity-80 text-gray-900 font-bold py-2 px-4 !rounded-button whitespace-nowrap cursor-pointer">
                            Play Now
                        </button>
                    </div>
                </div>

                <!-- Football Solitaire -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden card-hover transition-all duration-300 game-card" data-category="card">
                    <div class="h-48 bg-gradient-to-br from-teal-400 to-blue-500 relative overflow-hidden">
                        <img src="https://readdy.ai/api/search-image?query=Solitaire%20card%20game%20with%20football%20themed%20playing%20cards%2C%20green%20felt%20table%20background%2C%20classic%20card%20game%20layout%20with%20soccer%20player%20cards&width=400&height=300&seq=306&orientation=landscape" alt="Football Solitaire" class="w-full h-full object-cover object-top">
                        <div class="absolute top-4 right-4">
                            <span class="bg-teal-500 text-white px-2 py-1 rounded-full text-xs font-bold">+10 XP</span>
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="heading-font text-lg text-gray-900 mb-2">Football Solitaire</h3>
                        <p class="text-sm text-gray-600 mb-3">Classic solitaire with football cards</p>
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center space-x-2">
                                <div class="w-4 h-4 flex items-center justify-center">
                                    <i class="ri-star-fill text-yellow-400 text-sm"></i>
                                </div>
                                <span class="text-sm text-gray-600">4.4</span>
                            </div>
                            <span class="text-xs text-gray-500">Best: 2:34</span>
                        </div>
                        <button class="w-full bg-primary hover:bg-opacity-80 text-gray-900 font-bold py-2 px-4 !rounded-button whitespace-nowrap cursor-pointer">
                            Play Now
                        </button>
                    </div>
                </div>

                <!-- Reaction Test -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden card-hover transition-all duration-300 game-card" data-category="arcade">
                    <div class="h-48 bg-gradient-to-br from-yellow-400 to-orange-500 relative overflow-hidden">
                        <img src="https://readdy.ai/api/search-image?query=Football%20reaction%20time%20test%20game%2C%20goalkeeper%20gloves%20reaching%20for%20ball%2C%20fast%20paced%20sports%20reflex%20training%20game%20interface&width=400&height=300&seq=307&orientation=landscape" alt="Reaction Test" class="w-full h-full object-cover object-top">
                        <div class="absolute top-4 right-4">
                            <span class="bg-orange-500 text-white px-2 py-1 rounded-full text-xs font-bold">+15 XP</span>
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="heading-font text-lg text-gray-900 mb-2">Reaction Test</h3>
                        <p class="text-sm text-gray-600 mb-3">Test and improve your reaction speed</p>
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center space-x-2">
                                <div class="w-4 h-4 flex items-center justify-center">
                                    <i class="ri-star-fill text-yellow-400 text-sm"></i>
                                </div>
                                <span class="text-sm text-gray-600">4.6</span>
                            </div>
                            <span class="text-xs text-gray-500">Best: 0.18s</span>
                        </div>
                        <button class="w-full bg-primary hover:bg-opacity-80 text-gray-900 font-bold py-2 px-4 !rounded-button whitespace-nowrap cursor-pointer">
                            Play Now
                        </button>
                    </div>
                </div>

                <!-- Football Quiz -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden card-hover transition-all duration-300 game-card" data-category="strategy">
                    <div class="h-48 bg-gradient-to-br from-indigo-400 to-purple-500 relative overflow-hidden">
                        <img src="https://readdy.ai/api/search-image?query=Football%20trivia%20quiz%20game%20interface%2C%20question%20mark%20symbols%2C%20football%20knowledge%20test%20with%20stadium%20background%2C%20educational%20sports%20game&width=400&height=300&seq=308&orientation=landscape" alt="Football Quiz" class="w-full h-full object-cover object-top">
                        <div class="absolute top-4 right-4">
                            <span class="bg-indigo-500 text-white px-2 py-1 rounded-full text-xs font-bold">+22 XP</span>
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="heading-font text-lg text-gray-900 mb-2">Football Quiz</h3>
                        <p class="text-sm text-gray-600 mb-3">Test your football knowledge and tactics</p>
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center space-x-2">
                                <div class="w-4 h-4 flex items-center justify-center">
                                    <i class="ri-star-fill text-yellow-400 text-sm"></i>
                                </div>
                                <span class="text-sm text-gray-600">4.8</span>
                            </div>
                            <span class="text-xs text-gray-500">Best: 18/20</span>
                        </div>
                        <button class="w-full bg-primary hover:bg-opacity-80 text-gray-900 font-bold py-2 px-4 !rounded-button whitespace-nowrap cursor-pointer">
                            Play Now
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Daily Challenges -->
        <div class="bg-white rounded-xl shadow-lg p-6 mt-8">
            <div class="flex items-center justify-between mb-6">
                <h2 class="heading-font text-2xl text-gray-900">Daily Challenges</h2>
                <div class="text-sm text-gray-500">Resets in 18:42:15</div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="border border-primary border-opacity-20 rounded-lg p-4 bg-primary bg-opacity-5">
                    <div class="flex items-center space-x-3 mb-3">
                        <div class="w-8 h-8 bg-primary bg-opacity-20 rounded-full flex items-center justify-center">
                            <div class="w-4 h-4 flex items-center justify-center">
                                <i class="ri-target-line text-primary"></i>
                            </div>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-900">Score Master</h3>
                            <p class="text-xs text-gray-500">Score 500+ in Penalty Shooter</p>
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="text-xs text-gray-600">Progress: 320/500</div>
                        <div class="text-sm font-bold text-primary">+50 XP</div>
                    </div>
                    <div class="bg-gray-200 rounded-full h-2 mt-2">
                        <div class="bg-primary h-2 rounded-full" style="width: 64%"></div>
                    </div>
                </div>
                <div class="border border-gray-200 rounded-lg p-4">
                    <div class="flex items-center space-x-3 mb-3">
                        <div class="w-8 h-8 bg-secondary bg-opacity-20 rounded-full flex items-center justify-center">
                            <div class="w-4 h-4 flex items-center justify-center">
                                <i class="ri-gamepad-line text-secondary"></i>
                            </div>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-900">Game Explorer</h3>
                            <p class="text-xs text-gray-500">Play 3 different games</p>
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="text-xs text-gray-600">Progress: 1/3</div>
                        <div class="text-sm font-bold text-secondary">+30 XP</div>
                    </div>
                    <div class="bg-gray-200 rounded-full h-2 mt-2">
                        <div class="bg-secondary h-2 rounded-full" style="width: 33%"></div>
                    </div>
                </div>
                <div class="border border-gray-200 rounded-lg p-4">
                    <div class="flex items-center space-x-3 mb-3">
                        <div class="w-8 h-8 bg-yellow-100 rounded-full flex items-center justify-center">
                            <div class="w-4 h-4 flex items-center justify-center">
                                <i class="ri-fire-line text-yellow-600"></i>
                            </div>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-900">Streak Keeper</h3>
                            <p class="text-xs text-gray-500">Win 5 games in a row</p>
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="text-xs text-gray-600">Progress: 2/5</div>
                        <div class="text-sm font-bold text-yellow-600">+75 XP</div>
                    </div>
                    <div class="bg-gray-200 rounded-full h-2 mt-2">
                        <div class="bg-yellow-400 h-2 rounded-full" style="width: 40%"></div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<script id="game-filter">
    document.addEventListener('DOMContentLoaded', function() {
        const filterButtons = document.querySelectorAll('.game-filter');
        const gameCards = document.querySelectorAll('.game-card');
        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                const category = this.dataset.category;
                filterButtons.forEach(btn => {
                    btn.classList.remove('bg-primary', 'bg-opacity-20', 'text-primary');
                    btn.classList.add('text-gray-600', 'hover:bg-gray-100');
                });
                this.classList.add('bg-primary', 'bg-opacity-20', 'text-primary');
                this.classList.remove('text-gray-600', 'hover:bg-gray-100');
                gameCards.forEach(card => {
                    if (category === 'all' || card.dataset.category === category) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });
    });
</script>
<script id="game-interactions">
    document.addEventListener('DOMContentLoaded', function() {
        const statCards = document.querySelectorAll('.stat-card');
        const gameCards = document.querySelectorAll('.game-card');
        const playButtons = document.querySelectorAll('button');
        statCards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-4px)';
            });
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(-2px)';
            });
        });
        gameCards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-4px)';
            });
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(-2px)';
            });
        });
        playButtons.forEach(button => {
            if (button.textContent.includes('Play Now')) {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const gameCard = this.closest('.game-card');
                    const gameTitle = gameCard.querySelector('h3').textContent;
                    console.log('Starting game:', gameTitle);
                    this.textContent = 'Loading...';
                    this.disabled = true;
                    setTimeout(() => {
                        this.textContent = 'Play Now';
                        this.disabled = false;
                    }, 2000);
                });
            }
        });
    });
</script>
@endsection

@section('additional-scripts')

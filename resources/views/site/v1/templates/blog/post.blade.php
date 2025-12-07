
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meme Football - The Most Ridiculous Football League in Russia</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bangers&family=Rubik:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css">
    <script src="https://cdn.tailwindcss.com/3.4.16"></script>
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
        .hero-section {
            background-image: linear-gradient(to right, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0.5) 40%, rgba(0,0,0,0.3) 100%), url('https://readdy.ai/api/search-image?query=A%20surreal%20and%20humorous%20football%20match%20in%20a%20muddy%20stadium%20with%20giant%20insect%20mascots%20on%20the%20sidelines.%20The%20scene%20is%20chaotic%20with%20two%20teams%20wearing%20ridiculous%20uniforms%20playing%20in%20mud.%20The%20stadium%20is%20dilapidated%20with%20funny%20banners.%20The%20atmosphere%20is%20absurd%20yet%20energetic%2C%20with%20cartoon-like%20quality%20but%20still%20photorealistic.&width=1920&height=1080&seq=1&orientation=landscape');
            background-size: cover;
            background-position: center;
        }
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        .countdown-timer {
            font-variant-numeric: tabular-nums;
        }
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        .team-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            overflow: hidden;
            position: relative;
        }
    </style>
</head>
<body class="bg-gray-50">
<!-- Navigation -->

@include('site.v1.modules.header.header')





<main class="container mx-auto px-4 py-12">
    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Sidebar Navigation -->
        <div class="lg:w-1/4">
            <div class="bg-white rounded-lg shadow-sm p-6 sticky top-24">
                <h3 class="text-lg font-semibold mb-4">Quick Navigation</h3>
                <ul class="space-y-3">
                    <li>
                        <a href="#game-rules" class="flex items-center text-primary hover:text-blue-700 transition-colors">
                            <div class="w-5 h-5 flex items-center justify-center mr-2">
                                <i class="ri-football-line"></i>
                            </div>
                            <span>Game Rules</span>
                        </a>
                    </li>
                    <li>
                        <a href="#ranking-system" class="flex items-center text-gray-700 hover:text-primary transition-colors">
                            <div class="w-5 h-5 flex items-center justify-center mr-2">
                                <i class="ri-trophy-line"></i>
                            </div>
                            <span>Points &amp; Ranking</span>
                        </a>
                    </li>
                    <li>
                        <a href="#fair-play" class="flex items-center text-gray-700 hover:text-primary transition-colors">
                            <div class="w-5 h-5 flex items-center justify-center mr-2">
                                <i class="ri-hand-heart-line"></i>
                            </div>
                            <span>Fair Play Guidelines</span>
                        </a>
                    </li>
                    <li>
                        <a href="#technical-help" class="flex items-center text-gray-700 hover:text-primary transition-colors">
                            <div class="w-5 h-5 flex items-center justify-center mr-2">
                                <i class="ri-question-line"></i>
                            </div>
                            <span>Technical Help</span>
                        </a>
                    </li>
                    <li>
                        <a href="#faqs" class="flex items-center text-gray-700 hover:text-primary transition-colors">
                            <div class="w-5 h-5 flex items-center justify-center mr-2">
                                <i class="ri-questionnaire-line"></i>
                            </div>
                            <span>FAQs</span>
                        </a>
                    </li>
                </ul>
                <div class="mt-6 pt-6 border-t">
                    <a href="https://readdy.ai/home/ba17d2a5-8f15-42cd-a5e7-3b6aff6a4c18/9d40a6b3-9de1-4266-b408-31c7ef7711d6" data-readdy="true" class="flex items-center text-gray-600 hover:text-primary transition-colors">
                        <div class="w-5 h-5 flex items-center justify-center mr-2">
                            <i class="ri-arrow-left-line"></i>
                        </div>
                        <span>Back to Homepage</span>
                    </a>
                </div>
                <div class="mt-6 pt-6 border-t">
                    <button class="w-full bg-gray-100 text-gray-700 px-4 py-2 !rounded-button hover:bg-gray-200 transition-colors flex items-center justify-center whitespace-nowrap">
                        <div class="w-5 h-5 flex items-center justify-center mr-2">
                            <i class="ri-download-line"></i>
                        </div>
                        <span>Download as PDF</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Main Content Area -->
        <div class="lg:w-3/4">
            <!-- Game Rules Section -->
            <section id="game-rules" class="mb-12 scroll-mt-24">
                <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                    <div class="p-6 border-b">
                        <div class="flex items-center">
                            <div class="w-10 h-10 flex items-center justify-center bg-blue-100 text-primary rounded-full mr-4">
                                <i class="ri-football-line ri-lg"></i>
                            </div>
                            <h2 class="text-2xl font-bold">Game Rules Overview</h2>
                        </div>
                    </div>

                    <div class="p-6">
                        <div class="prose max-w-none">
                            <p class="mb-6">The Meme Football League operates under a unique set of rules designed to create fair competition while maintaining the fun, meme-based nature of our community. Below are the official rules that all teams and players must follow.</p>

                            <div class="mb-8">
                                <h3 class="text-xl font-semibold mb-4">Basic Match Rules</h3>
                                <ul class="space-y-3">
                                    <li class="flex items-start">
                                        <div class="w-5 h-5 flex items-center justify-center text-primary mt-1 mr-2">
                                            <i class="ri-check-line"></i>
                                        </div>
                                        <span>Matches are played in a virtual format with each team submitting their meme lineup before the deadline</span>
                                    </li>
                                    <li class="flex items-start">
                                        <div class="w-5 h-5 flex items-center justify-center text-primary mt-1 mr-2">
                                            <i class="ri-check-line"></i>
                                        </div>
                                        <span>Each match consists of two 45-minute halves with a 15-minute break between halves</span>
                                    </li>
                                    <li class="flex items-start">
                                        <div class="w-5 h-5 flex items-center justify-center text-primary mt-1 mr-2">
                                            <i class="ri-check-line"></i>
                                        </div>
                                        <span>Teams must field 11 players in their starting lineup with a maximum of 5 substitutes available</span>
                                    </li>
                                    <li class="flex items-start">
                                        <div class="w-5 h-5 flex items-center justify-center text-primary mt-1 mr-2">
                                            <i class="ri-check-line"></i>
                                        </div>
                                        <span>Match outcomes are determined by community voting and algorithm scoring based on meme quality, creativity, and relevance</span>
                                    </li>
                                </ul>
                            </div>

                            <div class="mb-8">
                                <h3 class="text-xl font-semibold mb-4">Player Eligibility</h3>
                                <div class="bg-gray-50 p-4 rounded-lg mb-4">
                                    <p class="text-gray-700">To be eligible to participate in the Meme Football League, players must:</p>
                                </div>
                                <ul class="space-y-3">
                                    <li class="flex items-start">
                                        <div class="w-5 h-5 flex items-center justify-center text-primary mt-1 mr-2">
                                            <i class="ri-check-line"></i>
                                        </div>
                                        <span>Be registered on the platform at least 48 hours before their first match</span>
                                    </li>
                                    <li class="flex items-start">
                                        <div class="w-5 h-5 flex items-center justify-center text-primary mt-1 mr-2">
                                            <i class="ri-check-line"></i>
                                        </div>
                                        <span>Have a complete profile with required information filled out</span>
                                    </li>
                                    <li class="flex items-start">
                                        <div class="w-5 h-5 flex items-center justify-center text-primary mt-1 mr-2">
                                            <i class="ri-check-line"></i>
                                        </div>
                                        <span>Agree to the league's code of conduct and fair play guidelines</span>
                                    </li>
                                    <li class="flex items-start">
                                        <div class="w-5 h-5 flex items-center justify-center text-primary mt-1 mr-2">
                                            <i class="ri-check-line"></i>
                                        </div>
                                        <span>Not be currently serving a suspension or ban from the league</span>
                                    </li>
                                </ul>
                            </div>

                            <div class="mb-8">
                                <h3 class="text-xl font-semibold mb-4">Match Timing and Deadlines</h3>
                                <div class="overflow-x-auto">
                                    <table class="min-w-full border border-gray-200 text-sm">
                                        <thead>
                                        <tr class="bg-gray-50">
                                            <th class="px-4 py-3 text-left font-semibold border-b">Activity</th>
                                            <th class="px-4 py-3 text-left font-semibold border-b">Deadline</th>
                                            <th class="px-4 py-3 text-left font-semibold border-b">Notes</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td class="px-4 py-3 border-b">Team Registration</td>
                                            <td class="px-4 py-3 border-b">7 days before season start</td>
                                            <td class="px-4 py-3 border-b">Late registrations not accepted</td>
                                        </tr>
                                        <tr class="bg-gray-50">
                                            <td class="px-4 py-3 border-b">Squad Submission</td>
                                            <td class="px-4 py-3 border-b">24 hours before match</td>
                                            <td class="px-4 py-3 border-b">Can be updated until deadline</td>
                                        </tr>
                                        <tr>
                                            <td class="px-4 py-3 border-b">Meme Submissions</td>
                                            <td class="px-4 py-3 border-b">12 hours before match</td>
                                            <td class="px-4 py-3 border-b">All starting players must submit</td>
                                        </tr>
                                        <tr class="bg-gray-50">
                                            <td class="px-4 py-3 border-b">Voting Period</td>
                                            <td class="px-4 py-3 border-b">During match + 2 hours</td>
                                            <td class="px-4 py-3 border-b">Community voting on memes</td>
                                        </tr>
                                        <tr>
                                            <td class="px-4 py-3 border-b">Results Announcement</td>
                                            <td class="px-4 py-3 border-b">3 hours after match end</td>
                                            <td class="px-4 py-3 border-b">Published on league website</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="mb-8">
                                <h3 class="text-xl font-semibold mb-4">Substitutions and Squad Size</h3>
                                <div class="grid md:grid-cols-2 gap-6">
                                    <div class="bg-blue-50 p-5 rounded-lg">
                                        <h4 class="font-semibold mb-2 text-blue-800">During Regular Season</h4>
                                        <ul class="space-y-2">
                                            <li class="flex items-start">
                                                <div class="w-5 h-5 flex items-center justify-center text-primary mt-1 mr-2">
                                                    <i class="ri-check-line"></i>
                                                </div>
                                                <span>Maximum squad size: 20 players</span>
                                            </li>
                                            <li class="flex items-start">
                                                <div class="w-5 h-5 flex items-center justify-center text-primary mt-1 mr-2">
                                                    <i class="ri-check-line"></i>
                                                </div>
                                                <span>Starting lineup: 11 players</span>
                                            </li>
                                            <li class="flex items-start">
                                                <div class="w-5 h-5 flex items-center justify-center text-primary mt-1 mr-2">
                                                    <i class="ri-check-line"></i>
                                                </div>
                                                <span>Substitutes allowed: 3 per match</span>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="bg-green-50 p-5 rounded-lg">
                                        <h4 class="font-semibold mb-2 text-green-800">During Playoffs</h4>
                                        <ul class="space-y-2">
                                            <li class="flex items-start">
                                                <div class="w-5 h-5 flex items-center justify-center text-primary mt-1 mr-2">
                                                    <i class="ri-check-line"></i>
                                                </div>
                                                <span>Maximum squad size: 23 players</span>
                                            </li>
                                            <li class="flex items-start">
                                                <div class="w-5 h-5 flex items-center justify-center text-primary mt-1 mr-2">
                                                    <i class="ri-check-line"></i>
                                                </div>
                                                <span>Starting lineup: 11 players</span>
                                            </li>
                                            <li class="flex items-start">
                                                <div class="w-5 h-5 flex items-center justify-center text-primary mt-1 mr-2">
                                                    <i class="ri-check-line"></i>
                                                </div>
                                                <span>Substitutes allowed: 5 per match</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Points & Ranking System -->
            <section id="ranking-system" class="mb-12 scroll-mt-24">
                <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                    <div class="p-6 border-b">
                        <div class="flex items-center">
                            <div class="w-10 h-10 flex items-center justify-center bg-blue-100 text-primary rounded-full mr-4">
                                <i class="ri-trophy-line ri-lg"></i>
                            </div>
                            <h2 class="text-2xl font-bold">Points &amp; Ranking System</h2>
                        </div>
                    </div>

                    <div class="p-6">
                        <div class="prose max-w-none">
                            <p class="mb-6">The Meme Football League uses a comprehensive points system to determine team standings, promotions, and relegations. Understanding how points are calculated is essential for strategic team management.</p>

                            <div class="mb-8">
                                <h3 class="text-xl font-semibold mb-4">Points Allocation</h3>
                                <div class="grid md:grid-cols-3 gap-4 mb-6">
                                    <div class="bg-green-50 p-4 rounded-lg text-center">
                                        <div class="text-3xl font-bold text-green-600 mb-2">3</div>
                                        <div class="font-medium">Points for a Win</div>
                                    </div>
                                    <div class="bg-gray-100 p-4 rounded-lg text-center">
                                        <div class="text-3xl font-bold text-gray-600 mb-2">1</div>
                                        <div class="font-medium">Point for a Draw</div>
                                    </div>
                                    <div class="bg-red-50 p-4 rounded-lg text-center">
                                        <div class="text-3xl font-bold text-red-600 mb-2">0</div>
                                        <div class="font-medium">Points for a Loss</div>
                                    </div>
                                </div>

                                <div class="bg-blue-50 p-5 rounded-lg mb-6">
                                    <h4 class="font-semibold mb-2 text-blue-800">Bonus Points</h4>
                                    <ul class="space-y-2">
                                        <li class="flex items-start">
                                            <div class="w-5 h-5 flex items-center justify-center text-primary mt-1 mr-2">
                                                <i class="ri-add-line"></i>
                                            </div>
                                            <span>+1 point for scoring 3 or more goals in a match</span>
                                        </li>
                                        <li class="flex items-start">
                                            <div class="w-5 h-5 flex items-center justify-center text-primary mt-1 mr-2">
                                                <i class="ri-add-line"></i>
                                            </div>
                                            <span>+1 point for a clean sheet (no goals conceded)</span>
                                        </li>
                                        <li class="flex items-start">
                                            <div class="w-5 h-5 flex items-center justify-center text-primary mt-1 mr-2">
                                                <i class="ri-add-line"></i>
                                            </div>
                                            <span>+2 points for "Meme of the Match" award (voted by community)</span>
                                        </li>
                                    </ul>
                                </div>

                                <div class="bg-red-50 p-5 rounded-lg">
                                    <h4 class="font-semibold mb-2 text-red-800">Penalty Points</h4>
                                    <ul class="space-y-2">
                                        <li class="flex items-start">
                                            <div class="w-5 h-5 flex items-center justify-center text-red-500 mt-1 mr-2">
                                                <i class="ri-subtract-line"></i>
                                            </div>
                                            <span>-1 point for accumulating 5 yellow cards in a season</span>
                                        </li>
                                        <li class="flex items-start">
                                            <div class="w-5 h-5 flex items-center justify-center text-red-500 mt-1 mr-2">
                                                <i class="ri-subtract-line"></i>
                                            </div>
                                            <span>-2 points for a red card offense</span>
                                        </li>
                                        <li class="flex items-start">
                                            <div class="w-5 h-5 flex items-center justify-center text-red-500 mt-1 mr-2">
                                                <i class="ri-subtract-line"></i>
                                            </div>
                                            <span>-3 points for failing to submit a complete team before deadline</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="mb-8">
                                <h3 class="text-xl font-semibold mb-4">Tiebreaker Rules</h3>
                                <p class="mb-4">When teams finish with equal points, the following tiebreakers are applied in order:</p>

                                <ol class="space-y-3 list-decimal pl-5">
                                    <li>Goal difference (goals scored minus goals conceded)</li>
                                    <li>Goals scored</li>
                                    <li>Head-to-head results between tied teams</li>
                                    <li>Fewer disciplinary points (yellow card = 1 point, red card = 3 points)</li>
                                    <li>Meme quality rating (average community rating throughout season)</li>
                                    <li>Coin toss (as a last resort)</li>
                                </ol>
                            </div>

                            <div class="mb-8">
                                <h3 class="text-xl font-semibold mb-4">Promotion &amp; Relegation</h3>
                                <div class="bg-gray-50 p-5 rounded-lg mb-6">
                                    <div class="grid md:grid-cols-2 gap-6">
                                        <div>
                                            <h4 class="font-semibold mb-3 text-green-700">Promotion</h4>
                                            <ul class="space-y-2">
                                                <li class="flex items-start">
                                                    <div class="w-5 h-5 flex items-center justify-center text-green-500 mt-1 mr-2">
                                                        <i class="ri-arrow-up-line"></i>
                                                    </div>
                                                    <span>Top 2 teams are automatically promoted</span>
                                                </li>
                                                <li class="flex items-start">
                                                    <div class="w-5 h-5 flex items-center justify-center text-green-500 mt-1 mr-2">
                                                        <i class="ri-arrow-up-line"></i>
                                                    </div>
                                                    <span>Teams finishing 3rd-6th compete in playoff for final promotion spot</span>
                                                </li>
                                            </ul>
                                        </div>
                                        <div>
                                            <h4 class="font-semibold mb-3 text-red-700">Relegation</h4>
                                            <ul class="space-y-2">
                                                <li class="flex items-start">
                                                    <div class="w-5 h-5 flex items-center justify-center text-red-500 mt-1 mr-2">
                                                        <i class="ri-arrow-down-line"></i>
                                                    </div>
                                                    <span>Bottom 3 teams are automatically relegated</span>
                                                </li>
                                                <li class="flex items-start">
                                                    <div class="w-5 h-5 flex items-center justify-center text-red-500 mt-1 mr-2">
                                                        <i class="ri-arrow-down-line"></i>
                                                    </div>
                                                    <span>Team finishing 4th from bottom plays relegation playoff against 3rd place team from lower division</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="bg-blue-50 p-5 rounded-lg">
                                    <h4 class="font-semibold mb-3 text-blue-800">League Structure</h4>
                                    <div class="overflow-x-auto">
                                        <table class="min-w-full border border-blue-200 text-sm">
                                            <thead>
                                            <tr class="bg-blue-100">
                                                <th class="px-4 py-3 text-left font-semibold border-b">Division</th>
                                                <th class="px-4 py-3 text-left font-semibold border-b">Teams</th>
                                                <th class="px-4 py-3 text-left font-semibold border-b">Matches</th>
                                                <th class="px-4 py-3 text-left font-semibold border-b">Season Length</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td class="px-4 py-3 border-b font-medium">Premier League</td>
                                                <td class="px-4 py-3 border-b">20 teams</td>
                                                <td class="px-4 py-3 border-b">38 matches</td>
                                                <td class="px-4 py-3 border-b">9 months</td>
                                            </tr>
                                            <tr class="bg-blue-50">
                                                <td class="px-4 py-3 border-b font-medium">Championship</td>
                                                <td class="px-4 py-3 border-b">24 teams</td>
                                                <td class="px-4 py-3 border-b">46 matches</td>
                                                <td class="px-4 py-3 border-b">9 months</td>
                                            </tr>
                                            <tr>
                                                <td class="px-4 py-3 border-b font-medium">League One</td>
                                                <td class="px-4 py-3 border-b">24 teams</td>
                                                <td class="px-4 py-3 border-b">46 matches</td>
                                                <td class="px-4 py-3 border-b">9 months</td>
                                            </tr>
                                            <tr class="bg-blue-50">
                                                <td class="px-4 py-3 border-b font-medium">League Two</td>
                                                <td class="px-4 py-3 border-b">24 teams</td>
                                                <td class="px-4 py-3 border-b">46 matches</td>
                                                <td class="px-4 py-3 border-b">9 months</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <h3 class="text-xl font-semibold mb-4">Visual Example: League Table</h3>
                                <div class="bg-white border rounded-lg overflow-hidden">
                                    <div class="overflow-x-auto">
                                        <table class="min-w-full text-sm">
                                            <thead>
                                            <tr class="bg-gray-50">
                                                <th class="px-4 py-3 text-left font-semibold border-b">Pos</th>
                                                <th class="px-4 py-3 text-left font-semibold border-b">Team</th>
                                                <th class="px-4 py-3 text-center font-semibold border-b">P</th>
                                                <th class="px-4 py-3 text-center font-semibold border-b">W</th>
                                                <th class="px-4 py-3 text-center font-semibold border-b">D</th>
                                                <th class="px-4 py-3 text-center font-semibold border-b">L</th>
                                                <th class="px-4 py-3 text-center font-semibold border-b">GF</th>
                                                <th class="px-4 py-3 text-center font-semibold border-b">GA</th>
                                                <th class="px-4 py-3 text-center font-semibold border-b">GD</th>
                                                <th class="px-4 py-3 text-center font-semibold border-b">Pts</th>
                                                <th class="px-4 py-3 text-center font-semibold border-b">Form</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr class="bg-green-50">
                                                <td class="px-4 py-3 border-b font-medium text-green-700">1</td>
                                                <td class="px-4 py-3 border-b font-medium">Meme United</td>
                                                <td class="px-4 py-3 border-b text-center">38</td>
                                                <td class="px-4 py-3 border-b text-center">26</td>
                                                <td class="px-4 py-3 border-b text-center">8</td>
                                                <td class="px-4 py-3 border-b text-center">4</td>
                                                <td class="px-4 py-3 border-b text-center">82</td>
                                                <td class="px-4 py-3 border-b text-center">32</td>
                                                <td class="px-4 py-3 border-b text-center">+50</td>
                                                <td class="px-4 py-3 border-b text-center font-bold">86</td>
                                                <td class="px-4 py-3 border-b">
                                                    <div class="flex space-x-1">
                                                        <span class="w-5 h-5 rounded-full bg-green-500 text-white flex items-center justify-center text-xs">W</span>
                                                        <span class="w-5 h-5 rounded-full bg-green-500 text-white flex items-center justify-center text-xs">W</span>
                                                        <span class="w-5 h-5 rounded-full bg-gray-400 text-white flex items-center justify-center text-xs">D</span>
                                                        <span class="w-5 h-5 rounded-full bg-green-500 text-white flex items-center justify-center text-xs">W</span>
                                                        <span class="w-5 h-5 rounded-full bg-green-500 text-white flex items-center justify-center text-xs">W</span>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="bg-green-50">
                                                <td class="px-4 py-3 border-b font-medium text-green-700">2</td>
                                                <td class="px-4 py-3 border-b font-medium">Meme City</td>
                                                <td class="px-4 py-3 border-b text-center">38</td>
                                                <td class="px-4 py-3 border-b text-center">25</td>
                                                <td class="px-4 py-3 border-b text-center">8</td>
                                                <td class="px-4 py-3 border-b text-center">5</td>
                                                <td class="px-4 py-3 border-b text-center">80</td>
                                                <td class="px-4 py-3 border-b text-center">33</td>
                                                <td class="px-4 py-3 border-b text-center">+47</td>
                                                <td class="px-4 py-3 border-b text-center font-bold">83</td>
                                                <td class="px-4 py-3 border-b">
                                                    <div class="flex space-x-1">
                                                        <span class="w-5 h-5 rounded-full bg-green-500 text-white flex items-center justify-center text-xs">W</span>
                                                        <span class="w-5 h-5 rounded-full bg-green-500 text-white flex items-center justify-center text-xs">W</span>
                                                        <span class="w-5 h-5 rounded-full bg-green-500 text-white flex items-center justify-center text-xs">W</span>
                                                        <span class="w-5 h-5 rounded-full bg-red-500 text-white flex items-center justify-center text-xs">L</span>
                                                        <span class="w-5 h-5 rounded-full bg-green-500 text-white flex items-center justify-center text-xs">W</span>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="bg-blue-50">
                                                <td class="px-4 py-3 border-b font-medium text-blue-700">3</td>
                                                <td class="px-4 py-3 border-b font-medium">Meme Liverpool</td>
                                                <td class="px-4 py-3 border-b text-center">38</td>
                                                <td class="px-4 py-3 border-b text-center">23</td>
                                                <td class="px-4 py-3 border-b text-center">9</td>
                                                <td class="px-4 py-3 border-b text-center">6</td>
                                                <td class="px-4 py-3 border-b text-center">78</td>
                                                <td class="px-4 py-3 border-b text-center">36</td>
                                                <td class="px-4 py-3 border-b text-center">+42</td>
                                                <td class="px-4 py-3 border-b text-center font-bold">78</td>
                                                <td class="px-4 py-3 border-b">
                                                    <div class="flex space-x-1">
                                                        <span class="w-5 h-5 rounded-full bg-green-500 text-white flex items-center justify-center text-xs">W</span>
                                                        <span class="w-5 h-5 rounded-full bg-gray-400 text-white flex items-center justify-center text-xs">D</span>
                                                        <span class="w-5 h-5 rounded-full bg-green-500 text-white flex items-center justify-center text-xs">W</span>
                                                        <span class="w-5 h-5 rounded-full bg-green-500 text-white flex items-center justify-center text-xs">W</span>
                                                        <span class="w-5 h-5 rounded-full bg-gray-400 text-white flex items-center justify-center text-xs">D</span>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="px-4 py-3 border-b font-medium">17</td>
                                                <td class="px-4 py-3 border-b font-medium">Meme Palace</td>
                                                <td class="px-4 py-3 border-b text-center">38</td>
                                                <td class="px-4 py-3 border-b text-center">10</td>
                                                <td class="px-4 py-3 border-b text-center">8</td>
                                                <td class="px-4 py-3 border-b text-center">20</td>
                                                <td class="px-4 py-3 border-b text-center">44</td>
                                                <td class="px-4 py-3 border-b text-center">66</td>
                                                <td class="px-4 py-3 border-b text-center">-22</td>
                                                <td class="px-4 py-3 border-b text-center font-bold">38</td>
                                                <td class="px-4 py-3 border-b">
                                                    <div class="flex space-x-1">
                                                        <span class="w-5 h-5 rounded-full bg-red-500 text-white flex items-center justify-center text-xs">L</span>
                                                        <span class="w-5 h-5 rounded-full bg-gray-400 text-white flex items-center justify-center text-xs">D</span>
                                                        <span class="w-5 h-5 rounded-full bg-green-500 text-white flex items-center justify-center text-xs">W</span>
                                                        <span class="w-5 h-5 rounded-full bg-red-500 text-white flex items-center justify-center text-xs">L</span>
                                                        <span class="w-5 h-5 rounded-full bg-green-500 text-white flex items-center justify-center text-xs">W</span>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="bg-red-50">
                                                <td class="px-4 py-3 border-b font-medium text-red-700">18</td>
                                                <td class="px-4 py-3 border-b font-medium">Meme Burnley</td>
                                                <td class="px-4 py-3 border-b text-center">38</td>
                                                <td class="px-4 py-3 border-b text-center">7</td>
                                                <td class="px-4 py-3 border-b text-center">14</td>
                                                <td class="px-4 py-3 border-b text-center">17</td>
                                                <td class="px-4 py-3 border-b text-center">33</td>
                                                <td class="px-4 py-3 border-b text-center">53</td>
                                                <td class="px-4 py-3 border-b text-center">-20</td>
                                                <td class="px-4 py-3 border-b text-center font-bold">35</td>
                                                <td class="px-4 py-3 border-b">
                                                    <div class="flex space-x-1">
                                                        <span class="w-5 h-5 rounded-full bg-red-500 text-white flex items-center justify-center text-xs">L</span>
                                                        <span class="w-5 h-5 rounded-full bg-red-500 text-white flex items-center justify-center text-xs">L</span>
                                                        <span class="w-5 h-5 rounded-full bg-gray-400 text-white flex items-center justify-center text-xs">D</span>
                                                        <span class="w-5 h-5 rounded-full bg-red-500 text-white flex items-center justify-center text-xs">L</span>
                                                        <span class="w-5 h-5 rounded-full bg-red-500 text-white flex items-center justify-center text-xs">L</span>
                                                    </div>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="p-3 border-t text-xs">
                                        <div class="flex flex-wrap gap-4">
                                            <div class="flex items-center">
                                                <div class="w-3 h-3 bg-green-50 border border-green-200 mr-1"></div>
                                                <span>Promotion</span>
                                            </div>
                                            <div class="flex items-center">
                                                <div class="w-3 h-3 bg-blue-50 border border-blue-200 mr-1"></div>
                                                <span>Playoff</span>
                                            </div>
                                            <div class="flex items-center">
                                                <div class="w-3 h-3 bg-red-50 border border-red-200 mr-1"></div>
                                                <span>Relegation</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Fair Play Guidelines -->
            <section id="fair-play" class="mb-12 scroll-mt-24">
                <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                    <div class="p-6 border-b">
                        <div class="flex items-center">
                            <div class="w-10 h-10 flex items-center justify-center bg-blue-100 text-primary rounded-full mr-4">
                                <i class="ri-hand-heart-line ri-lg"></i>
                            </div>
                            <h2 class="text-2xl font-bold">Fair Play Guidelines</h2>
                        </div>
                    </div>

                    <div class="p-6">
                        <div class="prose max-w-none">
                            <p class="mb-6">The Meme Football League is committed to creating a fun, respectful, and inclusive environment. Our Fair Play Guidelines ensure that all participants adhere to standards of good sportsmanship and ethical behavior.</p>

                            <div class="mb-8">
                                <h3 class="text-xl font-semibold mb-4">Conduct Expectations</h3>
                                <div class="bg-gray-50 p-5 rounded-lg mb-6">
                                    <h4 class="font-semibold mb-3">All participants must:</h4>
                                    <ul class="space-y-3">
                                        <li class="flex items-start">
                                            <div class="w-5 h-5 flex items-center justify-center text-primary mt-1 mr-2">
                                                <i class="ri-check-line"></i>
                                            </div>
                                            <span>Treat all other participants with respect and courtesy</span>
                                        </li>
                                        <li class="flex items-start">
                                            <div class="w-5 h-5 flex items-center justify-center text-primary mt-1 mr-2">
                                                <i class="ri-check-line"></i>
                                            </div>
                                            <span>Avoid offensive, discriminatory, or harmful content in memes and communications</span>
                                        </li>
                                        <li class="flex items-start">
                                            <div class="w-5 h-5 flex items-center justify-center text-primary mt-1 mr-2">
                                                <i class="ri-check-line"></i>
                                            </div>
                                            <span>Submit original content or properly credited memes</span>
                                        </li>
                                        <li class="flex items-start">
                                            <div class="w-5 h-5 flex items-center justify-center text-primary mt-1 mr-2">
                                                <i class="ri-check-line"></i>
                                            </div>
                                            <span>Accept victory and defeat with grace and sportsmanship</span>
                                        </li>
                                        <li class="flex items-start">
                                            <div class="w-5 h-5 flex items-center justify-center text-primary mt-1 mr-2">
                                                <i class="ri-check-line"></i>
                                            </div>
                                            <span>Report any violations or concerns to league administrators</span>
                                        </li>
                                    </ul>
                                </div>

                                <div class="bg-red-50 p-5 rounded-lg">
                                    <h4 class="font-semibold mb-3 text-red-800">Prohibited Behaviors</h4>
                                    <ul class="space-y-3">
                                        <li class="flex items-start">
                                            <div class="w-5 h-5 flex items-center justify-center text-red-500 mt-1 mr-2">
                                                <i class="ri-close-line"></i>
                                            </div>
                                            <span>Harassment, bullying, or intimidation of any kind</span>
                                        </li>
                                        <li class="flex items-start">
                                            <div class="w-5 h-5 flex items-center justify-center text-red-500 mt-1 mr-2">
                                                <i class="ri-close-line"></i>
                                            </div>
                                            <span>Hate speech, discriminatory language, or offensive content</span>
                                        </li>
                                        <li class="flex items-start">
                                            <div class="w-5 h-5 flex items-center justify-center text-red-500 mt-1 mr-2">
                                                <i class="ri-close-line"></i>
                                            </div>
                                            <span>Cheating, match-fixing, or manipulation of voting systems</span>
                                        </li>
                                        <li class="flex items-start">
                                            <div class="w-5 h-5 flex items-center justify-center text-red-500 mt-1 mr-2">
                                                <i class="ri-close-line"></i>
                                            </div>
                                            <span>Impersonation of other users or teams</span>
                                        </li>
                                        <li class="flex items-start">
                                            <div class="w-5 h-5 flex items-center justify-center text-red-500 mt-1 mr-2">
                                                <i class="ri-close-line"></i>
                                            </div>
                                            <span>Sharing of personal or private information without consent</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="mb-8">
                                <h3 class="text-xl font-semibold mb-4">Disciplinary System</h3>
                                <div class="grid md:grid-cols-2 gap-6 mb-6">
                                    <div class="bg-yellow-50 p-5 rounded-lg">
                                        <h4 class="font-semibold mb-3 text-yellow-800">Yellow Card Offenses</h4>
                                        <ul class="space-y-2">
                                            <li class="flex items-start">
                                                <div class="w-5 h-5 flex items-center justify-center text-yellow-500 mt-1 mr-2">
                                                    <i class="ri-alert-line"></i>
                                                </div>
                                                <span>Minor violations of conduct guidelines</span>
                                            </li>
                                            <li class="flex items-start">
                                                <div class="w-5 h-5 flex items-center justify-center text-yellow-500 mt-1 mr-2">
                                                    <i class="ri-alert-line"></i>
                                                </div>
                                                <span>Late submissions without prior notification</span>
                                            </li>
                                            <li class="flex items-start">
                                                <div class="w-5 h-5 flex items-center justify-center text-yellow-500 mt-1 mr-2">
                                                    <i class="ri-alert-line"></i>
                                                </div>
                                                <span>Unsportsmanlike comments in chat or forums</span>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="bg-red-50 p-5 rounded-lg">
                                        <h4 class="font-semibold mb-3 text-red-800">Red Card Offenses</h4>
                                        <ul class="space-y-2">
                                            <li class="flex items-start">
                                                <div class="w-5 h-5 flex items-center justify-center text-red-500 mt-1 mr-2">
                                                    <i class="ri-alert-line"></i>
                                                </div>
                                                <span>Serious violations of conduct guidelines</span>
                                            </li>
                                            <li class="flex items-start">
                                                <div class="w-5 h-5 flex items-center justify-center text-red-500 mt-1 mr-2">
                                                    <i class="ri-alert-line"></i>
                                                </div>
                                                <span>Repeated yellow card offenses</span>
                                            </li>
                                            <li class="flex items-start">
                                                <div class="w-5 h-5 flex items-center justify-center text-red-500 mt-1 mr-2">
                                                    <i class="ri-alert-line"></i>
                                                </div>
                                                <span>Cheating or vote manipulation</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="bg-gray-50 p-5 rounded-lg">
                                    <h4 class="font-semibold mb-3">Consequences</h4>
                                    <div class="overflow-x-auto">
                                        <table class="min-w-full border border-gray-200 text-sm">
                                            <thead>
                                            <tr class="bg-gray-100">
                                                <th class="px-4 py-3 text-left font-semibold border-b">Offense</th>
                                                <th class="px-4 py-3 text-left font-semibold border-b">First Occurrence</th>
                                                <th class="px-4 py-3 text-left font-semibold border-b">Second Occurrence</th>
                                                <th class="px-4 py-3 text-left font-semibold border-b">Third Occurrence</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td class="px-4 py-3 border-b">Yellow Card</td>
                                                <td class="px-4 py-3 border-b">Warning</td>
                                                <td class="px-4 py-3 border-b">1-match suspension</td>
                                                <td class="px-4 py-3 border-b">3-match suspension</td>
                                            </tr>
                                            <tr class="bg-gray-50">
                                                <td class="px-4 py-3 border-b">Red Card</td>
                                                <td class="px-4 py-3 border-b">3-match suspension</td>
                                                <td class="px-4 py-3 border-b">Season-long suspension</td>
                                                <td class="px-4 py-3 border-b">Permanent ban</td>
                                            </tr>
                                            <tr>
                                                <td class="px-4 py-3 border-b">5 Yellow Cards</td>
                                                <td class="px-4 py-3 border-b" colspan="3">Automatic 1-match suspension and -1 point for team</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-8">
                                <h3 class="text-xl font-semibold mb-4">Appeals Process</h3>
                                <div class="bg-blue-50 p-5 rounded-lg">
                                    <h4 class="font-semibold mb-3 text-blue-800">How to Appeal a Decision</h4>
                                    <ol class="space-y-3 list-decimal pl-5">
                                        <li>Submit an appeal request within 48 hours of the disciplinary action</li>
                                        <li>Include all relevant information and evidence supporting your case</li>
                                        <li>Appeals are reviewed by a panel of three independent league administrators</li>
                                        <li>Decision will be communicated within 72 hours of submission</li>
                                        <li>Panel decisions are final and binding</li>
                                    </ol>
                                    <div class="mt-4 p-4 bg-white rounded border border-blue-200">
                                        <p class="text-sm text-blue-800">Note: Appeals should only be submitted when there is clear evidence of an error or misunderstanding. Frivolous appeals may result in additional penalties.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <h3 class="text-xl font-semibold mb-4">Fair Play Recognition</h3>
                                <div class="bg-green-50 p-5 rounded-lg">
                                    <h4 class="font-semibold mb-3 text-green-800">Monthly Fair Play Awards</h4>
                                    <p class="mb-4">The league recognizes and rewards teams and players who exemplify the spirit of fair play with monthly awards:</p>
                                    <ul class="space-y-3">
                                        <li class="flex items-start">
                                            <div class="w-5 h-5 flex items-center justify-center text-green-600 mt-1 mr-2">
                                                <i class="ri-award-line"></i>
                                            </div>
                                            <span><strong>Team Fair Play Award:</strong> +3 bonus points in league standings</span>
                                        </li>
                                        <li class="flex items-start">
                                            <div class="w-5 h-5 flex items-center justify-center text-green-600 mt-1 mr-2">
                                                <i class="ri-award-line"></i>
                                            </div>
                                            <span><strong>Player Fair Play Award:</strong> Special profile badge and immunity from next yellow card</span>
                                        </li>
                                        <li class="flex items-start">
                                            <div class="w-5 h-5 flex items-center justify-center text-green-600 mt-1 mr-2">
                                                <i class="ri-award-line"></i>
                                            </div>
                                            <span><strong>Community Spirit Award:</strong> Featured spotlight on league homepage</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Technical Help -->
            <section id="technical-help" class="mb-12 scroll-mt-24">
                <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                    <div class="p-6 border-b">
                        <div class="flex items-center">
                            <div class="w-10 h-10 flex items-center justify-center bg-blue-100 text-primary rounded-full mr-4">
                                <i class="ri-question-line ri-lg"></i>
                            </div>
                            <h2 class="text-2xl font-bold">Technical Help</h2>
                        </div>
                    </div>

                    <div class="p-6">
                        <div class="prose max-w-none">
                            <p class="mb-6">Need help navigating the Meme Football League platform? Here's everything you need to know about using our website, managing your account, and troubleshooting common issues.</p>

                            <div class="mb-8">
                                <h3 class="text-xl font-semibold mb-4">Website Navigation Guide</h3>
                                <div class="grid md:grid-cols-2 gap-6">
                                    <div class="bg-gray-50 p-5 rounded-lg">
                                        <h4 class="font-semibold mb-3">Main Sections</h4>
                                        <ul class="space-y-3">
                                            <li class="flex items-start">
                                                <div class="w-5 h-5 flex items-center justify-center text-primary mt-1 mr-2">
                                                    <i class="ri-home-line"></i>
                                                </div>
                                                <div>
                                                    <span class="font-medium">Home</span>
                                                    <p class="text-sm text-gray-600 mt-1">Latest news, featured matches, and announcements</p>
                                                </div>
                                            </li>
                                            <li class="flex items-start">
                                                <div class="w-5 h-5 flex items-center justify-center text-primary mt-1 mr-2">
                                                    <i class="ri-trophy-line"></i>
                                                </div>
                                                <div>
                                                    <span class="font-medium">Leagues</span>
                                                    <p class="text-sm text-gray-600 mt-1">Browse all leagues, standings, and fixtures</p>
                                                </div>
                                            </li>
                                            <li class="flex items-start">
                                                <div class="w-5 h-5 flex items-center justify-center text-primary mt-1 mr-2">
                                                    <i class="ri-team-line"></i>
                                                </div>
                                                <div>
                                                    <span class="font-medium">Teams</span>
                                                    <p class="text-sm text-gray-600 mt-1">Team profiles, rosters, and statistics</p>
                                                </div>
                                            </li>
                                            <li class="flex items-start">
                                                <div class="w-5 h-5 flex items-center justify-center text-primary mt-1 mr-2">
                                                    <i class="ri-user-line"></i>
                                                </div>
                                                <div>
                                                    <span class="font-medium">Players</span>
                                                    <p class="text-sm text-gray-600 mt-1">Player profiles, stats, and history</p>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="bg-blue-50 p-5 rounded-lg">
                                        <h4 class="font-semibold mb-3 text-blue-800">Team Manager Features</h4>
                                        <ul class="space-y-3">
                                            <li class="flex items-start">
                                                <div class="w-5 h-5 flex items-center justify-center text-blue-600 mt-1 mr-2">
                                                    <i class="ri-settings-line"></i>
                                                </div>
                                                <div>
                                                    <span class="font-medium">Team Dashboard</span>
                                                    <p class="text-sm text-gray-600 mt-1">Manage your team, view upcoming matches</p>
                                                </div>
                                            </li>
                                            <li class="flex items-start">
                                                <div class="w-5 h-5 flex items-center justify-center text-blue-600 mt-1 mr-2">
                                                    <i class="ri-user-add-line"></i>
                                                </div>
                                                <div>
                                                    <span class="font-medium">Squad Management</span>
                                                    <p class="text-sm text-gray-600 mt-1">Add/remove players, set formations</p>
                                                </div>
                                            </li>
                                            <li class="flex items-start">
                                                <div class="w-5 h-5 flex items-center justify-center text-blue-600 mt-1 mr-2">
                                                    <i class="ri-upload-line"></i>
                                                </div>
                                                <div>
                                                    <span class="font-medium">Meme Submission</span>
                                                    <p class="text-sm text-gray-600 mt-1">Upload and manage your team's memes</p>
                                                </div>
                                            </li>
                                            <li class="flex items-start">
                                                <div class="w-5 h-5 flex items-center justify-center text-blue-600 mt-1 mr-2">
                                                    <i class="ri-message-2-line"></i>
                                                </div>
                                                <div>
                                                    <span class="font-medium">Team Chat</span>
                                                    <p class="text-sm text-gray-600 mt-1">Communicate with your team members</p>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-8">
                                <h3 class="text-xl font-semibold mb-4">Account Management</h3>
                                <div class="bg-gray-50 p-5 rounded-lg mb-6">
                                    <div class="grid md:grid-cols-2 gap-6">
                                        <div>
                                            <h4 class="font-semibold mb-3">Registration &amp; Login</h4>
                                            <ul class="space-y-2">
                                                <li class="flex items-start">
                                                    <div class="w-5 h-5 flex items-center justify-center text-primary mt-1 mr-2">
                                                        <i class="ri-user-add-line"></i>
                                                    </div>
                                                    <span>Click "Sign Up" in the top right corner</span>
                                                </li>
                                                <li class="flex items-start">
                                                    <div class="w-5 h-5 flex items-center justify-center text-primary mt-1 mr-2">
                                                        <i class="ri-mail-line"></i>
                                                    </div>
                                                    <span>Verify your email address</span>
                                                </li>
                                                <li class="flex items-start">
                                                    <div class="w-5 h-5 flex items-center justify-center text-primary mt-1 mr-2">
                                                        <i class="ri-profile-line"></i>
                                                    </div>
                                                    <span>Complete your profile information</span>
                                                </li>
                                            </ul>
                                        </div>
                                        <div>
                                            <h4 class="font-semibold mb-3">Profile Settings</h4>
                                            <ul class="space-y-2">
                                                <li class="flex items-start">
                                                    <div class="w-5 h-5 flex items-center justify-center text-primary mt-1 mr-2">
                                                        <i class="ri-edit-line"></i>
                                                    </div>
                                                    <span>Update personal information</span>
                                                </li>
                                                <li class="flex items-start">
                                                    <div class="w-5 h-5 flex items-center justify-center text-primary mt-1 mr-2">
                                                        <i class="ri-lock-line"></i>
                                                    </div>
                                                    <span>Change password and security settings</span>
                                                </li>
                                                <li class="flex items-start">
                                                    <div class="w-5 h-5 flex items-center justify-center text-primary mt-1 mr-2">
                                                        <i class="ri-notification-line"></i>
                                                    </div>
                                                    <span>Manage notification preferences</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="bg-blue-50 p-5 rounded-lg">
                                    <h4 class="font-semibold mb-3 text-blue-800">Password Recovery</h4>
                                    <ol class="space-y-2 list-decimal pl-5">
                                        <li>Click "Forgot Password" on the login screen</li>
                                        <li>Enter the email address associated with your account</li>
                                        <li>Check your email for a password reset link</li>
                                        <li>Click the link and follow instructions to create a new password</li>
                                        <li>Use your new password to log in</li>
                                    </ol>
                                    <div class="mt-4 p-4 bg-white rounded border border-blue-200">
                                        <p class="text-sm text-blue-800">Note: Password reset links expire after 24 hours. If you don't receive an email within 10 minutes, check your spam folder or contact support.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-8">
                                <h3 class="text-xl font-semibold mb-4">Troubleshooting Common Issues</h3>
                                <div class="space-y-4">
                                    <div class="border border-gray-200 rounded-lg overflow-hidden">
                                        <button class="accordion-header w-full flex items-center justify-between p-4 bg-gray-50 text-left">
                                            <span class="font-medium">Unable to Log In</span>
                                            <div class="w-5 h-5 flex items-center justify-center">
                                                <i class="ri-arrow-up-s-line"></i>
                                            </div>
                                        </button>
                                        <div class="accordion-content p-4 border-t border-gray-200 active">
                                            <ul class="space-y-2">
                                                <li class="flex items-start">
                                                    <div class="w-5 h-5 flex items-center justify-center text-primary mt-1 mr-2">
                                                        <i class="ri-check-line"></i>
                                                    </div>
                                                    <span>Verify you're using the correct email and password</span>
                                                </li>
                                                <li class="flex items-start">
                                                    <div class="w-5 h-5 flex items-center justify-center text-primary mt-1 mr-2">
                                                        <i class="ri-check-line"></i>
                                                    </div>
                                                    <span>Check if Caps Lock is enabled</span>
                                                </li>
                                                <li class="flex items-start">
                                                    <div class="w-5 h-5 flex items-center justify-center text-primary mt-1 mr-2">
                                                        <i class="ri-check-line"></i>
                                                    </div>
                                                    <span>Clear browser cookies and cache</span>
                                                </li>
                                                <li class="flex items-start">
                                                    <div class="w-5 h-5 flex items-center justify-center text-primary mt-1 mr-2">
                                                        <i class="ri-check-line"></i>
                                                    </div>
                                                    <span>Try using a different browser</span>
                                                </li>
                                                <li class="flex items-start">
                                                    <div class="w-5 h-5 flex items-center justify-center text-primary mt-1 mr-2">
                                                        <i class="ri-check-line"></i>
                                                    </div>
                                                    <span>Use the "Forgot Password" option to reset your password</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="border border-gray-200 rounded-lg overflow-hidden">
                                        <button class="accordion-header w-full flex items-center justify-between p-4 bg-gray-50 text-left">
                                            <span class="font-medium">Meme Upload Issues</span>
                                            <div class="w-5 h-5 flex items-center justify-center">
                                                <i class="ri-arrow-down-s-line"></i>
                                            </div>
                                        </button>
                                        <div class="accordion-content p-4 border-t border-gray-200">
                                            <ul class="space-y-2">
                                                <li class="flex items-start">
                                                    <div class="w-5 h-5 flex items-center justify-center text-primary mt-1 mr-2">
                                                        <i class="ri-check-line"></i>
                                                    </div>
                                                    <span>Ensure your meme is in an accepted format (JPG, PNG, GIF)</span>
                                                </li>
                                                <li class="flex items-start">
                                                    <div class="w-5 h-5 flex items-center justify-center text-primary mt-1 mr-2">
                                                        <i class="ri-check-line"></i>
                                                    </div>
                                                    <span>Check that the file size is under 5MB</span>
                                                </li>
                                                <li class="flex items-start">
                                                    <div class="w-5 h-5 flex items-center justify-center text-primary mt-1 mr-2">
                                                        <i class="ri-check-line"></i>
                                                    </div>
                                                    <span>Verify you're submitting before the deadline</span>
                                                </li>
                                                <li class="flex items-start">
                                                    <div class="w-5 h-5 flex items-center justify-center text-primary mt-1 mr-2">
                                                        <i class="ri-check-line"></i>
                                                    </div>
                                                    <span>Try a different browser if problems persist</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="border border-gray-200 rounded-lg overflow-hidden">
                                        <button class="accordion-header w-full flex items-center justify-between p-4 bg-gray-50 text-left">
                                            <span class="font-medium">Payment or Subscription Problems</span>
                                            <div class="w-5 h-5 flex items-center justify-center">
                                                <i class="ri-arrow-down-s-line"></i>
                                            </div>
                                        </button>
                                        <div class="accordion-content p-4 border-t border-gray-200">
                                            <ul class="space-y-2">
                                                <li class="flex items-start">
                                                    <div class="w-5 h-5 flex items-center justify-center text-primary mt-1 mr-2">
                                                        <i class="ri-check-line"></i>
                                                    </div>
                                                    <span>Verify your payment method is valid and not expired</span>
                                                </li>
                                                <li class="flex items-start">
                                                    <div class="w-5 h-5 flex items-center justify-center text-primary mt-1 mr-2">
                                                        <i class="ri-check-line"></i>
                                                    </div>
                                                    <span>Check your billing address matches your card information</span>
                                                </li>
                                                <li class="flex items-start">
                                                    <div class="w-5 h-5 flex items-center justify-center text-primary mt-1 mr-2">
                                                        <i class="ri-check-line"></i>
                                                    </div>
                                                    <span>Look for any declined transaction emails</span>
                                                </li>
                                                <li class="flex items-start">
                                                    <div class="w-5 h-5 flex items-center justify-center text-primary mt-1 mr-2">
                                                        <i class="ri-check-line"></i>
                                                    </div>
                                                    <span>Contact your bank to ensure they're not blocking the transaction</span>
                                                </li>
                                                <li class="flex items-start">
                                                    <div class="w-5 h-5 flex items-center justify-center text-primary mt-1 mr-2">
                                                        <i class="ri-check-line"></i>
                                                    </div>
                                                    <span>Try an alternative payment method</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <h3 class="text-xl font-semibold mb-4">Contact Support</h3>
                                <div class="bg-gray-50 p-5 rounded-lg">
                                    <div class="grid md:grid-cols-3 gap-6">
                                        <div class="text-center">
                                            <div class="w-12 h-12 mx-auto flex items-center justify-center bg-blue-100 text-primary rounded-full mb-3">
                                                <i class="ri-mail-line ri-lg"></i>
                                            </div>
                                            <h4 class="font-semibold mb-2">Email Support</h4>
                                            <p class="text-sm text-gray-600 mb-2">Response within 24 hours</p>
                                            <a href="mailto:support@memefootballleague.com" class="text-primary hover:text-blue-700 transition-colors">support@memefootballleague.com</a>
                                        </div>
                                        <div class="text-center">
                                            <div class="w-12 h-12 mx-auto flex items-center justify-center bg-blue-100 text-primary rounded-full mb-3">
                                                <i class="ri-customer-service-2-line ri-lg"></i>
                                            </div>
                                            <h4 class="font-semibold mb-2">Live Chat</h4>
                                            <p class="text-sm text-gray-600 mb-2">Available 9am-5pm GMT</p>
                                            <button class="text-primary hover:text-blue-700 transition-colors">Start Chat</button>
                                        </div>
                                        <div class="text-center">
                                            <div class="w-12 h-12 mx-auto flex items-center justify-center bg-blue-100 text-primary rounded-full mb-3">
                                                <i class="ri-question-answer-line ri-lg"></i>
                                            </div>
                                            <h4 class="font-semibold mb-2">Community Forum</h4>
                                            <p class="text-sm text-gray-600 mb-2">Get help from other users</p>
                                            <a href="#" class="text-primary hover:text-blue-700 transition-colors">Visit Forum</a>
                                        </div>
                                    </div>
                                    <div class="mt-6 pt-6 border-t text-center">
                                        <p class="text-gray-600 mb-4">For urgent issues or technical emergencies:</p>
                                        <button class="bg-primary text-white px-6 py-2 !rounded-button hover:bg-blue-600 transition-colors whitespace-nowrap">
                                            Submit Priority Support Ticket
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- FAQs -->
            <section id="faqs" class="mb-12 scroll-mt-24">
                <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                    <div class="p-6 border-b">
                        <div class="flex items-center">
                            <div class="w-10 h-10 flex items-center justify-center bg-blue-100 text-primary rounded-full mr-4">
                                <i class="ri-questionnaire-line ri-lg"></i>
                            </div>
                            <h2 class="text-2xl font-bold">Frequently Asked Questions</h2>
                        </div>
                    </div>

                    <div class="p-6">
                        <div class="prose max-w-none">
                            <p class="mb-6">Find quick answers to the most common questions about the Meme Football League. If you can't find what you're looking for, please contact our support team.</p>

                            <div class="space-y-4">
                                <div class="border border-gray-200 rounded-lg overflow-hidden">
                                    <button class="accordion-header w-full flex items-center justify-between p-4 bg-gray-50 text-left">
                                        <span class="font-medium">How do I join the Meme Football League?</span>
                                        <div class="w-5 h-5 flex items-center justify-center">
                                            <i class="ri-arrow-down-s-line"></i>
                                        </div>
                                    </button>
                                    <div class="accordion-content p-4 border-t border-gray-200">
                                        <p class="mb-3">Joining the Meme Football League is easy! Follow these steps:</p>
                                        <ol class="space-y-2 list-decimal pl-5">
                                            <li>Create an account on our website</li>
                                            <li>Verify your email address</li>
                                            <li>Complete your profile information</li>
                                            <li>Either create a new team or request to join an existing team</li>
                                            <li>If creating a new team, you'll need to register for the upcoming season</li>
                                            <li>New teams typically start in the lowest division unless spots are available in higher divisions</li>
                                        </ol>
                                    </div>
                                </div>

                                <div class="border border-gray-200 rounded-lg overflow-hidden">
                                    <button class="accordion-header w-full flex items-center justify-between p-4 bg-gray-50 text-left">
                                        <span class="font-medium">What types of memes are allowed?</span>
                                        <div class="w-5 h-5 flex items-center justify-center">
                                            <i class="ri-arrow-down-s-line"></i>
                                        </div>
                                    </button>
                                    <div class="accordion-content p-4 border-t border-gray-200">
                                        <p class="mb-3">We welcome a wide variety of memes, but there are some important guidelines:</p>
                                        <ul class="space-y-2">
                                            <li class="flex items-start">
                                                <div class="w-5 h-5 flex items-center justify-center text-green-500 mt-1 mr-2">
                                                    <i class="ri-check-line"></i>
                                                </div>
                                                <span>Original content is highly encouraged</span>
                                            </li>
                                            <li class="flex items-start">
                                                <div class="w-5 h-5 flex items-center justify-center text-green-500 mt-1 mr-2">
                                                    <i class="ri-check-line"></i>
                                                </div>
                                                <span>Football/soccer-related memes are preferred but not required</span>
                                            </li>
                                            <li class="flex items-start">
                                                <div class="w-5 h-5 flex items-center justify-center text-green-500 mt-1 mr-2">
                                                    <i class="ri-check-line"></i>
                                                </div>
                                                <span>Humor, creativity, and relevance are key factors in scoring</span>
                                            </li>
                                            <li class="flex items-start">
                                                <div class="w-5 h-5 flex items-center justify-center text-red-500 mt-1 mr-2">
                                                    <i class="ri-close-line"></i>
                                                </div>
                                                <span>No offensive, discriminatory, or inappropriate content</span>
                                            </li>
                                            <li class="flex items-start">
                                                <div class="w-5 h-5 flex items-center justify-center text-red-500 mt-1 mr-2">
                                                    <i class="ri-close-line"></i>
                                                </div>
                                                <span>No copyright infringement or unauthorized use of protected content</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="border border-gray-200 rounded-lg overflow-hidden">
                                    <button class="accordion-header w-full flex items-center justify-between p-4 bg-gray-50 text-left">
                                        <span class="font-medium">How is meme quality scored?</span>
                                        <div class="w-5 h-5 flex items-center justify-center">
                                            <i class="ri-arrow-down-s-line"></i>
                                        </div>
                                    </button>
                                    <div class="accordion-content p-4 border-t border-gray-200">
                                        <p class="mb-3">Meme scoring is based on a combination of community voting and algorithmic analysis:</p>
                                        <div class="bg-gray-50 p-4 rounded-lg mb-3">
                                            <h4 class="font-semibold mb-2">Scoring Criteria</h4>
                                            <ul class="space-y-2">
                                                <li class="flex items-start">
                                                    <div class="w-5 h-5 flex items-center justify-center text-primary mt-1 mr-2">
                                                        <i class="ri-star-line"></i>
                                                    </div>
                                                    <div>
                                                        <span class="font-medium">Humor (40%)</span>
                                                        <p class="text-sm text-gray-600 mt-1">How funny and entertaining the meme is</p>
                                                    </div>
                                                </li>
                                                <li class="flex items-start">
                                                    <div class="w-5 h-5 flex items-center justify-center text-primary mt-1 mr-2">
                                                        <i class="ri-star-line"></i>
                                                    </div>
                                                    <div>
                                                        <span class="font-medium">Creativity (30%)</span>
                                                        <p class="text-sm text-gray-600 mt-1">Originality and innovative approach</p>
                                                    </div>
                                                </li>
                                                <li class="flex items-start">
                                                    <div class="w-5 h-5 flex items-center justify-center text-primary mt-1 mr-2">
                                                        <i class="ri-star-line"></i>
                                                    </div>
                                                    <div>
                                                        <span class="font-medium">Relevance (20%)</span>
                                                        <p class="text-sm text-gray-600 mt-1">Connection to football/soccer or current events</p>
                                                    </div>
                                                </li>
                                                <li class="flex items-start">
                                                    <div class="w-5 h-5 flex items-center justify-center text-primary mt-1 mr-2">
                                                        <i class="ri-star-line"></i>
                                                    </div>
                                                    <div>
                                                        <span class="font-medium">Quality (10%)</span>
                                                        <p class="text-sm text-gray-600 mt-1">Technical aspects like image clarity and presentation</p>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <p>Community members vote on memes during matches, and our algorithm calculates final scores based on the criteria above. The team with the highest total meme score wins the match.</p>
                                    </div>
                                </div>

                                <div class="border border-gray-200 rounded-lg overflow-hidden">
                                    <button class="accordion-header w-full flex items-center justify-between p-4 bg-gray-50 text-left">
                                        <span class="font-medium">Is there a fee to participate?</span>
                                        <div class="w-5 h-5 flex items-center justify-center">
                                            <i class="ri-arrow-down-s-line"></i>
                                        </div>
                                    </button>
                                    <div class="accordion-content p-4 border-t border-gray-200">
                                        <p class="mb-3">The Meme Football League offers both free and premium participation options:</p>
                                        <div class="grid md:grid-cols-2 gap-4">
                                            <div class="bg-gray-50 p-4 rounded-lg">
                                                <h4 class="font-semibold mb-2">Free Tier</h4>
                                                <ul class="space-y-2">
                                                    <li class="flex items-start">
                                                        <div class="w-5 h-5 flex items-center justify-center text-green-500 mt-1 mr-2">
                                                            <i class="ri-check-line"></i>
                                                        </div>
                                                        <span>Basic participation in lower divisions</span>
                                                    </li>
                                                    <li class="flex items-start">
                                                        <div class="w-5 h-5 flex items-center justify-center text-green-500 mt-1 mr-2">
                                                            <i class="ri-check-line"></i>
                                                        </div>
                                                        <span>Limited meme submissions per match</span>
                                                    </li>
                                                    <li class="flex items-start">
                                                        <div class="w-5 h-5 flex items-center justify-center text-green-500 mt-1 mr-2">
                                                            <i class="ri-check-line"></i>
                                                        </div>
                                                        <span>Basic team management features</span>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="bg-blue-50 p-4 rounded-lg">
                                                <h4 class="font-semibold mb-2 text-blue-800">Premium Tier ($9.99/month)</h4>
                                                <ul class="space-y-2">
                                                    <li class="flex items-start">
                                                        <div class="w-5 h-5 flex items-center justify-center text-blue-600 mt-1 mr-2">
                                                            <i class="ri-check-line"></i>
                                                        </div>
                                                        <span>Participation in all divisions</span>
                                                    </li>
                                                    <li class="flex items-start">
                                                        <div class="w-5 h-5 flex items-center justify-center text-blue-600 mt-1 mr-2">
                                                            <i class="ri-check-line"></i>
                                                        </div>
                                                        <span>Unlimited meme submissions</span>
                                                    </li>
                                                    <li class="flex items-start">
                                                        <div class="w-5 h-5 flex items-center justify-center text-blue-600 mt-1 mr-2">
                                                            <i class="ri-check-line"></i>
                                                        </div>
                                                        <span>Advanced team management tools</span>
                                                    </li>
                                                    <li class="flex items-start">
                                                        <div class="w-5 h-5 flex items-center justify-center text-blue-600 mt-1 mr-2">
                                                            <i class="ri-check-line"></i>
                                                        </div>
                                                        <span>Exclusive tournaments and prizes</span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="border border-gray-200 rounded-lg overflow-hidden">
                                    <button class="accordion-header w-full flex items-center justify-between p-4 bg-gray-50 text-left">
                                        <span class="font-medium">How often are matches played?</span>
                                        <div class="w-5 h-5 flex items-center justify-center">
                                            <i class="ri-arrow-down-s-line"></i>
                                        </div>
                                    </button>
                                    <div class="accordion-content p-4 border-t border-gray-200">
                                        <p class="mb-3">Match frequency depends on the division and season schedule:</p>
                                        <ul class="space-y-2">
                                            <li class="flex items-start">
                                                <div class="w-5 h-5 flex items-center justify-center text-primary mt-1 mr-2">
                                                    <i class="ri-calendar-line"></i>
                                                </div>
                                                <span>Regular season matches are typically played once per week</span>
                                            </li>
                                            <li class="flex items-start">
                                                <div class="w-5 h-5 flex items-center justify-center text-primary mt-1 mr-2">
                                                    <i class="ri-calendar-line"></i>
                                                </div>
                                                <span>Cup competitions may require additional midweek matches</span>
                                            </li>
                                            <li class="flex items-start">
                                                <div class="w-5 h-5 flex items-center justify-center text-primary mt-1 mr-2">
                                                    <i class="ri-calendar-line"></i>
                                                </div>
                                                <span>Playoff matches are scheduled at the end of the regular season</span>
                                            </li>
                                            <li class="flex items-start">
                                                <div class="w-5 h-5 flex items-center justify-center text-primary mt-1 mr-2">
                                                    <i class="ri-calendar-line"></i>
                                                </div>
                                                <span>Special tournaments may be held during off-season periods</span>
                                            </li>
                                        </ul>
                                        <p class="mt-3">The full season schedule is published before the season begins, allowing teams to plan their participation accordingly.</p>
                                    </div>
                                </div>

                                <div class="border border-gray-200 rounded-lg overflow-hidden">
                                    <button class="accordion-header w-full flex items-center justify-between p-4 bg-gray-50 text-left">
                                        <span class="font-medium">Can I transfer to a different team?</span>
                                        <div class="w-5 h-5 flex items-center justify-center">
                                            <i class="ri-arrow-down-s-line"></i>
                                        </div>
                                    </button>
                                    <div class="accordion-content p-4 border-t border-gray-200">
                                        <p class="mb-3">Yes, player transfers are allowed during designated transfer windows:</p>
                                        <div class="bg-gray-50 p-4 rounded-lg mb-3">
                                            <h4 class="font-semibold mb-2">Transfer Windows</h4>
                                            <ul class="space-y-2">
                                                <li class="flex items-start">
                                                    <div class="w-5 h-5 flex items-center justify-center text-primary mt-1 mr-2">
                                                        <i class="ri-swap-line"></i>
                                                    </div>
                                                    <span>Mid-season transfer window (2 weeks in the middle of the season)</span>
                                                </li>
                                                <li class="flex items-start">
                                                    <div class="w-5 h-5 flex items-center justify-center text-primary mt-1 mr-2">
                                                        <i class="ri-swap-line"></i>
                                                    </div>
                                                    <span>Off-season transfer window (4 weeks before the new season)</span>
                                                </li>
                                            </ul>
                                        </div>
                                        <p>To transfer, you need to:</p>
                                        <ol class="space-y-2 list-decimal pl-5">
                                            <li>Request a transfer through your profile settings</li>
                                            <li>Receive approval from your current team manager</li>
                                            <li>Receive an invitation from the new team</li>
                                            <li>Accept the transfer offer before the transfer window closes</li>
                                        </ol>
                                        <p class="mt-3">Note: Players can only transfer once per season, and teams have limits on how many transfers they can make.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-8 bg-blue-50 p-5 rounded-lg">
                                <h3 class="text-xl font-semibold mb-4 text-blue-800">Still Have Questions?</h3>
                                <p class="mb-4">If you couldn't find the answer to your question, please don't hesitate to reach out to our support team or check our comprehensive documentation.</p>
                                <div class="flex flex-col sm:flex-row gap-4">
                                    <a href="#technical-help" class="bg-white text-primary border border-primary px-6 py-3 !rounded-button hover:bg-blue-50 transition-colors whitespace-nowrap flex items-center justify-center">
                                        <div class="w-5 h-5 flex items-center justify-center mr-2">
                                            <i class="ri-question-line"></i>
                                        </div>
                                        <span>Contact Support</span>
                                    </a>
                                    <button class="bg-primary text-white px-6 py-3 !rounded-button hover:bg-blue-600 transition-colors whitespace-nowrap flex items-center justify-center">
                                        <div class="w-5 h-5 flex items-center justify-center mr-2">
                                            <i class="ri-book-open-line"></i>
                                        </div>
                                        <span>View Full Documentation</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Feedback Section -->
            <section class="mb-12">
                <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                    <div class="p-6 border-b">
                        <div class="flex items-center">
                            <div class="w-10 h-10 flex items-center justify-center bg-blue-100 text-primary rounded-full mr-4">
                                <i class="ri-feedback-line ri-lg"></i>
                            </div>
                            <h2 class="text-2xl font-bold">Help Us Improve</h2>
                        </div>
                    </div>

                    <div class="p-6">
                        <div class="prose max-w-none">
                            <p class="mb-6">We're constantly working to improve our rules and help documentation. Your feedback is invaluable in making the Meme Football League better for everyone.</p>

                            <div class="bg-gray-50 p-6 rounded-lg">
                                <h3 class="text-xl font-semibold mb-4">Was this information helpful?</h3>
                                <div class="flex flex-col sm:flex-row items-center gap-4 mb-6">
                                    <button class="bg-green-500 text-white px-6 py-3 !rounded-button hover:bg-green-600 transition-colors whitespace-nowrap flex items-center justify-center">
                                        <div class="w-5 h-5 flex items-center justify-center mr-2">
                                            <i class="ri-thumb-up-line"></i>
                                        </div>
                                        <span>Yes, it was helpful</span>
                                    </button>
                                    <button class="bg-white text-gray-700 border border-gray-300 px-6 py-3 !rounded-button hover:bg-gray-100 transition-colors whitespace-nowrap flex items-center justify-center">
                                        <div class="w-5 h-5 flex items-center justify-center mr-2">
                                            <i class="ri-thumb-down-line"></i>
                                        </div>
                                        <span>No, I need more help</span>
                                    </button>
                                </div>

                                <div class="mb-6">
                                    <label for="feedback" class="block text-gray-700 font-medium mb-2">Share your feedback or suggestions</label>
                                    <textarea id="feedback" rows="4" class="w-full px-4 py-3 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition" placeholder="What could we improve or explain better?"></textarea>
                                </div>

                                <div class="flex items-center mb-6">
                                    <input type="checkbox" id="contact-me" class="mr-3">
                                    <label for="contact-me" class="text-gray-700">I'd like to be contacted about my feedback</label>
                                </div>

                                <div id="contact-form" class="hidden mb-6">
                                    <div class="grid md:grid-cols-2 gap-4">
                                        <div>
                                            <label for="name" class="block text-gray-700 font-medium mb-2">Name</label>
                                            <input type="text" id="name" class="w-full px-4 py-3 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition" placeholder="Your name">
                                        </div>
                                        <div>
                                            <label for="email" class="block text-gray-700 font-medium mb-2">Email</label>
                                            <input type="email" id="email" class="w-full px-4 py-3 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition" placeholder="Your email address">
                                        </div>
                                    </div>
                                </div>

                                <button class="bg-primary text-white px-6 py-3 !rounded-button hover:bg-blue-600 transition-colors whitespace-nowrap">Submit Feedback</button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</main>




@include('site.v1.modules.footer.footer')

<script id="countdown-timer">
    document.addEventListener('DOMContentLoaded', function() {
        // This is just a simulation of countdown timers
        // In a real application, you would calculate the actual time difference
        const countdowns = document.querySelectorAll('.countdown-timer span');

        // Update the countdown every second
        setInterval(function() {
            countdowns.forEach(countdown => {
                // Parse the current countdown value
                const parts = countdown.textContent.split(' ');
                let days = parseInt(parts[0]);
                let hours = parseInt(parts[1]);
                let minutes = parseInt(parts[2]);

                // Decrease the minutes
                minutes--;

                // Handle time rollover
                if (minutes < 0) {
                    minutes = 59;
                    hours--;

                    if (hours < 0) {
                        hours = 23;
                        days--;

                        if (days < 0) {
                            // Reset to some value when countdown reaches zero
                            days = 0;
                            hours = 0;
                            minutes = 0;
                        }
                    }
                }

                // Update the display
                countdown.textContent = `${days}d ${hours}h ${minutes}m`;
            });
        }, 60000); // Update every minute
    });
</script>

<script id="mobile-menu">
    document.addEventListener('DOMContentLoaded', function() {
        const menuButton = document.querySelector('button[type="button"]');
        const mobileMenu = document.createElement('div');
        mobileMenu.className = 'sm:hidden bg-white absolute top-16 left-0 right-0 z-50 shadow-lg transform transition-transform duration-300 -translate-y-full';
        mobileMenu.innerHTML = `
                <div class="px-2 pt-2 pb-3 space-y-1">
                    <a href="#" class="bg-primary text-white block px-3 py-2 rounded-md text-base font-medium">Home</a>
                    <a href="#" class="text-gray-700 hover:bg-gray-100 block px-3 py-2 rounded-md text-base font-medium">Club Rankings</a>
                    <a href="#" class="text-gray-700 hover:bg-gray-100 block px-3 py-2 rounded-md text-base font-medium">Tournaments</a>
                    <a href="#" class="text-gray-700 hover:bg-gray-100 block px-3 py-2 rounded-md text-base font-medium">Teams</a>
                    <a href="#" class="text-gray-700 hover:bg-gray-100 block px-3 py-2 rounded-md text-base font-medium">Upcoming Matches</a>
                    <a href="#" class="text-gray-700 hover:bg-gray-100 block px-3 py-2 rounded-md text-base font-medium">Help & Rules</a>
                    <a href="#" class="text-gray-700 hover:bg-gray-100 block px-3 py-2 rounded-md text-base font-medium">Blog</a>
                    <a href="#" class="bg-primary hover:bg-opacity-80 text-white block px-3 py-2 rounded-md text-base font-medium text-center mt-4">Login / Register</a>
                </div>
            `;

        document.body.appendChild(mobileMenu);

        let isMenuOpen = false;

        menuButton.addEventListener('click', function() {
            isMenuOpen = !isMenuOpen;
            if (isMenuOpen) {
                mobileMenu.classList.remove('-translate-y-full');
                menuButton.querySelector('i').classList.remove('ri-menu-line');
                menuButton.querySelector('i').classList.add('ri-close-line');
            } else {
                mobileMenu.classList.add('-translate-y-full');
                menuButton.querySelector('i').classList.remove('ri-close-line');
                menuButton.querySelector('i').classList.add('ri-menu-line');
            }
        });
    });
</script>
</body>
</html><script>
    (function() {
        var ws = new WebSocket('ws://' + window.location.host +
            '/jb-server-page?reloadMode=RELOAD_ON_SAVE&'+
            'referrer=' + encodeURIComponent(window.location.pathname));
        ws.onmessage = function (msg) {
            if (msg.data === 'reload') {
                window.location.reload();
            }
            if (msg.data.startsWith('update-css ')) {
                var messageId = msg.data.substring(11);
                var links = document.getElementsByTagName('link');
                for (var i = 0; i < links.length; i++) {
                    var link = links[i];
                    if (link.rel !== 'stylesheet') continue;
                    var clonedLink = link.cloneNode(true);
                    var newHref = link.href.replace(/(&|\?)jbUpdateLinksId=\d+/, "$1jbUpdateLinksId=" + messageId);
                    if (newHref !== link.href) {
                        clonedLink.href = newHref;
                    }
                    else {
                        var indexOfQuest = newHref.indexOf('?');
                        if (indexOfQuest >= 0) {
                            // to support ?foo#hash
                            clonedLink.href = newHref.substring(0, indexOfQuest + 1) + 'jbUpdateLinksId=' + messageId + '&' +
                                newHref.substring(indexOfQuest + 1);
                        }
                        else {
                            clonedLink.href += '?' + 'jbUpdateLinksId=' + messageId;
                        }
                    }
                    link.replaceWith(clonedLink);
                }
            }
        };
    })();
</script>

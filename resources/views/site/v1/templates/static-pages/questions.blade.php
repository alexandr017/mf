
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

            <!-- Points & Ranking System -->


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

                            @foreach($questions as $question)
                                @include('site.v1.modules.accordion.accordion')
                            @endforeach


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
                            <h2 class="text-2xl font-bold">Помогите нам стать лучше</h2>
                        </div>
                    </div>

                    <div class="p-6">
                        <div class="prose max-w-none">
                            <p class="mb-6">Мы постоянно работаем над улучшением наших правил и справочной документации. Ваши отзывы бесценны, ведь они помогают сделать проект лучше для всех.</p>

                            <div class="bg-gray-50 p-6 rounded-lg">
                                <div class="mb-6">
                                    <label for="feedback" class="block text-gray-700 font-medium mb-2">Поделитесь своими отзывами, предложениями или задай вопрос</label>
                                    <textarea id="feedback" rows="4" class="w-full px-4 py-3 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition" placeholder="What could we improve or explain better?"></textarea>
                                </div>

                                <div class="flex items-center mb-6">
                                    <input type="checkbox" id="contact-me" class="mr-3">
                                    <label for="contact-me" class="text-gray-700">Я хотел бы, чтобы со мной связались по поводу моего отзыва.</label>
                                </div>

                                <div id="contact-form" class="hidden mb-6">
                                    <div class="grid md:grid-cols-2 gap-4">
                                        <div>
                                            <label for="name" class="block text-gray-700 font-medium mb-2">Имя</label>
                                            <input type="text" id="name" class="w-full px-4 py-3 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition" placeholder="Ваше имя">
                                        </div>
                                        <div>
                                            <label for="email" class="block text-gray-700 font-medium mb-2">Email</label>
                                            <input type="email" id="email" class="w-full px-4 py-3 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition" placeholder="Ваш email">
                                        </div>
                                    </div>
                                </div>

                                <button class="bg-primary text-white px-6 py-3 !rounded-button hover:bg-blue-600 transition-colors whitespace-nowrap">Отправить</button>
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

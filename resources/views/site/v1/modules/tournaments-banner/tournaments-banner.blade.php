<!-- Page Header -->
<section class="bg-gray-900 py-16 relative overflow-hidden">
    <div class="absolute inset-0">
        @if(isset($image))
            <img src="{{ $image }}" alt="Tournament Background" class="w-full h-full object-cover opacity-30">
        @else
            <img src="/v1/images/tournaments-banner.jpg" alt="Tournament Background" class="w-full h-full object-cover opacity-30">
        @endif
    </div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="heading-font text-5xl md:text-7xl text-white mb-6">Tournament Central</h1>
        <p class="text-xl text-gray-200 mb-8 max-w-3xl mx-auto">From the Golden Toilet Trophy to the Cup of Chaos, discover all the prestigious (and ridiculous) tournaments in the Meme Football League.</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <button class="bg-primary hover:bg-opacity-80 text-gray-900 font-bold px-8 py-4 !rounded-button text-lg whitespace-nowrap cursor-pointer">
                <div class="flex items-center gap-2">
                    <div class="w-6 h-6 flex items-center justify-center">
                        <i class="ri-trophy-line"></i>
                    </div>
                    <span>View All Trophies</span>
                </div>
            </button>
            <button class="bg-white hover:bg-gray-100 text-gray-900 font-bold px-8 py-4 !rounded-button text-lg whitespace-nowrap cursor-pointer">
                <div class="flex items-center gap-2">
                    <div class="w-6 h-6 flex items-center justify-center">
                        <i class="ri-calendar-line"></i>
                    </div>
                    <span>Tournament Schedule</span>
                </div>
            </button>
        </div>
    </div>
</section>

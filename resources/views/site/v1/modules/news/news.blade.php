<div class="bg-white rounded-lg shadow-lg overflow-hidden card-hover transition-all duration-300">
    <div class="h-48 overflow-hidden">
        <img src="{{$post->preview}}" alt="{{$post->h1}}" class="w-full h-full object-cover object-top">
    </div>
    <div class="p-6">
        <div class="flex items-center mb-2">
            <span class="bg-primary bg-opacity-10 text-primary text-xs font-medium px-2.5 py-0.5 rounded">Match Report</span>
            <span class="text-gray-500 text-xs ml-2">June 16, 2025</span>
        </div>
        <h3 class="text-xl font-bold text-gray-900 mb-2">{{$post->h1}}</h3>
        <p class="text-gray-600 mb-4">{{$post->short_content}}</p>
        <a href="/blog/{{ $post->alias }}" class="text-primary hover:text-primary-dark font-medium flex items-center">
            Подробнее
            <div class="w-5 h-5 ml-1 flex items-center justify-center">
                <i class="ri-arrow-right-line"></i>
            </div>
        </a>
    </div>
</div>

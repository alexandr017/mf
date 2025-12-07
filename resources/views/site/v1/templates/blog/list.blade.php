@extends('site.v1.layouts.default')
{{--@section ('title', Shortcode::compile($page->title))--}}
{{--@section ('meta_description', Shortcode::compile($page->meta_description))--}}

@section('content')


<!-- News Section -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-8">
            <h2 class="heading-font text-4xl text-gray-900">latest Последние новости</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

            @foreach($posts as $post)
                @include('site.v1.modules.news.news', compact('post'))
            @endforeach


            <div class="bg-white rounded-lg shadow-lg overflow-hidden card-hover transition-all duration-300">
                <div class="h-48 overflow-hidden">
                    <img src="https://readdy.ai/api/search-image?query=A%20funny%20cartoon%20image%20of%20a%20football%20player%20celebrating%20a%20goal%20in%20a%20muddy%20field%2C%20wearing%20a%20ridiculous%20uniform%20with%20a%20comical%20expression%2C%20in%20a%20comic%20style&width=600&height=400&seq=11&orientation=landscape" alt="News Image" class="w-full h-full object-cover object-top">
                </div>
                <div class="p-6">
                    <div class="flex items-center mb-2">
                        <span class="bg-primary bg-opacity-10 text-primary text-xs font-medium px-2.5 py-0.5 rounded">Match Report</span>
                        <span class="text-gray-500 text-xs ml-2">June 16, 2025</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Snot FC Gets First Win After 12 Losses!</h3>
                    <p class="text-gray-600 mb-4">In a shocking turn of events that has football experts questioning the laws of probability, Snot FC has finally won a match after 12 consecutive losses.</p>
                    <a href="/blog/post-1" class="text-primary hover:text-primary-dark font-medium flex items-center">
                        Читать далее
                        <div class="w-5 h-5 ml-1 flex items-center justify-center">
                            <i class="ri-arrow-right-line"></i>
                        </div>
                    </a>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-lg overflow-hidden card-hover transition-all duration-300">
                <div class="h-48 overflow-hidden">
                    <img src="https://readdy.ai/api/search-image?query=A%20funny%20cartoon%20image%20of%20a%20giant%20mascot%20shaped%20like%20a%20red%20pimple%20standing%20next%20to%20a%20football%20team%2C%20the%20mascot%20is%20oversized%20and%20ridiculous%20looking%2C%20in%20a%20comic%20style&width=600&height=400&seq=12&orientation=landscape" alt="News Image" class="w-full h-full object-cover object-top">
                </div>
                <div class="p-6">
                    <div class="flex items-center mb-2">
                        <span class="bg-secondary bg-opacity-10 text-secondary text-xs font-medium px-2.5 py-0.5 rounded">Team News</span>
                        <span class="text-gray-500 text-xs ml-2">June 14, 2025</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Perm Pimples Unveil New Mascot: A Giant Zit</h3>
                    <p class="text-gray-600 mb-4">Perm Pimples FC have outdone themselves with their new mascot – a 7-foot tall, squeezable zit costume that occasionally "pops" during goal celebrations.</p>
                    <a href="/blog/post-1" class="text-primary hover:text-primary-dark font-medium flex items-center">
                        Читать далее
                        <div class="w-5 h-5 ml-1 flex items-center justify-center">
                            <i class="ri-arrow-right-line"></i>
                        </div>
                    </a>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-lg overflow-hidden card-hover transition-all duration-300">
                <div class="h-48 overflow-hidden">
                    <img src="https://readdy.ai/api/search-image?query=A%20funny%20cartoon%20image%20of%20football%20fans%20dressed%20in%20bizarre%20costumes%20with%20team%20colors%2C%20cheering%20in%20the%20stands%20of%20a%20stadium%2C%20some%20wearing%20cockroach%20antennas%2C%20in%20a%20comic%20style&width=600&height=400&seq=13&orientation=landscape" alt="News Image" class="w-full h-full object-cover object-top">
                </div>
                <div class="p-6">
                    <div class="flex items-center mb-2">
                        <span class="bg-gray-200 text-gray-800 text-xs font-medium px-2.5 py-0.5 rounded">Fan Zone</span>
                        <span class="text-gray-500 text-xs ml-2">June 12, 2025</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Kazan Cockroaches Fans Break Attendance Record</h3>
                    <p class="text-gray-600 mb-4">Over 10,000 fans showed up to watch Kazan Cockroaches, many dressed in full insect costumes despite the 30°C heat. Fifteen were treated for heat exhaustion.</p>
                    <a href="/blog/post-1" class="text-primary hover:text-primary-dark font-medium flex items-center">
                        Читать далее
                        <div class="w-5 h-5 ml-1 flex items-center justify-center">
                            <i class="ri-arrow-right-line"></i>
                        </div>
                    </a>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-lg overflow-hidden card-hover transition-all duration-300">
                <div class="h-48 overflow-hidden">
                    <img src="https://readdy.ai/api/search-image?query=A%20funny%20cartoon%20image%20of%20football%20fans%20dressed%20in%20bizarre%20costumes%20with%20team%20colors%2C%20cheering%20in%20the%20stands%20of%20a%20stadium%2C%20some%20wearing%20cockroach%20antennas%2C%20in%20a%20comic%20style&width=600&height=400&seq=13&orientation=landscape" alt="News Image" class="w-full h-full object-cover object-top">
                </div>
                <div class="p-6">
                    <div class="flex items-center mb-2">
                        <span class="bg-gray-200 text-gray-800 text-xs font-medium px-2.5 py-0.5 rounded">Fan Zone</span>
                        <span class="text-gray-500 text-xs ml-2">June 12, 2025</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Kazan Cockroaches Fans Break Attendance Record</h3>
                    <p class="text-gray-600 mb-4">Over 10,000 fans showed up to watch Kazan Cockroaches, many dressed in full insect costumes despite the 30°C heat. Fifteen were treated for heat exhaustion.</p>
                    <a href="/blog/post-1" class="text-primary hover:text-primary-dark font-medium flex items-center">
                        Читать далее
                        <div class="w-5 h-5 ml-1 flex items-center justify-center">
                            <i class="ri-arrow-right-line"></i>
                        </div>
                    </a>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-lg overflow-hidden card-hover transition-all duration-300">
                <div class="h-48 overflow-hidden">
                    <img src="https://readdy.ai/api/search-image?query=A%20funny%20cartoon%20image%20of%20football%20fans%20dressed%20in%20bizarre%20costumes%20with%20team%20colors%2C%20cheering%20in%20the%20stands%20of%20a%20stadium%2C%20some%20wearing%20cockroach%20antennas%2C%20in%20a%20comic%20style&width=600&height=400&seq=13&orientation=landscape" alt="News Image" class="w-full h-full object-cover object-top">
                </div>
                <div class="p-6">
                    <div class="flex items-center mb-2">
                        <span class="bg-gray-200 text-gray-800 text-xs font-medium px-2.5 py-0.5 rounded">Fan Zone</span>
                        <span class="text-gray-500 text-xs ml-2">June 12, 2025</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Kazan Cockroaches Fans Break Attendance Record</h3>
                    <p class="text-gray-600 mb-4">Over 10,000 fans showed up to watch Kazan Cockroaches, many dressed in full insect costumes despite the 30°C heat. Fifteen were treated for heat exhaustion.</p>
                    <a href="/blog/post-1" class="text-primary hover:text-primary-dark font-medium flex items-center">
                        Читать далее
                        <div class="w-5 h-5 ml-1 flex items-center justify-center">
                            <i class="ri-arrow-right-line"></i>
                        </div>
                    </a>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-lg overflow-hidden card-hover transition-all duration-300">
                <div class="h-48 overflow-hidden">
                    <img src="https://readdy.ai/api/search-image?query=A%20funny%20cartoon%20image%20of%20football%20fans%20dressed%20in%20bizarre%20costumes%20with%20team%20colors%2C%20cheering%20in%20the%20stands%20of%20a%20stadium%2C%20some%20wearing%20cockroach%20antennas%2C%20in%20a%20comic%20style&width=600&height=400&seq=13&orientation=landscape" alt="News Image" class="w-full h-full object-cover object-top">
                </div>
                <div class="p-6">
                    <div class="flex items-center mb-2">
                        <span class="bg-gray-200 text-gray-800 text-xs font-medium px-2.5 py-0.5 rounded">Fan Zone</span>
                        <span class="text-gray-500 text-xs ml-2">June 12, 2025</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Kazan Cockroaches Fans Break Attendance Record</h3>
                    <p class="text-gray-600 mb-4">Over 10,000 fans showed up to watch Kazan Cockroaches, many dressed in full insect costumes despite the 30°C heat. Fifteen were treated for heat exhaustion.</p>
                    <a href="/blog/post-1" class="text-primary hover:text-primary-dark font-medium flex items-center">
                        Читать далее
                        <div class="w-5 h-5 ml-1 flex items-center justify-center">
                            <i class="ri-arrow-right-line"></i>
                        </div>
                    </a>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-lg overflow-hidden card-hover transition-all duration-300">
                <div class="h-48 overflow-hidden">
                    <img src="https://readdy.ai/api/search-image?query=A%20funny%20cartoon%20image%20of%20a%20football%20player%20celebrating%20a%20goal%20in%20a%20muddy%20field%2C%20wearing%20a%20ridiculous%20uniform%20with%20a%20comical%20expression%2C%20in%20a%20comic%20style&width=600&height=400&seq=11&orientation=landscape" alt="News Image" class="w-full h-full object-cover object-top">
                </div>
                <div class="p-6">
                    <div class="flex items-center mb-2">
                        <span class="bg-primary bg-opacity-10 text-primary text-xs font-medium px-2.5 py-0.5 rounded">Match Report</span>
                        <span class="text-gray-500 text-xs ml-2">June 16, 2025</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Snot FC Gets First Win After 12 Losses!</h3>
                    <p class="text-gray-600 mb-4">In a shocking turn of events that has football experts questioning the laws of probability, Snot FC has finally won a match after 12 consecutive losses.</p>
                    <a href="/blog/post-1" class="text-primary hover:text-primary-dark font-medium flex items-center">
                        Читать далее
                        <div class="w-5 h-5 ml-1 flex items-center justify-center">
                            <i class="ri-arrow-right-line"></i>
                        </div>
                    </a>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-lg overflow-hidden card-hover transition-all duration-300">
                <div class="h-48 overflow-hidden">
                    <img src="https://readdy.ai/api/search-image?query=A%20funny%20cartoon%20image%20of%20a%20football%20player%20celebrating%20a%20goal%20in%20a%20muddy%20field%2C%20wearing%20a%20ridiculous%20uniform%20with%20a%20comical%20expression%2C%20in%20a%20comic%20style&width=600&height=400&seq=11&orientation=landscape" alt="News Image" class="w-full h-full object-cover object-top">
                </div>
                <div class="p-6">
                    <div class="flex items-center mb-2">
                        <span class="bg-primary bg-opacity-10 text-primary text-xs font-medium px-2.5 py-0.5 rounded">Match Report</span>
                        <span class="text-gray-500 text-xs ml-2">June 16, 2025</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Snot FC Gets First Win After 12 Losses!</h3>
                    <p class="text-gray-600 mb-4">In a shocking turn of events that has football experts questioning the laws of probability, Snot FC has finally won a match after 12 consecutive losses.</p>
                    <a href="/blog/post-1" class="text-primary hover:text-primary-dark font-medium flex items-center">
                        Читать далее
                        <div class="w-5 h-5 ml-1 flex items-center justify-center">
                            <i class="ri-arrow-right-line"></i>
                        </div>
                    </a>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-lg overflow-hidden card-hover transition-all duration-300">
                <div class="h-48 overflow-hidden">
                    <img src="https://readdy.ai/api/search-image?query=A%20funny%20cartoon%20image%20of%20a%20football%20player%20celebrating%20a%20goal%20in%20a%20muddy%20field%2C%20wearing%20a%20ridiculous%20uniform%20with%20a%20comical%20expression%2C%20in%20a%20comic%20style&width=600&height=400&seq=11&orientation=landscape" alt="News Image" class="w-full h-full object-cover object-top">
                </div>
                <div class="p-6">
                    <div class="flex items-center mb-2">
                        <span class="bg-primary bg-opacity-10 text-primary text-xs font-medium px-2.5 py-0.5 rounded">Match Report</span>
                        <span class="text-gray-500 text-xs ml-2">June 16, 2025</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Snot FC Gets First Win After 12 Losses!</h3>
                    <p class="text-gray-600 mb-4">In a shocking turn of events that has football experts questioning the laws of probability, Snot FC has finally won a match after 12 consecutive losses.</p>
                    <a href="/blog/post-1" class="text-primary hover:text-primary-dark font-medium flex items-center">
                        Читать далее
                        <div class="w-5 h-5 ml-1 flex items-center justify-center">
                            <i class="ri-arrow-right-line"></i>
                        </div>
                    </a>
                </div>
            </div>




        </div>
    </div>
</section>
@endsection

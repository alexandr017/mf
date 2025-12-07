@extends('site.v1.layouts.default')
{{--@section ('title', Shortcode::compile($page->title))--}}
{{--@section ('meta_description', Shortcode::compile($page->meta_description))--}}

@section('content')
    @include('site.v1.modules.tournaments-banner.tournaments-banner')

<!-- Current Tournaments Section -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="heading-font text-4xl md:text-5xl text-gray-900 mb-6">Current Tournaments</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">These prestigious tournaments are currently accepting teams from across Russia and beyond. Each trophy represents the pinnacle of ridiculous football achievement.</p>
        </div>

        <!-- Russian Cups and Trophies -->
        <div class="mb-20">
            <div class="flex items-center justify-center mb-12">
                <div class="flex items-center gap-4">
                    <div class="w-16 h-16 rounded-full overflow-hidden border-4 border-primary">
                        <img src="https://readdy.ai/api/search-image?query=Russian%20flag%20icon%20in%20a%20circular%20frame%2C%20patriotic%20colors%2C%20clean%20design%2C%20official%20style&width=200&height=200&seq=101&orientation=squarish" alt="Russia Flag" class="w-full h-full object-cover object-top">
                    </div>
                    <h3 class="heading-font text-3xl md:text-4xl text-gray-900">Russian Cups & Trophies</h3>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                <!-- Golden Toilet Trophy -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden border-2 border-gray-100 hover:border-primary transition-all duration-300 card-hover trophy-card cursor-pointer">
                    <div class="p-8 text-center">
                        <div class="w-32 h-32 mx-auto mb-6 trophy-glow">
                            <img src="https://readdy.ai/api/search-image?query=A%20golden%20toilet%20shaped%20trophy%20with%20elaborate%20decorations%2C%20shining%20metal%20finish%2C%20ridiculously%20ornate%20design%2C%20sitting%20on%20a%20marble%20pedestal%2C%20professional%20product%20photography%20with%20dramatic%20lighting&width=400&height=400&seq=102&orientation=squarish" alt="Golden Toilet Trophy" class="w-full h-full object-cover object-top">
                        </div>
                        <h4 class="heading-font text-xl text-gray-900 mb-2">Golden Toilet Trophy</h4>
                        <p class="text-gray-600 text-sm mb-4">The most prestigious award in Russian meme football</p>
                        <div class="space-y-2 text-sm">
                            <div class="flex justify-between">
                                <span class="text-gray-500">Prize Pool:</span>
                                <span class="font-bold text-primary">₽500,000</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500">Teams:</span>
                                <span class="font-bold">16</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500">Status:</span>
                                <span class="font-bold text-green-600">Open</span>
                            </div>
                        </div>
                        <button class="w-full mt-4 bg-primary hover:bg-opacity-80 text-gray-900 font-bold py-2 !rounded-button whitespace-nowrap cursor-pointer">
                            Join Tournament
                        </button>
                    </div>
                </div>

                <!-- Chaos Cup -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden border-2 border-gray-100 hover:border-primary transition-all duration-300 card-hover trophy-card cursor-pointer">
                    <div class="p-8 text-center">
                        <div class="w-32 h-32 mx-auto mb-6 trophy-glow">
                            <img src="https://readdy.ai/api/search-image?query=A%20chaotic%20looking%20cup%20trophy%20with%20twisted%20handles%20and%20random%20decorative%20elements%2C%20silver%20and%20bronze%20mixed%20metal%20finish%2C%20bizarre%20design%20with%20mismatched%20parts%2C%20professional%20product%20photography&width=400&height=400&seq=103&orientation=squarish" alt="Chaos Cup" class="w-full h-full object-cover object-top">
                        </div>
                        <h4 class="heading-font text-xl text-gray-900 mb-2">Chaos Cup</h4>
                        <p class="text-gray-600 text-sm mb-4">Where unpredictability meets football excellence</p>
                        <div class="space-y-2 text-sm">
                            <div class="flex justify-between">
                                <span class="text-gray-500">Prize Pool:</span>
                                <span class="font-bold text-primary">₽300,000</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500">Teams:</span>
                                <span class="font-bold">12</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500">Status:</span>
                                <span class="font-bold text-yellow-600">Qualifying</span>
                            </div>
                        </div>
                        <button class="w-full mt-4 bg-primary hover:bg-opacity-80 text-gray-900 font-bold py-2 !rounded-button whitespace-nowrap cursor-pointer">
                            View Bracket
                        </button>
                    </div>
                </div>

                <!-- Siberian Sludge Championship -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden border-2 border-gray-100 hover:border-primary transition-all duration-300 card-hover trophy-card cursor-pointer">
                    <div class="p-8 text-center">
                        <div class="w-32 h-32 mx-auto mb-6 trophy-glow">
                            <img src="https://readdy.ai/api/search-image?query=A%20muddy%20rough%20looking%20trophy%20made%20from%20ice%20and%20dirt%2C%20frozen%20championship%20cup%20with%20icicles%20hanging%20from%20it%2C%20rugged%20Siberian%20style%20design%2C%20dramatic%20lighting&width=400&height=400&seq=104&orientation=squarish" alt="Siberian Sludge Championship" class="w-full h-full object-cover object-top">
                        </div>
                        <h4 class="heading-font text-xl text-gray-900 mb-2">Siberian Sludge Championship</h4>
                        <p class="text-gray-600 text-sm mb-4">The coldest and muddiest tournament in Russia</p>
                        <div class="space-y-2 text-sm">
                            <div class="flex justify-between">
                                <span class="text-gray-500">Prize Pool:</span>
                                <span class="font-bold text-primary">₽250,000</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500">Teams:</span>
                                <span class="font-bold">8</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500">Status:</span>
                                <span class="font-bold text-green-600">Open</span>
                            </div>
                        </div>
                        <button class="w-full mt-4 bg-primary hover:bg-opacity-80 text-gray-900 font-bold py-2 !rounded-button whitespace-nowrap cursor-pointer">
                            Register Team
                        </button>
                    </div>
                </div>

                <!-- Moscow Mayhem Trophy -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden border-2 border-gray-100 hover:border-primary transition-all duration-300 card-hover trophy-card cursor-pointer">
                    <div class="p-8 text-center">
                        <div class="w-32 h-32 mx-auto mb-6 trophy-glow">
                            <img src="https://readdy.ai/api/search-image?query=A%20modern%20urban%20style%20trophy%20with%20city%20skyline%20elements%20and%20graffiti%20details%2C%20metallic%20finish%20with%20neon%20accents%2C%20contemporary%20street%20art%20inspired%20design%2C%20professional%20lighting&width=400&height=400&seq=105&orientation=squarish" alt="Moscow Mayhem Trophy" class="w-full h-full object-cover object-top">
                        </div>
                        <h4 class="heading-font text-xl text-gray-900 mb-2">Moscow Mayhem Trophy</h4>
                        <p class="text-gray-600 text-sm mb-4">Urban chaos meets football in the capital</p>
                        <div class="space-y-2 text-sm">
                            <div class="flex justify-between">
                                <span class="text-gray-500">Prize Pool:</span>
                                <span class="font-bold text-primary">₽400,000</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500">Teams:</span>
                                <span class="font-bold">20</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500">Status:</span>
                                <span class="font-bold text-red-600">Full</span>
                            </div>
                        </div>
                        <button class="w-full mt-4 bg-gray-400 text-white font-bold py-2 !rounded-button whitespace-nowrap cursor-not-allowed" disabled>
                            Tournament Full
                        </button>
                    </div>
                </div>

                <!-- Volga Vomit Cup -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden border-2 border-gray-100 hover:border-primary transition-all duration-300 card-hover trophy-card cursor-pointer">
                    <div class="p-8 text-center">
                        <div class="w-32 h-32 mx-auto mb-6 trophy-glow">
                            <img src="https://readdy.ai/api/search-image?query=A%20river-themed%20trophy%20cup%20with%20flowing%20water%20elements%20and%20aquatic%20decorations%2C%20blue%20and%20green%20color%20scheme%2C%20nautical%20inspired%20design%20with%20waves%20and%20marine%20elements&width=400&height=400&seq=106&orientation=squarish" alt="Volga Vomit Cup" class="w-full h-full object-cover object-top">
                        </div>
                        <h4 class="heading-font text-xl text-gray-900 mb-2">Volga Vomit Cup</h4>
                        <p class="text-gray-600 text-sm mb-4">Navigate the troubled waters of competition</p>
                        <div class="space-y-2 text-sm">
                            <div class="flex justify-between">
                                <span class="text-gray-500">Prize Pool:</span>
                                <span class="font-bold text-primary">₽200,000</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500">Teams:</span>
                                <span class="font-bold">10</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500">Status:</span>
                                <span class="font-bold text-green-600">Open</span>
                            </div>
                        </div>
                        <button class="w-full mt-4 bg-primary hover:bg-opacity-80 text-gray-900 font-bold py-2 !rounded-button whitespace-nowrap cursor-pointer">
                            Enter Now
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Spanish Cups and Trophies -->
        <div class="mb-20">
            <div class="flex items-center justify-center mb-12">
                <div class="flex items-center gap-4">
                    <div class="w-16 h-16 rounded-full overflow-hidden border-4 border-secondary">
                        <img src="https://readdy.ai/api/search-image?query=Spanish%20flag%20icon%20in%20a%20circular%20frame%2C%20red%20and%20yellow%20patriotic%20colors%2C%20clean%20design%2C%20official%20style&width=200&height=200&seq=107&orientation=squarish" alt="Spain Flag" class="w-full h-full object-cover object-top">
                    </div>
                    <h3 class="heading-font text-3xl md:text-4xl text-gray-900">Spanish Cups & Trophies</h3>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                <!-- Copa de la Locura -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden border-2 border-gray-100 hover:border-secondary transition-all duration-300 card-hover trophy-card cursor-pointer">
                    <div class="p-8 text-center">
                        <div class="w-32 h-32 mx-auto mb-6 trophy-glow">
                            <img src="https://readdy.ai/api/search-image?query=A%20Spanish%20style%20golden%20cup%20with%20flamenco%20decorative%20elements%2C%20ornate%20traditional%20design%20with%20red%20and%20gold%20colors%2C%20Spanish%20cultural%20motifs%2C%20elegant%20professional%20lighting&width=400&height=400&seq=108&orientation=squarish" alt="Copa de la Locura" class="w-full h-full object-cover object-top">
                        </div>
                        <h4 class="heading-font text-xl text-gray-900 mb-2">Copa de la Locura</h4>
                        <p class="text-gray-600 text-sm mb-4">The Cup of Madness from sunny Spain</p>
                        <div class="space-y-2 text-sm">
                            <div class="flex justify-between">
                                <span class="text-gray-500">Prize Pool:</span>
                                <span class="font-bold text-secondary">€350,000</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500">Teams:</span>
                                <span class="font-bold">14</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500">Status:</span>
                                <span class="font-bold text-green-600">Open</span>
                            </div>
                        </div>
                        <button class="w-full mt-4 bg-secondary hover:bg-opacity-80 text-white font-bold py-2 !rounded-button whitespace-nowrap cursor-pointer">
                            ¡Participar Ahora!
                        </button>
                    </div>
                </div>

                <!-- Trofeo del Disparate -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden border-2 border-gray-100 hover:border-secondary transition-all duration-300 card-hover trophy-card cursor-pointer">
                    <div class="p-8 text-center">
                        <div class="w-32 h-32 mx-auto mb-6 trophy-glow">
                            <img src="https://readdy.ai/api/search-image?query=A%20quirky%20nonsensical%20trophy%20with%20absurd%20Spanish%20elements%20like%20oversized%20paella%20pan%20base%20and%20bull%20horns%2C%20colorful%20and%20bizarre%20design%2C%20Mediterranean%20style&width=400&height=400&seq=109&orientation=squarish" alt="Trofeo del Disparate" class="w-full h-full object-cover object-top">
                        </div>
                        <h4 class="heading-font text-xl text-gray-900 mb-2">Trofeo del Disparate</h4>
                        <p class="text-gray-600 text-sm mb-4">Trophy of Nonsense - pure Spanish absurdity</p>
                        <div class="space-y-2 text-sm">
                            <div class="flex justify-between">
                                <span class="text-gray-500">Prize Pool:</span>
                                <span class="font-bold text-secondary">€280,000</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500">Teams:</span>
                                <span class="font-bold">12</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500">Status:</span>
                                <span class="font-bold text-yellow-600">Qualifying</span>
                            </div>
                        </div>
                        <button class="w-full mt-4 bg-secondary hover:bg-opacity-80 text-white font-bold py-2 !rounded-button whitespace-nowrap cursor-pointer">
                            Ver Clasificación
                        </button>
                    </div>
                </div>

                <!-- Barcelona Bizarro Bowl -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden border-2 border-gray-100 hover:border-secondary transition-all duration-300 card-hover trophy-card cursor-pointer">
                    <div class="p-8 text-center">
                        <div class="w-32 h-32 mx-auto mb-6 trophy-glow">
                            <img src="https://readdy.ai/api/search-image?query=A%20modern%20Barcelona-inspired%20trophy%20with%20Gaud%C3%AD%20architectural%20elements%2C%20mosaic%20patterns%2C%20and%20colorful%20ceramic%20decorations%2C%20artistic%20and%20surreal%20design&width=400&height=400&seq=110&orientation=squarish" alt="Barcelona Bizarro Bowl" class="w-full h-full object-cover object-top">
                        </div>
                        <h4 class="heading-font text-xl text-gray-900 mb-2">Barcelona Bizarro Bowl</h4>
                        <p class="text-gray-600 text-sm mb-4">Gaudí meets football in this architectural wonder</p>
                        <div class="space-y-2 text-sm">
                            <div class="flex justify-between">
                                <span class="text-gray-500">Prize Pool:</span>
                                <span class="font-bold text-secondary">€420,000</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500">Teams:</span>
                                <span class="font-bold">16</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500">Status:</span>
                                <span class="font-bold text-red-600">Full</span>
                            </div>
                        </div>
                        <button class="w-full mt-4 bg-gray-400 text-white font-bold py-2 !rounded-button whitespace-nowrap cursor-not-allowed" disabled>
                            Torneo Completo
                        </button>
                    </div>
                </div>

                <!-- Madrid Madness Medal -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden border-2 border-gray-100 hover:border-secondary transition-all duration-300 card-hover trophy-card cursor-pointer">
                    <div class="p-8 text-center">
                        <div class="w-32 h-32 mx-auto mb-6 trophy-glow">
                            <img src="https://readdy.ai/api/search-image?query=A%20royal%20Madrid%20style%20golden%20medal%20with%20crown%20elements%20and%20royal%20Spanish%20coat%20of%20arms%2C%20elegant%20regal%20design%20with%20purple%20and%20gold%20colors%2C%20luxury%20finish&width=400&height=400&seq=111&orientation=squarish" alt="Madrid Madness Medal" class="w-full h-full object-cover object-top">
                        </div>
                        <h4 class="heading-font text-xl text-gray-900 mb-2">Madrid Madness Medal</h4>
                        <p class="text-gray-600 text-sm mb-4">Royal recognition for the finest chaos</p>
                        <div class="space-y-2 text-sm">
                            <div class="flex justify-between">
                                <span class="text-gray-500">Prize Pool:</span>
                                <span class="font-bold text-secondary">€300,000</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500">Teams:</span>
                                <span class="font-bold">18</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500">Status:</span>
                                <span class="font-bold text-green-600">Open</span>
                            </div>
                        </div>
                        <button class="w-full mt-4 bg-secondary hover:bg-opacity-80 text-white font-bold py-2 !rounded-button whitespace-nowrap cursor-pointer">
                            Inscribirse
                        </button>
                    </div>
                </div>

                <!-- Valencia Vile Victory -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden border-2 border-gray-100 hover:border-secondary transition-all duration-300 card-hover trophy-card cursor-pointer">
                    <div class="p-8 text-center">
                        <div class="w-32 h-32 mx-auto mb-6 trophy-glow">
                            <img src="https://readdy.ai/api/search-image?query=An%20orange-themed%20trophy%20with%20citrus%20fruit%20elements%20and%20Mediterranean%20coastal%20decorations%2C%20bright%20orange%20and%20blue%20color%20scheme%2C%20fresh%20vibrant%20design&width=400&height=400&seq=112&orientation=squarish" alt="Valencia Vile Victory" class="w-full h-full object-cover object-top">
                        </div>
                        <h4 class="heading-font text-xl text-gray-900 mb-2">Valencia Vile Victory</h4>
                        <p class="text-gray-600 text-sm mb-4">Taste the bitter sweetness of triumph</p>
                        <div class="space-y-2 text-sm">
                            <div class="flex justify-between">
                                <span class="text-gray-500">Prize Pool:</span>
                                <span class="font-bold text-secondary">€180,000</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500">Teams:</span>
                                <span class="font-bold">8</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500">Status:</span>
                                <span class="font-bold text-green-600">Open</span>
                            </div>
                        </div>
                        <button class="w-full mt-4 bg-secondary hover:bg-opacity-80 text-white font-bold py-2 !rounded-button whitespace-nowrap cursor-pointer">
                            Unirse Torneo
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- View All Tournaments Button -->
        <div class="text-center mt-16">
            <button class="bg-white border-2 border-primary hover:bg-primary hover:text-white text-primary font-bold px-8 py-3 !rounded-button whitespace-nowrap transition-colors duration-300 cursor-pointer">
                <div class="flex items-center gap-2">
                    <div class="w-6 h-6 flex items-center justify-center">
                        <i class="ri-trophy-line"></i>
                    </div>
                    <span>View All 47 Available Tournaments</span>
                </div>
            </button>
        </div>
    </div>
</section>

<!-- Tournament Categories -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="heading-font text-4xl text-gray-900 mb-4">Tournament Categories</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">Different styles of chaos for every type of team</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Regional Tournaments -->
            <div class="bg-white rounded-lg shadow-lg p-6 text-center card-hover transition-all duration-300 cursor-pointer">
                <div class="w-16 h-16 mx-auto mb-4 bg-primary bg-opacity-10 rounded-full flex items-center justify-center">
                    <div class="w-8 h-8 text-primary">
                        <i class="ri-map-pin-2-line ri-lg"></i>
                    </div>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Regional</h3>
                <p class="text-gray-600 mb-4">Local chaos, neighborhood glory</p>
                <div class="text-2xl font-bold text-primary mb-2">23</div>
                <div class="text-sm text-gray-500">Active Tournaments</div>
            </div>

            <!-- International Tournaments -->
            <div class="bg-white rounded-lg shadow-lg p-6 text-center card-hover transition-all duration-300 cursor-pointer">
                <div class="w-16 h-16 mx-auto mb-4 bg-secondary bg-opacity-10 rounded-full flex items-center justify-center">
                    <div class="w-8 h-8 text-secondary">
                        <i class="ri-global-line ri-lg"></i>
                    </div>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">International</h3>
                <p class="text-gray-600 mb-4">Cross-border madness</p>
                <div class="text-2xl font-bold text-secondary mb-2">8</div>
                <div class="text-sm text-gray-500">Active Tournaments</div>
            </div>

            <!-- Seasonal Cups -->
            <div class="bg-white rounded-lg shadow-lg p-6 text-center card-hover transition-all duration-300 cursor-pointer">
                <div class="w-16 h-16 mx-auto mb-4 bg-yellow-100 rounded-full flex items-center justify-center">
                    <div class="w-8 h-8 text-yellow-600">
                        <i class="ri-sun-line ri-lg"></i>
                    </div>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Seasonal</h3>
                <p class="text-gray-600 mb-4">Weather-dependent disasters</p>
                <div class="text-2xl font-bold text-yellow-600 mb-2">12</div>
                <div class="text-sm text-gray-500">Seasonal Events</div>
            </div>

            <!-- Special Events -->
            <div class="bg-white rounded-lg shadow-lg p-6 text-center card-hover transition-all duration-300 cursor-pointer">
                <div class="w-16 h-16 mx-auto mb-4 bg-purple-100 rounded-full flex items-center justify-center">
                    <div class="w-8 h-8 text-purple-600">
                        <i class="ri-star-line ri-lg"></i>
                    </div>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Special</h3>
                <p class="text-gray-600 mb-4">Once-in-a-lifetime chaos</p>
                <div class="text-2xl font-bold text-purple-600 mb-2">4</div>
                <div class="text-sm text-gray-500">Exclusive Events</div>
            </div>
        </div>
    </div>
</section>

<!-- How to Join Section -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="heading-font text-4xl text-gray-900 mb-4">How to Join a Tournament</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">It's easier than you think to become a champion of chaos</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Step 1 -->
            <div class="text-center">
                <div class="w-20 h-20 mx-auto mb-6 bg-primary rounded-full flex items-center justify-center">
                    <span class="text-3xl font-bold text-gray-900">1</span>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-4">Choose Your Tournament</h3>
                <p class="text-gray-600">Browse our collection of ridiculous tournaments and select the one that matches your team's particular brand of chaos.</p>
            </div>

            <!-- Step 2 -->
            <div class="text-center">
                <div class="w-20 h-20 mx-auto mb-6 bg-secondary rounded-full flex items-center justify-center">
                    <span class="text-3xl font-bold text-white">2</span>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-4">Register Your Team</h3>
                <p class="text-gray-600">Complete the registration form with your team details, ridiculous name, and proof that you meet the minimum chaos requirements.</p>
            </div>

            <!-- Step 3 -->
            <div class="text-center">
                <div class="w-20 h-20 mx-auto mb-6 bg-yellow-400 rounded-full flex items-center justify-center">
                    <span class="text-3xl font-bold text-gray-900">3</span>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-4">Embrace the Mayhem</h3>
                <p class="text-gray-600">Show up, play badly but enthusiastically, and compete for glory in the most absurd football competitions on Earth.</p>
            </div>
        </div>

        <div class="text-center mt-12">
            <button class="bg-primary hover:bg-opacity-80 text-gray-900 font-bold px-8 py-4 !rounded-button text-lg whitespace-nowrap cursor-pointer">
                <div class="flex items-center gap-2">
                    <div class="w-6 h-6 flex items-center justify-center">
                        <i class="ri-team-line"></i>
                    </div>
                    <span>Register Your Team Now</span>
                </div>
            </button>
        </div>
    </div>
</section>

@endsection

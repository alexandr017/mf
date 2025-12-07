@extends('site.v1.layouts.default')
@section ('title', $page->title)
@section ('meta_description', $page->meta_description)

@section('content')

<main class="container mx-auto px-4 py-12">
    <div class="flex flex-col lg:flex-row gap-8">
        @include('site.v1.modules.menu-content.menu-content')

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
                            <h1 class="text-2xl font-bold">{{$page->h1}}</h1>
                        </div>
                    </div>

                    <div class="p-6">
                        <div class="prose max-w-none">
                            {!! $page->content !!}

                            @if($page->alias == 'about')
                                @include('site.v1.modules.forms.support')
                            @endif
                        </div>
                    </div>
                </div>
            </section>


        </div>
    </div>
</main>
@endsection

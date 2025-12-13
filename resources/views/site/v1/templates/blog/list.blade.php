@extends('site.v1.layouts.default')
{{--@section ('title', Shortcode::compile($page->title))--}}
{{--@section ('meta_description', Shortcode::compile($page->meta_description))--}}

@section('content')
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-8">
            <h2 class="heading-font text-4xl text-gray-900">Последние новости</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($posts as $post)
                @include('site.v1.modules.news.news', compact('post'))
            @endforeach
        </div>
    </div>
</section>
@endsection

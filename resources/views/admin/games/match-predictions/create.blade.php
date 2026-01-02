@extends('admin.layouts.app')
@section('title', 'Создание матча')
@section('h1', 'Создание матча')

@section('content')

    <form action="{{route('admin.match-predictions.store')}}" method="POST">
        @csrf
        @include('admin.games.match-predictions._form')
        <button type="submit" class="btn btn-success">Создать</button>
    </form>

@endsection


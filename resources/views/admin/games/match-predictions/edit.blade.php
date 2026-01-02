@extends('admin.layouts.app')
@section('title', 'Редактирование матча')
@section('h1', 'Редактирование матча')

@section('content')

    <form action="{{route('admin.match-predictions.update', $item->id)}}" method="POST">
        @csrf
        @method('PUT')
        @include('admin.games.match-predictions._form')
        <button type="submit" class="btn btn-success">Сохранить</button>
    </form>

@endsection


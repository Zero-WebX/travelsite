@extends('layouts.layout')

@section('title')
    Посты
@endsection

@section('caption')
    <h2 style="padding-left: 15px; padding-top: 15px">Посты</h2>
@endsection

@section('content')
<div>
    <form id="filterForm" class="d-flex m-3">
        <input type="text" name="search" id="searchInput" class="form-control me-2"
               placeholder="Глобальный поиск по содержимому постов"
               value="{{ request('search') }}">
        <button type="submit" class="btn btn-primary">Поиск</button>
    </form>

    <div class="container">
        <div class="row" id="postContainer">
            @include('partials.postlist', ['data' => $data])
        </div>
    </div>

    <div class="d-flex justify-content-between my-4">
        @if ($data->onFirstPage())
            <button class="btn btn-outline-secondary disabled">← Назад</button>
        @else
            <a href="{{ $data->appends(['search' => request('search')])->previousPageUrl() }}"
               class="btn btn-outline-purple">← Назад</a>
        @endif

        @if ($data->hasMorePages())
            <a href="{{ $data->appends(['search' => request('search')])->nextPageUrl() }}"
               class="btn btn-outline-purple ms-auto">Вперёд →</a>
        @else
            <button class="btn btn-outline-secondary disabled ms-auto">Вперёд →</button>
        @endif
    </div>
</div>
@endsection
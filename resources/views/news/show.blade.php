@extends('layouts.main')
@section('title', $news ? $news->title : '404 | NOT FOUND')
@section('content')
    @if (!$news)
        @include('errors.main')
    @else
        <div class="container mt-4">
            <div class="row">
                <div class="col-6 mx-auto">
                    <div class="mb-4">
                        <p class="badge rounded-pill text-bg-warning">
                            {{ $news->category->name }}
                        </p>
                        <h1 class="title fw-bold">{{ $news->title }}</h1>
                        <p class="subtitle">{{ $news->subtitle }}</p>
                        <p>
                            <span class="fw-bold">Publicado em</span>
                            {{ $news->created_at_formatted }}
                        </p>
                        <p>
                            <span class="fw-bold">Autor</span>
                            {{ $news->user->name }}
                        </p>
                        <img src="{{ asset($news->banner) }}" alt="{{ $news->title }}">
                        <div class="content">{!! nl2br(e($news->content)) !!}</div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

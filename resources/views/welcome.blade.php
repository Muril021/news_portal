@extends('layouts.main')
@section('title', 'Portal de Notícias')
@section('content')
    <div class="w-75 mx-auto">
        <div class="row">
            @if ($news->count() == 0)
                <h1 class="h2 mb-4">Notícias</h1>
                <p>Nenhuma notícia encontrada.</p>
            @else
                <h1 class="h2 mb-4">Notícias</h1>
                @foreach ($news as $item)
                    <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                        <a href="{{ route('news.show', $item->slug) }}">
                            <div class="card px-1">
                                <img src="{{ $item->banner }}" class="card-img-top"
                                    alt="{{ $item->title }}"
                                >
                                <div class="card-body p-1">
                                    <div class="w-100">
                                        <span class="badge rounded-pill text-bg-warning">
                                            {{ $item->category->name }}
                                        </span>
                                    </div>
                                    <div class="w-100 py-1">
                                        <span class="card-text">
                                            {{ $item->limited_title }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            @endif
        </div>
        <div class="d-flex justify-content-center">
            {{ $news->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection

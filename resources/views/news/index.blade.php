@extends('layouts.main')
@section('title', 'Notícias')
@section('content')
    <div class="w-75 mx-auto">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between header">
                    <h1 class="h2 mb-3">Notícias</h1>
                    <div class="button d-flex align-items-center">
                        <a
                            class="btn btn-warning d-flex align-items-center fw-bold"
                            role="button"
                            href="{{ route('news.create') }}"
                        >
                            <i class="fa-solid fa-plus me-1 mt-1"></i> Nova notícia
                        </a>
                    </div>
                </div>
                <table class="w-100 table table-hover table-striped table-sm mx-auto">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Título</th>
                            <th scope="col">Categoria</th>
                            <th scope="col">Autor</th>
                            <th scope="col">Opções</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($news as $item)
                            <tr>
                                <th scope="row">{{ $item->id }}</th>
                                <td>{{ $item->limited_title }}</td>
                                <td>
                                    <span class="badge rounded-pill text-bg-warning">
                                        {{ $item->category->name }}
                                    </span>
                                </td>
                                <td>{{ $item->user->name }}</td>
                                <td>
                                    <a class="btn btn-warning"
                                        href="{{ route('news.edit', $item->id) }}"
                                    >
                                        <i class="fa-solid fa-pen"></i>
                                    </a>
                                    <form
                                        action="{{ route('news.destroy', $item->id) }}"
                                        method="POST" class="d-inline"
                                    >
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {{ $news->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.main')
@section('title', 'Categorias')
@section('content')
    <div class="w-75 mx-auto">
        <div class="d-flex justify-content-between header">
            <h1 class="h2 mb-3">Categorias</h1>
            @if (Auth::user()->hasRole('admin'))
                <div class="button d-flex align-items-center">
                    <a
                        class="btn btn-warning d-flex align-items-center fw-bold"
                        role="button"
                        href="{{ route('category.create') }}"
                    >
                        <i class="fa-solid fa-plus me-1 mt-1"></i> Nova categoria
                    </a>
                </div>
            @endif
        </div>
        <table class="w-100 table table-hover table-striped text-center table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Autor</th>
                    <th scope="col">Notícias</th>
                    @if (Auth::user()->hasRole('admin'))
                        <th scope="col">Opções</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <th scope="row">{{ $category->id }}</th>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->user->name }}</td>
                        <td>{{ $category->news->count() }}</td>
                        <td>
                            @if (Auth::user()->hasRole('admin'))
                                <a class="btn btn-warning"
                                    href="{{ route('category.edit', $category->id) }}"
                                >
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                @if ($category->news->count() == 0)
                                    <form
                                        action="{{ route('category.destroy', $category->id) }}"
                                        method="POST" class="d-inline"
                                    >
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                @else
                                    <button
                                        type="button"
                                        class="btn btn-danger"
                                        onclick="alert('Não é possível remover uma categoria com notícias vinculadas.')"
                                    >
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                @endif
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {{ $categories->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection

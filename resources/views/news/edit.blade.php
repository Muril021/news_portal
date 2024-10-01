@extends('layouts.main')
@section('title', 'Editar notícia')
@section('content')
    <div class="form pb-5 w-75 mx-auto">
        @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif
        <h1 class="h2 mb-3">Editar notícia</h1>
        <form action="{{ route('news.update', $news->id) }}" method="POST"
            enctype="multipart/form-data"
        >
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="formFileSm" class="form-label fw-bold">
                    Imagem
                    <span class="text-danger fw-bold">*</span>
                </label>
                <input class="form-control form-control-sm" id="formFileSm" type="file"
                name="banner">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label fw-bold">
                    Título
                    <span class="text-danger fw-bold">*</span>
                </label>
                <input class="form-control form-control-sm" type="text" name="title"
                value="{{ old('title', $news->title) }}">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label fw-bold">
                    Subtítulo
                    <span class="text-danger fw-bold">*</span>
                </label>
                <input class="form-control form-control-sm" type="text" name="subtitle"
                value="{{ old('subtitle', $news->subtitle) }}">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label fw-bold">
                    Categoria
                    <span class="text-danger fw-bold">*</span>
                </label>
                <select class="form-select form-select-sm" aria-label="Small select example"
                name="category_id">
                    <option selected>Selecione</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ $category->id == $news->category_id ? 'selected' : '' }}
                        >
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label fw-bold">
                    Conteúdo
                    <span class="text-danger fw-bold">*</span>
                </label>
                <textarea class="form-control" id="exampleFormControlTextarea1"
                    style="height: 200px;" name="content"
                >{{ $news->content }}</textarea>
            </div>
            <button type="submit" class="btn btn-warning">
                <i class="fa-solid fa-check"></i> Salvar
            </button>
        </form>
    </div>
@endsection

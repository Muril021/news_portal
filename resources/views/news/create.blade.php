@extends('layouts.main')
@section('title', 'Nova notícia')
@section('content')
    <div class="form pb-5">
        <h1 class="h2 mb-3">Nova notícia</h1>
        <form
            action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="formFileSm" class="form-label fw-bold">
                    Imagem
                    <span class="text-danger fw-bold">*</span>
                </label>
                <input class="form-control form-control-sm" id="formFileSm" type="file" name="banner">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label fw-bold">
                    Título
                    <span class="text-danger fw-bold">*</span>
                </label>
                <input class="form-control form-control-sm" type="text" name="title">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label fw-bold">
                    Subtítulo
                    <span class="text-danger fw-bold">*</span>
                </label>
                <input class="form-control form-control-sm" type="text" name="subtitle">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label fw-bold">
                    Categoria
                    <span class="text-danger fw-bold">*</span>
                </label>
                <select class="form-select form-select-sm" aria-label="Small select example"
                name="category_id">
                    <option selected>Selecionar categoria</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
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
                ></textarea>
            </div>
            <button type="submit" class="btn btn-warning">
                <i class="fa-solid fa-check"></i> Salvar
            </button>
        </form>
    </div>
@endsection

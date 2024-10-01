@extends('layouts.main')
@section('title', 'Editar categoria')
@section('content')
    <div class="form pb-5 w-75 mx-auto">
        <form action="{{ route('category.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">
                    Nome
                    <span class="text-danger fw-bold">*</span>
                </label>
                <input type="text" class="form-control" name="name"
                value="{{ old('name', $category->name) }}">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Descrição</label>
                <textarea class="form-control" rows="3" name="description">
                    {{ old('description', $category->description) }}
                </textarea>
            </div>
            <button type="submit" class="btn btn-warning">
                <i class="fa-solid fa-check"></i> Salvar
            </button>
        </form>
    </div>
@endsection

@extends('layouts.main')
@section('title', 'Nova categoria')
@section('content')
    <div class="form pb-5 w-75 mx-auto">
        <h1 class="h2 mb-3">Nova categoria</h1>
        <form action="{{ route('category.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label fw-bold">
                    Nome
                    <span class="text-danger fw-bold">*</span>
                </label>
                <input type="text" class="form-control" id="exampleFormControlInput1" name="name">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label fw-bold">Descrição</label>
                <textarea class="form-control" rows="3" id="exampleFormControlTextarea1"
                name="description"></textarea>
            </div>
            <button type="submit" class="btn btn-warning">
                <i class="fa-solid fa-check"></i> Salvar
            </button>
        </form>
    </div>
@endsection

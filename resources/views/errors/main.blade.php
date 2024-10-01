@extends('layouts.main')
@section('title', '404 | NOT FOUND')
@section('content')
    <div class="row vh-100 w-75 mx-auto d-flex justify-content-center align-items-center text-center">
        <div class="message">
            <h1 class="h3">{{ $message ?? '404 | NOT FOUND' }}</h1>
            @if (!Request::routeIs('welcome'))
                <div class="button mt-5">
                    <a href="{{ route('welcome') }}" class="btn btn-warning">
                        Página inicial
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection

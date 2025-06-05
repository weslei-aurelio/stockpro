@extends('layouts.app')

@section('title', 'Produtos | StockPRO')

@push('products-css')
    @vite('resources/scss/products.scss')
@endpush

@section('content')
    <div class="container mt-5">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h1>
                    <strong>Produtos</strong>
                </h1>
                <button type="button" class="btn btn-primary text-white mb-4 custom-button">
                    + Novo Produto
                </button>
            </div>
        <nav class="navbar">
            <div class="container-fluid">
                <form class="d-flex" role="search">
                    <input class="form-control me-2 navbar-brand" type="search" placeholder="Procurar" aria-label="Search"/>
                    <button class="btn btn-primary" type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                        </svg>
                    </button>
                </form>
            </div>
        </nav>
{{--            <div class="col-md-6">--}}
{{--                <a href="{{ route('products.create') }}" class="btn btn-primary text-white">+ Novo Produto</a>--}}
{{--            </div>--}}
    </div>
@endsection

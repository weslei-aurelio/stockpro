@extends('layouts.app')

@section('title', 'Marcas | StockPRO')

@push('brands-css')
@vite('resources/scss/brands.scss')
@endpush

@section('content')
<div class="container mt-5">
    @session('status')
        <div class="alert alert-success text-center" role="alert">
            {{ $value }}
        </div>
    @endsession
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>
            <strong>Marcas</strong>
        </h1>
        <button type="button" class="btn btn-primary custom-button text-white mb-4" data-bs-toggle="modal" data-bs-target="#NewBrand">
            Nova Marca
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
    <table class="table table-hover table-striped">
        <thead class=table-primary>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Marca</th>
                <th scope="col">Ação</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($brands as $brand)
                <tr>
                    <th scope="row">{{ $brand->id }}</th>
                    <td>{{ $brand->name }}</td>
                    <td>
                        <div class="d-flex gap-2">
                            <a class="btn btn-primary text-white btn-sm" href="#">Editar</a>
                            <form action="#" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Inativar</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <nav aria-label="Page navigation example" class="d-flex justify-content-center">
        <ul class="pagination">
            <li class="page-item">
                <a class="page-link" href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
                <a class="page-link" href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
</div>
    @include('brands.partials.create')
    @include('layouts.components.alert')    
@endsection
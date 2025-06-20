@extends('layouts.app')

@section('title', 'Categorias | StockPRO')

@push('categories-css')
@vite('resources/scss/categories.scss')
@endpush

@section('content')
    @session('status')
        <div class="alert alert-success text-center" role="alert">
            {{ $value }}
        </div>
    @endsession
    <div class="container mt-5 d-flex justify-content-end">
        <button type="button" class="btn btn-primary custom-button text-white mb-4" data-bs-toggle="modal" data-bs-target="#NewCategories">
            Nova Categoria
        </button>
    </div>
    <div class="container">
        <h1 class="text-center m-5">Categorias</h1>
        <table class="table table-hover table-striped">
            <thead class="table-primary">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Categoria</th>
                    <th scope="col">Ação</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <th scope="row">{{ $category->id }}</th>
                        <td>{{ $category->name }}</td>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn border-0 bg-transparent p-0" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots-vertical text-dark" viewBox="0 0 16 16">
                                        <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0"/>
                                    </svg>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-lg-start">
                                    <li>
                                        <a class="dropdown-item" href="#">Editar</a>
                                    </li>
                                    <li>
                                        <form action="#" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item text-danger">Inativar</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @include('categories.partials.create')
    @include('layouts.components.alert')    
@endsection
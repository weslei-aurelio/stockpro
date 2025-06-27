@extends('layouts.app')

@section('title', 'Categorias | StockPRO')

@push('categories-css')
    @vite('resources/scss/categories.scss')
@endpush

@section('content')
    <div class="container mt-5">
        @session('status')
            <div class="alert alert-success text-center" role="alert">
                {{ $value }}
            </div>
        @endsession

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1><strong>Categorias</strong></h1>
            <button type="button" class="btn btn-primary custom-button text-white mb-4" data-bs-toggle="modal" data-bs-target="#NewCategories">
                Nova Categoria
            </button>
        </div>

        <nav class="navbar">
            <div class="container-fluid">
                <form action="/categories" class="d-flex" role="search" method="GET">
                    <input class="form-control me-2 navbar-brand" 
                        type="text" 
                        name="keyword" 
                        placeholder="Procurar" 
                        aria-label="Search"
                    />
                    <button class="btn btn-primary me-2" type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                             class="bi bi-search" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 
                                     3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 
                                     6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                        </svg>
                    </button>
                    @if(request('keyword'))
                        <a href="/categories" class="btn btn-danger">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2z"/>
                                <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466"/>
                            </svg>
                        </a>
                    @endif
                </form>
            </div>
        </nav>

        <table class="table table-hover table-striped">
            <thead class="table-primary">
                <tr>
                    <th scope="col">Categoria</th>
                    <th scope="col">Status</th>
                    <th scope="col">Ação</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->status->name ?? 'Sem status' }}</td>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn border-0 bg-transparent p-0" data-bs-toggle="dropdown"
                                        data-bs-display="static" aria-expanded="false">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                         fill="currentColor" class="bi bi-three-dots-vertical text-dark"
                                         viewBox="0 0 16 16">
                                        <path d="M9.5 13a1.5 1.5 0 1 1-3 0 
                                                 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 
                                                 1 1-3 0 1.5 1.5 0 0 1 3 
                                                 0m0-5a1.5 1.5 0 1 1-3 0 
                                                 1.5 1.5 0 0 1 3 0"/>
                                    </svg>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-lg-start">
                                    <li>
                                        <a class="dropdown-item" href="#">Editar</a>
                                    </li>
                                    @if ($category->status_id == 1)
                                    <form action="{{ route('categories.inactivate', $category->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="dropdown-item text-danger">Inativar</button>
                                    </form>
                                    @else
                                    <form action="{{ route('categories.activate', $category->id )}}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Ativar</button>
                                    </form>
                                    @endif
                                </ul>
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

    @include('categories.partials.create')
    @include('layouts.components.alert')
@endsection
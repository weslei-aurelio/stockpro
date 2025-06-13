@extends('layouts.app')

@section('title', 'Usuários | StockPRO')

@push('index-css')
@vite('resources/scss/index.scss')
@endpush

@section('content')
    @session('status')
        <div class="alert alert-success text-center" role="alert">
            {{ $value }}
        </div>
    @endsession
    <div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1><strong>Usuários</strong></h1>
       <button type="button" class="btn btn-primary custom-button text-white mb-4" data-bs-toggle="modal" data-bs-target="#NewUser">
            + Novo usuário
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
        <table class="table custom-table">
            <thead>
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Status</th>
                    <th scope="col">Ação</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <th>{{ $user->status->name}}</th>
                    <td>
                        <div class="btn-group dropup">
                            <button type="button" class="btn border-0 bg-transparent p-0" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots-vertical text-dark" viewBox="0 0 16 16">
                                    <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0"/>
                                </svg>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-lg-start bg-info">
                                <li><a href="/users/{{ $user->id }}" class="dropdown-item">Editar</a></li>
                                <li>
                                    @if ($user->status_id == 1)
                                    <form action="{{ url('users/' . $user->id . '/inactivate') }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="dropdown-item text-danger">Inativar</button>
                                    </form>
                                    @else
                                    <form action="{{ url('users/' . $user->id . '/activate') }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Ativar</button>
                                    </form>
                                    @endif
                                </li>
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
    @include('layouts.components.alert')
    @include('users.partials.create')
@endsection


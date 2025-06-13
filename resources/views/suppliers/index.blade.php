@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Fornecedores</h1>
        <a href="{{ route('suppliers.create') }}">Cadastrar fornecedor</a>
    </div>
    <div class="container mt-5">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Nome / Razão Social</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Telefone</th>
                    <th scope="col">Observações</th>
                    <th scope="col">Ação</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($suppliers as $supplier)
                    <tr>
                        <td>{{ $supplier->name }}</td>
                        <td>{{ $supplier->email }}</td>
                        <td>{{ $supplier->phone }}</td>
                        <td><a href="#">Ver observações</a></td>
                        <td>
                            <div class="btn-group dropup">
                        <button type="button" class="btn border-0 bg-transparent p-0" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots-vertical text-dark" viewBox="0 0 16 16">
                                <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0"/>
                            </svg>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-lg-start bg-info">
                            <li><a href="{{ route('suppliers.edit', $supplier->id) }}" class="dropdown-item">Editar</a></li>
                            {{-- <li>
                                @if ($supplier)
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
                            </li> --}}
                        </ul>
                    </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
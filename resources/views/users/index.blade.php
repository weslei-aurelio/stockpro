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
    <div class="container mt-5 d-flex justify-content-end">
        <a href="{{ route('users.create') }}" class="btn btn-primary">Novo usuário</a>
    </div>
    <div class="container mt-5">
        <h1><strong>Usuários</strong></h1>
        <table class="table custom_table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nome</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Status</th>
                    <th scope="col">Ação</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($users as $user)
                <tr>
                    <th scope="row">{{ $user->id }}</th>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <th scope="col">{{ $user->status?->name ?? 'Sem status' }}</th>
                    <td>
                        <a 
                            href="/users/{{ $user->id }}" 
                            class="btn btn-primary btn-sm">
                            Editar
                        </a>
                        @if ($user->status_id == 1)
                            <form 
                                action="{{ url('users/' . $user->id . '/inactivate') }}" 
                                method="POST" 
                                style="display:inline;"
                            >
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Inativar</button>
                            </form>
                        @else
                            <form 
                                action="{{ url('users/' . $user->id . '/activate') }}" 
                                method="POST" 
                                style="display:inline;"
                            >
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm">Ativar</button>
                            </form>
                        @endif  
                    </td>
                </tr>
@endforeach
            </tbody>
        </table>
    </div>
@endsection

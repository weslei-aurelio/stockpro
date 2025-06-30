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
                    <input  
                        class="form-control me-2 navbar-brand" 
                        type="text" 
                        name="keyword"
                        placeholder="Nome ou e-mail" 
                        aria-label="Search"
                    />
                    <button class="btn btn-primary me-2" type="submit">
                        <svg 
                            xmlns="http://www.w3.org/2000/svg" 
                            width="16" 
                            height="16" 
                            fill="currentColor" 
                            class="bi bi-search" 
                            viewBox="0 0 16 16">
                            <path 
                                d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"
                            />
                        </svg>
                    </button>
                    @if(request('keyword') && $users->isNotEmpty())
                        <a href="/users" class="btn btn-danger" title="Limpar busca">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2z"/>
                                <path
                                    d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466"/>
                            </svg>
                        </a>
                    @endif
            </form>
        </div>

            @if(request('keyword') && $users->isEmpty())
                <div class="d-flex align-items-center gap-2 mt-3">
                    <h5 class="mb-0">
                        Nenhum usuário cadastrado com a busca <strong>{{ $keyword }}</strong>.
                    </h5>
                    <a href="/users" class="btn btn-danger" title="Limpar busca">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2z"/>
                            <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466"/>
                        </svg>
                    </a>
                </div>
            @endif

        </nav>
        <table class="table table-hover table-striped">
            <thead class="table-primary">
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
                    <td class="{{ $user->status_id == 1 ? 'text-success': 'text-danger'}}">{{ $user->status->name}}</td>
                    <td>
                        <div class="btn-group">
                            <button type="button" class="btn border-0 bg-transparent p-0" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                                <svg 
                                    xmlns="http://www.w3.org/2000/svg" 
                                    width="16" 
                                    height="16" 
                                    fill="currentColor" 
                                    class="bi bi-three-dots-vertical text-dark" 
                                    viewBox="0 0 16 16">
                                    <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0"/>
                                </svg>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-lg-start bg-info">
                                <li>
                                    <button type="button" 
                                        class="dropdown-item"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#EditUser"
                                        data-user-id="{{ $user->id }}"
                                        data-user-name="{{ $user->name }}"
                                        data-user-email="{{ $user->email }}">
                                        Editar
                                    </button>
                                </li>
                                <li>
                                    @if($user->id != auth()->user()->id)
                                         @if ($user->status_id == 1)
                                            <form action="{{ route('users.inactivate', $user->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item text-danger">Inativar</button>
                                            </form>
                                        @else
                                            <form action="{{ route('users.activate', $user->id )}}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="dropdown-item">Ativar</button>
                                            </form>
                                        @endif
                                    @endif
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $users->links() }}
    </div>
   
    @include('users.partials.create')
    @include('users.partials.edit')
    @include('layouts.components.alert')

    @if ($errors->create->any())
        <script>
            window.onload = function() {
                var newUserModal = new bootstrap.Modal(document.getElementById('NewUser'));
                newUserModal.show();
            }
        </script>
    @endif

    @if ($errors->edit->any())
        <script>
            window.onload = function() {
                var editUserModal = new bootstrap.Modal(document.getElementById('EditUser'));

                // Repõe os valores antigos
                document.getElementById('editName').value  = "{{ old('name') }}";
                document.getElementById('editEmail').value = "{{ old('email') }}";

                const form = document.getElementById('editUserForm');
                form.action = form.action.replace('__ID__', "{{ old('id') }}");

                editUserModal.show();
            }
        </script>
    @endif
@endsection

@section('scripts')
{{-- preencher os inputs da modal editar usuário --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {

        const modal = document.getElementById('EditUser');

        if (modal) {
            modal.addEventListener('show.bs.modal', function (event) {
                const button  = event.relatedTarget;
                
                const name    = button.getAttribute('data-user-name');
                const email   = button.getAttribute('data-user-email');
                const id      = button.getAttribute('data-user-id');

                document.getElementById('editName').value  = name;
                document.getElementById('editEmail').value = email;
                document.getElementById('userID').value    = id;

                const form  = document.getElementById('editUserForm');
                form.action = form.action.replace('__ID__', id);
                console.log(form.action);
            });
        }
    });
</script>
@endsection



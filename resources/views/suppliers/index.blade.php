@extends('layouts.app')

@section('title', 'Fornecedores | StockPRO')

@push('suppliers-css')
@vite('resources/scss/suppliers.scss')
@endpush

@section('content')
    @session('status')
            <div class="alert alert-success text-center" role="alert">
                {{ $value }}
            </div>
        @endsession
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1><strong>Fornecedores</strong></h1>
            <button type="button" class="btn btn-primary text-white mb-4" data-bs-toggle="modal" data-bs-target="#NewSupplier">
                Cadastrar Fornecedor
            </button>
        </div>
    </div>
    <div class="container mt-5">
        <nav class="navbar">
            <div class="container-fluid">
                <form class="d-flex" role="search">
                <input class="form-control me-2 navbar-brand" 
                        type="text"
                        name="keyword" 
                        placeholder="Fornecedor" 
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
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                        </svg>
                    </button>
                    @if(request('keyword') && $suppliers->isNotEmpty())
                        <a href="/suppliers" class="btn btn-danger" title="Limpar busca">
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

            @if(request('keyword') && $suppliers->isEmpty())
                <div class="d-flex align-items-center gap-2 mt-3">
                    <h4 class="mb-0">
                        Nenhum fornecedor cadastrado com a busca <strong>{{ $keyword }}</strong>.
                    </h4>
                    <a href="/suppliers" class="btn btn-danger" title="Limpar busca">
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
                    <th scope="col">Nome / Razão Social</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Telefone</th>
                    <th scope="col">Status</th>
                    <th scope="col">Ação</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($suppliers as $supplier)
                    <tr>
                        <td>{{ $supplier->name }}</td>
                        <td>{{ $supplier->email }}</td>
                        <td>{{ $supplier->phone }}</td>
                        @if($supplier->status_id == 1)
                            <td class="text-success">{{ $supplier->status->name }}</td>
                        @else
                            <td class="text-danger">{{ $supplier->status->name }}</td>
                        @endif
                        <td>
                            <div class="btn-group dropup">
                        <button type="button" class="btn border-0 bg-transparent p-0" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots-vertical text-dark" viewBox="0 0 16 16">
                                <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0"/>
                            </svg>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-lg-start bg-info">
                            <li>
                                <button type="button"
                                    class="dropdown-item"
                                    data-bs-toggle="modal"
                                    data-bs-target="#EditSuppliers"
                                    data-supplier-id="{{ $supplier->id }}"
                                    data-supplier-name="{{ $supplier->name }}"
                                    data-supplier-email="{{ $supplier->email }}"
                                    data-supplier-phone="{{ $supplier->phone }}"
                                    data-supplier-observation="{{ $supplier->observation }}">
                                        Editar
                                </button>
                            </li>
                            <li>
                                @if ($supplier->status_id == 1)
                                    <form action="{{ route('suppliers.inactivate', $supplier->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="dropdown-item text-danger">Inativar</button>
                                    </form>
                                @else
                                    <form action="{{ route('suppliers.activate', $supplier->id )}}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-success">Ativar</button>
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
            {{ $suppliers->links() }}
    </div>

@include('suppliers.partials.create')
@include('suppliers.partials.edit')
@include('layouts.components.alert')

@section('scripts')

    @if ($errors->any())
        <script>
            window.onload = function() {
                var newUserModal = new bootstrap.Modal(document.getElementById('NewSupplier'));
                newUserModal.show();
            }
        </script>
    @endif


   @if ($errors->edit->any())
<script>
    window.onload = function() {
        var editModal = new bootstrap.Modal(document.getElementById('EditSuppliers'));

        document.getElementById('editName').value = "{{ old('name') }}";
        document.getElementById('editEmail').value = "{{ old('email') }}";
        document.getElementById('editPhone').value = "{{ old('phone') }}";
        document.getElementById('editObservation').value = "{{ old('observation') }}";
        document.getElementById('supplierID').value = "{{ old('id') }}";

        const form = document.getElementById('editSuppliersForm');
        form.action = form.action.replace('__ID__', "{{ old('id') }}");

        editModal.show();
    };
</script>
@endif



<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modal = document.getElementById('EditSuppliers');

        if (modal) {
            modal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;

                // Recupera os dados dos atributos do botão
                const id = button.getAttribute('data-supplier-id');
                const name = button.getAttribute('data-supplier-name');
                const email = button.getAttribute('data-supplier-email');
                const phone = button.getAttribute('data-supplier-phone');
                const observation = button.getAttribute('data-supplier-observation');

                // Preenche os campos
                document.getElementById('supplierID').value = id;
                document.getElementById('editName').value = name;
                document.getElementById('editEmail').value = email;
                document.getElementById('editPhone').value = phone;
                document.getElementById('editObservation').value = observation;

                // Atualiza a rota de edição com o ID correto
                const form = document.getElementById('editSuppliersForm');
                form.action = form.action.replace('__ID__', id);
            });
        }
    });
</script>

@endsection

@endsection
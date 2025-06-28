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
                <input class="form-control me-2 navbar-brand" 
                    type="text"
                    name="keyword" 
                    placeholder="Procurar" 
                    aria-label="Search"
                />
                <button class="btn btn-primary me-2" type="submit">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                    </svg>
                </button>
                @if(request('keyword'))
                    <a href="/brands" class="btn btn-danger">
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
        <thead class=table-primary>
            <tr>
                <th scope="col">Marca</th>
                <th scope="col">Status</th>
                <th scope="col">Ação</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($brands as $brand)
                <tr>
                    <td>{{ $brand->name }}</td>
                    @if($brand->status_id == 1)
                        <td class="text-success">{{ $brand->status->name }}</td>
                    @else
                        <td class="text-danger">{{ $brand->status->name }}</td>
                    @endif
                    <td>
                        <div class="btn-group">
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
                                            data-bs-target="#EditBrands"
                                            data-categories-id="{{ $brand->id }}"
                                            data-categories-name="{{ $brand->name }}">
                                                Editar
                                        </button>
                                    </li>
                                @if ($brand->status_id == 1)
                                    <form action="{{ route('brands.inactivate', $brand->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="dropdown-item text-danger">Inativar</button>
                                    </form>
                                    @else
                                    <form action="{{ route('brands.activate', $brand->id )}}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-success">Ativar</button>
                                    </form>
                                    @endif
                            </ul>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
        {{ $brands->links() }}
</div>
    @include('brands.partials.create')
    @include('brands.partials.edit')
    @include('layouts.components.alert')
    
@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('EditBrands');

    if (modal) {
        modal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;

            const name = button.getAttribute('data-brands-name');
            const id = button.getAttribute('data-brands-id');

            // Preenche os inputs da modal
            document.getElementById('editName').value = name;
            document.getElementById('brandsID').value = id;

            // Atualiza a action do form
            const form = document.getElementById('editBrandsForm');
            form.action = form.action.replace('__ID__', id);
        });
    }
});
</script>
@endsection

@endsection
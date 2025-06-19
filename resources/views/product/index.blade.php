@extends('layouts.app')

@section('title', 'Produtos | StockPRO')

@push('products-css')
    @vite('resources/scss/products.scss')
@endpush

@section('content')
@include('layouts.components.alert')
<div class="container mt-5">
        @session('status')
            <div class="alert alert-success text-center" role="alert">
                {{ $value }}
            </div>
        @endsession
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1>
                <strong>Produtos</strong>
            </h1>
            <button type="button" class="btn btn-primary text-white mb-4 custom-button" data-bs-toggle="modal" data-bs-target="#NewProduct">
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
    <table class="table custom-table">
        <thead>
            <tr>
                <th scope="col">Descrição</th>
                <th scope="col">Categoria</th>
                <th scope="col">Preço</th>
                <th scope="col">Estoque</th>
                <th scope="col">Status</th>
                <th scope="col">Ação</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->category->name }}</td>
                    <td>{{ $product->salePrice}}</td>
                    <td>{{ $product->numberUnits }}</td>
                     <td>Pendente</td>
                    <td>
                        <div class="btn-group dropup">
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
                                     <button
                                        class="dropdown-item"
                                        data-bs-toggle="modal"
                                        data-bs-target="#EditProduct"
                                        data-id="{{ $product->id }}"
                                        data-description="{{ $product->description }}"
                                        data-brand="{{ $product->brand_id }}"
                                        data-category="{{ $product->category_id }}"
                                        data-purchaseValue="{{ $product->purchaseValue }}"
                                        data-salePrice="{{ $product->salePrice }}"
                                        data-profitMargin="{{ $product->profitMargin }}"
                                        data-numberUnits="{{ $product->numberUnits }}"
                                    >
                                    Editar
                                    </button>
                                </li>
                                <li>
                                  <a href="#" class="dropdown-item">Inativar</a>
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
@include('product.partials.create')
@include('product.partials.edit')
@endsection

@section('scripts')
  <script>
    document.addEventListener('DOMContentLoaded', function () {
        const modal = document.getElementById('EditProduct');

        if (modal) {
            modal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;

                const id            = button.getAttribute('data-id');
                const description   = button.getAttribute('data-description');
                const brand         = button.getAttribute('data-brand');
                const category      = button.getAttribute('data-category');
                const purchaseValue = button.getAttribute('data-purchaseValue');
                const salePrice     = button.getAttribute('data-salePrice');
                const profitMargin  = button.getAttribute('data-profitMargin');
                const numberUnits   = button.getAttribute('data-numberUnits');

                // Preenche os campos da modal
                document.getElementById('EditDescription').value   = description;
                document.getElementById('editBrand').value         = brand;
                document.getElementById('editCategory').value      = category;
                document.getElementById('editPurchaseValue').value = purchaseValue;
                document.getElementById('editSalePrice').value     = salePrice;
                document.getElementById('editProfitMargin').value  = profitMargin;
                document.getElementById('editNumberUnits').value   = numberUnits;

                // Atualiza o action do formulário
                const form  = document.getElementById('editProductForm');
                const teste = form.action = `/products/${id}/edit`;
            });
        }
    });
</script>
@endsection

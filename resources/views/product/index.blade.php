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
        <h1><strong>Produtos</strong></h1>
        <button type="button" class="btn btn-primary text-white mb-4 custom-button" data-bs-toggle="modal" data-bs-target="#NewProduct">
            + Novo Produto
        </button>
    </div>
    <nav class="navbar">
        <div class="container-fluid">
            <form action="{{ route('products.index') }}" method="GET" class="d-flex" role="search">
                <input 
                    class="form-control me-2 navbar-brand" 
                    type="text"
                    name="keyword"
                    placeholder="Nome do produto" 
                    aria-label="Search"
                />
                <button class="btn btn-primary" type="submit">
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
                @if(request('keyword') && $products->isNotEmpty())
                        <a href="/products" class="btn btn-danger" title="Limpar busca">
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

            @if(request('keyword') && $products->isEmpty())
                <div class="d-flex align-items-center gap-2 mt-3">
                    <h4 class="mb-0">
                        Nenhum fornecedor cadastrado com a busca <strong>{{ $keyword }}</strong>.
                    </h4>
                    <a href="/products" class="btn btn-danger" title="Limpar busca">
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
                    <td>R$ {{ money_mask($product->salePrice) }}</td>
                    <td>{{ $product->numberUnits }}</td>
                    <td class="{{ $product->status_id == 1 ? 'text-success': 'text-danger'}}">{{ $product->status->name }}</td>
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
                                    <button
                                        class="dropdown-item"
                                        data-bs-toggle="modal"
                                        data-bs-target="#EditProduct"
                                        data-id="{{ $product->id }}"
                                        data-description="{{ $product->description }}"
                                        data-brand="{{ $product->brand_id }}"
                                        data-category="{{ $product->category_id }}"
                                        data-purchaseValue="{{ money_mask($product->purchaseValue) }}"
                                        data-salePrice="{{ money_mask($product->salePrice) }}"
                                        data-profitMargin="{{ money_mask($product->profitMargin) }}"
                                        data-numberUnits="{{ $product->numberUnits }}"
                                    >
                                        Editar
                                    </button>
                                </li>
                                <li>
                                    @if ($product->status_id == 1)
                                    <form action="{{ route('products.inactivate', $product->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="dropdown-item text-danger">Inativar</button>
                                    </form>
                                    @else
                                    <form action="{{ route('products.activate', $product->id )}}" method="POST" class="d-inline">
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
    {{ $products->links() }}
</div>

@include('product.partials.create')
@include('product.partials.edit')

@if ($errors->create->any())
    <script>
        window.onload = function() {
            var NewProductModel = new bootstrap.Modal(document.getElementById('NewProduct'));

            NewProductModel.show();
        }
    </script>
@endif

@if ($errors->edit->any())
    <script>
        window.onload = function() {
            var EditProduct = new bootstrap.Modal(document.getElementById('EditProduct'));

            document.getElementById('EditDescription').value    = "{{ old('description') }}"
            document.getElementById('editBrand').value          = "{{ old('brand_id') }}"
            document.getElementById('editCategory').value       = "{{ old('category_id') }}"
            document.getElementById('editPurchaseValue').value  = "{{ old('purchaseValue') }}"
            document.getElementById('editSalePrice').value      = "{{ old('salePrice') }}"
            document.getElementById('editProfitMargin').value   = "{{ old('profitMargin') }}"
            document.getElementById('editNumberUnits').value    = "{{ old('numberUnits') }}"

            const form = document.getElementById('editProductForm');
            form.action = form.action.replace('__ID__', "{{ old('id') }}");

            EditProduct.show();
        }
    </script>
@endif
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

                document.getElementById('productID').value         = id;
                document.getElementById('EditDescription').value   = description;
                document.getElementById('editBrand').value         = brand;
                document.getElementById('editCategory').value      = category;
                document.getElementById('editPurchaseValue').value = purchaseValue;
                document.getElementById('editSalePrice').value     = salePrice;
                document.getElementById('editProfitMargin').value  = profitMargin;
                document.getElementById('editNumberUnits').value   = numberUnits;

                const form  = document.getElementById('editProductForm');
                form.action = form.action.replace('__ID__', id);
                form.action = `/products/${id}/edit`;
            });
        }
    });
</script>
@endsection

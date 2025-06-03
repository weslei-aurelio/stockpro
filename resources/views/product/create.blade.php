@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Cadastro de produto</h1>
        <form action="{{ route('products.create') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="brands">
                    Descrição do produto
                </label>
                <input 
                    type="text"
                    name="description"
                    class="form-control"
                    value="{{ old('description') }}"
                    placeholder="Ex: Cerveja Amstel 350ml"
                >
            </div>
            <div class="mb-3">
                <label for="brand">
                    Marca do produto
                </label>
                <select name="brand" id="brand">
                    <option value="" selected="">Marca</option>
                    @foreach ($brands as $brand)
                        <option value="{{ $brand->id }}"> {{$brand->name}} </option>
                    @endforeach
                </select>
            </div>
             <div class="mb-3">
                <label for="categories">
                    Tipo de produto
                </label>
                <select name="category" id="category">
                    <option value="" selected="">Produto</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"> {{$category->name}} </option>
                    @endforeach
                </select>
            </div>
             <div class="mb-3">
                <label for="purchaseValue">
                    Valor de compra (unidade)
                </label>
                <input 
                    type="text"
                    name="purchaseValue"
                    class="form-control money"
                    value="{{ old('purchaseValue') }}"
                    placeholder="0,00"
                >
            </div>
            <div class="mb-3">
                <label for="salePrice">
                    Valor de venda (unidade)
                </label>
                <input 
                    type="text"
                    name="salePrice"
                    class="form-control money"
                    value="{{ old('salePrice') }}"
                    placeholder="0,00"
                >
            </div>
            <div class="mb-3">
                <label for="profitMargin">
                    % de margem desejada (unidade)
                </label>
                <input 
                    type="text"
                    name="profitMargin"
                    class="form-control percent"
                    value="{{ old('profitMargin') }}"
                    placeholder="Ex: 25,00"
                >
            </div>
             <div class="mb-3">
                <label for="numberUnits">
                    Quantidade de unidades
                </label>
                <input 
                    type="number"
                    name="numberUnits"
                    class="form-control"
                    value="{{ old('numberUnits') }}"
                    placeholder="Ex: 200"
                >
            </div>
            <button class="btn btn-primary text-white">Cadastrar produto</button>
        </form>
    </div>
@endsection


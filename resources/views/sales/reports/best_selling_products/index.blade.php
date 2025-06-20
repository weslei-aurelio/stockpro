@extends('layouts.app')

@section('title', 'Produtos Mais Vendidos | StockPRO')

@section('content')
    <div class="container my-3">
        <x-date-range-filter action="/best-selling-products" />
    </div>
    <div class="container mt-4">
        <h1>Produtos mais vendidos</h1>
        <div class="container mt-4">
            <table class="table table-bordered table-striped table-hover">
            <thead class="table-primary">
                <tr>
                    <th scope="col">Código do produto</th>
                    <th scope="col">Produto</th>
                    <th scope="col">Unidades vendidas</th>
                    <th scope="col">Porcetagem de lucro</th>
                    <th scope="col">Lucro liquido</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <th>{{ $product->product_id }}</th>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->total_vendido }}</td>
                        <td>{{ number_format($product->profitMargin, 2, ',', '.') }}%</td>
                        <td class="text-success">R$ {{ number_format($product->lucro_total, 2, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
            </table>
        </div>
    </div>
@endsection
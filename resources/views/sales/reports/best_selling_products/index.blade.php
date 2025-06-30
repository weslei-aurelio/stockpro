@extends('layouts.app')

@section('title', 'Produtos Mais Vendidos | StockPRO')

@section('content')
    <div class="container mt-4">
        <div class="row align-items-center mb-5">
        <div class="col-md-6 d-flex align-items-center">
        <h1 class="m-0">Produtos mais vendidos</h1>
        </div>
            <div class="col-md-6 d-flex justify-content-end">
            </div>
        </div>
        <div class="container mt-4">
            <table class="table table-bordered table-striped table-hover">
            <thead class="table-primary">
                <tr class="text-center">
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
                        <td>{{ $product->product_id }}</th>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->total_vendido }}</td>
                        <td>{{ number_format($product->profitMargin, 2, ',', '.') }}%</td>
                        <td class="text-success">R$ {{ number_format($product->lucro_total, 2, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
            </table>
            {{ $products->links() }}
        </div>
    </div>
@endsection
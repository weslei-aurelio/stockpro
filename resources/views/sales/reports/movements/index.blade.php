@extends('layouts.app')

@section('content')
    <div class="container-fluix bg-dark text-white">
        <p class="text-center">Aqui será criado a parte dos filtros</p>
    </div>
    <div class="container mt-4">
        <h1>Relatório de movimentação</h1>
        <div class="container mt-4">
            <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th scope="col">Data de venda</th>
                    <th scope="col">Produto</th>
                    <th scope="col">Quantidade</th>
                    <th scope="col">Valor de compra</th>
                    <th scope="col">Valor de venda</th>
                    <th scope="col">Lucro sobre a venda</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($itens as $item)
                    <tr>
                    <th>{{ $item->sale->sale_date }}</th>
                    <td>{{ $item->product->description }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->product->purchaseValue }}</td>
                    <td>{{ $item->unit_value }}</td>
                    <td>
                        R$ {{ number_format(($item->unit_value - $item->product->purchaseValue) * $item->quantity, 2, ',', '.') }}
                    </td>
                </tr>
                @endforeach
            </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5" class="text-end"><strong>Total:</strong></td>
                        <td class="text-danger"><strong>R$ {{ number_format($totalLucro, 2, ',', '.') }}</strong></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection
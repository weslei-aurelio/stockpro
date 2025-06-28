@extends('layouts.app')

@section('title', 'Relatório de Movimentação | StockPRO')

@section('content')
    <div class="container mt-4">
        <div class="row align-items-center mb-5">
            <div class="col-md-6">
                <h1 class="m-0">Relatório de movimentação</h1>
            </div>
            <div class="col-md-3 offset-md-3">
                <input type="text" id="periodo" class="date-picker form-control" placeholder="Período">
            </div>
        </div>
            <table class="table table-bordered table-striped table-hover">
            <thead class="table-primary ">
                <tr class="text-center">
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
                    <td>{{ formatDate($item->sale->sale_date) }}</td>
                    <td>{{ $item->product->description }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>R$ {{ money_mask($item->product->purchaseValue) }}</td>
                    <td>R$ {{ money_mask($item->unit_value) }}</td>
                    <td>
                        R$ {{ number_format(($item->unit_value - $item->product->purchaseValue) * $item->quantity, 2, ',', '.') }}
                    </td>
                </tr>
                @endforeach
            </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5" class="text-end"><strong>Total:</strong></td>
                        <td class="text-success"><strong>R$ {{ number_format($totalLucro, 2, ',', '.') }}</strong></td>
                    </tr>
                </tfoot>
            </table>
            {{ $itens->links() }}
    </div>
@endsection
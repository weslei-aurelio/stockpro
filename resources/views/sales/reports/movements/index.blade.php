@extends('layouts.app')

@section('title', 'Relatório de Movimentação | StockPRO')

@push('index-css')
    @vite('resources/scss/index.scss')
@endpush

@section('content')
    @session('status')
        <div class="alert alert-success text-center" role="alert">
            {{ $value }}
        </div>
    @endsession
    <div class="container mt-4">
        <div class="row align-items-center mb-5">
        <div class="col-md-6 d-flex align-items-center">
        <h1 class="m-0">Relatório de movimentação</h1>
        </div>
            <div class="col-md-6 d-flex justify-content-end">
                <form id="form-search" action="{{ route('movementReport.index') }}" method="GET" class="d-flex">
                    <input type="hidden" name="inicio" value="{{ date_mask(Request::get('inicio')) }}" />
                    <input type="hidden" name="fim" value="{{ date_mask(Request::get('fim')) }}" />
                    <input type="text" id="periodo" name="periodo" class="form-control" placeholder="Período" value="{{ old('periodo') }}" style="min-width: 229px;">
                </form>
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
        @if ($itens instanceof \Illuminate\Pagination\LengthAwarePaginator || $itens instanceof \Illuminate\Pagination\Paginator)
            {{ $itens->links() }}
        @endif
    </div>
    @include('layouts.components.alert')
@endsection

@push('scripts')
<script>
    $(function(){
    flatpickr("#periodo", {
        static: true,
        mode: "range",
        locale: "pt",
        dateFormat: "d/m/Y",
        onValueUpdate: function(dObj, dStr, fp, dayElem){
            if(dObj.length > 1){
                $('#form-search').submit();
            }
        },
        @if(isset($inicio) && isset($fim))
            defaultDate: [$('[name="inicio"]').val(), $('[name="fim"]').val()]
        @endif
        });
    });
</script>
@endpush
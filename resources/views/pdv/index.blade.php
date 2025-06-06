@extends('layouts.app')

@section('title', 'PDV | StockPRO')

@section('content')

<div class="container">
    <div>
        <h1>
            PDV
        </h1>
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
    <form action="" method="POST">
    @csrf
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Item</th>
                <th scope="col">Descrição</th>
                <th scope="col">Quantidade</th>
                <th scope="col">Unidade</th>
                <th scope="col">Preço (R$)</th>
                <th scope="col">Total (R$)</th>
            </tr>
        </thead>

        <tbody>
            <!-- Seção para desenvolvimento Back-End (Responsabilidade: Weslei) -->
            <tr>
                <th scope="row">1</th>
                <td>Whisky Passaport 1L</td>
                <td>2</td>
                <td>UN</td>
                <td>R$ 60,50</td>
                <td>R$ 121,00</td>
            </tr>
            <!-- Repita os demais itens como necessário -->
        </tbody>

        <tfoot>
            <tr>
                <th>Quantidade <small class="d-block text-muted">Itens Comprados</small></th>
                <th>Preço <small class="d-block text-muted">Valor Unitário</small></th>
                <th>Total Item <small class="d-block text-muted">Valor Unitário + Quantidade</small></th>
                <th>Total Compra <small class="d-block text-muted">Valor Total</small></th>
                <th colspan="2"></th>
            </tr>
            <tr>
                <td colspan="6" class="text-end">
                    <a href="/pdv" class="text-decoration-none text-dark">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Finalizar Compra</button>
                </td>
            </tr>
        </tfoot>
    </table>
</form>
</div>

@endsection
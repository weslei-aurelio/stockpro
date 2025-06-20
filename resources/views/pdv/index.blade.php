@extends('layouts.app')

@section('title', 'PDV | StockPRO')

@push('pdv-css')
@vite('resources/scss/pdv.scss')
@endpush

@section('content')
<div class="d-flex justify-content-center align-items-center">
    <div class="container py-4 bg-pdv">
        <h1 class="text-primary text-center">PDV</h1>
    <!-- Pesquisa -->
    <div class="container col-md-6 mb-3">
        <label for="search" class="form-label"></label>
        <input type="text" class="form-control" id="search-product" placeholder="Selecione o Produto...">
        <div id="suggestions" class="list-group"></div>
    </div>
    <!-- Produto Selecionado -->
    <div class="row align-items-end mb-3">
        <div class="col-md-6">
            <label for="selectedProduct" class="form-label"></label>
            <input type="text" class="form-control" id="selectedProduct" placeholder="Ex: Cerveja Brahma">
            <input type="hidden" id="selectedProductId">
        </div>
        <div class="col-md-3">
            <label for="quantity" class="form-label">Quantidade</label>
            <input type="number" class="form-control" id="quantity" min="1" value="1">
        </div>
        <div class="col-md-3">
            <button class="btn btn-primary w-100 text-white" id="adicionarItemLista">Adicionar</button>
        </div>
    </div>
    <!-- Lista de Produtos -->
    <table class="table table-striped" id="tabelaProdutos">
        <thead>
        <tr>
            <th>Produto</th>
            <th>Qtd</th>
            <th>Valor Unitário</th>
            <th>Total Item</th>
        </tr>
        </thead>
        <tbody>
            
        </tbody>
        <tfoot>
        <tr>
            <th colspan="3" class="text-end">Total Geral</th>
            <th id="totalGeral">R$ 0,00</th>
        </tr>
        </tfoot>
    </table>
    <div class="text-end">
        <button class="btn btn-success" id="btnFinalizar">Finalizar Venda</button>
    </div>
</div>
</div>

@include('layouts.components.alert')

@endsection

@section('scripts')
    <script>
        
        // mascára valor monetário
        let money_mask = new Intl.NumberFormat('pt-BR', {
            style: 'currency',
            currency: 'BRL'
        });

        // Evento para realizar a busca do produto no banco de dados
        $('#search-product').on('input', function() {
            let query = $(this).val();
            if(query.length >= 2) { // pesquisa a partir de 2 caracteres
                $.ajax({
                    url: '/search-products',
                    method: 'GET',
                    data: { searchTerm: query },
                    success: function(data) {
                        $('#suggestions').empty();
                        data.forEach(product => {
                            $('#suggestions').append(
                                `<a href="#" class="list-group-item list-group-item-action" 
                                    data-id="${product.id}" 
                                    data-description="${product.description}"
                                    data-sale-price="${product.salePrice}">
                                    ${product.description}
                                </a>`
                            );
                        });
                    }
                });
            } else {
                $('#suggestions').empty();
            }
        });

        // Evento de clique na sugestão
        $('#suggestions').on('click', '.list-group-item', function(e) {
            e.preventDefault();
            
            // Pega os dados do item clicado
            let productId           = $(this).data('id');
            let productDescription  = $(this).data('description');
            let salePrice           = parseFloat($(this).data('salePrice'));
            console.log(salePrice);
            
            // Preenche o input de produto selecionado
            $('#selectedProduct').val(productDescription);
            $('#selectedProductId').val(productId);
            $('#selectedProduct').data('salePrice', salePrice);
            
            // Limpa as sugestões
            $('#suggestions').empty();
        });

        let vendaItens = [];
        let totalGeral = 0;

        $('#adicionarItemLista').on('click', function() {
            let id = $('#selectedProductId').val();
            let description = $('#selectedProduct').val();
            let quantity = parseInt($('#quantity').val());
            let salePrice = parseFloat($('#selectedProduct').data('salePrice'));

            if (!id || !description || quantity <= 0) {
                alert("Preencha corretamente o produto e a quantidade.");
                return;
            }

            let totalItem = salePrice * quantity;

            // Adiciona na lista de venda
            vendaItens.push({
                id: id,
                description: description,
                quantity: quantity,
                salePrice: salePrice,
                totalItem: totalItem
            });

            // Adiciona na tabela visual
            $('#tabelaProdutos tbody').append(`
                <tr data-id="${id}">
                    <td>${description}</td>
                    <td>${quantity}</td>
                    <td>${money_mask.format(salePrice)}</td>
                    <td>${money_mask.format(totalItem)}</td>
                    <td><button class="btn btn-danger btn-sm btn-remover">Remover</button></td>
                </tr>
            `);

            // Atualiza o total geral
            totalGeral += totalItem;
            $('#totalGeral').text(money_mask.format(totalGeral));

            // Limpa os campos para nova entrada
            $('#selectedProductId').val('');
            $('#selectedProduct').val('');
            $('#quantity').val(1);
        });

        // Remove itens da lista e atualiza o total da venda
        $('#tabelaProdutos').on('click', '.btn-remover', function() {
            let linha = $(this).closest('tr');

            // Recupera o total desse item
            let totalItemTexto = linha.find('td').eq(3).text();
            let totalItem = parseFloat(totalItemTexto.replace("R$", "").replace(".", "").replace(",", "."));

            // Atualiza o total geral
            totalGeral -= totalItem;
            $('#totalGeral').text(money_mask.format(totalGeral));

            // Remove a linha visualmente
            linha.remove();

            let idItem = linha.data('id');
            vendaItens = vendaItens.filter(item => item.id != idItem);
            console.log(vendaItens);

        });

        $('#btnFinalizar').on('click', function() {

            console.log(JSON.stringify({
                items: vendaItens,
                total: totalGeral
            }));

            $.ajax({
                url: '/sales',
                method: 'POST',
                contentType: 'application/json',
                data: JSON.stringify({
                    items: vendaItens,
                    total: totalGeral
                }),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(resposta) {
                    alert('Venda realizada com sucesso!');
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });

        });

    </script>
@endsection
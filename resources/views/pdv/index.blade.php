@extends('layouts.app')

@section('content')
    <div class="container py-4">
    <!-- Pesquisa -->
    <div class="mb-3">
        <label for="search" class="form-label">🔍 Pesquisa Produto</label>
        <input type="text" class="form-control" id="search-product" placeholder="Digite o produto...">
        <div id="suggestions" class="list-group"></div>
    </div>
    <!-- Produto Selecionado -->
    <div class="row align-items-end mb-3">
        <div class="col-md-6">
            <label for="selectedProduct" class="form-label">Produto Selecionado</label>
            <input type="text" class="form-control" id="selectedProduct" placeholder="Ex: Cerveja Brahma">
            <input type="hidden" id="selectedProductId">
        </div>
        <div class="col-md-3">
            <label for="quantity" class="form-label">Quantidade</label>
            <input type="number" class="form-control" id="quantity" min="1" value="1">
        </div>
        <div class="col-md-3">
            <button class="btn btn-primary w-100" id="adicionarItemLista">Adicionar</button>
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
    <!-- Finalizar Venda -->
    <div class="text-end">
        <button class="btn btn-success">Finalizar Venda</button>
    </div>
</div>
@endsection

@section('scripts')
    <script>

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
                                    data-description="${product.description}">
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
            let productId = $(this).data('id');
            let productDescription = $(this).data('description');
            
            // Preenche o input de produto selecionado
            $('#selectedProduct').val(productDescription);
            $('#selectedProductId').val(productId);
            
            // Limpa as sugestões
            $('#suggestions').empty();
        });

        let vendaItens = [];
        let totalGeral = 0;

        $('#adicionarItemLista').on('click', function() {
            let id = $('#selectedProductId').val();
            let description = $('#selectedProduct').val();
            let quantity = parseInt($('#quantity').val());

            if (!id || !description || quantity <= 0) {
                alert("Preencha corretamente o produto e a quantidade.");
                return;
            }

            // Exemplo fixo de preço (vamos depois puxar isso do banco, mas agora é só para teste)
            let precoUnitario = 5.00; // valor fictício temporário
            let totalItem = precoUnitario * quantity;

            // Adiciona na lista de venda
            vendaItens.push({
                id: id,
                description: description,
                quantity: quantity,
                precoUnitario: precoUnitario,
                totalItem: totalItem
            });

            // Adiciona na tabela visual
            $('#tabelaProdutos tbody').append(`
                <tr>
                    <td>${description}</td>
                    <td>${quantity}</td>
                    <td>R$ ${precoUnitario.toFixed(2)}</td>
                    <td>R$ ${totalItem.toFixed(2)}</td>
                </tr>
            `);

            // Atualiza o total geral
            totalGeral += totalItem;
            $('#totalGeral').text("R$ " + totalGeral.toFixed(2));

            // Limpa os campos para nova entrada
            $('#selectedProductId').val('');
            $('#selectedProduct').val('');
            $('#quantity').val(1);
        });

    </script>
@endsection
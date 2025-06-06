<div class="modal fade" id="NewProduct" tabindex="-1" role="dialog" aria-labellebdy="NewProduct" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-fullscreen-xl-down" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">
                    <strong>
                        Novo Produto
                    </strong>
                </h2>
                <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('products.create') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="brands">
                            Descrição
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
                        <label for="brand" class="form-label">Marca</label>
                        <div class="d-flex align-items-center gap-2">
                                <select class="form-select" name="brand" id="brand">
                                <option selected>Selecione</option>
                                @foreach ($brands as $brand)
                                      <option value="{{ $brand->id }}"> {{$brand->name}} </option>
                                @endforeach
                                </select>
                            <a href="{{ route('brands.create') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#000000" class="bi bi-plus-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="categories" class="form-label">Tipo</label>
                        <div class="d-flex align-items-center gap-2">
                            <select class="form-select" name="category" id="category">
                                <option selected>Selecione</option>
                                @foreach ($categories as $category)
                                       <option value="{{ $category->id }}"> {{$category->name}} </option>
                                @endforeach
                                </select>
                                </select>
                                <a href="{{ route('categories.create') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#000000" class="bi bi-plus-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
                                </svg>
                                </a>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="purchaseValue">
                            Valor de compra (unidade)
                        </label>
                        <input
                            id="purchaseValue"
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
                            id="salePrice"
                            type="text"
                            name="salePrice"
                            class="form-control money"
                            value="{{ old('salePrice') }}"
                            placeholder="0,00"
                        >
                    </div>
                    <div class="mb-3">
                        <label for="profitMargin">
                            Lucro Desejado (%)
                        </label>
                        <input
                            id="profitMargin"
                            type="text"
                            name="profitMargin"
                            class="form-control percent"
                            value="{{ old('profitMargin') }}"
                            placeholder="Ex: 25,00"
                        >
                    </div>
                    <div class="mb-3">
                        <label for="numberUnits">
                            Quantidade
                        </label>
                        <input
                            type="number"
                            name="numberUnits"
                            class="form-control"
                            value="{{ old('numberUnits') }}"
                            placeholder="Ex: 200"
                        >
                    </div>
                </form>
                <div class="modal-footer">
                    <a href="/products" class="text-decoration-none text-dark">Cancelar</a>
                    <button type="submit" class="btn btn-primary text-white custom-button-create">Salvar</button>
                </div>
            </div>
        </div>
    </div> 
</div>       

<script>
    document.addEventListener('DOMContentLoaded', function () {

        const costInput = document.getElementById('purchaseValue');
        const saleInput = document.getElementById('salePrice');
        const marginInput = document.getElementById('profitMargin');

        function parseValue(value) {
            return parseFloat(value.replace(/\./g, '').replace(',', '.')) || 0;
        }

        function formatCurrency(value) {
            return value.toFixed(2).replace('.', ',');
        }

        // Atualiza margem (de lucro) com base no valor de venda
        saleInput.addEventListener('blur', function () {
            const cost = parseValue(costInput.value);
            const sale = parseValue(saleInput.value);

            if (cost > 0 && sale > 0) {
                // margem = ((venda - custo) / venda) * 100
                const margin = ((sale - cost) / sale) * 100;
                marginInput.value = formatCurrency(margin);
            }
        });

        // Atualiza valor de venda com base na margem (de lucro)
        marginInput.addEventListener('blur', function () {
            const cost = parseValue(costInput.value);
            const margin = parseValue(marginInput.value);

            if (cost > 0 && margin > 0 && margin < 100) {
                // venda = custo / (1 - margem/100)
                const sale = cost / (1 - (margin / 100));
                saleInput.value = formatCurrency(sale);
            }
        });
    });
</script>


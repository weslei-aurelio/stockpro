<div class="modal fade" id="EditCategories" tabindex="-1" role="dialog" aria-labelledby="EditCategories" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-fullscreen-xl-down" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">
                    <strong>Editar categoria</strong>
                </h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form action="{{ route('categories.update', '__ID__') }}" method="POST" id="editCategoriesForm">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" id="categoriesID">

                    <div class="form-floating mb-3">
                        <input
                            type="text"
                            name="name"
                            class="form-control @error('name', 'edit') is-invalid @enderror"
                            id="editName"
                            placeholder="Nome da Categoria"
                            value="{{ old('name') }}"
                        >
                        <label for="editName">Nome da Categoria</label>
                        @error('name', 'edit')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="modal-footer">
                        <a href="/categories" class="text-decoration-none text-dark">
                            Cancelar
                        </a>
                        <button type="submit" class="btn btn-primary text-white custom-button-create">
                            Atualizar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="NewCategories" tabindex="-1" role="dialog" aria-labelledby="NewCategories" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-fullscreen-xl-down" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title"><strong>Criar Categoria</strong></h2>
                <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('categories.store') }}" method="POST">
                    @csrf
                    <div class="form-floating mb-3">
                        <input
                            type="text"
                            id="name"
                            name="name"
                            class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name') }}"
                            placeholder="Categoria"
                        >
                        <label class="floatingInput">Categoria</label>
                        @error('name')
                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="modal-footer">
                        <a href="/categories" class="text-decoration-none text-dark" data-bs-dismiss="modal">Cancelar</a>
                        <button type="submit" class="btn btn-primary text-white custom-button-create">Criar Categoria</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
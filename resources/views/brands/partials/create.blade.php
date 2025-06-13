<div class="modal fade" id="NewBrand" tabindex="-1" role="dialog" aria-labelledby="NewBrand" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-fullscreen-xl-down" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title"><strong>Criar Marca</strong></h2>
                <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('brands.store') }}" method="POST">
                    @csrf
                    <div class="form-floating mb-3">
                        <input
                            type="text"
                            id="name"
                            name="name"
                            class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name') }}"
                            placeholder="Marca"
                        >
                        <label class="floatingInput">Marca</label>
                        @error('name')
                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="modal-footer">
                        <a href="/brands" class="text-decoration-none text-dark" data-bs-dismiss="modal">Cancelar</a>
                        <button type="submit" class="btn btn-primary text-white custom-button-create">Criar Marca</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

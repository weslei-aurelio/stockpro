<div class="modal fade" id="NewSupplier" tabindex="-1" role="dialog" aria-labelledby="NewSupplier" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-fullscreen-xl-down" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">
                    <strong>
                        Cadastrar Fornecedor
                    </strong>
                </h2>
                <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('suppliers.store') }}" method="POST">
                    @csrf
                    <div class="form-floating mb-3">
                        <input
                            type="text"
                            name="name"
                            class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name') }}"
                            placeholder="Nome Completo"
                        >
                        <label class="floatingInput">Nome / Razão Social</label>
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input
                            type="email"
                            name="email"
                            class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email') }}"
                            placeholder="Endereço de E-mail"
                        >
                        <label class="floatingInput">Endereço de E-mail</label>
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input
                            type="text"
                            name="phone"
                            class="phone form-control @error('phone') is-invalid @enderror"
                            value="{{ old('phone') }}"
                            placeholder="Telefone celular"
                        >
                        <label class="floatingInput">Telefone celular</label>
                        @error('phone')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <textarea 
                            name="observation"
                            class="form-control" 
                            placeholder="Leave a comment here" 
                            id="floatingTextarea"
                            style="height: 30%">
                        </textarea>
                        <label>Observações sobre o forncedor</label>
                    </div>
                    <div class="modal-footer">
                        <a href="/suppliers" class="text-decoration-none text-dark">Cancelar</a>
                        <button type="submit" class="btn btn-primary text-white custom-button-create">Cadastrar Fornecedor</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
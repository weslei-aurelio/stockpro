<div class="modal fade" id="EditSuppliers" tabindex="-1" role="dialog" aria-labelledby="EditSuppliers" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-fullscreen-xl-down" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">
                    <strong>Editar Fornecedor</strong>
                </h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form action="{{ route('suppliers.update', '__ID__') }}" method="POST" id="editSuppliersForm">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" id="supplierID">

                    <div class="form-floating mb-3">
                        <input
                            type="text"
                            name="name"
                            class="form-control @error('name', 'edit') is-invalid @enderror"
                            id="editName"
                            placeholder="Nome / Razão Social"
                            value="{{ old('name') }}"
                        >
                        <label for="editName">Nome / Razão Social</label>
                        @error('name', 'edit')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <input
                            type="email"
                            name="email"
                            class="form-control @error('email', 'edit') is-invalid @enderror"
                            id="editEmail"
                            placeholder="Endereço de E-mail"
                            value="{{ old('email') }}"
                        >
                        <label for="editEmail">Endereço de E-mail</label>
                        @error('email', 'edit')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <input
                            type="text"
                            name="phone"
                            class="form-control phone @error('phone', 'edit') is-invalid @enderror"
                            id="editPhone"
                            placeholder="Telefone"
                            value="{{ old('phone') }}"
                        >
                        <label for="editPhone">Telefone</label>
                        @error('phone', 'edit')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <textarea
                            name="observation"
                            class="form-control"
                            id="editObservation"
                            placeholder="Observações"
                            style="height: 30%"
                        >{{ old('observation') }}</textarea>
                        <label for="editObservation">Observações</label>
                    </div>

                    <div class="modal-footer">
                        <a href="/suppliers" class="text-decoration-none text-dark">Cancelar</a>
                        <button type="submit" class="btn btn-primary text-white custom-button-create">Atualizar Fornecedor</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

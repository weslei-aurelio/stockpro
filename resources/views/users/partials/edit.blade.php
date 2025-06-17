<div class="modal fade" id="EditUser" tabindex="-1" role="dialog" aria-labellebdy="EditUser" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-fullscreen-xl-down" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">
                    <strong>
                        Editar usuário
                    </strong>
                </h2>
                <button 
                    type="button" 
                    class="btn btn-close" 
                    data-bs-dismiss="modal" 
                    aria-label="Close"
                >
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ url('/users/__ID__/edit') }}" method="POST" id="editUserForm">
                    @csrf
                    @method('PUT')
                    <div class="form-floating mb-3">
                        <input type="hidden" name="id" value="{{ old('id') }}" id="userID">
                        <input
                            type="text"
                            name="name"
                            class="form-control @error('name', 'edit') is-invalid @enderror"
                            id="editName"
                            value="{{ old('name')}} "
                        >
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
                            value="{{ old('email') }}"
                        >
                        @error('email', 'edit')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <label class="floatingInput">Senha</label>
                        <input
                            type="password"
                            name="password"
                            class="form-control @error('password', 'edit') is-invalid @enderror"
                        >
                        @error('password', 'edit')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <label class="floatingInput">Confirmar Senha</label>
                        <input
                            type="password" 
                            name="password_confirmation" 
                            class="form-control" 
                            class="form-control @error('password', 'edit') is-invalid @enderror"
                        >
                        @error('password', 'edit')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="modal-footer">
                        <a 
                            href="/users" 
                            class="text-decoration-none text-dark">
                            Cancelar
                        </a>
                        <button 
                            type="submit" 
                            class="btn btn-primary text-white custom-button-create">
                            Atualizar
                        </button>
                    </div>
                </form>
            </div>    
        </div>
    </div>
</div>
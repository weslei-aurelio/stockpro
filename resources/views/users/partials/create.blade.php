<div class="modal fade" id="NewUser" tabindex="-1" role="dialog" aria-labellebdy="NewUser" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-fullscreen-xl-down" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">
                    <strong>
                        Novo Usuário
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
                <form action="{{ route('users.store') }}" method="POST">
                    @csrf
                    <div class="form-floating mb-3">
                        <input
                            type="text"
                            name="name"
                            class="form-control @error('name', 'create') is-invalid @enderror"
                            value="{{ old('name') }}"
                            placeholder="Nome Completo"
                        >
                        <label class="floatingInput">Nome completo</label>
                        @error('name', 'create')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input
                            type="email"
                            name="email"
                            class="form-control @error('email', 'create') is-invalid @enderror"
                            value="{{ old('email') }}"
                            placeholder="Endereço de E-mail"
                        >
                        <label class="floatingInput">Endereço de E-mail</label>
                        @error('email', 'create')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-floating mb-3 position-relative">
                        <input 
                            type="password" 
                            name="password" 
                            class="form-control @error('password', 'create') is-invalid @enderror" 
                            id="passwordField" 
                            placeholder="Senha"
                        >
                        <label for="passwordField">
                            Senha
                        </label>
                        {{-- Validar, pois não está funcionando! --}}
                        <span 
                            class="toggle-password position-absolute top-50 end-0 translate-middle-y me-3" 
                            onclick="togglePassword('passwordField', this)"
                        >
                            <i class="fa-solid fa-eye"></i>
                        </span>
                        @error('password', 'create')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-floating mb-3 position-relative">
                        <input 
                            type="password" 
                            name="password_confirmation" 
                            class="form-control"  
                            placeholder="Confirmar Senha"
                        >
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
                            Salvar
                        </button>
                    </div>
                </form>
            </div>    
        </div>
    </div>
</div>
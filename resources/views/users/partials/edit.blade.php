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
                <form action="{{ route('users.update', ['user' => '__ID__'])  }}" method="POST" id="editUserForm">
                    @csrf
                    @method('PUT')
                    <div class="form-floating mb-3">
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
                            id="confirmPasswordField" 
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
{{-- 
<script>
    // funcionalidade para visualizar/esconder a senha digitada pelo usuário
    function togglePassword(fieldId, toggleElement) {
        const passwordInput = document.getElementById(fieldId);
        const icon = toggleElement.querySelector('i');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }
</script> --}}
@extends('layouts.guest')

@section('title', 'Realizar Cadastro | StockPRO')

@push('register-css')
@vite('resources/scss/register.scss')
@endpush


@section('content')
    <div class="container-fluid d-flex align-items-center justify-content-center">
        <div class="form-container">
            <form action="{{ route('register') }}" method="POST">
            @csrf
            <img class="mx-auto d-block mb-3" src="/images/logo.png" alt="StockPRO" class="mb-4">
            <h1 class="h3 mb-3 d-block mb-3 text-center">Realizar cadastro</h1>
            <div class="form-floating mb-3">
                <input
                    type="text"
                    name="name"
                    class="form-control @error('name') is-invalid @enderror"
                    id="floatingInput"
                    value="{{ old('name') }}"
                    placeholder="Nome Completo"
                >
                <label class="floatingInput">Nome Completo</label>
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
                    id="floatingInput"
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
            <div class="form-floating mb-3 position-relative">
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="passwordField" placeholder="Senha">
                <label for="passwordField">Senha</label>
                <span class="toggle-password position-absolute top-50 end-0 translate-middle-y me-3" onclick="togglePassword('passwordField', this)">
                    <i class="fa-solid fa-eye"></i>
                </span>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-floating mb-3 position-relative">
                <input type="password" name="password_confirmation" class="form-control" id="confirmPasswordField" placeholder="Confirmar Senha">
                <label for="confirmPasswordField">Confirmar Senha</label>
                <span class="toggle-password position-absolute top-50 end-0 translate-middle-y me-3" onclick="togglePassword('confirmPasswordField', this)">
                    <i class="fa-solid fa-eye"></i>
                </span>
            </div>
            <button type="submit" class="btn btn-primary text-white w-100 py-3">Cadastrar</button>
        </div>
            </form>
    </div>

<!-- Script para alternar senha e ícone -->
<script>
function togglePassword(fieldId, toggleElement) {
    const passwordInput = document.getElementById(fieldId);
    const icon = toggleElement.querySelector('i');

    if (passwordInput.type === 'password') {
        passwordInput.type = 'text'; // Mostra senha
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        passwordInput.type = 'password'; // Oculta senha
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}
</script>

@endsection

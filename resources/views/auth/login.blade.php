@extends('layouts.guest')

@section('title', 'Login | StockPRO')

@push('login-css')
@vite('resources/scss/login.scss')
@endpush

@section('content')
<div class="container-fluid d-flex align-items-center justify-content-center">
    <div class="form-container">
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <img class="mx-auto d-block mb-3" src="/images/logo.png" alt="StockPRO" class="mb-4">
            <h1 class="h3 mb-3 fw-normal text-center">Entrar</h1>
            <div class="form-floating mb-3">
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="floatingInput" value="{{ old('email') }}" placeholder="E-mail">
                <label for="floatingInput">E-mail</label>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
           <div class="form-floating mb-3 position-relative">
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="floatingPassword" placeholder="Senha">
                <label for="floatingPassword">Senha</label>
                <span class="toggle-password position-absolute top-50 end-0 translate-middle-y me-3" onclick="togglePassword()">
                <i class="fa-solid fa-eye"></i> <!-- Ícone inicial -->
                </span>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary text-white w-100 py-3">Acessar</button>
            <div class="row mt-3 text-center">
                <a href="{{ route('password.request') }}" class="text-secondary">Esqueci minha senha</a>
            </div>
            <div class="row text-center">
                <a href="{{ route('register') }}" class="text-secondary">Realizar cadastro</a>
            </div>
        </form>
    </div>
</div>

<script>
function togglePassword() {
    const passwordInput = document.getElementById('floatingPassword');
    const toggleIcon = document.querySelector('.toggle-password i');

    if (passwordInput.type === 'password') {
        passwordInput.type = 'text'; 
        toggleIcon.classList.remove('fa-eye');
        toggleIcon.classList.add('fa-eye-slash');
    } else {
        passwordInput.type = 'password'; 
        toggleIcon.classList.remove('fa-eye-slash');
        toggleIcon.classList.add('fa-eye');
    }
}
</script>

@endsection

@extends('layouts.guest')

@section('title', 'Esqueci Minha Senha | StockPRO')

@push('forgot_password-css')
@vite('resources/scss/forgot_password.scss')
@endpush

@section('content')
    @session('status')
        <div class="alert alert-success text-center" role="alert">
            {{ $value }}
        </div>
    @endsession
    <div class="container-fluid d-flex align-items-center justify-content-center">
        <div class="form-container">
        <form action="{{ route('password.email') }}" method="POST">
            @csrf
            <img class="mx-auto d-block mb-3" src="/images/logo.png" alt="StockPRO" class="mb-4">
            <h1 class="h3 mb-3 fw-normal text-center">Resetar Senha</h1>
            <div class="form-floating mb-3">
                <input
                    type="email"
                    name="email"
                    class="form-control @error('email') is-invalid @enderror"
                    id="floatingInput"
                    value="{{ old('email') }}"
                    placeholder="Endereço de E-mail"
                >
                <label class="floatingInput mb-3">Endereço de E-mail</label>
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary mb-3 text-white w-100 py-2">Solicitar</button>
            <div class="row">
                <a href="{{ route('login') }}" class="text-center text-secondary">Realizar login</a>
            </div>
        </form>
    </div>
</div>
@endsection

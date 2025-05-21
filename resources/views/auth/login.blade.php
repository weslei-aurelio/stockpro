@extends('layouts.guest')

@section('content')
    @session('status')
        <div class="alert alert-success text-center" role="alert">
            {{ $value }}
        </div>
    @endsession
    <div class="container-fluid px-5">
        <h1 class="text-center mt-5">Realizar login</h1>
        <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">E-mail</label>
                    <input
                        type="email"
                        name="email"
                        class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email') }}"
                    >
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Senha</label>
                    <input
                        type="password"
                        name="password"
                        class="form-control @error('password') is-invalid @enderror"
                    >
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
            </form>
            <div class="container text-center">
                <div class="row">
                    <a href="{{ route('password.request') }}">Esqueci minha senha</a>
                </div>
                <div class="row">
                    <a href="{{ route('register') }}">Realizar cadastro</a>
                </div>
            </div>
        </div>
@endsection

@extends('layouts.guest')

@section('content')
    <div class="container">
        <h1 class="text-center my-5">Resetar senha</h1>
        <form action="{{ route('password.update') }}" method="POST">
            @csrf
            <input
                type="hidden"
                name="token"
                class="form-control @error('name') is-invalid @enderror"
                value="{{ request()->token }}"
                >
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            <div class="mb-3">
                <label class="form-label">Endereço de E-mail</label>
                <input
                    type="email"
                    name="email"
                    class="form-control @error('email') is-invalid @enderror"
                    value="{{ request()->email }}"
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
             <div class="mb-3">
                <label class="form-label">Confirmar senha</label>
                <input
                    type="password"
                    name="password_confirmation"
                    class="form-control"
                >
            </div>
            <button type="submit" class="btn btn-primary">Resetar senha</button>
        </form>
    </div>
@endsection

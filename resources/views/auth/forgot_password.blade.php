@extends('layouts.guest')

@section('content')
    @session('status')
        <div class="alert alert-success text-center" role="alert">
            {{ $value }}
        </div>
    @endsession
    <div class="container">
        <h1>Resetar senha</h1>
        <form action="{{ route('password.email') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Endereço de E-mail</label>
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
            <button type="submit" class="btn btn-primary">Solicitar</button>
        </form>
        <div class="container text-center">
            <div class="row">
                <a href="{{ route('login') }}">Realizar login</a>
            </div>
        </div>
    </div>
@endsection

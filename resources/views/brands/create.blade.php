@extends('layouts.app')

@section('title', 'Marcas | StockPRO')

@push('brands-css')
    @vite('resources/scss/brands.scss')
@endpush

@section('content')
<div class="d-flex justify-content-center align-items-center vh-100">
    <div class="container bg-brands p-4 rounded" style="max-width: 500px;">
        @session('status')
            <div class="alert alert-success text-center" role="alert">
                {{ $value }}
            </div>
        @endsession

        <div class="text-center mb-4">
            <h1><strong>Criar Marca</strong></h1>
        </div>

        <form action="{{ route('brands.store') }}" method="POST">
            @csrf
            <div class="mb-3 text-center">
                <label for="name" class="form-label d-block mx-auto" style="max-width: 300px;">Marca</label>
                <input 
                type="text"
                id="name"
                name="name"
                class="form-control mx-auto @error('name') is-invalid @enderror"
                style="max-width: 300px;"
                value="{{ old('name') }}"
                >
                @error('name')
                    <div class="invalid-feedback d-block text-center">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary text-white">Criar marca</button>
            </div>
        </form>
    </div>
</div>

@include('layouts.components.alert')
@endsection

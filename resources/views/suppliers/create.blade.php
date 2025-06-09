@extends('layouts.app')

@section('content')
    <div class="container p-5">
        <h1>Cadastrar Fornecedor</h1>
        <form action="{{ route('suppliers.store') }}" method="POST">
            @csrf
            <div class="form-floating mb-3">
                <input
                    type="text"
                    name="name"
                    class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name') }}"
                    placeholder="Nome Completo"
                >
                <label class="floatingInput">Nome / Razão Social</label>
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
            <div class="form-floating mb-3">
                <input
                    type="text"
                    name="phone"
                    class="phone form-control @error('phone') is-invalid @enderror"
                    value="{{ old('phone') }}"
                    placeholder="Telefone celular"
                >
                <label class="floatingInput">Telefone celular</label>
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-floating mb-3">
                <textarea 
                    name="observation"
                    class="form-control" 
                    placeholder="Leave a comment here" 
                    id="floatingTextarea"
                    style="height: 30%">
                </textarea>
                <label>Observações sobre o forncedor</label>
            </div>
            <button 
                type="submit" 
                class="btn btn-primary text-white custom-button-create">
                Cadastrar fornecedor
            </button>
        </form>
    </div>
@endsection
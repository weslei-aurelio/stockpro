@extends('layouts.app')

@section('content')
    <div class="container p-5">
        <h1>Atualizar cadastro Fornecedor</h1>
        <form action="{{ route('suppliers.update', $supplier->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-floating mb-3">
                <input
                    type="text"
                    name="name"
                    class="form-control @error('name') is-invalid @enderror"
                    value="{{ $supplier->name }}"
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
                    value="{{ $supplier->email }}"
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
                    value="{{ $supplier->phone }}"
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
                    style="height: 30%"
                >
                {{ old('observation', $supplier->observation ?? '')}}
                </textarea>
                <label>Observações sobre o forncedor</label>
            </div>
            <button 
                type="submit" 
                class="btn btn-primary text-white custom-button-create">
                Atualizar cadastro
            </button>
        </form>
    </div>
@endsection
@extends('layouts.app')

@section('content')
    <h1 class="text-center pt-5">Criar categoria</h1>
    <div class="container p-2">
        <form action="{{ route('categories.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Categoria</label>
                <input 
                    type="text"
                    name="name"
                    class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name') }}"
                >
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
             <button type="submit" class="btn btn-primary text-white">Criar categoria</button>
        </form>
    </div>
@endsection
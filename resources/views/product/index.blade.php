@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1>Lista de produto</h1>
            </div>
            <div class="col-md-6">
                <a href="{{ route('products.create') }}" class="btn btn-primary text-white">Cadastrar produto</a>
            </div>
        </div>
    </div>
@endsection
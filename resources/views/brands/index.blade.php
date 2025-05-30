@extends('layouts.app')

@section('content')
    @session('status')
        <div class="alert alert-success text-center" role="alert">
            {{ $value }}
        </div>
    @endsession
    <div class="container mt-5 d-flex justify-content-end">
        <a href="{{ route('brands.create') }}" class="btn btn-primary text-white">Nova marca</a>
    </div>
    <h1 class="text-center">Lista de marcas</h1>
@endsection
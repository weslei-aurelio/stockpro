@extends('layouts.app')

@section('title', 'Marcas | StockPRO')

@push('brands-css')
@vite('resources/scss/brands.scss')
@endpush

@section('content')
    @session('status')
        <div class="alert alert-success text-center" role="alert">
            {{ $value }}
        </div>
    @endsession
    <div class="container mt-5 d-flex justify-content-end">
        <a href="{{ route('brands.create') }}" class="btn btn-primary text-white">Nova marca</a>
    </div>
    <div class="container">
        <h1 class="text-center m-5">Lista de marcas</h1>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Marca</th>
                    <th scope="col">Ação</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($brands as $brand)
                    <tr>
                        <th scope="row">{{ $brand->id }}</th>
                        <td>{{ $brand->name }}</td>
                        <td>
                            <div class="d-flex gap-2">
                                <a class="btn btn-primary text-white btn-sm" href="#">Editar</a>
                                <form action="#" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Inativar</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @include('layouts.components.alert')    
@endsection
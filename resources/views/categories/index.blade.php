@extends('layouts.app')

@section('title', 'Categorias | StockPRO')

@push('categories-css')
@vite('resources/scss/categories.scss')
@endpush

@section('content')
    @session('status')
        <div class="alert alert-success text-center" role="alert">
            {{ $value }}
        </div>
    @endsession
    <div class="container mt-5 d-flex justify-content-end">
        <button type="button" class="btn btn-primary custom-button text-white mb-4" data-bs-toggle="modal" data-bs-target="#NewCategories">
            Nova Categoria
        </button>
    </div>
    <div class="container">
        <h1 class="text-center m-5">Categorias</h1>
        <table class="table table-hover table-striped">
            <thead class="table-primary">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Categoria</th>
                    <th scope="col">Ação</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <th scope="row">{{ $category->id }}</th>
                        <td>{{ $category->name }}</td>
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
    @include('categories.partials.create')
    @include('layouts.components.alert')    
@endsection
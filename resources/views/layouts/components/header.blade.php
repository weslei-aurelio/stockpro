@push('header-css')
@vite('resources/scss/header.scss')
@endpush

<nav class="navbar navbar-expand-lg navbar bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand" href="/dashboard">
            <img src="/images/logo-header.png" alt="StockPro" id="logo">
        </a>
         <div class="d-flex align-items-center">
        <h2 class="mb-0 me-4 text-white">Distribuidora JR</h2>
        <div class="btn-group">
            <button type="button" class="dropdown-toggle no-border" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                    <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
                </svg>
            </button>
            <ul class="dropdown-menu dropdown-menu-lg-end">
                <li><span class="dropdown-item-text">{{ auth()->user()->name }}</span></li>
                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item">Sair</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>
</nav>
<div class="container-fluid px-4 py-2">
    <button class="btn btn-outline-success" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar" aria-controls="sidebar">
        ☰
    </button>
</div>
<div class="offcanvas offcanvas-start" tabindex="-1" id="sidebar" aria-labelledby="sidebarLabel">
    <div class="offcanvas-header">
        <h5 id="sidebarLabel">Menu</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Fechar"></button>
    </div>
    <div class="offcanvas-body">
        <a href="/" class="d-block mb-2 text-success">Home</a>
        <a href="{{ route('pdv.index')}}" class="d-block mb-2 text-success">PDV</a>
        <a href="{{ route('products.index')}}" class="d-block mb-2 text-success">Produtos</a>
        <a href="{{ route('brands.index')}}" class="d-block mb-2 text-success">Marcas</a>
        <a href="{{ route('categories.index')}}" class="d-block mb-2 text-success">Categorias</a>
        <a href="{{ route('users.index')}}" class="d-block mb-2 text-success">Usuários</a>
    </div>
</div>

@push('footer-css')
@vite('resources/scss/footer.scss')
@endpush

<footer class="footer mt-auto">
    <hr>
        <div class="container text-center">
            <div class="row align-items-center footer-row">
                <div class="col footer-col">
                    &copy; 2025 StockPro. Todos os direitos reservados
                </div>
            <div class="col footer-col">
                <a href="{{ asset('manuals/manual-do-usuario.pdf') }}" class="text-primary" download>
                    Manual do Usuário
                </a>
            </div>
                <div class="col footer-col">
                    <img src="/images/logo.png" id="logo" alt="StockPRO">
                </div>
            </div>
        </div>
    </hr>
</footer>

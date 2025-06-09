@if (session('success'))
<div class="toast-container" id="success-toast">
    <div class="toast-content">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
            class="bi bi-check-circle-fill" viewBox="0 0 16 16">
            <path
                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
        </svg>
        <div class="message">
            {{ session('success') }}
        </div>
        <button type="button" class="close-btn" onclick="closeToast(event)">×</button>
    </div>
</div>

<script>
    function closeToast(e) {
        e.stopPropagation(); // Impede o clique de afetar o dropdown atrás
        const toast = document.getElementById('success-toast');
        if (toast) {
            toast.classList.add('fade-out');
            setTimeout(() => toast.remove(), 500);
        }
    }
    setTimeout(() => {
        const toast = document.getElementById('success-toast');
        if (toast) {
            toast.classList.add('fade-out');
            setTimeout(() => toast.remove(), 500);
        }
    }, 5000);
</script>
@endif

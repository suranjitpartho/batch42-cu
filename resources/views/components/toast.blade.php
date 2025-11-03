<div class="toast-container">
    @if (session('success'))
        <div class="toast toast-success" role="alert">
            <i class="toast-icon fa-solid fa-circle-check"></i>
            <div class="toast-divider"></div>
            <span class="toast-message">{{ session('success') }}</span>
        </div>
    @endif
    @if (session('error'))
        <div class="toast toast-danger" role="alert">
            <i class="toast-icon fa-solid fa-circle-xmark"></i>
            <div class="toast-divider"></div>
            <span class="toast-message">{{ session('error') }}</span>
        </div>
    @endif
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Toast Notifications
    const toasts = document.querySelectorAll('.toast');
    toasts.forEach((toast, index) => {
        // Stagger the appearance slightly and trigger the 'show' transition
        setTimeout(() => {
            toast.classList.add('show');
        }, 100 + (index * 100));

        // After 4 seconds, start the fade-out by removing the 'show' class
        setTimeout(() => {
            toast.classList.remove('show');
        }, 4100);

        // After 4.6 seconds (giving the 0.5s transition time to finish), remove the element
        setTimeout(() => {
            // Check if the element and its parent still exist before trying to remove
            if (toast && toast.parentNode) {
                toast.parentNode.removeChild(toast);
            }
        }, 4600);
    });
});
</script>

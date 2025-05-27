@if (!request()->cookie('cookie_consent'))
<div id="cookie-consent-banner" class="fixed bottom-0 left-0 right-0 bg-gray-900 text-white p-4 z-50">
    <div class="container mx-auto flex justify-between items-center">
        <div class="flex-1 pr-4">
            <p>Kami menggunakan cookie untuk meningkatkan pengalaman Anda di situs web kami. Dengan melanjutkan menggunakan situs ini, Anda menyetujui penggunaan cookie.</p>
        </div>
        <div class="flex items-center space-x-4">
            <button onclick="acceptCookies()" class="bg-white text-gray-900 px-4 py-2 rounded hover:bg-gray-100">
                Setuju
            </button>
        </div>
    </div>
</div>

<script>
function acceptCookies() {
    fetch('{{ route('cookie.store') }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            document.getElementById('cookie-consent-banner').style.display = 'none';
        }
    });
}
</script>

<style>
#cookie-consent-banner {
    box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
    animation: slideUp 0.5s ease-out;
}

@keyframes slideUp {
    from {
        transform: translateY(100%);
    }
    to {
        transform: translateY(0);
    }
}
</style>
@endif
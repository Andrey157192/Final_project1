@if(session('show_cookie_consent') && !request()->cookie('cookie_consent'))
<div id="cookieModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3 text-center">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Persetujuan Cookie</h3>
            <div class="mt-2 px-7 py-3">
                <p class="text-sm text-gray-500">
                    Situs ini menggunakan cookie untuk meningkatkan pengalaman Anda. Dengan melanjutkan menggunakan situs ini, Anda menyetujui penggunaan cookie kami.
                </p>
            </div>
            <div class="items-center px-4 py-3">
                <button id="acceptCookies" 
                        class="px-4 py-2 bg-blue-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-300">
                    Setuju
                </button>
                <button id="rejectCookies"
                        class="mt-2 px-4 py-2 bg-gray-100 text-gray-700 text-base font-medium rounded-md w-full shadow-sm hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-300">
                    Tolak
                </button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('cookieModal');
    if (modal) {
        modal.style.display = 'block';
    }
});

document.getElementById('acceptCookies').addEventListener('click', function() {
    fetch('{{ route('cookie.store') }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json'
        }
    }).then(response => response.json())
      .then(data => {
        if (data.status === 'success') {
            const modal = document.getElementById('cookieModal');
            modal.style.opacity = '0';
            modal.style.transition = 'opacity 0.5s ease-out';
            setTimeout(() => {
                modal.style.display = 'none';
            }, 500);
        }
    });
});

document.getElementById('rejectCookies').addEventListener('click', function() {
    const modal = document.getElementById('cookieModal');
    modal.style.opacity = '0';
    modal.style.transition = 'opacity 0.5s ease-out';
    setTimeout(() => {
        modal.style.display = 'none';
    }, 500);
    
    fetch('/api/clear-cookie-consent-session', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json'
        }
    });
});
</script>

<style>
#cookieModal {
    opacity: 0;
    animation: fadeIn 0.5s ease-out forwards;
}

@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}
</style>
@endif
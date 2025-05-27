@if(Auth::check() && !session('cookie_consent'))
<div id="cookie-consent-banner" class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50">
    <div class="bg-white p-6 rounded-lg shadow-xl max-w-md mx-4">
        <div class="flex flex-col space-y-4">
            <div class="flex items-start space-x-3">
                <div class="flex-shrink-0 text-2xl">🍪</div>
                <div>
                    <h3 class="text-lg font-semibold mb-2">Pengaturan Cookie</h3>
                    <p class="text-gray-600">
                        Kami menggunakan cookie untuk menyimpan status login Anda. Cookie ini membantu kami menjaga keamanan dan kenyamanan penggunaan website.
                    </p>
                </div>
            </div>
            <div class="flex justify-end space-x-4">
                <button onclick="handleCookieChoice('declined')" 
                        class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors">
                    Tolak
                </button>
                <button onclick="handleCookieChoice('accepted')" 
                        class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                    Setuju
                </button>
            </div>
        </div>
    </div>
</div>

<script>
function handleCookieChoice(choice) {
    fetch('{{ route('cookie.consent.store') }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        },
        body: JSON.stringify({ consent: choice })
    })
    .then(response => response.json())
    .then(data => {
        const banner = document.getElementById('cookie-consent-banner');
        banner.classList.add('opacity-0');
        banner.style.transition = 'opacity 0.3s ease-out';
        
        if (choice === 'declined') {
            alert('Cookie penggunaan ditolak. Beberapa fitur mungkin tidak berfungsi optimal.');
        }
        
        setTimeout(() => {
            banner.remove();
        }, 300);
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

document.addEventListener('DOMContentLoaded', function() {
    const banner = document.getElementById('cookie-consent-banner');
    if (banner) {
        requestAnimationFrame(() => {
            banner.style.opacity = '1';
        });
    }
});
</script>

<style>
#cookie-consent-banner {
    opacity: 0;
    transition: opacity 0.3s ease-in;
}

.opacity-0 {
    opacity: 0;
}
</style>
@endif
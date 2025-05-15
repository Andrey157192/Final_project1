@php
    $cookieConsent = Cookie::get('cookie_consent');
    $showCookieConsent = session('show_cookie_consent', false);
@endphp

@if(!$cookieConsent && $showCookieConsent)
<div id="cookie-consent-banner" class="fixed bottom-0 left-0 right-0 bg-white shadow-lg p-4 z-50 transition-transform duration-300 transform translate-y-0">
    <div class="container mx-auto">
        <div class="flex flex-wrap items-center justify-between">
            <div class="w-full md:w-3/4 mb-4 md:mb-0">
                <p class="text-gray-700 text-sm">                    We use cookies to enhance your experience. By continuing to visit this site you agree to our use of cookies
                </p>
            </div>
            <div class="w-full md:w-1/4 flex justify-end">                <button onclick="setCookieConsent('accept')" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-md text-sm transition duration-300 mr-2">
                    Accept
                </button>
                <button onclick="setCookieConsent('decline')" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-2 rounded-md text-sm transition duration-300">
                    Decline
                </button>
            </div>
        </div>
    </div>
</div>

<style>
.cookie-consent-hidden {
    transform: translateY(100%);
}
</style>

<script>
function setCookieConsent(action) {
    const banner = document.getElementById('cookie-consent-banner');
    const maxAge = 365 * 24 * 60 * 60; // 1 year in seconds
    
    // Set the cookie
    document.cookie = `cookie_consent=${action};max-age=${maxAge};path=/`;
    
    // Make an AJAX request to clear the session flag
    fetch('/api/clear-cookie-consent-session', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        }
    });
    
    // Hide the banner with animation
    banner.classList.add('cookie-consent-hidden');
    setTimeout(() => {
        banner.style.display = 'none';
    }, 300);
}
</script>
@endif

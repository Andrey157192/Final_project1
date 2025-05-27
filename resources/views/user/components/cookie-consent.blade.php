@php
    $cookieConsent = Cookie::get('cookie_consent');
    $isLoggedIn = Auth::check();
    $isAdmin = $isLoggedIn && Auth::user()->role === 'admin';
    $showBanner = $isLoggedIn && !$isAdmin && !$cookieConsent;
@endphp

@if($showBanner)
<div class="cookie-overlay" id="cookieOverlay">
    <div class="cookie-banner" id="cookieBanner">
        <div class="cookie-content">
            <h2 class="cookie-title">Pengaturan Cookie</h2>
            <p>Kami menggunakan cookie untuk menyimpan status login Anda. Cookie ini membantu kami menjaga keamanan dan kenyamanan penggunaan website.</p>
            <div class="cookie-buttons">
                <button class="decline-btn" onclick="declineCookie()">Tolak</button>
                <button class="accept-btn" onclick="acceptCookie()">Setuju</button>
            </div>
        </div>
    </div>
</div>

<style>
    .cookie-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 1000;
    }

    .cookie-banner {
        background-color: #FFF9C4;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        width: 90%;
        max-width: 500px;
        position: relative;
    }

    .cookie-content {
        text-align: left;
    }

    .cookie-title {
        font-size: 24px;
        margin-bottom: 15px;
        color: #333;
    }

    .cookie-banner p {
        margin: 0 0 20px 0;
        color: #666;
        font-size: 14px;
        line-height: 1.6;
    }

    .cookie-buttons {
        display: flex;
        gap: 10px;
        justify-content: flex-start;
    }

    .cookie-buttons button {
        padding: 8px 24px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 14px;
        font-weight: 500;
        transition: all 0.2s;
    }

    .accept-btn {
        background-color: #FFD700;
        color: #333;
    }

    .accept-btn:hover {
        background-color: #FFC800;
    }

    .decline-btn {
        background-color: #FFE082;
        color: #333;
    }

    .decline-btn:hover {
        background-color: #FFD54F;
    }

    @media (max-width: 640px) {
        .cookie-banner {
            width: 85%;
            padding: 20px;
        }
        
        .cookie-buttons {
            flex-direction: row;
        }
        
        .cookie-buttons button {
            flex: 1;
        }
    }
</style>

<script>
function acceptCookie() {
    setCookieConsent('accept');
}

function declineCookie() {
    setCookieConsent('decline');
}

function setCookieConsent(action) {
    const overlay = document.getElementById('cookieOverlay');
    const banner = document.getElementById('cookieBanner');
    const maxAge = 365 * 24 * 60 * 60; // 1 year in seconds
    
    fetch('/api/cookie-consent', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json'
        },
        body: JSON.stringify({ consent: action })
    })
    .then(response => response.json())
    .then(data => {
        overlay.style.opacity = '0';
        banner.style.transform = 'scale(0.95)';
        overlay.style.transition = 'opacity 0.3s ease';
        banner.style.transition = 'transform 0.3s ease';
        
        setTimeout(() => {
            overlay.remove();
        }, 300);
    })
    .catch(error => {
        console.error('Error:', error);
    });
}
</script>
@endif

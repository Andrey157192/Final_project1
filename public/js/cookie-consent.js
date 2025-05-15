class CookieManager {
    static set(name, value, days = 365) {
        const d = new Date();
        d.setTime(d.getTime() + (days * 24 * 60 * 60 * 1000));
        const expires = `expires=${d.toUTCString()}`;
        document.cookie = `${name}=${value};${expires};path=/;SameSite=Lax`;
    }

    static get(name) {
        const nameEQ = `${name}=`;
        const ca = document.cookie.split(';');
        for (let i = 0; i < ca.length; i++) {
            let c = ca[i];
            while (c.charAt(0) === ' ') c = c.substring(1);
            if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length);
        }
        return null;
    }

    static delete(name) {
        document.cookie = `${name}=;expires=Thu, 01 Jan 1970 00:00:01 GMT;path=/`;
    }
}

// Cookie consent management
const CookieConsent = {
    init() {
        const isLoggedIn = document.body.classList.contains('user-logged-in');
        const cookieConsent = document.getElementById('cookieConsent');
        
        if (isLoggedIn) {
            // Untuk user yang sudah login, langsung tampilkan
            if (!CookieManager.get('cookieConsent')) {
                cookieConsent.style.display = 'block';
            }
        } else {
            // Untuk user yang belum login, cek cookie consent
            if (!CookieManager.get('cookieConsent')) {
                cookieConsent.style.display = 'block';
            }
        }
    },

    accept() {
        CookieManager.set('cookieConsent', 'accepted');
        document.getElementById('cookieConsent').style.display = 'none';
        this.enableAnalytics();
    },

    reject() {
        CookieManager.set('cookieConsent', 'rejected');
        document.getElementById('cookieConsent').style.display = 'none';
    },

    enableAnalytics() {
        // Add your analytics initialization here if needed
    }
};

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    CookieConsent.init();
});

// Global functions for the buttons
function acceptCookies() {
    CookieConsent.accept();
}

function rejectCookies() {
    CookieConsent.reject();
}

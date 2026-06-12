(function () {
    'use strict';

    var STORAGE_KEY = 'mycovai_cookie_consent';

    function getConsent() {
        try {
            return localStorage.getItem(STORAGE_KEY);
        } catch (e) {
            return null;
        }
    }

    function setConsent(value) {
        try {
            localStorage.setItem(STORAGE_KEY, value);
        } catch (e) {
            /* ignore quota / private mode */
        }
    }

    /**
     * Hook for future Google Consent Mode v2 integration.
     * Call gtag('consent', 'update', {...}) here when CMP is added.
     */
    function onConsentGranted() {
        if (typeof window.covaiOnCookieConsent === 'function') {
            window.covaiOnCookieConsent({ analytics: true, ads: true });
        }
    }

    function init() {
        var banner = document.getElementById('covai-cookie-notice');
        var acceptBtn = document.getElementById('covai-cookie-accept');
        if (!banner || !acceptBtn) {
            return;
        }

        if (getConsent() === 'accepted') {
            banner.setAttribute('hidden', '');
            return;
        }

        banner.removeAttribute('hidden');

        acceptBtn.addEventListener('click', function () {
            setConsent('accepted');
            onConsentGranted();
            banner.setAttribute('hidden', '');
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})();

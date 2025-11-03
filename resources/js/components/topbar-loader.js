document.addEventListener('DOMContentLoaded', function () {
    var loader = document.getElementById('top-bar-loader');

    if (!loader) {
        console.warn('Top bar loader element not found.');
        return;
    }

    // Function to show the loader
    function showLoader() {
        loader.style.display = 'block';
    }

    // Function to hide the loader
    function hideLoader() {
        loader.style.display = 'none';
    }

    // Show loader on initial page load (before window.load)
    showLoader();

    // Hide loader when page is fully loaded
    window.addEventListener('load', hideLoader);

    // Handle XMLHttpRequest (AJAX) requests
    (function (open) {
        XMLHttpRequest.prototype.open = function () {
            this.addEventListener('loadstart', showLoader, false);
            this.addEventListener('loadend', hideLoader, false);
            open.apply(this, arguments);
        };
    })(XMLHttpRequest.prototype.open);

    // Handle Fetch API requests
    const originalFetch = window.fetch;
    window.fetch = function (...args) {
        showLoader();
        return originalFetch.apply(this, args).finally(hideLoader);
    };

    // Show loader when navigating away
    window.addEventListener('beforeunload', showLoader);

    // Hide loader on bfcache restore (e.g., when using back button)
    window.addEventListener('pageshow', function (event) {
        if (event.persisted) {
            hideLoader();
        }
    });

    // Generic handler for download links that need loader monitoring
    var downloadLinks = document.querySelectorAll('.monitored-download-link');
    if (downloadLinks.length > 0) {
        downloadLinks.forEach(function(link) {
            link.addEventListener('click', function() {
                showLoader();

                // For file downloads, the page doesn't unload. This timeout hides the loader
                // after a delay, assuming the download has started. This is safe because
                // it only applies to links with the 'monitored-download-link' class.
                setTimeout(hideLoader, 4000); // 4 seconds
            });
        });
    }
});

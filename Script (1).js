document.addEventListener('DOMContentLoaded', function() {
    // Get the body element
    const body = document.body;

    // Check for dark mode and Miesha mode in the URL parameters
    const urlParams = new URLSearchParams(window.location.search);
    const darkMode = urlParams.get('darkMode') === 'true';
    const mieshaMode = urlParams.get('mieshaMode') === 'true';

    // Apply dark mode if needed
    if (darkMode) {
        body.classList.add('dark-mode');
    }

    // Apply Miesha mode if needed
    if (mieshaMode) {
        body.classList.add('miesha-mode');
    }
});
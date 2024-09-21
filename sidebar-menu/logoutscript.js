// logoutscript.js
window.onload = function() {
    // Clear session or any authentication tokens here if necessary.
    // Redirect to login.html after 3 seconds
    setTimeout(function() {
        window.location.href = 'login.html';
    }, 1);
};
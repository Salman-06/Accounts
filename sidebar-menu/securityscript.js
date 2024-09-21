// securityscript.js

document.getElementById('change-password-form').addEventListener('submit', function(e) {
    e.preventDefault(); // Prevent default form submission

    const existingPassword = document.getElementById('existing-password').value;
    const newPassword = document.getElementById('new-password').value;
    const retypePassword = document.getElementById('retype-password').value;

    // Validation checks
    if (newPassword !== retypePassword) {
        alert("New password and re-typed password do not match.");
        return;
    }

    // Send data to Node.js server
    fetch('/change-password', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            existingPassword: existingPassword,
            newPassword: newPassword
        }),
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert("Password changed successfully.");
            window.location.href = 'login.html'; // Redirect to login page
        } else {
            alert("Error: " + data.message);
        }
    })
    .catch((error) => {
        console.error('Error:', error);
    });
});

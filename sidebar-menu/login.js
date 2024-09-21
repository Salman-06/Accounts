function handleLogin(event) {
            event.preventDefault(); // Prevent form from submitting the traditional way
            
            // Simulate login validation (you can add actual login logic here)
            const username = document.getElementById('username-field').value;
            const password = document.getElementById('password-field').value;
            
            if (username === '' && password === '') {
                // Redirect to index.html after successful login
                window.location.href = 'index.html';
            } else {
                alert('Invalid credentials');
            }
        }
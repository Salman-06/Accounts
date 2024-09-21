const express = require('express');
const path = require('path');
const app = express();

// Serve static files from the public folder (login.html, logout.html, etc.)
app.use(express.static(path.join(__dirname, 'public')));

// Logout route
app.get('/logout', (req, res) => {
    // Here you could also clear any session data if using express-session or cookies
    // req.session.destroy(); // If using sessions
    res.sendFile(path.join(__dirname, 'public', 'logout.html'));
});

// Login route (just serve login.html)
app.get('/login', (req, res) => {
    res.sendFile(path.join(__dirname, 'public', 'login.html'));
});

// Start the server
const PORT = process.env.PORT || 3000;
app.listen(PORT, () => {
    console.log(`Server is running on port ${PORT}`);
});

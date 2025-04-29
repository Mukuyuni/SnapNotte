// DOM Elements
const loginForm = document.getElementById('loginForm');
const adminLink = document.getElementById('adminLink');

// Simulated Backend Data
const users = [
    { email: 'admin@email.com', password: 'admin123', role: 'admin' },
    { email: 'user@email.com', password: 'user123', role: 'user' }
];

// Handle Login Form Submission
loginForm.addEventListener('submit', (e) => {
    e.preventDefault();
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    // Find matching user
    const user = users.find(u => u.email === email && u.password === password);

    if (user) {
        if (user.role === 'admin') {
            // Redirect Admin to Admin Page
            window.location.href = 'admin.html';
        } else {
            // Redirect User to Homepage
            window.location.href = 'homepage.html';
        }
    } else {
        alert('Invalid credentials!');
    }
});

// Direct Admin Link
adminLink.addEventListener('click', (e) => {
    e.preventDefault();
    alert('Only accessible to Admins. Please log in!');
    window.location.href = 'admin.html';
});

// DOM Elements
const addUserForm = document.getElementById('addUserForm');
const userTable = document.getElementById('userTable');

// Simulated Backend (Temporary Data Storage)
let users = [
    { username: 'adminAdrian', email: 'admin@email.com', role: 'admin' },
    { username: 'userJohn', email: 'user@email.com', role: 'user' }
];

// Render Users in Table
function renderUsers() {
    userTable.innerHTML = ''; // Clear the table
    users.forEach((user, index) => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${user.username}</td>
            <td>${user.email}</td>
            <td>${user.role}</td>
            <td>
                <button onclick="editUser(${index})">Edit</button>
                <button onclick="deleteUser(${index})">Delete</button>
            </td>
        `;
        userTable.appendChild(row);
    });
}

// Add New User
addUserForm.addEventListener('submit', (e) => {
    e.preventDefault();
    const username = document.getElementById('username').value;
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value; // Securely hash this before sending to backend
    const role = document.getElementById('role').value;

    users.push({ username, email, role });
    renderUsers();
    addUserForm.reset();
});

// Edit User
function editUser(index) {
    const user = users[index];
    document.getElementById('username').value = user.username;
    document.getElementById('email').value = user.email;
    document.getElementById('role').value = user.role;

    addUserForm.onsubmit = (e) => {
        e.preventDefault();
        user.username = document.getElementById('username').value;
        user.email = document.getElementById('email').value;
        user.role = document.getElementById('role').value;

        renderUsers();
        addUserForm.reset();
        addUserForm.onsubmit = addUserFormSubmitHandler; // Reset the form behavior
    };
}

// Delete User
function deleteUser(index) {
    users.splice(index, 1);
    renderUsers();
}

// Initial Render
renderUsers();

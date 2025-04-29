<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Snapnote</title>
    <style>
        /* Page styling */
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background: url('Images/BingWallpaper\ \(1\).jpg') no-repeat center center fixed; /* Add your background image */
            background-size: cover;
            color: white;
        }

        /* Centering the admin panel */
        .admin-container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /* Form styling */
        .admin-form {
            background: rgba(0, 0, 0, 0.7); /* Slight transparency */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px 2px rgba(255, 255, 255, 0.3);
            width: 300px;
            margin-bottom: 20px;
        }

        .admin-form h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .admin-form input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: none;
            border-radius: 5px;
        }

        .admin-form button {
            width: 100%;
            padding: 10px;
            background-color: #f44336;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .admin-form button:hover {
            background-color: #e53935;
        }

        .admin-form a {
            display: block;
            text-align: center;
            color: white;
            margin-top: 10px;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="admin-container">
        <!-- Add User Form -->
        <form class="admin-form" method="POST" action="">
            <h2>Add User</h2>
            <input type="text" name="username" placeholder="Username" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="add_user">Add User</button>
        </form>

        <!-- Delete User Form -->
        <form class="admin-form" method="POST" action="">
            <h2>Delete User</h2>
            <input type="email" name="delete_email" placeholder="Enter Email to Delete" required>
            <button type="submit" name="delete_user">Delete User</button>
        </form>
        <a href="http://localhost/SnapNote/homepage.html">Go to Homepage</a>
    </div>

    <?php
        // Start PHP logic for admin functionality
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "snapnote_db";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Add user logic
            if (isset($_POST['add_user'])) {
                $user = $_POST['username'];
                $email = $_POST['email'];
                $pass = $_POST['password'];

                $sql = "INSERT INTO users (username, email, password) VALUES ('$user', '$email', '$pass')";

                if ($conn->query($sql) === TRUE) {
                    echo "<p style='text-align: center; color: green;'>User added successfully!</p>";
                } else {
                    echo "<p style='text-align: center; color: red;'>Error: " . $conn->error . "</p>";
                }
            }

            // Delete user logic
            if (isset($_POST['delete_user'])) {
                $delete_email = $_POST['delete_email'];

                $sql = "DELETE FROM users WHERE email='$delete_email'";

                if ($conn->query($sql) === TRUE) {
                    if ($conn->affected_rows > 0) {
                        echo "<p style='text-align: center; color: green;'>User deleted successfully!</p>";
                    } else {
                        echo "<p style='text-align: center; color: red;'>No user found with that email.</p>";
                    }
                } else {
                    echo "<p style='text-align: center; color: red;'>Error: " . $conn->error . "</p>";
                }
            }

            $conn->close();
        }
    ?>
</body>
</html>

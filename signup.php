<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Page - Snapnote</title>
    <style>
        /* Page styling */
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background: url('Images/aerial\ view\ of\ new\ york\,\ mannhattan.png') no-repeat center center fixed; /* Add your background image */
            background-size: cover;
            color: white; /* Ensure readability on darker background */
        }

        /* Center the form */
        .signup-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /* Form styling */
        .signup-form {
            background: rgba(0, 0, 0, 0.7); /* Slight transparency */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px 2px rgba(255, 255, 255, 0.3);
            width: 300px;
        }

        .signup-form h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .signup-form input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: none;
            border-radius: 5px;
        }

        .signup-form button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .signup-form button:hover {
            background-color: #45a049;
        }

        .signup-form a {
            display: block;
            text-align: center;
            color: white;
            margin-top: 10px;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="signup-container">
        <form class="signup-form" method="POST" action="">
            <h2>Sign Up</h2>
            <input type="text" name="username" placeholder="Username" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Sign Up</button>
            <a href="login.php">Already have an account? Login</a>
        </form>
    </div>
    <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "snapnote_db";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $user = $_POST['username'];
            $email = $_POST['email'];
            $pass = $_POST['password'];

            $sql = "INSERT INTO users (username, email, password) VALUES ('$user', '$email', '$pass')";

            if ($conn->query($sql) === TRUE) {
                header("Location: login.php");
                exit();
            } else {
                echo "<p style='text-align: center;'>Error: " . $conn->error . "</p>";
            }

            $conn->close();
        }
    ?>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page - Snapnote</title>
    <style>
        /* Page styling */
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background: url('Images/Icircles of mistsushi japan.png') no-repeat center center fixed; /* Add your background image */
            background-size: cover;
            color: white;
        }

        /* Center the form */
        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /* Form styling */
        .login-form {
            background: rgba(0, 0, 0, 0.7); /* Slight transparency */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px 2px rgba(255, 255, 255, 0.3);
            width: 300px;
        }

        .login-form h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .login-form input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: none;
            border-radius: 5px;
        }

        .login-form button {
            width: 100%;
            padding: 10px;
            background-color: #008CBA;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .login-form button:hover {
            background-color: #007B9E;
        }

        .login-form a {
            display: block;
            text-align: center;
            color: white;
            margin-top: 10px;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <form class="login-form" method="POST" action="">
            <h2>Login</h2>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
            <a href="admin.php">Go to Admin Page</a> <!-- Link to Admin Page -->
        </form>
    </div>
    <?php
        session_start();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "snapnote_db";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $email = $_POST['email'];
            $pass = $_POST['password'];

            // Verify user credentials
            $sql = "SELECT * FROM users WHERE email='$email' AND password='$pass'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $_SESSION['user'] = $email;
                header("Location: http://localhost/SnapNote/homepage.html"); // Redirect to the homepage
                exit();
            } else {
                echo "<p style='text-align: center; color: red;'>Invalid login credentials. Please try again.</p>";
            }

            $conn->close();
        }
    ?>
</body>
</html>

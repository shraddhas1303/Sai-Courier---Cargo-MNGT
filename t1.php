<?php
// Start session
session_start();

// Database connection details
$host = 'localhost'; // Database host
$dbname = 'user'; // Replace with your database name
$username = 'root'; // Replace with your username
$password = ''; // Replace with your password

try {
    // Establish database connection using PDO
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Check if form data is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $branch_email = $_POST['branch_email'];
    $admin_password = $_POST['admin_password'];

    // Query to find matching user
    $sql = "SELECT * FROM user_admin WHERE user_name = :email AND password = :password";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $branch_email);
    $stmt->bindParam(':password', $admin_password);

    // Execute the query
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // If user is found, redirect to the dashboard
        $_SESSION['logged_in'] = true;
        $_SESSION['admin_name'] = $user['admin_name']; // Store admin name in session
        header("Location: dashboard.php"); // 
        exit();
    } else {
        // Invalid login details
        $_SESSION['login_error'] = "Invalid username or password.";
        header("Location: login.php"); // Redirect back to login page
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        /* Basic Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(to right, #6a11cb, #2575fc); /* Gradient background */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-container {
            background: #fff;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            transition: transform 0.3s ease-in-out;
        }

        .login-container:hover {
            transform: scale(1.05);
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
            font-size: 28px;
            font-weight: 600;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-size: 16px;
            color: #333;
            margin-bottom: 5px;
            display: block;
            font-weight: 600;
        }

        input[type="email"], input[type="password"] {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            border: 2px solid #ddd;
            border-radius: 8px;
            margin-top: 5px;
            transition: border-color 0.3s ease;
        }

        input[type="email"]:focus, input[type="password"]:focus {
            border-color: #2575fc;
            outline: none;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #2575fc;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #1d64b6;
        }

        p {
            text-align: center;
            color: #ff0000;
        }

        .forgot-password {
            display: block;
            text-align: center;
            margin-top: 15px;
            font-size: 14px;
        }

        .forgot-password a {
            color: #2575fc;
            text-decoration: none;
        }

        .forgot-password a:hover {
            text-decoration: underline;
        }

        .alert {
            color: red;
            font-size: 14px;
            text-align: center;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

    <div class="login-container">
        <h2>Admin Login</h2>

        <?php
        // Display error message if any
        if (isset($_SESSION['login_error'])) {
            echo '<div class="alert">' . $_SESSION['login_error'] . '</div>';
            unset($_SESSION['login_error']);
        }
        ?>

        <form method="POST" action="login.php">
            <div class="form-group">
                <label for="branch_email">Email:</label>
                <input type="email" name="branch_email" id="branch_email" required>
            </div>

            <div class="form-group">
                <label for="admin_password">Password:</label>
                <input type="password" name="admin_password" id="admin_password" required>
            </div>

            <div class="form-group">
                <button type="submit">Secure Login</button>
            </div>
        </form>

        <div class="forgot-password">
            <a href="#">Forgot Password?</a>
        </div>
    </div>

</body>
</html>

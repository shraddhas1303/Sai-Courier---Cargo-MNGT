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
        // If user is found, set session variables
        $_SESSION['logged_in'] = true;
        $_SESSION['admin_name'] = $user['admin_name']; // Store admin name in session
        $_SESSION['session_id'] = session_id(); // Generate a unique session ID
        header("Location: dashboard.php"); // Redirect to the dashboard
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
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(45deg, #ff9a9e, #fad0c4, #fbc2eb, #a1c4fd, #c2e9fb);
            background-size: 400% 400%;
            animation: gradient-animation 10s ease infinite;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            overflow: hidden;
        }

        @keyframes gradient-animation {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }

        .login-container {
            background: rgba(255, 255, 255, 0.85);
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
            animation: slide-in 1s ease-out;
            position: relative;
            overflow: hidden;
        }

        .login-container::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(to right, rgba(255, 154, 158, 0.3), rgba(162, 196, 254, 0.3));
            animation: rotate-background 8s linear infinite;
            z-index: -1;
        }

        @keyframes rotate-background {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }

        @keyframes slide-in {
            0% {
                opacity: 0;
                transform: translateY(-50px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
            font-size: 28px;
            font-weight: 700;
            animation: fade-in 1s ease;
        }

        @keyframes fade-in {
            0% {
                opacity: 0;
            }
            100% {
                opacity: 1;
            }
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
            box-shadow: 0 0 10px rgba(37, 117, 252, 0.5);
        }

        button {
            width: 100%;
            padding: 12px;
            background: linear-gradient(to right, #6a11cb, #2575fc);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s ease, transform 0.2s;
        }

        button:hover {
            background: linear-gradient(to right, #2575fc, #6a11cb);
            transform: scale(1.05);
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

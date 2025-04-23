<?php
// Start session
session_start();

// Database connection details
$host = 'localhost'; // Database host
$dbname = 'user'; // Replace with your database name
$username = 'root'; // Replace with your username
$password = ''; // Replace with your password

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Update profile and password
$message = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $mobile = $conn->real_escape_string($_POST['mobile']);
    $city = $conn->real_escape_string($_POST['city']);
    
    // Handling password update
    if (!empty($_POST['old_password']) && !empty($_POST['new_password']) && !empty($_POST['confirm_password'])) {
        $old_password = $_POST['old_password'];
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];

        // Check if old password matches the current password in the database
        $sql = "SELECT password FROM users WHERE id = 1";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();

        if ($row && password_verify($old_password, $row['password'])) {
            // If passwords match, update the password
            if ($new_password === $confirm_password) {
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                $sql = "UPDATE users SET password='$hashed_password' WHERE id = 1";
                if ($conn->query($sql) === TRUE) {
                    $message = "Password updated successfully!";
                } else {
                    $message = "Error updating password: " . $conn->error;
                }
            } else {
                $message = "New password and confirm password do not match.";
            }
        } else {
            $message = "Old password is incorrect.";
        }
    }

    // Update user profile
    if (empty($_POST['old_password'])) {
        $sql = "UPDATE users SET name='$name', email='$email', mobile='$mobile', city='$city' WHERE id = 1";
        if ($conn->query($sql) === TRUE) {
            $message = "Profile updated successfully!";
        } else {
            $message = "Error updating profile: " . $conn->error;
        }
    }
}

$conn->close();
?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard with Profile and Password Update</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom CSS */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f7fc;
            margin: 0;
            padding: 0;
        }
        .card {
            border-radius: 15px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: skyblue;
            color: white;
            font-size: 22px;
            text-align: center;
            padding: 20px;
            border-radius: 15px 15px 0 0;
        }
        .btn-orange {
            background-color: skyblue;
            border: none;
            color: white;
            padding: 12px 18px;
            border-radius: 8px;
            font-size: 16px;
            transition: background-color 0.3s;
        }
        .btn-orange:hover {
            background-color: #ff6347;
        }
    </style>
</head>
<body>

<!-- Profile and Password Update Form -->
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h3>Update Profile and Change Password</h3>
        </div>
        <div class="card-body">
            <?php if (!empty($message)): ?>
                <div class="alert alert-info text-center"><?php echo $message; ?></div>
            <?php endif; ?>

            <form action="" method="POST">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Enter your name" required>
                    </div>
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="mobile" class="form-label">Mobile</label>
                        <input type="tel" id="mobile" name="mobile" class="form-control" placeholder="Enter your mobile" required>
                    </div>
                    <div class="col-md-6">
                        <label for="city" class="form-label">City</label>
                        <input type="text" id="city" name="city" class="form-control" placeholder="Enter your city" required>
                    </div>
                </div>

                <!-- Password Update Section -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="old_password" class="form-label">Old Password</label>
                        <input type="password" id="old_password" name="old_password" class="form-control" placeholder="Enter your old password">
                    </div>
                    <div class="col-md-6">
                        <label for="new_password" class="form-label">New Password</label>
                        <input type="password" id="new_password" name="new_password" class="form-control" placeholder="Enter your new password">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="confirm_password" class="form-label">Confirm New Password</label>
                        <input type="password" id="confirm_password" name="confirm_password" class="form-control" placeholder="Confirm your new password">
                    </div>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn-orange">Update Profile</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

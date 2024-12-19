<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            display: flex;
        }
        .sidebar {
            width: 250px;
            background-color: #343a40;
            color: white;
            height: 100vh;
            position: fixed;
            padding-top: 20px;
        }
        .sidebar a {
            color: white;
            display: block;
            padding: 10px;
            text-decoration: none;
        }
        .sidebar a:hover {
            background-color: #495057;
        }
        .content {
            margin-left: 250px;
            padding: 20px;
            flex-grow: 1;
        }
        .navbar .profile {
            margin-left: auto;
        }
    </style>
</head>
<body>
    
    <div class="sidebar">
        <h4 class="text-center">Admin Panel</h4>
        <a href="#">Dashboard</a>
        <a href="#">Bill</a>
        <a href="#">Report</a>
        <a href="#">Settings</a>
        <a href="#">Settings</a>
        <a href="logout.php">Logout</a>
    </div>

    
    <div class="content">
    
        <nav class="navbar navbar-expand-lg navbar-light bg-light shadow">
            <a class="navbar-brand" href="#"><h3>Welcome To Sai Courier & Cargo Mgmt.</h3> </a>
            <div class="profile dropdown">
                <a href="#" class="nav-link dropdown-toggle" id="profileDropdown" role="button" data-toggle="dropdown">
                    <img src="./img/logo.png" alt="Profile" width="40" height="40" class="rounded-circle">
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="profileDropdown">
                    <header class="head_profile background-color:red">

                    </header>
                    <a class="dropdown-item" href="#">View Profile</a>
                    <a class="dropdown-item" href="#">Email</a>
                    <a class="dropdown-item" href="#">Contact</a>
                    <hr>
                    <a  href="logout.php" style="color: #343a40; margin: left 25px;">Logout</a>
                </div>
            </div>
        </nav>

    
        <div class="mt-4">
            <h3>Welcome to the Admin Panel</h3>
            <p>This is your admin dashboard.</p>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.4.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>





















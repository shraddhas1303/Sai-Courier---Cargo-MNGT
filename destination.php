<?php

$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "user"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $destination = $conn->real_escape_string($_POST['destination']);

    // Ensure destination contains only text
    if (preg_match("/^[a-zA-Z\s]+$/", $destination)) {
        $sql = "INSERT INTO destination (dest_name, dest_status) VALUES ('$destination', 'active')";
        if ($conn->query($sql) === TRUE) {
            $message = "Destination added successfully!";
        } else {
            $message = "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        $message = "Error: Destination can only contain letters and spaces.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Example</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        .sidebar {
            height: 100vh;
            background-color: #1a2a41;
            color: #fff;
            padding: 30px;
            position: fixed;
            width: 240px;
            transition: all 0.3s ease;
        }
        .sidebar h2 {
            font-size: 24px;
            text-align: center;
            font-weight: bold;
            margin-bottom: 30px;
        }
        .sidebar a {
            display: block;
            color: #fff;
            text-decoration: none;
            padding: 12px 15px;
            margin-bottom: 12px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .sidebar a:hover {
            background-color: #3d4f6a;
        }
        .topbar {
            background-color: #fff;
            padding: 10px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid #ddd;
            margin-left: 240px;
        }
        .content {
            margin-left: 260px;
            padding: 30px;
        }
        .footer {
            text-align: center;
            padding: 16px;
            font-size: 14px;
            background-color: #fff;
            border-top: 1px solid #ddd;
            position: fixed;
            bottom: 0;
            left: 240px;
            width: calc(100% - 240px);
        }
        .form-container {
            max-width: 600px;
            margin: 30px auto;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
        }
        .btn-orange {
            background-color: #f57c00;
            color: #fff;
            font-weight: bold;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn-orange:hover {
            background-color: #e76900;
        }
    </style>
</head>
<body>

<div class="sidebar">
    <h2>SAI CURRIER AND CARGO</h2>

    <div class="dropdown">
        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-bar-chart-line"></i> Masters
        </a>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="destination.php" style="color:black">ADD Destination</a></li>
            <li><a class="dropdown-item" href="showlist.php" style="color:black">List of Destination</a></li>
            <li><a class="dropdown-item" href="customer.php" style="color:black">ADD Customers</a></li>
            <li><a class="dropdown-item" href="customer_list.php" style="color:black">List of Customers</a></li>
        </ul>
    </div>
    <div class="dropdown">
        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-bar-chart-line"></i> Bill
        </a>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="createbill.php" style="color:black">Create Bill</a></li>
            <li><a class="dropdown-item" href="billlist.php" style="color:black">Bill List</a></li>
        </ul>
    </div>
    
    <div class="dropdown">
        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-bar-chart-line"></i> Reports
        </a>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#" style="color:black">Today Report</a></li>
            <li><a class="dropdown-item" href="#" style="color:black">Monthly Report</a></li>
        </ul>
    </div>
    
    <div class="footer-icons">
        <i class="bi bi-telephone"></i>
        <i class="bi bi-chat-dots"></i>
    </div>
</div>

<div class="topbar">
    <div>
        <button class="btn btn-light"><i class="bi bi-list"></i></button>
    </div>
    <div>
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="https://th.bing.com/th?q=Female+Profile+Icon+Circle&w=120&h=120&c=1&rs=1&qlt=90&cb=1&dpr=1.3&pid=InlineBlock&mkt=en-IN&cc=IN&setlang=en&adlt=moderate&t=1&mw=247" class="rounded-circle" alt="Profile" style="height:50px; width:50px;">
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="update.php">Profile & Security</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="index.php">Logout</a></li>
            </ul>
        </div>
    </div>
</div>

<div class="content">
    <div class="form-container">
        <h3 class="text-center">Add Destination</h3>
        <?php if (!empty($message)): ?>
            <div class="alert alert-info text-center"><?php echo $message; ?></div>
        <?php endif; ?>
        <form action="" method="POST">
            <div class="mb-3">
                <label for="destination" class="form-label">Destination</label>
                <input type="text" class="form-control" id="destination" name="destination" required>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn-orange">Save</button>
            </div>
        </form>
    </div>
</div>

<div class="footer">
    &copy; 2024 SAI Courier and Cargo. All Rights Reversed.
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

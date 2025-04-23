<?php

$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'user';


$conn = new mysqli($host, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = ""; 


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer_name = $_POST['customer_name'];
    $customer_mobile = $_POST['customer_mobile'];
    $customer_type = $_POST['customer_type'];

   
    $sql = "INSERT INTO customers (customer_name, customer_mobile, customer_type) 
            VALUES ('$customer_name', '$customer_mobile', '$customer_type')";

    if ($conn->query($sql) === TRUE) {
        $message = "Customer added successfully!";
    } else {
        $message = "Error: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Customer</title>
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

        .form-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 30px;
            background-color: #ffffff;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .btn-custom {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 12px 20px;
            font-size: 16px;
            border-radius: 5px;
            width: 100%;
        }

        .btn-custom:hover {
            background-color: #0056b3;
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
    </style>
    <script>
        
        function validateForm() {
            var name = document.getElementById("customer_name").value;
            var mobile = document.getElementById("customer_mobile").value;

            
            var namePattern = /^[a-zA-Z\s]+$/;
            if (!namePattern.test(name)) {
                alert("Customer Name should only contain letters.");
                return false;
            }

           
            var mobilePattern = /^[0-9]{10}$/;
            if (!mobilePattern.test(mobile)) {
                alert("Customer Mobile should contain exactly 10 digits.");
                return false;
            }

            return true;
        }
    </script>
</head>
<body>

<!-- Sidebar -->
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
            <li><a class="dropdown-item" href="#" style="color:black">Bill List</a></li>
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
</div>


<div class="topbar">
    <h3>Dashboard</h3>
    <div>
        <button class="btn btn-light"><i class="bi bi-list"></i></button>
    </div>
</div>


<div class="content">
    <h2>Add New Customer</h2>

    
    <?php if (!empty($message)): ?>
        <div class="alert alert-success"><?php echo $message; ?></div>
    <?php endif; ?>

    <div class="form-container">
        <h3>Enter Customer Details</h3>
        <form action="" method="POST" onsubmit="return validateForm()">
            <div class="form-group">
                <label for="customer_name">Customer Name</label>
                <input type="text" id="customer_name" name="customer_name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="customer_mobile">Customer Mobile</label>
                <input type="text" id="customer_mobile" name="customer_mobile" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="customer_type">Customer Type</label>
                <select id="customer_type" name="customer_type" class="form-control" required>
                    <option value="sender">Sender</option>
                    <option value="receiver">Receiver</option>
                </select>
            </div><br>

            <button type="submit" class="btn-custom">Add Customer</button>
        </form>
    </div>
</div>


<div class="footer">
    &copy; 2025 SAI Courier and Cargo
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

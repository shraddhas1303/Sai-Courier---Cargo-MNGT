<?php
// Database connection
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'user';

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables
$customer_id = 0;
$customer_name = '';
$customer_mobile = '';
$customer_type = '';

// Check if a customer ID is provided
if (isset($_GET['id'])) {
    $customer_id = intval($_GET['id']);
    $sql = "SELECT * FROM customers WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $customer_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $customer_name = $row['customer_name'];
        $customer_mobile = $row['customer_mobile'];
        $customer_type = $row['customer_type'];
    } else {
        die("Customer not found.");
    }
    $stmt->close();
}

// Handle form submission for updating customer details
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customer_id = $_POST['customer_id'];
    $customer_name = $_POST['customer_name'];
    $customer_mobile = $_POST['customer_mobile'];
    $customer_type = $_POST['customer_type'];

    $sql = "UPDATE customers SET customer_name = ?, customer_mobile = ?, customer_type = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sssi', $customer_name, $customer_mobile, $customer_type, $customer_id);

    if ($stmt->execute()) {
        // After successful update, redirect to the customer list page
        echo "<script>alert('Customer updated successfully!'); window.location.href='customer_list.php';</script>";
    } else {
        echo "Error updating record: " . $stmt->error;
    }
    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Customer</title>
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
        .topbar .dropdown-toggle {
            background: none;
            border: none;
            padding: 0;
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
            width: calc(100% - 300px);
            height: 7%;
        }
        .form-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }
        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-container .mb-3 {
            margin-bottom: 15px;
        }
        .form-container input, .form-container select {
            height: 40px;
            font-size: 16px;
        }
        .form-container button {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            background-color: #007bff;
            border: none;
            color: white;
            cursor: pointer;
            border-radius: 5px;
        }
        .form-container button:hover {
            background-color: #0056b3;
        }
    </style>
    <script>
        // JavaScript to validate mobile number and customer name
        function validateForm() {
            var name = document.getElementById("customer_name").value;
            var mobile = document.getElementById("customer_mobile").value;

            // Check if customer name contains only letters (no numbers)
            var namePattern = /^[a-zA-Z\s]+$/;
            if (!namePattern.test(name)) {
                alert("Customer Name should only contain letters.");
                return false;
            }

            // Check if mobile number is exactly 10 digits long and contains only numbers
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
            <button class="btn btn-secondary dropdown-toggle" type="button" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="https://th.bing.com/th?q=Female+Profile+Icon+Circle&w=120&h=120&c=1&rs=1&qlt=90&cb=1&dpr=1.3&pid=InlineBlock&mkt=en-IN&cc=IN&setlang=en&adlt=moderate&t=1&mw=247" class="rounded-circle" alt="Profile" style="height:50px; width: 50px;">
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                <li><a class="dropdown-item" href="update.php">Profile & Security</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="index.php">Logout</a></li>
            </ul>
        </div>
    </div>
</div>

<div class="content">
    <div class="form-container">
        <h2>Edit Customer</h2>
        <form method="POST" action="edit_customer.php?id=<?php echo $customer_id; ?>" onsubmit="return validateForm()">
            <input type="hidden" name="customer_id" value="<?php echo $customer_id; ?>">
            <div class="mb-3">
                <label for="customer_name" class="form-label">Customer Name</label>
                <input type="text" class="form-control" id="customer_name" name="customer_name" value="<?php echo htmlspecialchars($customer_name); ?>" required>
            </div>
            <div class="mb-3">
                <label for="customer_mobile" class="form-label">Customer Mobile</label>
                <input type="text" class="form-control" id="customer_mobile" name="customer_mobile" value="<?php echo htmlspecialchars($customer_mobile); ?>" required>
            </div>
            <div class="mb-3">
                <label for="customer_type" class="form-label">Customer Type</label>
                <select class="form-select" id="customer_type" name="customer_type" required>
                    <option value="Sender" <?php echo $customer_type === 'Sender' ? 'selected' : ''; ?>>Sender</option>
                    <option value="Receiver" <?php echo $customer_type === 'Receiver' ? 'selected' : ''; ?>>Receiver</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update Customer</button>
        </form>
    </div>
</div>

<div class="footer">
    <p>&copy; 2024 Sai Courier and Cargo</p>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

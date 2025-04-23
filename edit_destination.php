<?php

$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "user"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$dest_id = 0;
$dest_name = '';
$dest_status = '';

if (isset($_GET['id'])) {
    $dest_id = intval($_GET['id']);
    $sql = "SELECT * FROM destination WHERE dest_id = $dest_id";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $dest_name = $row['dest_name'];
        $dest_status = $row['dest_status'];
    } else {
        echo "Destination not found.";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dest_id = intval($_POST['dest_id']); // Retrieve dest_id from hidden input field
    $dest_name = $_POST['dest_name'];
    $dest_status = $_POST['dest_status'];

    $sql = "UPDATE destination SET dest_name = ?, dest_status = ? WHERE dest_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $dest_name, $dest_status, $dest_id);

    if ($stmt->execute()) {
        echo "<script>alert('Destination updated successfully!'); window.location.href='showlist.php';</script>";
    } else {
        echo "Error updating record: " . $stmt->error;
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Destination</title>
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
        .sidebar h5 {
            text-align: center;
            color: #ddd;
            margin-bottom: 40px;
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
        .sidebar .footer-icons {
            margin-top: 40px;
            text-align: center;
        }
        .sidebar .footer-icons i {
            margin: 0 15px;
            font-size: 22px;
            cursor: pointer;
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
        .dropdown-menu-end {
            min-width: 150px;
        }
        .footer-icons i:hover {
            color: #007bff;
        }
        .dropdown-menu {
            padding: 0;
        }
        .dropdown-menu a {
            padding: 10px 15px;
        }
        .dropdown-menu a:hover {
            background-color: lightgrey;
            color: #1a0101;
        }
        .content h2 {
            font-size: 32px;
            font-weight: bold;
            color: #343a40;
        }
        .content p {
            font-size: 18px;
            color: #6c757d;
        }
        .form-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 30px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .btn-submit {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
        }
        .btn-submit:hover {
            background-color: #0056b3;
        }
    </style>
    <script>
        function validateDestinationInput() {
            const destName = document.getElementById('dest_name').value;
            const textOnlyPattern = /^[a-zA-Z\s]+$/;
            if (!textOnlyPattern.test(destName)) {
                alert("Please enter text only in the Destination field.");
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
    <h2>Edit Destination</h2>
    <div class="form-container">
        <form method="POST" action="edit_destination.php" onsubmit="return validateDestinationInput()">
            <!-- Hidden input to pass dest_id -->
            <input type="hidden" name="dest_id" value="<?php echo $dest_id; ?>">

            <div class="mb-3">
                <label for="dest_name" class="form-label">Destination Name</label>
                <input 
                    type="text" 
                    class="form-control" 
                    id="dest_name" 
                    name="dest_name" 
                    value="<?php echo htmlspecialchars($dest_name); ?>" 
                    required 
                    pattern="[a-zA-Z\s]+" 
                    title="Only letters and spaces are allowed.">
            </div>
            <div class="mb-3">
                <label for="dest_status" class="form-label">Status</label>
                <select class="form-select" id="dest_status" name="dest_status" required>
                    <option value="active" <?php echo $dest_status === 'active' ? 'selected' : ''; ?>>Active</option>
                    <option value="inactive" <?php echo $dest_status === 'inactive' ? 'selected' : ''; ?>>Inactive</option>
                </select>
            </div>
            <button type="submit" class="btn-submit">Update Destination</button>
        </form>
    </div>
</div>

<div class="footer">
    <p></p>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

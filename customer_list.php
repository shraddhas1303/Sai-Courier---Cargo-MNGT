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

// Handle delete request
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $delete_sql = "DELETE FROM customers WHERE id = $delete_id";
    if ($conn->query($delete_sql) === TRUE) {
        header("Location: customer_list.php?message=Customer+deleted+successfully");
        exit;
    } else {
        echo "<div class='alert alert-danger'>Error deleting customer: " . $conn->error . "</div>";
    }
}

// Retrieve customers by type
$sql_senders = "SELECT * FROM customers WHERE customer_type = 'Sender'";
$result_senders = $conn->query($sql_senders);

$sql_receivers = "SELECT * FROM customers WHERE customer_type = 'Receiver'";
$result_receivers = $conn->query($sql_receivers);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer List - Dashboard</title>
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
        .table td, .table th {
            vertical-align: middle;
        }
        .footer-icons {
            display: flex;
            gap: 10px;
            justify-content: center;
        }
        .footer-icons i {
            font-size: 24px;
            cursor: pointer;
        }
    </style>
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
    
    <div class="footer-icons">
        <i class="bi bi-telephone"></i>
        <i class="bi bi-chat-dots"></i>
    </div>
</div>

<!-- Topbar -->
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
    <h2>Customer List</h2>

    <!-- Sender List -->
    <h3>Senders</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Customer Name</th>
                <th>Customer Mobile</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result_senders->num_rows > 0): ?>
                <?php while ($row = $result_senders->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['customer_name']; ?></td>
                        <td><?php echo $row['customer_mobile']; ?></td>
                        <td>
                            <a href="edit_customer.php?id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>
                            <a href="?delete_id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this customer?')">
                                <i class="bi bi-trash"></i> Delete
                            </a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">No Senders found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <!-- Receiver List -->
    <h3>Receivers</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Customer Name</th>
                <th>Customer Mobile</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result_receivers->num_rows > 0): ?>
                <?php while ($row = $result_receivers->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['customer_name']; ?></td>
                        <td><?php echo $row['customer_mobile']; ?></td>
                        <td>
                            <a href="edit_customer.php?id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>
                            <a href="?delete_id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this customer?')">
                                <i class="bi bi-trash"></i> Delete
                            </a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">No Receivers found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<div class="footer">
    &copy; 2025 SAI Courier and Cargo
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

<?php if (isset($_GET['message'])): ?>
    <script type="text/javascript">
        alert('<?php echo $_GET['message']; ?>');
    </script>
<?php endif; ?>

</body>
</html>

<?php
$conn->close();
?>

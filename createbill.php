<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bill Receipt</title>
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
        .bill-container {
            border: 1px solid #000;
            padding: 10px;
            margin: 10px auto;
            width: 80%;
            background-color: #fff;
        }
        .bill-header {
            text-align: center;
            margin-bottom: 10px;
        }
        .bill-header h1 {
            font-size: 18px;
            margin: 0;
        }
        .bill-header h2 {
            font-size: 14px;
            margin: 0;
        }
        .bill-section label {
            display: block;
            font-size: 14px;
            margin-bottom: 5px;
        }
        .bill-section input,
        .bill-section select {
            width: 100%;
            padding: 8px;
            font-size: 14px;
            margin-bottom: 10px;
        }
        .bill-footer {
            text-align: center;
            margin-top: 10px;
        }
        .btn {
            padding: 8px 15px;
            font-size: 14px;
            cursor: pointer;
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 3px;
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
        <button class="btn btn-light"><i class="bi bi-list"></i></button>
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown">
                <img src="https://th.bing.com/th?q=Female+Profile+Icon+Circle&w=120&h=120&c=1&rs=1&qlt=90&cb=1&dpr=1.3&pid=InlineBlock&mkt=en-IN&cc=IN&setlang=en&adlt=moderate&t=1&mw=247" class="rounded-circle" alt="Profile" style="height:50px; width:50px;">
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="update.php">Profile & Security</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="index.php">Logout</a></li>
            </ul>
        </div>
    </div>
    
    <div class="content">
        <div class="bill-container">
            <div class="bill-header">
                <h1>Bill Receipt</h1>
                <h2>Receipt No.: AUTO</h2>
                <h2>Receipt Date: <span id="today-date"></span></h2>
            </div>
            <div class="bill-section">
                <label>Origin:</label>
                <input type="text" value="Nashik" disabled>
            </div>
            <div class="bill-section">
                <label>Destination:</label>
                <select>
                    <option value="">Select Destination</option>
                    <option value="Mumbai">Mumbai</option>
                    <option value="Pune">Pune</option>
                    <option value="Nagpur">Nagpur</option>
                </select>
            </div>
            <div class="bill-section">
                <label>Sender Type:</label>
                <select>
                    <option value="">Select Sender Type</option>
                    <option value="Individual">Individual</option>
                    <option value="Business">Business</option>
                </select>
            </div>
            <div class="bill-section">
                <label>Receiver Type:</label>
                <select>
                    <option value="">Select Receiver Type</option>
                    <option value="Individual">Individual</option>
                    <option value="Business">Business</option>
                </select>
            </div>
            <div class="bill-section">
                <label>Product Parcel:</label>
                <select>
                    <option value="">Select Parcel Type</option>
                    <option value="Docx">Document</option>
                    <option value="Parcel">Parcel</option>
                </select>
            </div>
            <div class="bill-section">
                <label>Value:</label>
                <input type="text" placeholder="Enter Value">
            </div>
            <div class="bill-section">
                <label>Weight:</label>
                <input type="text" placeholder="Enter Weight">
            </div>
            <div class="bill-section">
                <label>Amount:</label>
                <input type="text" placeholder="Enter Amount">
            </div>
            <div class="bill-footer">
                <button class="btn" onclick="printBill()">Save and Print</button>
            </div>
        </div>
    </div>
    
    <div class="footer">
        <p>© 2025 SAI Courier and Cargo</p>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('today-date').innerText = new Date().toLocaleDateString();
        function printBill() {
            window.print();
        }
    </script>
</body>
</html>

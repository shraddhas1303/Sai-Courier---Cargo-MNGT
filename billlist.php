<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bill List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script>
        // Function to load and display bills
        function loadBills() {
            const bills = JSON.parse(localStorage.getItem('bills')) || [];
            const billTableBody = document.getElementById('billTableBody');

            // Clear table body
            billTableBody.innerHTML = "";

            // Populate table with bills
            bills.forEach((bill, index) => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${index + 1}</td>
                    <td>${bill.receiptNo}</td>
                    <td>${bill.date}</td>
                    <td>${bill.destination}</td>
                    <td>${bill.senderType}</td>
                    <td>${bill.receiverType}</td>
                    <td>${bill.parcelType}</td>
                    <td>${bill.value}</td>
                    <td>${bill.weight}</td>
                    <td>${bill.amount}</td>
                `;
                billTableBody.appendChild(row);
            });
        }

        // Load bills when the page loads
        window.onload = loadBills;
    </script>
</head>
<body>
    <div class="container mt-5">
        <h1>Bill List</h1>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Receipt No</th>
                    <th>Date</th>
                    <th>Destination</th>
                    <th>Sender Type</th>
                    <th>Receiver Type</th>
                    <th>Parcel Type</th>
                    <th>Value</th>
                    <th>Weight</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody id="billTableBody">
                <!-- Rows will be inserted here dynamically -->
            </tbody>
        </table>
    </div>
</body>
</html>

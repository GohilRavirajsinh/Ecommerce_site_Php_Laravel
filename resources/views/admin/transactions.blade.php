<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Manage Transactions</title>
    <link rel="stylesheet" href="transactions_style.css">
    <style>
        /* General Styling */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f2f4f8;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1000px;
            margin: 50px auto;
            padding: 20px;
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        /* Add Button */
        .btn-add {
            background-color: #4CAF50;
            color: white;
            padding: 10px 18px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            float: right;
            margin-bottom: 15px;
            transition: 0.3s;
        }

        .btn-add:hover {
            background-color: #45a049;
        }

        /* Table Styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        td {
            color: #555;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        /* Modal Styling */
        .modal {
            display: none;
            position: fixed;
            z-index: 10;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: white;
            padding: 25px;
            border-radius: 10px;
            width: 400px;
            position: relative;
            animation: fadeIn 0.3s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: scale(0.9);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .modal-content h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .modal-content input {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .modal-content button {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            width: 100%;
            border: none;
            border-radius: 5px;
            margin-top: 10px;
            cursor: pointer;
            transition: 0.3s;
        }

        .modal-content button:hover {
            background-color: #45a049;
        }

        .close {
            color: #aaa;
            position: absolute;
            top: 12px;
            right: 16px;
            font-size: 24px;
            cursor: pointer;
        }

        .close:hover {
            color: #000;
        }

        /* Action Buttons */
        button {
            padding: 6px 12px;
            margin: 2px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: 0.2s;
        }

        button:hover {
            opacity: 0.85;
        }

        button:nth-child(1) {
            background-color: #2196F3;
            color: white;
        }

        button:nth-child(2) {
            background-color: #f44336;
            color: white;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Manage Transactions</h2>
        <button class="btn-add" onclick="showAddTransactionModal()">+ Add Transaction</button>

        <table>
            <thead>
                <tr>
                    <th>Transaction ID</th>
                    <th>Order ID</th>
                    <th>User ID</th>
                    <th>Order Price (INR)</th>
                    <th>Commission (INR)</th>
                    <th>Commission (USD)</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="transactionTable">
                <!-- Dynamic rows will be added here -->
            </tbody>
        </table>
    </div>

    <!-- Add Transaction Modal -->
    <div id="addTransactionModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeAddTransactionModal()">&times;</span>
            <h2>Add Transaction</h2>
            <form id="addTransactionForm">
                <input type="number" id="orderId" placeholder="Order ID" required>
                <input type="number" id="userId" placeholder="User ID" required>
                <input type="number" id="orderPrice" placeholder="Order Price (INR)" required>
                <button type="submit">Add Transaction</button>
            </form>
        </div>
    </div>

    <script src="transactions_script.js"></script>
</body>

</html>

<script>
    document.getElementById('addTransactionForm').addEventListener('submit', async function (e) {
        e.preventDefault();

        const orderId = document.getElementById('orderId').value;
        const userId = document.getElementById('userId').value;
        const orderPrice = parseFloat(document.getElementById('orderPrice').value);

        const commissionINR = orderPrice * 0.10;
        const commissionUSD = await convertINRtoUSD(commissionINR);

        addTransactionToTable(orderId, userId, orderPrice, commissionINR, commissionUSD);
        closeAddTransactionModal();
        this.reset();
    });

    async function convertINRtoUSD(amountINR) {
        try {
            const response = await fetch('https://api.exchangerate-api.com/v4/latest/INR');
            const data = await response.json();
            const exchangeRate = data.rates.USD;
            return (amountINR * exchangeRate).toFixed(2);
        } catch (error) {
            console.error('Error fetching exchange rate:', error);
            return 'Error';
        }
    }

    function addTransactionToTable(orderId, userId, orderPrice, commissionINR, commissionUSD) {
        const table = document.getElementById('transactionTable');
        const row = table.insertRow();
        row.innerHTML = `
        <td>${generateTransactionId()}</td>
        <td>${orderId}</td>
        <td>${userId}</td>
        <td>₹${orderPrice.toFixed(2)}</td>
        <td>₹${commissionINR.toFixed(2)}</td>
        <td>$${commissionUSD}</td>
        <td>
            <button onclick="editTransaction(this)">Edit</button>
            <button onclick="deleteTransaction(this)">Delete</button>
        </td>
    `;
    }

    function generateTransactionId() {
        return 'T' + Math.floor(Math.random() * 100000);
    }

    function showAddTransactionModal() {
        document.getElementById('addTransactionModal').style.display = 'flex';
    }

    function closeAddTransactionModal() {
        document.getElementById('addTransactionModal').style.display = 'none';
    }

    function editTransaction(button) {
        // Implement edit functionality
        alert('Edit functionality to be implemented.');
    }

    function deleteTransaction(button) {
        if (confirm('Are you sure you want to delete this transaction?')) {
            const row = button.parentElement.parentElement;
            row.parentElement.removeChild(row);
        }
    }

</script>
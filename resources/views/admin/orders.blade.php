<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage Orders</title>
    <link rel="stylesheet" href="orders_style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
        }

        .container {
            max-width: 900px;
            margin: 30px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
            text-align: left;
            padding: 10px;
        }

        th {
            background: #007bff;
            color: white;
        }

        button {
            padding: 8px 12px;
            margin: 5px;
            border: none;
            cursor: pointer;
        }

        .btn-add {
            background: #28a745;
            color: white;
            float: right;
            margin-bottom: 10px;
        }

        .btn-edit {
            background: #ffc107;
            color: black;
        }

        .btn-delete {
            background: #dc3545;
            color: white;
        }

        /* Modal Styling */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background: white;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
        }

        .close {
            float: right;
            font-size: 24px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Manage Orders</h2>
        <button class="btn-add" onclick="showAddOrderModal()">+ Add Order</button>

        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>User ID</th>
                    <th>Product ID</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="orderTable">
                <!-- Dynamic rows will be added here -->
            </tbody>
        </table>
    </div>

    <!-- Add Order Modal -->
    <div id="addOrderModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeAddOrderModal()">&times;</span>
            <h2>Add Order</h2>
            <form id="addOrderForm">
                <input type="number" id="userId" placeholder="User ID" required>
                <input type="number" id="productId" placeholder="Product ID" required>
                <select id="orderStatus">
                    <option value="Pending">Pending</option>
                    <option value="Completed">Completed</option>
                    <option value="Cancelled">Cancelled</option>
                </select>
                <button type="submit">Add Order</button>
            </form>
        </div>
    </div>

    <script src="orders_script.js"></script>
</body>

</html>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.getElementById("addOrderForm").addEventListener("submit", function (e) {
            e.preventDefault();
            addOrder();
        });
    });

    // Function to show Add Order modal
    function showAddOrderModal() {
        document.getElementById("addOrderModal").style.display = "flex";
    }

    // Function to close Add Order modal
    function closeAddOrderModal() {
        document.getElementById("addOrderModal").style.display = "none";
    }

    // Function to add a new order dynamically
    function addOrder() {
        let userId = document.getElementById("userId").value;
        let productId = document.getElementById("productId").value;
        let orderStatus = document.getElementById("orderStatus").value;

        if (userId && productId && orderStatus) {
            let table = document.getElementById("orderTable");
            let row = table.insertRow();
            let orderId = table.rows.length; // Generate ID dynamically

            row.innerHTML = `
            <td>${orderId}</td>
            <td>${userId}</td>
            <td>${productId}</td>
            <td>${orderStatus}</td>
            <td>
                <button class="btn-edit" onclick="editOrder(this)">Edit</button>
                <button class="btn-delete" onclick="deleteOrder(this)">Delete</button>
            </td>
        `;

            closeAddOrderModal();
        } else {
            alert("Please fill all fields.");
        }
    }

    // Function to delete an order dynamically
    function deleteOrder(btn) {
        let row = btn.parentNode.parentNode;
        row.parentNode.removeChild(row);
    }

    // Function to edit an order dynamically
    function editOrder(btn) {
        let row = btn.parentNode.parentNode;
        let userId = row.cells[1].innerText;
        let productId = row.cells[2].innerText;
        let orderStatus = row.cells[3].innerText;

        document.getElementById("userId").value = userId;
        document.getElementById("productId").value = productId;
        document.getElementById("orderStatus").value = orderStatus;

        showAddOrderModal();
        row.parentNode.removeChild(row);
    }

</script>
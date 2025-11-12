<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage Affiliate Links</title>
    <link rel="stylesheet" href="affiliate_style.css">
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
        <h2>Manage Affiliate Links</h2>
        <button class="btn-add" onclick="showAddLinkModal()">+ Add Affiliate Link</button>

        <table>
            <thead>
                <tr>
                    <th>Link ID</th>
                    <!-- <th>User ID</th> -->
                    <th>Product ID</th>
                    <th>Affiliate Link</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="linkTable">
                <!-- Dynamic rows will be added here -->
            </tbody>
        </table>
    </div>

    <!-- Add Affiliate Link Modal -->
    <div id="addLinkModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeAddLinkModal()">&times;</span>
            <h2>Add Affiliate Link</h2>
            <form id="addLinkForm">
                <input type="number" id="userId" placeholder="User ID" required>
                <input type="number" id="productId" placeholder="Product ID" required>
                <input type="url" id="affiliateLink" placeholder="Affiliate Link" required>
                <button type="submit">Add Link</button>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.getElementById("addLinkForm").addEventListener("submit", function (e) {
                e.preventDefault();
                addAffiliateLink();
            });
        });

        // Function to show Add Affiliate Link modal
        function showAddLinkModal() {
            document.getElementById("addLinkModal").style.display = "flex";
        }

        // Function to close Add Affiliate Link modal
        function closeAddLinkModal() {
            document.getElementById("addLinkModal").style.display = "none";
        }

        // Function to add a new affiliate link dynamically
        function addAffiliateLink() {
            let userId = document.getElementById("userId").value;
            let productId = document.getElementById("productId").value;
            let affiliateLink = document.getElementById("affiliateLink").value;

            if (userId && productId && affiliateLink) {
                let table = document.getElementById("linkTable");
                let row = table.insertRow();
                let linkId = table.rows.length; // Generate ID dynamically

                row.innerHTML = `
            <td>${linkId}</td>
            <td>${userId}</td>
            <td>${productId}</td>
            <td><a href="${affiliateLink}" target="_blank">${affiliateLink}</a></td>
            <td>
                <button class="btn-edit" onclick="editAffiliateLink(this)">Edit</button>
                <button class="btn-delete" onclick="deleteAffiliateLink(this)">Delete</button>
            </td>
        `;

                closeAddLinkModal();
            } else {
                alert("Please fill all fields.");
            }
        }

        // Function to delete an affiliate link dynamically
        function deleteAffiliateLink(btn) {
            let row = btn.parentNode.parentNode;
            row.parentNode.removeChild(row);
        }

        // Function to edit an affiliate link dynamically
        function editAffiliateLink(btn) {
            let row = btn.parentNode.parentNode;
            let userId = row.cells[1].innerText;
            let productId = row.cells[2].innerText;
            let affiliateLink = row.cells[3].innerText;

            document.getElementById("LiknId").value = linkId;
            document.getElementById("productId").value = productId;
            document.getElementById("affiliateLink").value = affiliateLink;

            showAddLinkModal();
            row.parentNode.removeChild(row);
        }

    </script>
</body>

</html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage Users</title>
    <link rel="stylesheet" href="/users.css">
    <script defer src="/users.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background: #f4f4f4;
            padding: 20px;
        }

        .admin-container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            max-width: 900px;
            margin: auto;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .search-bar {
            text-align: center;
            margin-bottom: 10px;
        }

        .search-bar input {
            width: 50%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 10px;
            text-align: center;
        }

        th {
            background: #333;
            color: white;
        }

        button {
            padding: 6px 10px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            font-size: 14px;
        }

        .edit-btn {
            background: #3498db;
            color: white;
        }

        .delete-btn {
            background: #e74c3c;
            color: white;
        }

        .status-active {
            color: green;
            font-weight: bold;
        }

        .status-inactive {
            color: red;
            font-weight: bold;
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
            border-radius: 5px;
            width: 300px;
            text-align: center;
        }

        .modal-content input,
        .modal-content select {
            width: 100%;
            padding: 5px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .close {
            position: absolute;
            right: 15px;
            font-size: 20px;
            cursor: pointer;
        }
    </style>
</head>

<body>

    <div class="admin-container">
        <h1>Manage Users</h1>

        <div class="search-bar">
            <input type="text" id="search" placeholder="Search users..." onkeyup="searchUsers()">
        </div>

        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="userTable">
                <!-- User data will be dynamically inserted here -->
            </tbody>
        </table>
    </div>

    <!-- Modal for Editing Users -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Edit User</h2>
            <form method="post" action="{{ route('admin.users') }}">
                <label for="editName">Name:</label>
                <input type="text" id="editName">
                <label for="editEmail">Email:</label>
                <input type="email" id="editEmail" disabled>
                <label for="editRole">Role:</label>
                <select id="editRole">
                    <option value="User">User</option>
                    <option value="Admin">Admin</option>
                </select>
                <label for="editStatus">Status:</label>
                <select id="editStatus">
                    <option value="Active">Active</option>
                    <option value="Inactive">Inactive</option>
                </select>
                <button onclick="saveUser()">Save</button>
            </form>
        </div>

    </div>

</body>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        loadUsers();
    });

    let users = [
        { name: "John Doe", email: "john@example.com", role: "Admin", status: "Active" },
        { name: "Jane Smith", email: "jane@example.com", role: "User", status: "Inactive" },
        { name: "Mike Ross", email: "mike@example.com", role: "User", status: "Active" }
    ];

    function loadUsers() {
        let table = document.getElementById("userTable");
        table.innerHTML = "";
        users.forEach((user, index) => {
            let row = `
            <tr>
                <td>${user.name}</td>
                <td>${user.email}</td>
                <td>${user.role}</td>
                <td class="${user.status === 'Active' ? 'status-active' : 'status-inactive'}">${user.status}</td>
                <td>
                    <button class="edit-btn" onclick="editUser(${index})">Edit</button>
                    <button class="delete-btn" onclick="deleteUser(${index})">Delete</button>
                </td>
            </tr>
        `;
            table.innerHTML += row;
        });
    }

    function editUser(index) {
        let user = users[index];
        document.getElementById("editName").value = user.name;
        document.getElementById("editEmail").value = user.email;
        document.getElementById("editRole").value = user.role;
        document.getElementById("editStatus").value = user.status;
        document.getElementById("editModal").style.display = "flex";

        document.getElementById("saveUser").onclick = function () {
            saveUser(index);
        };
    }

    function saveUser(index) {
        users[index].name = document.getElementById("editName").value;
        users[index].role = document.getElementById("editRole").value;
        users[index].status = document.getElementById("editStatus").value;
        closeModal();
        loadUsers();
    }

    function deleteUser(index) {
        Swal.fire({
            title: "Are you sure?",
            text: "You will not be able to recover this user!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                users.splice(index, 1);
                loadUsers();
                Swal.fire("Deleted!", "User has been deleted.", "success");
            }
        });
    }

    function closeModal() {
        document.getElementById("editModal").style.display = "none";
    }

    function searchUsers() {
        let filter = document.getElementById("search").value.toUpperCase();
        let rows = document.querySelectorAll("#userTable tr");

        rows.forEach(row => {
            let name = row.cells[0].innerText.toUpperCase();
            row.style.display = name.includes(filter) ? "" : "none";
        });
    }

</script>
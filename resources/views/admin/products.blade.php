<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products</title>
    <link rel="stylesheet" href="products_style.css">
    <style>
        /* General Styles */
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }

        .container {
            max-width: 1000px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        input,
        textarea {
            width: 100%;
            padding: 10px;
            margin: 7px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .btn-add {
            display: inline-block;
            margin-bottom: 10px;
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 30px;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn-add:hover {
            background-color: #45a049;
        }

        /* Table Styles */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            text-align: center;
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        button {
            padding: 6px 10px;
            margin: 2px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            opacity: 0.9;
        }

        button:nth-child(1) {
            background-color: #2196F3;
            color: white;
        }

        button:nth-child(2) {
            background-color: #f44336;
            color: white;
        }

        /* Modal Styles */
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
            padding: 25px;
            border-radius: 10px;
            width: 400px;
            position: relative;
            animation: slideDown 0.3s ease;
        }

        @keyframes slideDown {
            from {
                transform: translateY(-50px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .close {
            position: absolute;
            top: 10px;
            right: 15px;
            font-size: 24px;
            cursor: pointer;
            color: #333;
        }

        #imagePreview {
            max-width: 100%;
            max-height: 150px;
            margin-top: 10px;
            display: block;
            border-radius: 5px;
        }

        /* Responsive */
        @media(max-width: 500px) {
            .modal-content {
                width: 90%;
            }
        }
    </style>
</head>

<body>

    <div class="container">
        <h2>Manage Products</h2>
        <input type="text" id="searchInput" placeholder="Search by Product Name..." onkeyup="searchProduct()">
        <button class="btn-add" onclick="showAddProductModal()">+ Add Product</button>

        <table>
            <thead>
                <tr>
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="productTable"></tbody>
        </table>
    </div>

    <!-- Add/Edit Product Modal -->
    <div id="addProductModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeAddProductModal()">&times;</span>
            <h2 id="modalTitle">Add Product</h2>
            <form id="addProductForm">
                <input type="number" id="productId" placeholder="Product ID" required>
                <input type="text" id="productName" placeholder="Product Name" required>
                <input type="number" id="price" placeholder="Price" required>
                <input type="file" id="productImage" accept="image/*" onchange="previewImage(event)">
                <img id="imagePreview" src="#" alt="Image Preview" style="display: none;">
                <textarea id="description" placeholder="Description" required></textarea>
                <button type="submit">Save Product</button>
            </form>
        </div>
    </div>

    <script src="products_script.js"></script>

</body>

</html>

<script>
    let products = [];
    let editIndex = null;

    const productTable = document.getElementById("productTable");
    const addProductModal = document.getElementById("addProductModal");
    const addProductForm = document.getElementById("addProductForm");

    function showAddProductModal() {
        editIndex = null;
        document.getElementById("modalTitle").innerText = "Add Product";
        addProductForm.reset();
        document.getElementById('imagePreview').style.display = 'none';
        addProductModal.style.display = "flex";
    }

    function closeAddProductModal() {
        addProductModal.style.display = "none";
    }

    addProductForm.addEventListener("submit", function (e) {
        e.preventDefault();

        const id = document.getElementById("productId").value;
        const name = document.getElementById("productName").value;
        const price = document.getElementById("price").value;
        const imageInput = document.getElementById("productImage");
        const image = imageInput.files[0]?.name || (editIndex !== null ? products[editIndex].image : '');
        const desc = document.getElementById("description").value;

        const productData = { id, name, price, image, desc };

        if (editIndex !== null) {
            products[editIndex] = productData;
        } else {
            products.push(productData);
        }

        displayProducts();
        closeAddProductModal();
    });

    function displayProducts() {
    productTable.innerHTML = "";
    products.forEach((product, index) => {
        productTable.innerHTML += `
        <tr>
            <td>${product.id}</td>
            <td>${product.name}</td>
            <td>${product.price}</td>
            <td><img src="images/${product.image}" width="50" height="50" style="object-fit:cover;"></td>
            <td>${product.desc}</td>
            <td>
                <button onclick="editProduct(${index})">Edit</button>
                <button onclick="deleteProduct(${index})">Delete</button>
            </td>
        </tr>`;
    });
}


    function deleteProduct(index) {
        products.splice(index, 1);
        displayProducts();
    }

    function editProduct(index) {
        const product = products[index];
        editIndex = index;

        document.getElementById("modalTitle").innerText = "Edit Product";
        document.getElementById("productId").value = product.id;
        document.getElementById("productName").value = product.name;
        document.getElementById("price").value = product.price;
        document.getElementById("description").value = product.desc;

        if (product.image) {
            document.getElementById("imagePreview").src = 'images/' + product.image;
            document.getElementById("imagePreview").style.display = 'block';
        } else {
            document.getElementById("imagePreview").style.display = 'none';
        }

        addProductModal.style.display = "flex";
    }

    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function () {
            const output = document.getElementById('imagePreview');
            output.src = reader.result;
            output.style.display = 'block';
        }
        reader.readAsDataURL(event.target.files[0]);
    }

    function searchProduct() {
        const value = document.getElementById("searchInput").value.toLowerCase();
        const filtered = products.filter(p => p.name.toLowerCase().includes(value));
        productTable.innerHTML = "";
        filtered.forEach((product, index) => {
            productTable.innerHTML += `
        <tr>
            <td>${product.id}</td>
            <td>${product.name}</td>
            <td>${product.price}</td>
            <td>${product.image}</td>
            <td>${product.desc}</td>
            <td>
                <button onclick="editProduct(${index})">Edit</button>
                <button onclick="deleteProduct(${index})">Delete</button>
            </td>
        </tr>`;
        });
    }

</script>
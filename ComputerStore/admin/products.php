<?php
include("../config.php");

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin') {
    exit("Access Denied!");
}

/* ADD PRODUCT */
if (isset($_POST['add'])) {

    $name = $_POST['name'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];

    $conn->query("
        INSERT INTO products(name, category, price, stock)
        VALUES('$name', '$category', '$price', '$stock')
    ");
}

/* DELETE PRODUCT */
if (isset($_GET['delete'])) {

    $id = (int)$_GET['delete'];

    $conn->query("
        DELETE FROM products
        WHERE id=$id
    ");

    header("Location: products.php");
    exit();
}

/* FILTER */
$filter = $_GET['category'] ?? '';

if ($filter != '') {

    $result = $conn->query("
        SELECT *
        FROM products
        WHERE category='$filter'
        ORDER BY id DESC
    ");

} else {

    $result = $conn->query("
        SELECT *
        FROM products
        ORDER BY id DESC
    ");
}
?>

<!DOCTYPE html>
<html>

<head>

    <title>Manage Products</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        rel="stylesheet">

</head>

<body class="container mt-4">

    <h2>Manage Products</h2>

    <a href="dashboard.php" class="btn btn-secondary mb-3">
        Back to Dashboard
    </a>

    <hr>

    <h4>Add Product</h4>

    <form method="POST">

        <input
            type="text"
            name="name"
            class="form-control mb-2"
            placeholder="Product Name"
            required>

        <select
            name="category"
            class="form-control mb-2"
            required>

            <option value="">Select Category</option>

            <option value="PC">PC</option>
            <option value="CPU">CPU</option>
            <option value="GPU">GPU</option>
            <option value="RAM">RAM</option>
            <option value="Storage">Storage</option>
            <option value="Motherboard">Motherboard</option>
            <option value="Monitor">Monitor</option>
            <option value="Keyboard">Keyboard</option>
            <option value="Mouse">Mouse</option>
            <option value="Headset">Headset</option>
            <option value="PSU">PSU</option>

        </select>

        <input
            type="number"
            name="price"
            class="form-control mb-2"
            placeholder="Price"
            required>

        <input
            type="number"
            name="stock"
            class="form-control mb-2"
            placeholder="Stock"
            required>

        <button
            type="submit"
            name="add"
            class="btn btn-success">

            Add Product

        </button>

    </form>

    <hr>

    <h4>Product List</h4>

    <form method="GET" class="mb-3">

        <div class="row">

            <div class="col-md-4">

                <select
                    name="category"
                    class="form-control">

                    <option value="">All</option>

                    <option value="PC">PC</option>
                    <option value="CPU">CPU</option>
                    <option value="GPU">GPU</option>
                    <option value="RAM">RAM</option>
                    <option value="Storage">Storage</option>
                    <option value="Motherboard">Motherboard</option>
                    <option value="Monitor">Monitor</option>
                    <option value="Keyboard">Keyboard</option>
                    <option value="Mouse">Mouse</option>
                    <option value="Headset">Headset</option>
                    <option value="PSU">PSU</option>

                </select>

            </div>

            <div class="col-md-2">

                <button
                    type="submit"
                    class="btn btn-primary">

                    Filter

                </button>

            </div>

        </div>

    </form>

    <table class="table table-bordered">

        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Category</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Action</th>
        </tr>

        <?php while ($row = $result->fetch_assoc()) { ?>

            <tr>

                <td><?= $row['id'] ?></td>

                <td><?= htmlspecialchars($row['name']) ?></td>

                <td><?= htmlspecialchars($row['category']) ?></td>

                <td>₱<?= number_format($row['price'], 2) ?></td>

                <td><?= $row['stock'] ?></td>

                <td>

                    <a href="products.php?delete=<?= $row['id'] ?>" class="btn btn-danger btn-sm"
                        onclick="return confirm('Delete this product?')">

                        Delete

                    </a>

                </td>

            </tr>

        <?php } ?>

    </table>

</body>

</html>
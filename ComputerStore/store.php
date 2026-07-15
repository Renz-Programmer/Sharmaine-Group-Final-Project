<?php
include("header.php");

if (isset($_POST['product_id'])) {

    if (!isset($_SESSION['user'])) {
        header("Location: auth.php");
        exit();
    }

    $uid = $_SESSION['user']['id'];
    $product_id = (int)$_POST['product_id'];
    $qty = (int)$_POST['qty'];

    $check = $conn->query("
        SELECT *
        FROM cart
        WHERE user_id = $uid
        AND product_id = $product_id
    ");

    if ($check->num_rows > 0) {

        $conn->query("
            UPDATE cart
            SET quantity = quantity + $qty
            WHERE user_id = $uid
            AND product_id = $product_id
        ");
    } else {

        $conn->query("
            INSERT INTO cart(user_id, product_id, quantity)
            VALUES($uid, $product_id, $qty)
        ");
    }

    echo "
    <div class='alert alert-success'>
         Item added to cart successfully!
    </div>
    ";
}

$category = $_GET['category'] ?? '';

if ($category) {

    $result = $conn->query("
        SELECT *
        FROM products
        WHERE category='$category'
    ");
} else {

    $result = $conn->query("
        SELECT *
        FROM products
    ");
}
?>

<div class="mb-10">
    <a href="store.php" class="btn btn-dark btn-sm">All</a>
    <a href="?category=CPU" class="btn btn-primary btn-sm">CPU</a>
    <a href="?category=GPU" class="btn btn-success btn-sm">GPU</a>
    <a href="?category=RAM" class="btn btn-warning btn-sm">RAM</a>
    <a href="?category=Motherboard" class="btn btn-secondary btn-sm">Motherboard</a>
    <a href="?category=Storage" class="btn btn-info btn-sm">Storage</a>
    <a href="?category=PSU" class="btn btn-danger btn-sm">PSU</a>
    <a href="?category=Monitor" class="btn btn-primary btn-sm">Monitor</a>
    <a href="?category=Mouse" class="btn btn-success btn-sm">Mouse</a>
    <a href="?category=Keyboard" class="btn btn-warning btn-sm">Keyboard</a>
    <a href="?category=Headset" class="btn btn-dark btn-sm">Headset</a>
    <a href="?category=PC" class="btn btn-secondary btn-sm">Prebuilt PC</a>
</div>

<hr>

<div class="row">

    <?php while ($row = $result->fetch_assoc()): ?>

        <div class="col-md-3">

            <div class="card mb-7 shadow h-100">

                <a href="product.php?id=<?= $row['id'] ?>"
                    class="text-decoration-none text-dark">

                    <?php

                    $imagePath = "uploads/" . $row['image'];

                    if (!empty($row['image']) && file_exists($imagePath)) {

                    ?>

                        <img
                            src="<?= htmlspecialchars($imagePath) ?>"
                            class="card-img-top"
                            style="height:200px; object-fit:cover;"
                            alt="<?= htmlspecialchars($row['name']) ?>">

                    <?php } else { ?>

                        <img
                            src="https://via.placeholder.com/300x200?text=No+Image"
                            class="card-img-top"
                            style="height:200px; object-fit:cover;"
                            alt="No Image">

                    <?php } ?>

                    <div class="card-body">

                        <h6>
                            <?= htmlspecialchars($row['name']) ?>
                        </h6>

                        <p class="text-muted">
                            <?= htmlspecialchars($row['category']) ?>
                        </p>

                        <p class="fw-bold text-success">
                            ₱<?= number_format($row['price'], 2) ?>
                        </p>

                    </div>

                </a>

                <div class="card-footer bg-white border-0">

                    <form method="POST">

                        <input
                            type="hidden"
                            name="product_id"
                            value="<?= $row['id'] ?>">

                        <input
                            type="hidden"
                            name="qty"
                            value="1">

                        <button
                            type="submit"
                            class="btn btn-primary w-100">

                            Add to Cart

                        </button>

                    </form>

                </div>

            </div>

        </div>

    <?php endwhile; ?>

</div>

<?php include("footer.php"); ?>
<?php
include("header.php");

$id = (int)($_GET['id'] ?? 0);

$result = $conn->query("
    SELECT *
    FROM products
    WHERE id = $id
");

$product = $result->fetch_assoc();

if (!$product) {
    die("Product not found.");
}

/* ADD TO CART */
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

$imagePath = "uploads/" . $product['image'];
?>

<div class="container mt-4">

    <div class="row">

        <div class="col-md-5 text-center">

            <?php if (!empty($product['image']) && file_exists($imagePath)) { ?>

                <img
                    src="<?= htmlspecialchars($imagePath) ?>"
                    class="img-fluid rounded shadow"
                    style="max-height:500px; width:auto;"
                    alt="<?= htmlspecialchars($product['name']) ?>">

            <?php } else { ?>

                <img
                    src="https://via.placeholder.com/300x300?text=No+Image"
                    class="img-fluid rounded shadow"
                    style="max-height:500px; width:auto;"
                    alt="No Image">

            <?php } ?>

        </div>

        <div class="col-md-7">

            <h2><?= htmlspecialchars($product['name']) ?></h2>

            <p class="text-muted">
                <?= htmlspecialchars($product['category']) ?>
            </p>

            <h3 class="text-success">
                ₱<?= number_format($product['price'], 2) ?>
            </h3>

            <p>
                <strong>Stock:</strong>
                <?= $product['stock'] ?>
            </p>

            <?php if ($product['category'] == 'PC' && !empty($product['specs'])) { ?>

                <hr>

                <h4>Specifications</h4>

                <div class="card mb-3">
                    <div class="card-body">
                        <?= nl2br(htmlspecialchars($product['specs'])) ?>
                    </div>
                </div>

            <?php } ?>

            <hr>

            <h4>Description</h4>

            <p>
                <?= nl2br(htmlspecialchars($product['description'] ?? 'No description available.')) ?>
            </p>

            <form method="POST">

                <input
                    type="hidden"
                    name="product_id"
                    value="<?= $product['id'] ?>">

                <input
                    type="hidden"
                    name="qty"
                    value="1">

                <button
                    type="submit"
                    class="btn btn-primary">

                    Add to Cart

                </button>

                <a
                    href="store.php"
                    class="btn btn-secondary">

                    Back to Store

                </a>

            </form>

        </div>

    </div>

</div>

<?php include("footer.php"); ?>
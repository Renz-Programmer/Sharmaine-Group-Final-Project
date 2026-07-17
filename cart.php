<?php
require_once __DIR__ . '/config.php';

if (!isset($_SESSION['user'])) {
    header("Location: auth.php");
    exit();
}

$uid = $_SESSION['user']['id'];

/* ADD TO CART */
if (isset($_POST['product_id'])) {

    $product_id = (int)$_POST['product_id'];
    $qty = (int)($_POST['qty'] ?? 1);

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
}

/* REMOVE ITEM */
if (isset($_GET['remove'])) {

    $product_id = (int)$_GET['remove'];

    $conn->query("
        DELETE FROM cart
        WHERE user_id = $uid
        AND product_id = $product_id
    ");

    header("Location: cart.php");
    exit();
}

$result = $conn->query("
    SELECT products.*, cart.quantity, cart.product_id AS cart_product_id
    FROM cart
    JOIN products ON products.id = cart.product_id
    WHERE cart.user_id = $uid
");

$total = 0;

include __DIR__ . '/header.php';
?>

<h2 class="mb-4"> Your Cart</h2>

<table class="table table-bordered table-hover">

    <thead>
        <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>

        <?php while ($row = $result->fetch_assoc()): ?>

            <?php
            $itemTotal = $row['price'] * $row['quantity'];
            $total += $itemTotal;
            ?>

            <tr>

                <td>
                    <?php if (!empty($row['image'])): ?>

                        <img src="uploads/<?= rawurlencode($row['image']) ?>"
                            alt="<?= htmlspecialchars($row['name']) ?>"
                            width="80" height="80" style="object-fit:cover;">
                    <?php else: ?>
                        <span class="text-muted">No image</span>
                    <?php endif; ?>
                </td>

                <td>
                    <?= htmlspecialchars($row['name']) ?>
                </td>

                <td>
                    ₱<?= number_format($row['price'], 2) ?>
                </td>

                <td>
                    <?= $row['quantity'] ?>
                </td>

                <td>
                    ₱<?= number_format($itemTotal, 2) ?>
                </td>

                <td>
                    <a href="cart.php?remove=<?= $row['cart_product_id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Remove this item?')">
                        Remove
                    </a>
                </td>

            </tr>

        <?php endwhile; ?>

    </tbody>

</table>

<div class="text-end">

    <h3>
        Total: ₱<?= number_format($total, 2) ?>
    </h3>

    <a href="checkout.php"
        class="btn btn-success">
        Proceed to Checkout
    </a>

</div>

<?php include("footer.php"); ?>

<?php
include("header.php");

if (!isset($_SESSION['user'])) {
    header("Location: auth.php");
    exit();
}

$user = $_SESSION['user'];
$uid = $user['id'];

$result = $conn->query("
    SELECT products.*, cart.quantity
    FROM cart
    JOIN products ON products.id = cart.product_id
    WHERE cart.user_id = $uid
");

$total = 0;
?>

<h2 class="mb-4">🧾 Checkout</h2>

<div class="row">

    <div class="col-md-8">

        <div class="card shadow mb-4">

            <div class="card-header bg-dark text-white">
                Order Summary
            </div>

            <div class="card-body">

                <table class="table table-bordered">

                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Qty</th>
                            <th>Total</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php while ($row = $result->fetch_assoc()): ?>

                            <?php
                            $subtotal = $row['price'] * $row['quantity'];
                            $total += $subtotal;
                            ?>

                            <tr>
                                <td><?= htmlspecialchars($row['name']) ?></td>
                                <td>₱<?= number_format($row['price'], 2) ?></td>
                                <td><?= $row['quantity'] ?></td>
                                <td>₱<?= number_format($subtotal, 2) ?></td>
                            </tr>

                        <?php endwhile; ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

    <div class="col-md-4">

        <div class="card shadow">

            <div class="card-header bg-success text-white">
                Customer Details
            </div>

            <div class="card-body">

                <p>
                    <strong>Name:</strong><br>
                    <?= htmlspecialchars($user['name']) ?>
                </p>

                <p>
                    <strong>Address:</strong><br>
                    <?= htmlspecialchars($user['address']) ?>
                </p>

                <p>
                    <strong>Contact:</strong><br>
                    <?= htmlspecialchars($user['contact']) ?>
                </p>

                <hr>

                <form action="order_confirmation.php" method="POST">
                    <h4 class="text-success">
                    Total: ₱<?= number_format($total, 2) ?>
                    </h4>

                    <input
                        type="hidden"
                        name="total"
                        value="<?= $total ?>">

                    <div class="mb-3">

                        <label class="form-label">
                            Payment Method
                        </label>

                        <select
                            name="payment_method"
                            class="form-select"
                            required>

                            <option value="">Select Payment Method</option>
                            <option value="Cash on Delivery">Cash on Delivery</option>
                            <option value="GCash">GCash</option>
                            <option value="Maya">Maya</option>
                            <option value="Credit/Debit Card">Credit / Debit Card</option>
                            <option value="Bank Transfer">Bank Transfer</option>

                        </select>

                    </div>

                    <button
                        type="submit"
                        class="btn btn-success w-100">

                        ✅ Place Order

                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

<?php include("footer.php"); ?>
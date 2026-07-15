<?php
include("header.php");

if(!isset($_SESSION['user'])){
    header("Location: auth.php");
    exit();
}

$payment = $_POST['payment_method'] ?? '';
$total = $_POST['total'] ?? 0;

$orderNo = "ORD" . rand(100000,999999);
?>

<div class="container mt-5">

    <div class="card shadow">

        <div class="card-body text-center">

            <h1 class="text-success">
                ✅ Order Confirmed
            </h1>

            <hr>

            <h3>
                Order Number:
                <?= $orderNo ?>
            </h3>

            <p>
                Thank you for shopping at
                <strong>Sharmaine Computer Store</strong>.
            </p>

            <p>
                <strong>Payment Method:</strong>
                <?= htmlspecialchars($payment) ?>
            </p>

            <p>
                <strong>Total Amount:</strong>
                ₱<?= number_format($total,2) ?>
            </p>

            <p>
                Estimated Delivery:
                3 - 7 Business Days
            </p>

            <a href="store.php" class="btn btn-primary">
                Continue Shopping
            </a>

        </div>

    </div>

</div>

<?php include("footer.php"); ?>
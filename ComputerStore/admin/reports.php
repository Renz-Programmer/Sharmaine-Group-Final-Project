<?php
include("../config.php");

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin') {
    exit("Access Denied!");
}
?>

<!DOCTYPE html>
<html>
<head>

    <title>Reports</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        rel="stylesheet">

</head>

<body class="container mt-4">

<h2> Reports</h2>

<a href="dashboard.php" class="btn btn-secondary mb-3">
    Back to Dashboard
</a>
<hr>

<!-- INVENTORY REPORT -->

<div class="card mb-4">

    <div class="card-header bg-primary text-white">
         Inventory Report
    </div>

    <div class="card-body">

        <table class="table table-bordered">

            <tr>
                <th>ID</th>
                <th>Product</th>
                <th>Category</th>
                <th>Stock</th>
            </tr>

            <?php

            $products = $conn->query("
                SELECT *
                FROM products
                ORDER BY name
            ");

            while($row = $products->fetch_assoc()){

            ?>

            <tr>

                <td><?= $row['id'] ?></td>

                <td>
                    <?= htmlspecialchars($row['name']) ?>
                </td>

                <td>
                    <?= htmlspecialchars($row['category']) ?>
                </td>

                <td>

                    <?php if($row['stock'] <= 5): ?>

                        <span class="badge bg-danger">
                            <?= $row['stock'] ?>
                        </span>

                    <?php else: ?>

                        <span class="badge bg-success">
                            <?= $row['stock'] ?>
                        </span>

                    <?php endif; ?>

                </td>

            </tr>

            <?php } ?>

        </table>

    </div>

</div>

<!-- AUDIT LOGS -->

<div class="card">

    <div class="card-header bg-dark text-white">
         Audit Logs
    </div>

    <div class="card-body">

        <table class="table table-bordered">

            <tr>
                <th>User</th>
                <th>Action</th>
                <th>Date</th>
            </tr>

            <?php

            $logs = $conn->query("
                SELECT users.name,
                       audit_logs.action,
                       audit_logs.created_at
                FROM audit_logs
                JOIN users
                ON users.id = audit_logs.user_id
                ORDER BY audit_logs.created_at DESC
            ");

            while($row = $logs->fetch_assoc()){

            ?>

            <tr>

                <td>
                    <?= htmlspecialchars($row['name']) ?>
                </td>

                <td>
                    <?= htmlspecialchars($row['action']) ?>
                </td>

                <td>
                    <?= $row['created_at'] ?>
                </td>

            </tr>

            <?php } ?>

        </table>

    </div>

</div>

</body>
</html>
<?php
include("../config.php");

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin') {
    exit("Access Denied!");
}

$productCount = $conn->query("SELECT COUNT(*) AS total FROM products")->fetch_assoc()['total'];
$userCount = $conn->query("SELECT COUNT(*) AS total FROM users")->fetch_assoc()['total'];
$cartCount = $conn->query("SELECT COUNT(*) AS total FROM cart")->fetch_assoc()['total'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f4f6f9;
        }

        .sidebar {
            min-height: 100vh;
            background: #212529;
        }

        .sidebar a {
            color: white;
            display: block;
            text-decoration: none;
            padding: 15px;
            transition: .3s;
        }

        .sidebar a:hover {
            background: #343a40;
            padding-left: 20px;
        }

        .card-dashboard {
            border: none;
            border-radius: 15px;
        }

        .dashboard-header {
            background: white;
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, .1);
        }
    </style>

</head>

<body>

    <div class="container-fluid">

        <div class="row">

            <!-- SIDEBAR -->

            <div class="col-md-2 sidebar">

                <h4 class="text-white text-center mt-4">
                     Admin Panel
                </h4>

                <hr class="text-white">

                <a href="dashboard.php">
                     Dashboard
                </a>

                <a href="products.php">
                     Manage Products
                </a>

                <a href="users.php">
                     Manage Users
                </a>
                <a href="reports.php">
                     Reports
                </a>

                <a href="../index.php">
                      View Store
                </a>

                <a href="../logout.php">
                     Logout
                </a>

            </div>

            <!-- CONTENT -->

            <div class="col-md-10 p-4">

                <div class="dashboard-header">

                    <h2>
                        Welcome,
                        <?= htmlspecialchars($_SESSION['user']['name']) ?>
                    </h2>

                    <p class="text-muted">
                        Sharmaine Computer Store Management System
                    </p>

                </div>

                <div class="row">

                    <div class="col-md-4 mb-4">

                        <div class="card bg-primary text-white card-dashboard">

                            <div class="card-body text-center">

                                <h5>Total Products</h5>

                                <h1>
                                    <?= $productCount ?>
                                </h1>

                            </div>

                        </div>

                    </div>

                    <div class="col-md-4 mb-4">

                        <div class="card bg-success text-white card-dashboard">

                            <div class="card-body text-center">

                                <h5>Total Users</h5>

                                <h1>
                                    <?= $userCount ?>
                                </h1>

                            </div>

                        </div>

                    </div>

                    <div class="col-md-4 mb-4">

                        <div class="card bg-warning text-dark card-dashboard">

                            <div class="card-body text-center">

                                <h5>Cart Items</h5>

                                <h1>
                                    <?= $cartCount ?>
                                </h1>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="card shadow">

                    <div class="card-header">
                        Quick Actions
                    </div>

                    <div class="card-body">

                        <a href="products.php"
                            class="btn btn-primary">
                            Manage Products
                        </a>

                        <a href="users.php"
                            class="btn btn-success">
                            Manage Users
                        </a>

                        <a href="reports.php"
                            class="btn btn-warning">
                            View Reports
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</body>

</html>
<?php require_once __DIR__ . '/config.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sharmaine Computer Store</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f5f5f5;
        }

        .navbar {
            background: linear-gradient(90deg,
                    #0f2027,
                    #203a43,
                    #2c5364);
        }

        .navbar-brand {
            font-size: 24px;
            font-weight: bold;
        }

        .nav-link {
            color: white !important;
            transition: 0.3s;
            font-weight: 500;
        }

        .nav-link:hover {
            color: #ffc107 !important;
        }

        .nav-btn {
            border-radius: 25px;
            padding: 8px 18px;
        }

        .shadow-nav {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        }

        .welcome-user {
            color: #ffc107;
            font-weight: bold;
            margin-right: 10px;
        }
    </style>
</head>

<body class="d-flex flex-column min-vh-100">

    <nav class="navbar navbar-expand-lg navbar-dark shadow-nav">

        <div class="container">

<a class="navbar-brand d-flex align-items-center" href="index.php">

        <img src="Logo.png" alt="Sharmaine Store Logo" style="height:50px; width:auto;" class="me-2">

    <div>
        <div class="fw-bold">
            Sharmaine Store
        </div>

    </div>

</a>

            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarMenu">

                <span class="navbar-toggler-icon"></span>

            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarMenu">

                <ul class="navbar-nav align-items-center">

                    <li class="nav-item">
                        <a class="nav-link" href="index.php">
                             Home
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="store.php">
                             Store
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="cart.php">
                             Cart
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="about.php">About</a>
                    </li>

                    <?php if (isset($_SESSION['user'])): ?>

                        <li class="nav-item">
                            <span class="welcome-user">
                                <?= htmlspecialchars($_SESSION['user']['name']) ?>
                            </span>
                        </li>

                        <?php if (
                            isset($_SESSION['user']['role']) &&
                            $_SESSION['user']['role'] == 'admin'
                        ): ?>

                            <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] == 'admin'): ?>

                                <li class="nav-item">
                                    <a class="nav-link" href="admin/dashboard.php">
                                         Admin Dashboard
                                    </a>
                                </li>

                            <?php endif; ?>

                        <?php endif; ?>

                        <li class="nav-item">
                            <a href="logout.php" class="btn btn-danger nav-btn ms-2">
                                Logout
                            </a>
                        </li>

                    <?php else: ?>


                        <li class="nav-item">
                            <a href="auth.php" class="btn btn-success nav-btn ms-2">
                                Login / Register
                            </a>
                        </li>


                    <?php endif; ?>

                </ul>

            </div>

        </div>

    </nav>

    <main class="container mt-4 flex-grow-1">
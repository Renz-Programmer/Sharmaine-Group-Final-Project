<?php
include("../config.php");

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin') {
    exit("Access Denied!");
}

/* ADD USER */
if (isset($_POST['add'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    $conn->query("
        INSERT INTO users(name,email,password,role)
        VALUES('$name','$email','$password','$role')
    ");

    header("Location: users.php");
    exit();
}

/* UPDATE USER ROLE */
if (isset($_POST['update'])) {

    $id = (int)$_POST['id'];
    $role = $_POST['role'];

    $conn->query("
        UPDATE users
        SET role='$role'
        WHERE id=$id
    ");

    header("Location: users.php");
    exit();
}

/* DELETE USER */
if (isset($_GET['delete'])) {

    $id = (int)$_GET['delete'];

    $conn->query("
        DELETE FROM users
        WHERE id=$id
    ");

    header("Location: users.php");
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>

    <title>Manage Users</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        rel="stylesheet">

</head>

<body class="container mt-4">

    <h2> Manage Users</h2>

    <a href="dashboard.php" class="btn btn-secondary mb-3">
        Back to Dashboard
    </a>

    <hr>

    <h4>Add User</h4>

    <form method="POST">

        <input
            type="text"
            name="name"
            class="form-control mb-2"
            placeholder="Full Name"
            required>

        <input
            type="email"
            name="email"
            class="form-control mb-2"
            placeholder="Email"
            required>

        <input
            type="password"
            name="password"
            class="form-control mb-2"
            placeholder="Password"
            required>

        <select
            name="role"
            class="form-control mb-2">

            <option value="buyer">Buyer</option>
            <option value="admin">Admin</option>

        </select>

        <button
            type="submit"
            name="add"
            class="btn btn-success">

            Add User

        </button>

    </form>

    <hr>

    <h4>User List</h4>

    <table class="table table-bordered">

        <thead>

            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Action</th>
            </tr>

        </thead>

        <tbody>

            <?php

            $result = $conn->query("
        SELECT *
        FROM users
        ORDER BY id DESC
    ");

            while ($row = $result->fetch_assoc()) {

            ?>

                <tr>

                    <form method="POST">

                        <td>
                            <?= $row['id'] ?>

                            <input
                                type="hidden"
                                name="id"
                                value="<?= $row['id'] ?>">
                        </td>

                        <td>
                            <?= htmlspecialchars($row['name']) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($row['email']) ?>
                        </td>

                        <td>

                            <select
                                name="role"
                                class="form-select">

                                <option
                                    value="buyer"
                                    <?= $row['role'] == 'buyer' ? 'selected' : '' ?>>
                                    Buyer
                                </option>

                                <option
                                    value="admin"
                                    <?= $row['role'] == 'admin' ? 'selected' : '' ?>>
                                    Admin
                                </option>

                            </select>

                        </td>
                        <td>

                            <button
                                type="submit"
                                name="update"
                                class="btn btn-warning btn-sm">

                                Update Role

                            </button>

                            <a hrefhp?delete=<?= $row['id'] ?> class="btn btn-danger btn-sm"
                                onclick="return confirm('Delete this user?')">

                                Delete

                            </a>

                        </td>

                    </form>

                </tr>

            <?php } ?>

        </tbody>

    </table>

</body>

</html>
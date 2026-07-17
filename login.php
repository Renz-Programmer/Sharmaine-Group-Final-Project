<?php include("header.php");

if ($_POST) {
    $email = $_POST['email'];

    $res = $conn->query("SELECT * FROM users WHERE email='$email'");
    $user = $res->fetch_assoc();

    if ($user && password_verify($_POST['password'], $user['password'])) {
        $_SESSION['user'] = $user;

        if ($user['role'] == 'admin') {
            header("Location: admin/dashboard.php");
        } else {
            header("Location: store.php");
        }
        exit();
    } else {
        echo "Invalid login!";
    }
}
?>

<h2>Login</h2>

<form method="POST">
    <input name="email" class="form-control mb-2" required>
    <input type="password" name="password" class="form-control mb-2" required>
    <button class="btn btn-success">Login</button>
</form>

<?php include("footer.php"); ?>
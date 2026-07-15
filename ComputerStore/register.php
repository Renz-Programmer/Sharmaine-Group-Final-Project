<?php
include("header.php");
require_once __DIR__ . '/email_helper.php';

if ($_POST) {

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];
    $confirm = $_POST['confirm_password'];
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);

    if ($password != $confirm) {

        echo "<p class='text-danger'>
                Passwords do not match!
              </p>";

    } else {

        $check = $conn->query("
            SELECT id
            FROM users
            WHERE email='$email'
        ");

        if ($check->num_rows > 0) {

            echo "<p class='text-danger'>
                    Email already exists!
                  </p>";

        } else {

            $pass = password_hash($password, PASSWORD_DEFAULT);

            $token = bin2hex(random_bytes(32));

            $conn->query("
                INSERT INTO users(
                    name,
                    email,
                    password,
                    address,
                    contact,
                    is_verified,
                    verification_token
                )
                VALUES(
                    '$name',
                    '$email',
                    '$pass',
                    '$address',
                    '$contact',
                    0,
                    '$token'
                )
            ");

            $sent = send_verification_email($email, $name, $token);

            if ($sent) {
                echo "<div class='alert alert-success'>
                        Registration successful!<br><br>
                        A verification email has been sent to:
                        <strong>$email</strong><br><br>
                        Please verify your account before logging in.
                      </div>";
            } else {
                echo "<div class='alert alert-warning'>
                        Registration completed, but the verification email could not be sent.<br>
                        Please contact support or try again later.
                      </div>";
            }
        }
    }
}
?>

<h2>Register</h2>

<form method="POST">

    <input
        name="name"
        class="form-control mb-2"
        placeholder="Full Name"
        required>

    <input
        name="email"
        type="email"
        class="form-control mb-2"
        placeholder="Email Address"
        required>

    <input
        name="password"
        type="password"
        class="form-control mb-2"
        placeholder="Password"
        required>

    <input
        name="confirm_password"
        type="password"
        class="form-control mb-2"
        placeholder="Confirm Password"
        required>

    <textarea
        name="address"
        class="form-control mb-2"
        placeholder="Complete Address"
        required></textarea>

    <input
        name="contact"
        class="form-control mb-2"
        placeholder="Contact Number"
        required>

    <button
        type="submit"
        class="btn btn-primary">

        Register

    </button>

</form>

<?php include("footer.php"); ?>
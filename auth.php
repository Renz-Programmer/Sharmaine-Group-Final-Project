<?php
require_once __DIR__ . '/config.php';

// LOGIN
if(isset($_POST['login'])){

    $email = $_POST['email'];
    $password = $_POST['password'];

    $result = $conn->query("
        SELECT *
        FROM users
        WHERE email='$email'
    ");

    if($result->num_rows > 0){

        $user = $result->fetch_assoc();

        if(password_verify($password, $user['password'])){

            if($user['is_verified'] == 0){

                echo "
                <div class='alert alert-danger'>
                    Please verify your email before logging in.
                </div>
                ";

            } else {

                $_SESSION['user'] = $user;

                if(isset($user['role']) && $user['role'] == 'admin'){

                    header("Location: admin/dashboard.php");

                } else {

                    header("Location: store.php");

                }

                exit();
            }
        }
    }

    echo "
    <div class='alert alert-danger'>
        Invalid login credentials.
    </div>
    ";
}

// REGISTER
if(isset($_POST['register'])){

    require_once __DIR__ . '/email_helper.php';

    $name = $_POST['name'];
    $email = $_POST['reg_email'];
    $password = $_POST['reg_password'];
    $confirm = $_POST['confirm_password'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];

    if($password != $confirm){

        echo "
        <div class='alert alert-danger'>
            Passwords do not match.
        </div>
        ";

    } else {

        $check = $conn->query("
            SELECT *
            FROM users
            WHERE email='$email'
        ");

        if($check->num_rows > 0){

            echo "
            <div class='alert alert-danger'>
                Email already exists.
            </div>
            ";

        } else {

            $hashedPassword =
            password_hash($password, PASSWORD_DEFAULT);

            $token = bin2hex(random_bytes(32));

            $conn->query("
                INSERT INTO users
                (
                    name,
                    email,
                    password,
                    address,
                    contact,
                    is_verified,
                    verification_token
                )
                VALUES
                (
                    '$name',
                    '$email',
                    '$hashedPassword',
                    '$address',
                    '$contact',
                    0,
                    '$token'
                )
            ");

            $sent = send_verification_email($email, $name, $token);

            if ($sent) {
                echo "
                <div class='alert alert-success'>
                    Registration successful!<br><br>
                    A verification email has been sent to <strong>$email</strong>.<br>
                    Please verify your account before logging in.
                </div>
                ";
            } else {
                echo "
                <div class='alert alert-warning'>
                    Registration completed, but the verification email could not be sent.<br>
                    Please contact support or try again later.
                </div>
                ";
            }
        }
    }
}

include __DIR__ . '/header.php';
?>

<style>
.auth-card{
    max-width:700px;
    margin:auto;
}

.nav-tabs .nav-link{
    color:#333 !important;
    font-weight:bold;
}

.nav-tabs .nav-link.active{
    background:#198754 !important;
    color:white !important;
}
</style>

<div class="row justify-content-center">
    <div class="col-md-8">

        <div class="card shadow-lg auth-card">

            <div class="card-header bg-dark text-white text-center">
                <h3>Sharmaine Computer Store</h3>
            </div>

            <div class="card-body">

                <ul class="nav nav-tabs nav-fill mb-4">

                    <li class="nav-item">
                        <button
                            class="nav-link active"
                            data-bs-toggle="tab"
                            data-bs-target="#loginTab"
                            type="button">
                            Login
                        </button>
                    </li>

                    <li class="nav-item">
                        <button
                            class="nav-link"
                            data-bs-toggle="tab"
                            data-bs-target="#registerTab"
                            type="button">
                            Register
                        </button>
                    </li>

                </ul>

                <div class="tab-content">

                    <!-- LOGIN -->
                    <div class="tab-pane fade show active" id="loginTab">

                        <form method="POST">

                            <div class="mb-3">
                                <label>Email</label>
                                <input
                                    type="email"
                                    name="email"
                                    class="form-control"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label>Password</label>
                                <input
                                    type="password"
                                    name="password"
                                    class="form-control"
                                    required>
                            </div>

                            <button
                                type="submit"
                                name="login"
                                class="btn btn-primary w-100">
                                Login
                            </button>

                        </form>

                    </div>

                    <!-- REGISTER -->
                    <div class="tab-pane fade" id="registerTab">

                        <form method="POST">

                            <div class="mb-3">
                                <label>Full Name</label>
                                <input
                                    type="text"
                                    name="name"
                                    class="form-control"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label>Email</label>
                                <input
                                    type="email"
                                    name="reg_email"
                                    class="form-control"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label>Password</label>
                                <input
                                    type="password"
                                    name="reg_password"
                                    class="form-control"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label>Confirm Password</label>
                                <input
                                    type="password"
                                    name="confirm_password"
                                    class="form-control"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label>Complete Address</label>
                                <textarea
                                    name="address"
                                    class="form-control"
                                    required></textarea>
                            </div>

                            <div class="mb-3">
                                <label>Contact Number</label>
                                <input
                                    type="text"
                                    name="contact"
                                    class="form-control"
                                    required>
                            </div>

                            <button
                                type="submit"
                                name="register"
                                class="btn btn-success w-100">
                                Register
                            </button>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>
</div>

<?php include("footer.php"); ?>
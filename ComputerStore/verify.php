<?php
include("header.php");

$token = $_GET['token'] ?? '';

$result = $conn->query("
    SELECT *
    FROM users
    WHERE verification_token='$token'
");

if($result->num_rows > 0){

    $conn->query("
        UPDATE users
        SET
            is_verified = 1,
            verification_token = NULL
        WHERE verification_token='$token'
    ");

    echo "
    <div class='alert alert-success'>
        ✅ Your account has been verified successfully!

        <br><br>

        <a href='auth.php' class='btn btn-success'>
            Login Now
        </a>
    </div>
    ";

} else {

    echo "
    <div class='alert alert-danger'>
        ❌ Invalid verification link.
    </div>
    ";
}

include("footer.php");
?>
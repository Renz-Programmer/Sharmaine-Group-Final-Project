<?php

$phpMailerBase = __DIR__ . '/email/PHPMailer-master/src';
$phpMailerAvailable = is_file($phpMailerBase . '/PHPMailer.php')
    && is_file($phpMailerBase . '/SMTP.php')
    && is_file($phpMailerBase . '/Exception.php');

if ($phpMailerAvailable) {
    require_once $phpMailerBase . '/PHPMailer.php';
    require_once $phpMailerBase . '/SMTP.php';
    require_once $phpMailerBase . '/Exception.php';
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function send_verification_email($to_email, $to_name, $token) {
    global $phpMailerAvailable;

    if (!$phpMailerAvailable) {
        error_log('PHPMailer is not installed; verification email was not sent.');
        return false;
    }

    $mail = new PHPMailer(true);
    $safeName = htmlspecialchars($to_name, ENT_QUOTES, 'UTF-8');

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'sharmainecomparts@gmail.com';
        $mail->Password = 'xumxtxizfymwudbg';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;
        $mail->CharSet = 'UTF-8';

        $mail->setFrom('sharmainecomparts@gmail.com', 'Sharmaine Computer Store');
        $mail->addReplyTo('sharmainecomparts@gmail.com', 'Sharmaine Store Support');
        $mail->addAddress($to_email, $to_name);

        $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
        $basePath = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])), '/');
        $verifyLink = $scheme . '://' . $_SERVER['HTTP_HOST'] . $basePath
            . '/verify.php?token=' . urlencode($token);

        $mail->isHTML(true);
        $mail->Subject = 'Please verify your Sharmaine Computer Store account';
        $mail->Body = "
            <p>Hello <strong>$safeName</strong>,</p>
            <p>Thank you for registering at Sharmaine Computer Store.</p>
            <p>Please click the button below to verify your account:</p>
            <p><a href='$verifyLink' style='display:inline-block;padding:10px 18px;background:#198754;color:#fff;text-decoration:none;border-radius:4px;'>Verify Account</a></p>
            <p>If the button does not work, paste this link into your browser:</p>
            <p><a href='$verifyLink'>$verifyLink</a></p>
            <p>Thank you,<br>Sharmaine Computer Store Team</p>
        ";
        $mail->AltBody = "Hello $to_name,\n\nPlease verify your account by visiting the following link:\n$verifyLink\n\nThank you,\nSharmaine Computer Store Team";

        return $mail->send();
    } catch (Exception $e) {
        error_log('Mailer Error: ' . $mail->ErrorInfo);
        return false;
    }
}

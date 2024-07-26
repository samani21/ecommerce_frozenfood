<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

function sendVerificationEmail($email, $verification_code)
{
    $mail = new PHPMailer(true);
    try {
        // Server settings
        $mail->SMTPDebug = 0;                                 // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'yogadwimaulanaaa@gmail.com';             // SMTP username
        $mail->Password = 'tajotfkkpdtexeyx';
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                    // TCP port to connect to

        // Recipients
        $mail->setFrom('yogadwimaulanaaa@gmail.com', 'Yoga');
        $mail->addAddress($email);                            // Add a recipient

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Email Verification';
        $mail->Body    = "Click the link below to verify your email address:<br><br>
                          <a href='http://localhost/bikafrozen/verify.php?code=$verification_code'>Verify Email</a>";

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}

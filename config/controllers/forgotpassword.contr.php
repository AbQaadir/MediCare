<?php

declare(strict_types=1);


function isInputEmailEmpty(string $email) {
    if (empty($email)){
        return true;
    } else {
        return false;
    } 
}

function isInputEmailInvalid(string $email) {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        return true;
    } else {
        return false;
    } 
}

function isInputEmailRegistered(object $pdo, string $email) {
    if (getUser($pdo, $email) || getAdmin($pdo, $email) || getSuperAdmin($pdo, $email)) {
        return true;
    } else {
        return false;
    }
}


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

function sendEmail(string $to, string $subject, string $message) {

    try {
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->Username = "qaadir.inbox@gmail.com";
        $mail->Password = "gyktsixjrzbwmwhj";
        $mail->setFrom("qaadir.inbox@gmail.com", "Assignment 02");
        $mail->addAddress($to);

        $mail->Subject = $subject;
        $mail->Body = $message;

        $mail->send();
        return true; // Email sent successfully
    } catch (Exception $e) {
        return false; // Email sending failed
    }
}
<?php
header('Content-type: text/html; charset=utf-8');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'class.phpmailer.php';
require 'class.smtp.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    $to = "";
    $subject = "Webka";

    $body = "Meno: $name\n";
    $body .= "Email: $email\n";
    $body .= "Správa:\n$message";

    $headers = "From: $email";

    $smtp_host = "";
    $smtp_port = 25; 
    $smtp_username = ""; 
    $smtp_password = ""; 

    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->Host = $smtp_host;
    $mail->Port = $smtp_port;
    $mail->SMTPAuth = true;
    $mail->Username = $smtp_username;
    $mail->Password = $smtp_password;
    $mail->From = "";
    $mail->FromName = $name;
    $mail->addAddress($to);
    $mail->Subject = $subject;
    $mail->Body = $body;

    try {
        $mail->send();
        echo "<script>
                alert('Čoskoro sa Vám ozveme!');
                window.location.href = 'index.html';
              </script>";
    } catch (Exception $e) {
        echo "<script>
                alert('Failed to send email. Error: " . addslashes($mail->ErrorInfo) . "');
                window.location.href = 'index.html';
              </script>";
    }
}
?>
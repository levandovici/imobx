<?php
// Advanced contact form using PHPMailer
// This file demonstrates how to use PHPMailer if you decide to use Composer

session_start();

// Load Composer autoloader
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Form handling
$form_message = '';
$form_message_type = ''; // 'success' or 'error'

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['contact_form'])) {
    // Sanitize and validate form data
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);
    
    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $form_message = 'Invalid email address';
        $form_message_type = 'error';
    } elseif (empty($name) || empty($message)) {
        $form_message = 'Please fill in all fields';
        $form_message_type = 'error';
    } else {
        try {
            // Create PHPMailer instance
            $mail = new PHPMailer(true);
            
            // Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.example.com'; // Your SMTP server
            $mail->SMTPAuth = true;
            $mail->Username = 'your_email@example.com'; // SMTP username
            $mail->Password = 'your_password'; // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;
            
            // Recipients
            $mail->setFrom($email, $name);
            $mail->addAddress('contact@imobx.md', 'IMOBX Contact');
            $mail->addReplyTo($email, $name);
            
            // Content
            $mail->isHTML(true);
            $mail->Subject = 'New Contact Form Submission from IMOBX.MD';
            $mail->Body = "
                <html>
                <head>
                    <title>New Contact Form Submission</title>
                </head>
                <body>
                    <h2>Contact Form Details</h2>
                    <p><strong>Name:</strong> {$name}</p>
                    <p><strong>Email:</strong> {$email}</p>
                    <p><strong>Message:</strong></p>
                    <p>{$message}</p>
                    <hr>
                    <p><small>Sent from: {$_SERVER['REMOTE_ADDR']} at " . date('Y-m-d H:i:s') . "</small></p>
                </body>
                </html>
            ";
            $mail->AltBody = "Name: {$name}\nEmail: {$email}\nMessage:\n{$message}\n\nSent from: {$_SERVER['REMOTE_ADDR']} at " . date('Y-m-d H:i:s');
            
            // Send email
            $mail->send();
            $form_message = 'Thank you! Your message has been sent successfully.';
            $form_message_type = 'success';
            
        } catch (Exception $e) {
            $form_message = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            $form_message_type = 'error';
        }
    }
}

// Language detection and handling (same as main file)
$supported_languages = ['ru', 'ro', 'en'];
$default_language = 'ru';

if (isset($_GET['lang']) && in_array($_GET['lang'], $supported_languages)) {
    $_SESSION['lang'] = $_GET['lang'];
    $current_lang = $_GET['lang'];
} elseif (isset($_SESSION['lang']) && in_array($_SESSION['lang'], $supported_languages)) {
    $current_lang = $_SESSION['lang'];
} else {
    $current_lang = $default_language;
}

// Include the rest of the index.php file from line 18 onwards
// You would need to extract the translations and HTML from the main file
// and include them here, or modify the main file to use this approach

// For now, this is a demonstration of how to implement PHPMailer
echo "PHPMailer contact form implementation. See code comments for usage.";
?>
<?php
// Include PHPMailer library
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './vendor/autoload.php';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if (empty($_POST['g-recaptcha-response'])) {
        echo "Please verify that you are not a robot.";
        exit;
    }
    // Verify reCAPTCHA
    $recaptchaSecret = '#';
    $recaptchaResponse = $_POST['g-recaptcha-response'];

    $verify = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$recaptchaSecret&response=$recaptchaResponse");
    $responseData = json_decode($verify);

    if (!$responseData->success) {
        die("reCAPTCHA verification failed. Please try again.");
    }

    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];

    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);


    try {
        // SMTP configuration
        $mail->isSMTP();
        $mail->Host = '#'; // Replace with your SMTP server address
        $mail->SMTPAuth = true;
        $mail->Username = 'contact@s.com'; // Replace with your SMTP username
        $mail->Password = 'pass'; // Replace with your SMTP password
        $mail->Port = 465;
        $mail->SMTPSecure = 'ssl'; // Enable TLS encryption

        // Email settings
        $mail->setFrom('contact@s.com', 'Chithra Decors Contact Form'); // Replace with your email and name
        $mail->addAddress('contact@s.com'); // Add recipient's email

        $mail->Subject = "Message from $name";
        $mail->isHTML(true);
       $mailContent = '
    <div style="font-family: Arial, sans-serif; max-width: 600px; margin: auto; border: 1px solid #ddd; padding: 20px;">
        <h2 style="color: #1976d2; text-align: center;">Chithra Decors</h2>
        <h3 style="text-align: center; color: #444;">New Contact Form Submission</h3>
        <hr style="border-top: 1px solid #ccc;">

        <p><strong>Name:</strong> ' . htmlspecialchars($name) . '</p>
        <p><strong>Email:</strong> ' . htmlspecialchars($email) . '</p>
        <p><strong>Phone:</strong> ' . htmlspecialchars($phone) . '</p>
        <p><strong>Message:</strong><br>' . nl2br(htmlspecialchars($message)) . '</p>

        <hr style="border-top: 1px solid #ccc;">
        <p style="font-size: 12px; color: #777; text-align: center;">This message was sent from the contact form on the Sri Mahalaxmi Hospital website.</p>
    </div>';

        $mail->Body = $mailContent;

        // Send the email
       if ($mail->send()) {
    echo "success"; // Don't return full HTML
} else {
    echo "Failed to send email.";
}
    } catch (Exception $e) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    }
} else {
    // Redirect to 'index.html' if accessed without POST
    header('Location: index.html');
    exit;
}

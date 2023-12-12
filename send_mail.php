<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents("php://input"), true);

    // reCAPTCHA server-side verification
    $recaptchaUrl = 'https://www.google.com/recaptcha/api/siteverify';
    $recaptchaSecret = '6LfTWS4pAAAAAAe5w2Mob23CWCUzqKgy2vXGucmv';  // Your secret key
    $recaptchaResponse = $data['recaptchaResponse'];

    $verifyResponse = file_get_contents($recaptchaUrl . '?secret=' . $recaptchaSecret . '&response=' . $recaptchaResponse);
    $responseData = json_decode($verifyResponse);

    if (!$responseData->success) {
        echo 'reCAPTCHA verification failed.';
        exit;
    }

    // Email sending logic
    $to = 'electricalemailname@gmail.com'; // Replace with your email address
    $subject = 'New Contact Form Message from ' . $data['firstName'] . ' ' . $data['lastName'];
    $message = "You have received a new message from your website contact form.\n\n";
    $message .= "Here are the details:\n\n";
    $message .= "Name: " . $data['firstName'] . ' ' . $data['lastName'] . "\n";
    $message .= "Email: " . $data['email'] . "\n";
    $message .= "Message:\n" . $data['message'] . "\n";

    // To send HTML mail, the Content-type header must be set
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/plain;charset=UTF-8" . "\r\n";

    // Additional headers
    $headers .= 'From: <electricalemailname@gmail.com>' . "\r\n"; // Replace with your mail address

    if (mail($to, $subject, $message, $headers)) {
        echo 'Mail sent successfully.';
    } else {
        echo 'Mail sending failed.';
    }
}
?>



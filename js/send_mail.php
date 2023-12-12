<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents("php://input"), true);

    $to = 'electricalemailname@gmail.com';
    $subject = 'New Contact Form Submission';
    $message = "Name: " . $data['firstName'] . " " . $data['lastName'] . "\n";
    $message .= "Email: " . $data['email'] . "\n";
    $message .= "Message: " . $data['message'];
    $headers = 'From: webmaster@example.com' . "\r\n" .
               'Reply-To: ' . $data['email'] . "\r\n" .
               'X-Mailer: PHP/' . phpversion();

    mail($to, $subject, $message, $headers);

    echo 'Mail sent.';
}
?>

<?php
// Enable error reporting for debugging (remove in production)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate input data
    $name = htmlspecialchars(strip_tags(trim($_POST['name'])));
    $email = htmlspecialchars(strip_tags(trim($_POST['email'])));
    $message = htmlspecialchars(strip_tags(trim($_POST['message'])));

    // Validate name
    if (empty($name)) {
        die("Error: Name is required.");
    }

    // Validate email
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Error: A valid email address is required.");
    }

    // Validate message
    if (empty($message)) {
        die("Error: Message cannot be empty.");
    }

    // Example: Send an email (configure your mail server)
    $to = "hhalimou51@gmail.com"; // Replace with your email address
    $subject = "New Contact Form Submission";
    $body = "Name: $name\nEmail: $email\nMessage:\n$message";
    $headers = "From: $email";

    if (mail($to, $subject, $body, $headers)) {
        echo "Thank you for contacting us, $name. We will get back to you soon!";
    } else {
        echo "Error: Failed to send your message. Please try again later.";
    }
} else {
    // Redirect if the form is accessed without a POST request
    header("Location: contact.html");
    exit();
}
?>

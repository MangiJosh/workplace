<?php
// Simple contact handler
header('Content-Type: text/html; charset=UTF-8');

$firstName = isset($_REQUEST['firstName']) ? trim($_REQUEST['firstName']) : '';
$lastName = isset($_REQUEST['lastName']) ? trim($_REQUEST['lastName']) : '';
$email = isset($_REQUEST['email']) ? trim($_REQUEST['email']) : '';
$phone = isset($_REQUEST['phone']) ? trim($_REQUEST['phone']) : '';
$subject = isset($_REQUEST['subject']) ? trim($_REQUEST['subject']) : '';
$message = isset($_REQUEST['message']) ? trim($_REQUEST['message']) : '';

if (!empty($firstName) && !empty($lastName) && !empty($email) && !empty($subject) && !empty($message)) {
    // Send email
    $to = "mangi@thingstech.co.za";
    $emailSubject = "New Contact Form - " . $subject;
    
    $emailBody = "New Contact Form Submission\n\n";
    $emailBody .= "Name: " . $firstName . " " . $lastName . "\n";
    $emailBody .= "Email: " . $email . "\n";
    $emailBody .= "Phone: " . $phone . "\n";
    $emailBody .= "Subject: " . $subject . "\n\n";
    $emailBody .= "Message:\n" . $message . "\n\n";
    $emailBody .= "---\nSent from website contact form";
    
    $headers = "From: " . $email . "\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";
    
    @mail($to, $emailSubject, $emailBody, $headers);
    
    // Show success page
    echo "<!DOCTYPE html>
    <html>
    <head>
        <title>Message Sent</title>
        <style>
            body { font-family: Arial, sans-serif; text-align: center; padding: 50px; background: #f5f5f5; }
            .container { background: white; padding: 40px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); max-width: 500px; margin: 0 auto; }
            .success { color: #28a745; font-size: 24px; margin-bottom: 20px; }
            .info { color: #666; margin: 10px 0; }
            .btn { background: #007bff; color: white; padding: 12px 24px; text-decoration: none; border-radius: 5px; display: inline-block; margin: 10px; }
            .btn:hover { background: #0056b3; }
        </style>
    </head>
    <body>
        <div class='container'>
            <div class='success'>✓ Message Sent!</div>
            <div class='info'>Thank you, " . htmlspecialchars($firstName) . "!</div>
            <div class='info'>Your message has been sent to mangi@thingstech.co.za</div>
            <div class='info'>We'll get back to you within 24 hours.</div>
            <a href='contact.html' class='btn'>Return to Contact Form</a>
            <a href='index.html' class='btn'>Go Home</a>
        </div>
    </body>
    </html>";
} else {
    // Redirect to contact form
    header("Location: contact.html");
    exit();
}
?>

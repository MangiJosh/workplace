<?php
// Handle contact form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $firstName = htmlspecialchars($_POST['firstName'] ?? '');
    $lastName = htmlspecialchars($_POST['lastName'] ?? '');
    $email = htmlspecialchars($_POST['email'] ?? '');
    $phone = htmlspecialchars($_POST['phone'] ?? '');
    $subject = htmlspecialchars($_POST['subject'] ?? '');
    $message = htmlspecialchars($_POST['message'] ?? '');
    
    // Email configuration
    $to = "info@theworkplacewithdumisani.co.za";
    $emailSubject = "New Contact Form Submission - " . $subject;
    
    // Create email body
    $emailBody = "
    New Contact Form Submission
    
    Contact Information:
    Name: {$firstName} {$lastName}
    Email: {$email}
    Phone: {$phone}
    Subject: {$subject}
    
    Message:
    {$message}
    
    ---
    This message was sent from the contact form on your website.
    ";
    
    // Send email
    $headers = "From: {$email}\r\n";
    $headers .= "Reply-To: {$email}\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
    
    if (mail($to, $emailSubject, $emailBody, $headers)) {
        // Redirect to confirmation page
        header("Location: order-confirmation.html?type=contact");
        exit();
    } else {
        // Handle error
        header("Location: order-confirmation.html?type=error");
        exit();
    }
} else {
    // If not POST request, redirect to home
    header("Location: index.html");
    exit();
}
?>

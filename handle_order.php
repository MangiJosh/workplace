<?php
// Handle order form submission
// Debug information
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if this is a POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = htmlspecialchars($_POST['name'] ?? '');
    $email = htmlspecialchars($_POST['email'] ?? '');
    $phone = htmlspecialchars($_POST['phone'] ?? '');
    $address = htmlspecialchars($_POST['address'] ?? '');
    $quantity = htmlspecialchars($_POST['quantity'] ?? '1');
    
    // Email configuration
    $to = "info@theworkplacewithdumisani.co.za";
    $subject = "New Book Order - " . $name;
    
    // Create email body
    $emailBody = "
    New Book Order Received
    
    Customer Information:
    Name: {$name}
    Email: {$email}
    Phone: {$phone}
    
    Order Details:
    Quantity: {$quantity} book(s)
    
    Delivery Address:
    {$address}
    
    ---
    This order was placed through the website order form.
    ";
    
    // Send email
    $headers = "From: {$email}\r\n";
    $headers .= "Reply-To: {$email}\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
    
    if (mail($to, $subject, $emailBody, $headers)) {
        // Redirect to confirmation page
        header("Location: order-confirmation.html?type=order");
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

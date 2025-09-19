<?php
// Alternative order handler with better error handling
header('Content-Type: text/html; charset=UTF-8');

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Log the request for debugging
$log = "Request Method: " . $_SERVER["REQUEST_METHOD"] . "\n";
$log .= "Request URI: " . $_SERVER["REQUEST_URI"] . "\n";
$log .= "POST data: " . print_r($_POST, true) . "\n";
file_put_contents('order_debug.log', $log, FILE_APPEND);

// Check if this is a POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Get form data
        $name = isset($_POST['name']) ? htmlspecialchars(trim($_POST['name'])) : '';
        $email = isset($_POST['email']) ? htmlspecialchars(trim($_POST['email'])) : '';
        $phone = isset($_POST['phone']) ? htmlspecialchars(trim($_POST['phone'])) : '';
        $address = isset($_POST['address']) ? htmlspecialchars(trim($_POST['address'])) : '';
        $quantity = isset($_POST['quantity']) ? htmlspecialchars(trim($_POST['quantity'])) : '1';
        
        // Basic validation
        if (empty($name) || empty($email) || empty($address)) {
            throw new Exception("Required fields are missing");
        }
        
        // Email configuration
        $to = "info@theworkplacewithdumisani.co.za";
        $subject = "New Book Order - " . $name;
        
        // Create email body
        $emailBody = "New Book Order Received\n\n";
        $emailBody .= "Customer Information:\n";
        $emailBody .= "Name: {$name}\n";
        $emailBody .= "Email: {$email}\n";
        $emailBody .= "Phone: {$phone}\n\n";
        $emailBody .= "Order Details:\n";
        $emailBody .= "Quantity: {$quantity} book(s)\n\n";
        $emailBody .= "Delivery Address:\n";
        $emailBody .= "{$address}\n\n";
        $emailBody .= "---\n";
        $emailBody .= "This order was placed through the website order form.\n";
        
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
        
    } catch (Exception $e) {
        // Log error
        error_log("Order form error: " . $e->getMessage());
        header("Location: order-confirmation.html?type=error");
        exit();
    }
} else {
    // If not POST request, show error message
    echo "<h1>405 Method Not Allowed</h1>";
    echo "<p>This page only accepts POST requests.</p>";
    echo "<p>Request method received: " . $_SERVER["REQUEST_METHOD"] . "</p>";
    echo "<p><a href='workplace.html'>Return to Order Form</a></p>";
}
?>

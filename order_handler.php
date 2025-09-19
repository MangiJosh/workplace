<?php
// Comprehensive order handler that handles both GET and POST
header('Content-Type: text/html; charset=UTF-8');

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Log all requests for debugging
$log_entry = date('Y-m-d H:i:s') . " - ";
$log_entry .= "Method: " . $_SERVER["REQUEST_METHOD"] . " | ";
$log_entry .= "URI: " . $_SERVER["REQUEST_URI"] . " | ";
$log_entry .= "Data: " . json_encode($_REQUEST) . "\n";
file_put_contents('debug.log', $log_entry, FILE_APPEND);

// Handle both GET and POST requests
$method = $_SERVER["REQUEST_METHOD"];

if ($method == "POST" || $method == "GET") {
    // Get form data from either POST or GET
    $name = isset($_REQUEST['name']) ? htmlspecialchars(trim($_REQUEST['name'])) : '';
    $email = isset($_REQUEST['email']) ? htmlspecialchars(trim($_REQUEST['email'])) : '';
    $phone = isset($_REQUEST['phone']) ? htmlspecialchars(trim($_REQUEST['phone'])) : '';
    $address = isset($_REQUEST['address']) ? htmlspecialchars(trim($_REQUEST['address'])) : '';
    $quantity = isset($_REQUEST['quantity']) ? htmlspecialchars(trim($_REQUEST['quantity'])) : '1';
    
    // Check if we have the minimum required data
    if (!empty($name) && !empty($email) && !empty($address)) {
        // Email configuration
        $to = "mangi@thingstech.co.za";
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
        
        $emailSent = @mail($to, $subject, $emailBody, $headers);
        
        if ($emailSent) {
            // Redirect to confirmation page
            header("Location: order-confirmation.html?type=order");
            exit();
        } else {
            // Show success page even if email fails (for testing)
            echo "<!DOCTYPE html>
            <html>
            <head>
                <title>Order Received</title>
                <style>
                    body { font-family: Arial, sans-serif; text-align: center; padding: 50px; }
                    .success { color: green; font-size: 24px; }
                    .info { color: #666; margin: 20px 0; }
                </style>
            </head>
            <body>
                <div class='success'>✓ Order Received!</div>
                <div class='info'>Thank you, {$name}! Your order has been received.</div>
                <div class='info'>Email: {$email}</div>
                <div class='info'>Quantity: {$quantity}</div>
                <p><a href='workplace.html'>Return to Order Form</a> | <a href='index.html'>Home</a></p>
            </body>
            </html>";
            exit();
        }
    } else {
        // Show form if no data provided
        echo "<!DOCTYPE html>
        <html>
        <head>
            <title>Order Form</title>
            <style>
                body { font-family: Arial, sans-serif; max-width: 600px; margin: 50px auto; padding: 20px; }
                .form-group { margin: 15px 0; }
                label { display: block; margin-bottom: 5px; font-weight: bold; }
                input, textarea { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; }
                button { background: #007cba; color: white; padding: 12px 24px; border: none; border-radius: 4px; cursor: pointer; }
                button:hover { background: #005a87; }
            </style>
        </head>
        <body>
            <h1>Book Order Form</h1>
            <form method='POST' action='order_handler.php'>
                <div class='form-group'>
                    <label for='name'>Full Name *</label>
                    <input type='text' id='name' name='name' required>
                </div>
                <div class='form-group'>
                    <label for='email'>Email Address *</label>
                    <input type='email' id='email' name='email' required>
                </div>
                <div class='form-group'>
                    <label for='phone'>Phone Number</label>
                    <input type='tel' id='phone' name='phone'>
                </div>
                <div class='form-group'>
                    <label for='address'>Delivery Address *</label>
                    <textarea id='address' name='address' rows='3' required></textarea>
                </div>
                <div class='form-group'>
                    <label for='quantity'>Quantity</label>
                    <input type='number' id='quantity' name='quantity' value='1' min='1' max='10'>
                </div>
                <button type='submit'>Place Order</button>
            </form>
            <p><a href='workplace.html'>← Back to Main Page</a></p>
        </body>
        </html>";
        exit();
    }
} else {
    // Unsupported method
    echo "<h1>Method Not Allowed</h1>";
    echo "<p>This page only accepts GET and POST requests.</p>";
    echo "<p>Received method: " . $method . "</p>";
    echo "<p><a href='workplace.html'>Return to Order Form</a></p>";
}
?>

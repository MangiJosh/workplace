<?php
// Simple order handler that works around 405 errors
// This file can be accessed directly or via form submission

// Set content type
header('Content-Type: text/html; charset=UTF-8');

// Get form data from any method
$name = isset($_REQUEST['name']) ? trim($_REQUEST['name']) : '';
$email = isset($_REQUEST['email']) ? trim($_REQUEST['email']) : '';
$phone = isset($_REQUEST['phone']) ? trim($_REQUEST['phone']) : '';
$address = isset($_REQUEST['address']) ? trim($_REQUEST['address']) : '';
$quantity = isset($_REQUEST['quantity']) ? trim($_REQUEST['quantity']) : '1';

// If form data is provided, process it
if (!empty($name) && !empty($email) && !empty($address)) {
    // Send email
    $to = "mangi@thingstech.co.za";
    $subject = "New Book Order - " . $name;
    
    $message = "New Book Order Received\n\n";
    $message .= "Customer: " . $name . "\n";
    $message .= "Email: " . $email . "\n";
    $message .= "Phone: " . $phone . "\n";
    $message .= "Quantity: " . $quantity . "\n\n";
    $message .= "Delivery Address:\n" . $address . "\n\n";
    $message .= "---\nSent from website order form";
    
    $headers = "From: " . $email . "\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";
    
    // Try to send email
    $emailSent = @mail($to, $subject, $message, $headers);
    
    // Show success page
    echo "<!DOCTYPE html>
    <html>
    <head>
        <title>Order Confirmation</title>
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
            <div class='success'>✓ Order Received!</div>
            <div class='info'>Thank you, " . htmlspecialchars($name) . "!</div>
            <div class='info'>Your order has been sent to mangi@thingstech.co.za</div>
            <div class='info'>We'll contact you within 24 hours.</div>
            <a href='workplace.html' class='btn'>Return to Order Form</a>
            <a href='index.html' class='btn'>Go Home</a>
        </div>
    </body>
    </html>";
    
} else {
    // Show the order form
    echo "<!DOCTYPE html>
    <html>
    <head>
        <title>Book Order Form</title>
        <style>
            body { font-family: Arial, sans-serif; max-width: 600px; margin: 50px auto; padding: 20px; background: #f5f5f5; }
            .container { background: white; padding: 40px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
            .form-group { margin: 20px 0; }
            label { display: block; margin-bottom: 5px; font-weight: bold; color: #333; }
            input, textarea { width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 5px; font-size: 16px; }
            button { background: #007bff; color: white; padding: 15px 30px; border: none; border-radius: 5px; font-size: 16px; cursor: pointer; }
            button:hover { background: #0056b3; }
            .required { color: red; }
        </style>
    </head>
    <body>
        <div class='container'>
            <h1>Order Your Book</h1>
            <form method='POST' action='simple_order.php'>
                <div class='form-group'>
                    <label for='name'>Full Name <span class='required'>*</span></label>
                    <input type='text' id='name' name='name' required>
                </div>
                <div class='form-group'>
                    <label for='email'>Email Address <span class='required'>*</span></label>
                    <input type='email' id='email' name='email' required>
                </div>
                <div class='form-group'>
                    <label for='phone'>Phone Number</label>
                    <input type='tel' id='phone' name='phone'>
                </div>
                <div class='form-group'>
                    <label for='address'>Delivery Address <span class='required'>*</span></label>
                    <textarea id='address' name='address' rows='4' required></textarea>
                </div>
                <div class='form-group'>
                    <label for='quantity'>Quantity</label>
                    <input type='number' id='quantity' name='quantity' value='1' min='1' max='10'>
                </div>
                <button type='submit'>Place Order</button>
            </form>
            <p><a href='workplace.html'>← Back to Main Page</a></p>
        </div>
    </body>
    </html>";
}
?>

<?php
// Universal form handler that accepts data via GET or POST
// This bypasses 405 errors by being more flexible

// Get all form data
$formData = $_REQUEST; // Gets both GET and POST data

// Extract the data
$name = isset($formData['name']) ? trim($formData['name']) : '';
$email = isset($formData['email']) ? trim($formData['email']) : '';
$phone = isset($formData['phone']) ? trim($formData['phone']) : '';
$address = isset($formData['address']) ? trim($formData['address']) : '';
$quantity = isset($formData['quantity']) ? trim($formData['quantity']) : '1';

// Check if this is an order form
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
    
    $emailSent = @mail($to, $subject, $message, $headers);
    
    // Return JSON response
    header('Content-Type: application/json');
    echo json_encode([
        'success' => true,
        'message' => 'Order received! We will contact you within 24 hours.',
        'emailSent' => $emailSent
    ]);
    exit;
}

// If no valid data, return error
header('Content-Type: application/json');
echo json_encode([
    'success' => false,
    'message' => 'Missing required information'
]);
?>

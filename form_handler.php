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
    
    // Create HTML email with CSS styling
    $htmlMessage = '
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>New Book Order</title>
        <style>
            body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; margin: 0; padding: 0; background-color: #f4f4f4; }
            .container { max-width: 600px; margin: 20px auto; background: white; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); overflow: hidden; }
            .header { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 30px; text-align: center; }
            .header h1 { margin: 0; font-size: 24px; font-weight: bold; }
            .content { padding: 30px; }
            .section { margin-bottom: 25px; }
            .section h2 { color: #2c3e50; font-size: 18px; margin-bottom: 15px; padding-bottom: 8px; border-bottom: 2px solid #e9ecef; }
            .field { margin-bottom: 12px; }
            .field-label { font-weight: bold; color: #555; display: inline-block; width: 120px; }
            .field-value { color: #333; }
            .address-box { background: #f8f9fa; padding: 15px; border-radius: 5px; border-left: 4px solid #007bff; margin-top: 10px; }
            .footer { background: #f8f9fa; padding: 20px; text-align: center; color: #666; font-size: 14px; border-top: 1px solid #e9ecef; }
            .highlight { background: #e3f2fd; padding: 15px; border-radius: 5px; margin: 15px 0; border-left: 4px solid #2196f3; }
            @media (max-width: 600px) {
                .container { margin: 10px; }
                .header, .content { padding: 20px; }
                .field-label { width: 100px; }
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="header">
                <h1>📚 New Book Order Received</h1>
            </div>
            <div class="content">
                <div class="section">
                    <h2>👤 Client Information</h2>
                    <div class="field">
                        <span class="field-label">Name:</span>
                        <span class="field-value">' . htmlspecialchars($name) . '</span>
                    </div>
                    <div class="field">
                        <span class="field-label">Email:</span>
                        <span class="field-value">' . htmlspecialchars($email) . '</span>
                    </div>
                    <div class="field">
                        <span class="field-label">Phone:</span>
                        <span class="field-value">' . htmlspecialchars($phone) . '</span>
                    </div>
                </div>
                
                <div class="section">
                    <h2>📦 Order Details</h2>
                    <div class="field">
                        <span class="field-label">Quantity:</span>
                        <span class="field-value">' . htmlspecialchars($quantity) . ' book(s)</span>
                    </div>
                </div>
                
                <div class="section">
                    <h2>📍 Delivery Address</h2>
                    <div class="address-box">
                        ' . nl2br(htmlspecialchars($address)) . '
                    </div>
                </div>
                
                <div class="highlight">
                    <strong>📧 This order was placed through the website order form.</strong><br>
                    <strong>⏰ Please respond within 24 hours to confirm the order.</strong>
                </div>
            </div>
            <div class="footer">
                <p>Sent from The Workplace with Dumisani website</p>
                <p>Reply directly to this email to contact the client</p>
            </div>
        </div>
    </body>
    </html>';
    
    $headers = "From: The Workplace Website <noreply@theworkplacewithdumisani.co.za>\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";
    $headers .= "Return-Path: noreply@theworkplacewithdumisani.co.za\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";
    $headers .= "X-Priority: 3\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    
    $emailSent = @mail($to, $subject, $htmlMessage, $headers);
    
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

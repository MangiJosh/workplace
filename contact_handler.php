<?php
// Contact form handler
$formData = $_REQUEST;

$firstName = isset($formData['firstName']) ? trim($formData['firstName']) : '';
$lastName = isset($formData['lastName']) ? trim($formData['lastName']) : '';
$email = isset($formData['email']) ? trim($formData['email']) : '';
$phone = isset($formData['phone']) ? trim($formData['phone']) : '';
$subject = isset($formData['subject']) ? trim($formData['subject']) : '';
$message = isset($formData['message']) ? trim($formData['message']) : '';

if (!empty($firstName) && !empty($lastName) && !empty($email) && !empty($subject) && !empty($message)) {
    // Send email
    $to = "mangi@thingstech.co.za";
    $emailSubject = "New Contact Form - " . $subject;
    
    // Create HTML email with CSS styling
    $htmlMessage = '
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>New Contact Form</title>
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
            .message-box { background: #f8f9fa; padding: 20px; border-radius: 5px; border-left: 4px solid #28a745; margin-top: 10px; white-space: pre-wrap; }
            .footer { background: #f8f9fa; padding: 20px; text-align: center; color: #666; font-size: 14px; border-top: 1px solid #e9ecef; }
            .highlight { background: #e3f2fd; padding: 15px; border-radius: 5px; margin: 15px 0; border-left: 4px solid #2196f3; }
            .subject-badge { background: #007bff; color: white; padding: 5px 12px; border-radius: 20px; font-size: 12px; font-weight: bold; }
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
                <h1>💬 New Contact Form Submission</h1>
            </div>
            <div class="content">
                <div class="section">
                    <h2>👤 Contact Information</h2>
                    <div class="field">
                        <span class="field-label">Name:</span>
                        <span class="field-value">' . htmlspecialchars($firstName . ' ' . $lastName) . '</span>
                    </div>
                    <div class="field">
                        <span class="field-label">Email:</span>
                        <span class="field-value">' . htmlspecialchars($email) . '</span>
                    </div>
                    <div class="field">
                        <span class="field-label">Phone:</span>
                        <span class="field-value">' . htmlspecialchars($phone) . '</span>
                    </div>
                    <div class="field">
                        <span class="field-label">Subject:</span>
                        <span class="field-value"><span class="subject-badge">' . htmlspecialchars($subject) . '</span></span>
                    </div>
                </div>
                
                <div class="section">
                    <h2>📝 Message</h2>
                    <div class="message-box">' . htmlspecialchars($message) . '</div>
                </div>
                
                <div class="highlight">
                    <strong>📧 This message was sent through the website contact form.</strong><br>
                    <strong>⏰ Please respond within 24 hours to maintain good customer service.</strong>
                </div>
            </div>
            <div class="footer">
                <p>Sent from The Workplace with Dumisani website</p>
                <p>Reply directly to this email to contact the customer</p>
            </div>
        </div>
    </body>
    </html>';
    
    $headers = "From: " . $email . "\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    
    $emailSent = @mail($to, $emailSubject, $htmlMessage, $headers);
    
    header('Content-Type: application/json');
    echo json_encode([
        'success' => true,
        'message' => 'Message sent! We will get back to you within 24 hours.',
        'emailSent' => $emailSent
    ]);
    exit;
}

header('Content-Type: application/json');
echo json_encode([
    'success' => false,
    'message' => 'Missing required information'
]);
?>

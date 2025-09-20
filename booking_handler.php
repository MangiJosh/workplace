<?php
// Booking form handler
$formData = $_REQUEST;

$firstName = isset($formData['firstName']) ? trim($formData['firstName']) : '';
$lastName = isset($formData['lastName']) ? trim($formData['lastName']) : '';
$email = isset($formData['email']) ? trim($formData['email']) : '';
$phone = isset($formData['phone']) ? trim($formData['phone']) : '';
$organization = isset($formData['organization']) ? trim($formData['organization']) : '';
$serviceType = isset($formData['serviceType']) ? trim($formData['serviceType']) : '';
$eventDate = isset($formData['eventDate']) ? trim($formData['eventDate']) : '';
$eventLocation = isset($formData['eventLocation']) ? trim($formData['eventLocation']) : '';
$attendees = isset($formData['attendees']) ? trim($formData['attendees']) : '';
$budget = isset($formData['budget']) ? trim($formData['budget']) : '';
$message = isset($formData['message']) ? trim($formData['message']) : '';

if (!empty($firstName) && !empty($lastName) && !empty($email) && !empty($phone) && !empty($organization) && !empty($serviceType)) {
    // Send email
    $to = "mangi@thingstech.co.za";
    $subject = "New Booking Request - " . $serviceType;
    
    // Create HTML email with CSS styling
    $htmlMessage = '
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>New Booking Request</title>
        <style>
            body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; margin: 0; padding: 0; background-color: #f4f4f4; }
            .container { max-width: 600px; margin: 20px auto; background: white; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); overflow: hidden; }
            .header { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 30px; text-align: center; }
            .header h1 { margin: 0; font-size: 24px; font-weight: bold; }
            .content { padding: 30px; }
            .section { margin-bottom: 25px; }
            .section h2 { color: #2c3e50; font-size: 18px; margin-bottom: 15px; padding-bottom: 8px; border-bottom: 2px solid #e9ecef; }
            .field { margin-bottom: 12px; }
            .field-label { font-weight: bold; color: #555; display: inline-block; width: 140px; }
            .field-value { color: #333; }
            .service-badge { background: #28a745; color: white; padding: 5px 12px; border-radius: 20px; font-size: 12px; font-weight: bold; }
            .event-details { background: #f8f9fa; padding: 20px; border-radius: 5px; border-left: 4px solid #ffc107; margin-top: 10px; }
            .message-box { background: #f8f9fa; padding: 20px; border-radius: 5px; border-left: 4px solid #17a2b8; margin-top: 10px; white-space: pre-wrap; }
            .footer { background: #f8f9fa; padding: 20px; text-align: center; color: #666; font-size: 14px; border-top: 1px solid #e9ecef; }
            .highlight { background: #e3f2fd; padding: 15px; border-radius: 5px; margin: 15px 0; border-left: 4px solid #2196f3; }
            .priority { background: #fff3cd; padding: 15px; border-radius: 5px; margin: 15px 0; border-left: 4px solid #ffc107; }
            @media (max-width: 600px) {
                .container { margin: 10px; }
                .header, .content { padding: 20px; }
                .field-label { width: 120px; }
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="header">
                <h1>New Booking Request</h1>
            </div>
            <div class="content">
                <div class="section">
                    <h2>Client Information</h2>
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
                        <span class="field-label">Organization:</span>
                        <span class="field-value">' . htmlspecialchars($organization) . '</span>
                    </div>
                </div>
                
                <div class="section">
                    <h2>Service Details</h2>
                    <div class="field">
                        <span class="field-label">Service Type:</span>
                        <span class="field-value"><span class="service-badge">' . htmlspecialchars($serviceType) . '</span></span>
                    </div>
                </div>
                
                <div class="section">
                    <h2>Event Information</h2>
                    <div class="event-details">
                        <div class="field">
                            <span class="field-label">Event Date:</span>
                            <span class="field-value">' . htmlspecialchars($eventDate) . '</span>
                        </div>
                        <div class="field">
                            <span class="field-label">Location:</span>
                            <span class="field-value">' . htmlspecialchars($eventLocation) . '</span>
                        </div>
                        <div class="field">
                            <span class="field-label">Expected Attendees:</span>
                            <span class="field-value">' . htmlspecialchars($attendees) . '</span>
                        </div>
                        <div class="field">
                            <span class="field-label">Budget Range:</span>
                            <span class="field-value">' . htmlspecialchars($budget) . '</span>
                        </div>
                    </div>
                </div>
                
                <div class="section">
                    <h2>Additional Message</h2>
                    <div class="message-box">' . htmlspecialchars($message) . '</div>
                </div>
                
                <div class="priority">
                    <strong>HIGH PRIORITY - New Booking Request</strong><br>
                    <strong>This booking request was sent through the website booking form.</strong><br>
                    <strong>Please respond within 24 hours to secure this booking.</strong>
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
    
    header('Content-Type: application/json');
    echo json_encode([
        'success' => true,
        'message' => 'Booking request sent! We will contact you within 24 hours to discuss your requirements.',
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

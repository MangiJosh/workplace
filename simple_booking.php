<?php
// Simple booking handler
header('Content-Type: text/html; charset=UTF-8');

$firstName = isset($_REQUEST['firstName']) ? trim($_REQUEST['firstName']) : '';
$lastName = isset($_REQUEST['lastName']) ? trim($_REQUEST['lastName']) : '';
$email = isset($_REQUEST['email']) ? trim($_REQUEST['email']) : '';
$phone = isset($_REQUEST['phone']) ? trim($_REQUEST['phone']) : '';
$organization = isset($_REQUEST['organization']) ? trim($_REQUEST['organization']) : '';
$serviceType = isset($_REQUEST['serviceType']) ? trim($_REQUEST['serviceType']) : '';
$eventDate = isset($_REQUEST['eventDate']) ? trim($_REQUEST['eventDate']) : '';
$eventLocation = isset($_REQUEST['eventLocation']) ? trim($_REQUEST['eventLocation']) : '';
$attendees = isset($_REQUEST['attendees']) ? trim($_REQUEST['attendees']) : '';
$budget = isset($_REQUEST['budget']) ? trim($_REQUEST['budget']) : '';
$message = isset($_REQUEST['message']) ? trim($_REQUEST['message']) : '';

if (!empty($firstName) && !empty($lastName) && !empty($email) && !empty($phone) && !empty($organization) && !empty($serviceType)) {
    // Send email
    $to = "mangi@thingstech.co.za";
    $subject = "New Booking Request - " . $serviceType;
    
    $emailBody = "New Booking Request Received\n\n";
    $emailBody .= "Contact Information:\n";
    $emailBody .= "Name: " . $firstName . " " . $lastName . "\n";
    $emailBody .= "Email: " . $email . "\n";
    $emailBody .= "Phone: " . $phone . "\n";
    $emailBody .= "Organization: " . $organization . "\n\n";
    $emailBody .= "Event Details:\n";
    $emailBody .= "Service Type: " . $serviceType . "\n";
    $emailBody .= "Event Date: " . $eventDate . "\n";
    $emailBody .= "Location: " . $eventLocation . "\n";
    $emailBody .= "Attendees: " . $attendees . "\n";
    $emailBody .= "Budget: " . $budget . "\n\n";
    $emailBody .= "Message:\n" . $message . "\n\n";
    $emailBody .= "---\nSent from website booking form";
    
    $headers = "From: " . $email . "\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";
    
    @mail($to, $subject, $emailBody, $headers);
    
    // Show success page
    echo "<!DOCTYPE html>
    <html>
    <head>
        <title>Booking Request Sent</title>
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
            <div class='success'>✓ Booking Request Sent!</div>
            <div class='info'>Thank you, " . htmlspecialchars($firstName) . "!</div>
            <div class='info'>Your booking request has been sent to mangi@thingstech.co.za</div>
            <div class='info'>We'll contact you within 24 hours to discuss your requirements.</div>
            <a href='bookings.html' class='btn'>Return to Booking Form</a>
            <a href='index.html' class='btn'>Go Home</a>
        </div>
    </body>
    </html>";
} else {
    // Redirect to booking form
    header("Location: bookings.html");
    exit();
}
?>

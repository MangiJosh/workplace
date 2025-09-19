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
    
    $emailSent = @mail($to, $subject, $emailBody, $headers);
    
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

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
    
    $emailBody = "New Contact Form Submission\n\n";
    $emailBody .= "Name: " . $firstName . " " . $lastName . "\n";
    $emailBody .= "Email: " . $email . "\n";
    $emailBody .= "Phone: " . $phone . "\n";
    $emailBody .= "Subject: " . $subject . "\n\n";
    $emailBody .= "Message:\n" . $message . "\n\n";
    $emailBody .= "---\nSent from website contact form";
    
    $headers = "From: " . $email . "\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";
    
    $emailSent = @mail($to, $emailSubject, $emailBody, $headers);
    
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

<?php
// Handle booking form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $firstName = htmlspecialchars($_POST['firstName'] ?? '');
    $lastName = htmlspecialchars($_POST['lastName'] ?? '');
    $email = htmlspecialchars($_POST['email'] ?? '');
    $phone = htmlspecialchars($_POST['phone'] ?? '');
    $organization = htmlspecialchars($_POST['organization'] ?? '');
    $serviceType = htmlspecialchars($_POST['serviceType'] ?? '');
    $eventDate = htmlspecialchars($_POST['eventDate'] ?? '');
    $eventLocation = htmlspecialchars($_POST['eventLocation'] ?? '');
    $attendees = htmlspecialchars($_POST['attendees'] ?? '');
    $budget = htmlspecialchars($_POST['budget'] ?? '');
    $message = htmlspecialchars($_POST['message'] ?? '');
    
    // Email configuration
    $to = "mangi@thingstech.co.za";
    $subject = "New Booking Request - " . $serviceType;
    
    // Create email body
    $emailBody = "
    New Booking Request Received
    
    Contact Information:
    Name: {$firstName} {$lastName}
    Email: {$email}
    Phone: {$phone}
    Organization: {$organization}
    
    Event Details:
    Service Type: {$serviceType}
    Preferred Date: {$eventDate}
    Event Location: {$eventLocation}
    Expected Attendees: {$attendees}
    Budget Range: {$budget}
    
    Additional Message:
    {$message}
    
    ---
    This message was sent from the booking form on your website.
    ";
    
    // Send email
    $headers = "From: {$email}\r\n";
    $headers .= "Reply-To: {$email}\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
    
    if (mail($to, $subject, $emailBody, $headers)) {
        // Redirect to confirmation page
        header("Location: order-confirmation.html?type=booking");
        exit();
    } else {
        // Handle error
        header("Location: order-confirmation.html?type=error");
        exit();
    }
} else {
    // If not POST request, redirect to home
    header("Location: index.html");
    exit();
}
?>

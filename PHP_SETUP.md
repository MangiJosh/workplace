# PHP Email Setup Instructions

## Overview
This project now includes PHP handlers for form submissions that will send emails to `info@theworkplacewithdumisani.co.za` and redirect users to a confirmation page.

## Files Created
- `handle_booking.php` - Processes booking form submissions
- `handle_contact.php` - Processes contact form submissions  
- `handle_order.php` - Processes book order form submissions
- `order-confirmation.html` - Confirmation page for all form submissions

## Setup Requirements

### 1. Web Server with PHP
- Ensure your web server supports PHP (version 7.0 or higher)
- PHP must have the `mail()` function enabled

### 2. Email Configuration
The PHP handlers use PHP's built-in `mail()` function. For production use, consider:

**Option A: Basic Setup (Current)**
- Uses PHP's built-in mail function
- May require server email configuration

**Option B: SMTP Setup (Recommended for Production)**
- Install PHPMailer or similar library
- Configure SMTP settings for reliable email delivery
- Update the PHP handlers to use SMTP instead of `mail()`

### 3. File Permissions
Ensure the PHP files have proper permissions:
```bash
chmod 644 *.php
```

### 4. Testing
1. Upload all files to your web server
2. Test each form:
   - Booking form on `bookings.html`
   - Contact form on `contact.html` 
   - Order form on `workplace.html`
3. Verify emails are received at `info@theworkplacewithdumisani.co.za`
4. Confirm redirects to `order-confirmation.html` work properly

## Form Behavior
- All forms now submit to their respective PHP handlers
- Upon successful submission, users are redirected to `order-confirmation.html`
- The confirmation page shows different messages based on form type
- Users can return to home page or book another service

## Troubleshooting
- If emails aren't being sent, check server mail configuration
- If redirects aren't working, ensure PHP files are in the same directory as HTML files
- Check server error logs for PHP errors
- Verify all form field names match between HTML and PHP files

## Security Notes
- All form inputs are sanitized using `htmlspecialchars()`
- Consider adding CSRF protection for production use
- Implement rate limiting to prevent spam
- Add server-side validation for all form fields

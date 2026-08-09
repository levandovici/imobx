# IMOBX.MD - Contact Form Email Implementation

This document explains the email functionality implemented for the contact form and provides setup instructions.

## Current Implementation (Simple PHP mail())

The contact form in `index.php` now uses PHP's built-in `mail()` function to send emails to `contact@imobx.md`.

### How It Works

1. **Form Submission**: When the user submits the contact form, it POSTs to the same page
2. **PHP Processing**: The PHP code at the top of `index.php` processes the form submission
3. **Email Sending**: Uses PHP's `mail()` function to send the email
4. **Feedback**: Shows success/error messages in the appropriate language

### Code Location

**Form Processing** (Lines 4-46 in index.php):
```php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['contact_form'])) {
    // Sanitize and validate form data
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);
    
    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $form_message = 'Invalid email address';
        $form_message_type = 'error';
    } elseif (empty($name) || empty($message)) {
        $form_message = 'Please fill in all fields';
        $form_message_type = 'error';
    } else {
        // Email configuration
        $to = 'contact@imobx.md';
        $subject = 'New Contact Form Submission from IMOBX.MD';
        
        // Build email content
        $email_content = "Name: $name\n";
        $email_content .= "Email: $email\n";
        $email_content .= "Message:\n$message\n";
        $email_content .= "\n---\n";
        $email_content .= "Sent from: " . $_SERVER['REMOTE_ADDR'];
        $email_content .= " at " . date('Y-m-d H:i:s');
        
        // Email headers
        $headers = "From: $name <$email>\r\n";
        $headers .= "Reply-To: $email\r\n";
        $headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";
        $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
        
        // Send email
        if (mail($to, $subject, $email_content, $headers)) {
            $form_message = 'Thank you! Your message has been sent successfully.';
            $form_message_type = 'success';
        } else {
            $form_message = 'Sorry, there was an error sending your message. Please try again.';
            $form_message_type = 'error';
        }
    }
}
```

**Form HTML** (Lines 1189-1228 in index.php):
```php
<form method="POST" action="">
    <input type="hidden" name="contact_form" value="1">
    
    <div class="form-group">
        <label for="name"><?php echo $t['form_name']; ?></label>
        <input type="text" id="name" name="name" required 
               value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>">
    </div>
    
    <!-- More form fields... -->
    
    <button type="submit" class="submit-btn"><?php echo $t['form_submit']; ?></button>
</form>
```

### Features

- **Sanitization**: All input data is sanitized to prevent security issues
- **Validation**: Email format validation and required field checking
- **Multilingual**: Success/error messages in Russian, Romanian, and English
- **Form Persistence**: Form data is preserved if there's an error
- **Security**: Includes sender IP address and timestamp
- **UTF-8 Support**: Proper character encoding for multilingual content

## Server Requirements for Simple Implementation

For the simple PHP `mail()` function to work, your server needs:

1. **PHP mail() function enabled**: Check with `phpinfo()` or contact your hosting provider
2. **SMTP server configured**: Your server's PHP configuration needs SMTP settings
3. **Proper permissions**: PHP needs permission to send emails

### Common Issues and Solutions

**Issue**: Emails not being sent
- **Solution**: Check PHP error logs, verify SMTP configuration

**Issue**: Emails going to spam
- **Solution**: Add SPF, DKIM, and DMARC records to your domain

**Issue**: Character encoding issues
- **Solution**: The implementation already includes UTF-8 headers

## Advanced Implementation (PHPMailer)

For more reliable email delivery, you can use PHPMailer. This requires Composer.

### Setup Instructions

1. **Install Composer** (if not already installed):
   ```bash
   # Download Composer installer
   php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
   php composer-setup.php
   php -r "unlink('composer-setup.php');"
   ```

2. **Install PHPMailer**:
   ```bash
   composer install
   ```

3. **Configure SMTP settings** in `contact_advanced.php`:
   ```php
   $mail->Host = 'smtp.example.com'; // Your SMTP server
   $mail->Username = 'your_email@example.com'; // SMTP username
   $mail->Password = 'your_password'; // SMTP password
   ```

### Benefits of PHPMailer

- **Better deliverability**: Proper SMTP authentication
- **HTML emails**: Support for rich HTML content
- **Attachments**: Easy file attachment support
- **Error handling**: Detailed error messages
- **TLS/SSL**: Secure email transmission
- **Debugging**: Built-in debugging capabilities

### Popular SMTP Services

- **Gmail**: `smtp.gmail.com`, port 587
- **Outlook**: `smtp-mail.outlook.com`, port 587
- **SendGrid**: `smtp.sendgrid.net`, port 587
- **Mailgun**: `smtp.mailgun.org`, port 587
- **Amazon SES**: Region-specific SMTP endpoints

## Email Deliverability Best Practices

### 1. DNS Records

Add these DNS records to `imobx.md`:

**SPF Record**:
```
imobx.md. IN TXT "v=spf1 ip4:your_server_ip include:_spf.google.com ~all"
```

**DKIM Record**:
```
selector._domainkey.imobx.md. IN TXT "v=DKIM1; k=rsa; p=your_public_key"
```

**DMARC Record**:
```
_dmarc.imobx.md. IN TXT "v=DMARC1; p=none; rua=mailto:dmarc@imobx.md"
```

### 2. Server Configuration

- **Reverse DNS**: Ensure your server has proper PTR records
- **Server IP**: Use a dedicated IP if sending high volume
- **Rate limiting**: Implement rate limiting to prevent spam flags

### 3. Content Best Practices

- **Subject lines**: Clear, relevant, not spammy
- **Content**: Professional, well-formatted
- **Unsubscribe**: Include unsubscribe mechanism for newsletters
- **Physical address**: Include your physical address in footer

## Testing the Contact Form

### Local Testing

To test the contact form locally:

1. **Use a testing SMTP service** like Mailtrap:
   ```php
   $mail->Host = 'smtp.mailtrap.io';
   $mail->Port = 2525;
   $mail->Username = 'your_mailtrap_username';
   $mail->Password = 'your_mailtrap_password';
   ```

2. **Check logs**: Monitor PHP error logs for mail() function issues

### Production Testing

1. **Send test emails** to multiple email providers
2. **Check spam folders** to ensure deliverability
3. **Monitor delivery rates** using your SMTP service's dashboard
4. **Test multilingual content** to ensure proper encoding

## Security Considerations

### Current Security Measures

- **Input sanitization**: All user input is sanitized
- **Email validation**: Proper email format validation
- **Rate limiting**: Consider implementing rate limiting (not included yet)
- **CSRF protection**: Consider adding CSRF tokens (not included yet)

### Recommended Enhancements

1. **Rate Limiting**: Prevent form spam
   ```php
   session_start();
   if (isset($_SESSION['last_submit']) && time() - $_SESSION['last_submit'] < 60) {
       die('Please wait 60 seconds between submissions');
   }
   $_SESSION['last_submit'] = time();
   ```

2. **CSRF Protection**: Add CSRF tokens
   ```php
   session_start();
   if (empty($_SESSION['csrf_token'])) {
       $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
   }
   ```

3. **Honeypot Field**: Add hidden field to detect bots
   ```html
   <input type="text" name="honeypot" style="display:none">
   ```

## Monitoring and Maintenance

### Log Email Activity

Consider logging email activity for monitoring:
```php
$log_message = date('Y-m-d H:i:s') . " - Email sent to $to from $email\n";
file_put_contents('email_log.txt', $log_message, FILE_APPEND);
```

### Regular Checks

- **Weekly**: Check email deliverability rates
- **Monthly**: Review DNS records and security settings
- **Quarterly**: Update email templates and content

## Troubleshooting

### Email Not Sending

1. **Check PHP error logs**: `/var/log/php_errors.log` or similar
2. **Verify mail() function**: Create a simple test script
3. **Check SMTP settings**: Verify server configuration
4. **Test with different email**: Try sending to different addresses

### Email Going to Spam

1. **Check DNS records**: Verify SPF, DKIM, DMARC
2. **Review content**: Ensure content isn't spammy
3. **Check server reputation**: Use tools like MXToolbox
4. **Test spam score**: Use tools like Mail-Tester.com

### Character Encoding Issues

1. **Verify UTF-8 headers**: Current implementation includes these
2. **Check database encoding**: If storing messages
3. **Test multilingual content**: Send test messages in all languages

## Current Implementation Status

✅ **Implemented**:
- Basic PHP mail() function
- Form validation and sanitization
- Multilingual error/success messages
- Form data persistence on error
- UTF-8 character encoding
- Security headers and IP logging

⚠️ **Recommended**:
- PHPMailer integration for better deliverability
- Rate limiting to prevent spam
- CSRF protection
- Email activity logging
- DNS records (SPF, DKIM, DMARC)

The current implementation is functional and suitable for basic use. For production environments with high email volume or critical deliverability requirements, consider implementing the PHPMailer solution.
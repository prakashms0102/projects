<?php
require 'vendor/autoload.php';

use SendGrid\Mail\Mail;

// Create a new email instance
$email = new Mail();

// Verified sender email (MUST be verified in SendGrid)
$email->setFrom("bhushanprakash601@gmail.com", "Prakash Sah");

// Recipient
$email->addTo("prakashbhushan55@gmail.com", "Receiver Name");

// Subject
$email->setSubject("Welcome to S-Lite India!");

// Plain Text Version (fallback for old clients)
$email->addContent(
    "text/plain",
    "Hello,\n\nThis is a sample email sent from core PHP using SendGrid.\nThank you!\nS-Lite India"
);

// HTML Content with Header + Footer
$email->addContent(
    "text/html",
    '
    <html>
    <body style="margin:0; padding:0; font-family:Arial, sans-serif; background-color:#f6f9fc;">
        <table width="100%" cellpadding="0" cellspacing="0">
            <tr>
                <td align="center">
                    <table width="600" cellpadding="0" cellspacing="0" style="background-color:#ffffff; border-radius:8px; overflow:hidden; box-shadow:0 2px 4px rgba(0,0,0,0.1);">
                        <!-- Header -->
                        <tr>
                            <td style="background-color:#003366; color:#ffffff; padding:20px; text-align:center;">
                                <h1 style="margin:0; font-size:24px;">S-Lite India</h1>
                            </td>
                        </tr>

                        <!-- Body -->
                        <tr>
                            <td style="padding:30px; font-size:16px; color:#333;">
                                <p>Hi <strong>Receiver</strong>,</p>
                                <p>Thank you for getting in touch with us! This is a test email sent using <strong>SendGrid and Core PHP</strong>.</p>
                                <p>We hope you are having a great day.</p>
                                <p>Best regards,<br><strong>Prakash from S-Lite India</strong></p>
                            </td>
                        </tr>

                        <!-- Footer -->
                        <tr>
                            <td style="background-color:#f0f0f0; padding:20px; text-align:center; font-size:14px; color:#777;">
                                &copy; ' . date("Y") . ' S-Lite India. All rights reserved.<br>
                                <a href="https://sliteindia.com" style="color:#003366; text-decoration:none;">Visit our Website</a>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>
    </html>'
);

// Optional: Add attachment, max 20MB file allow
$filePath = 'image.jpg'; // e.g., video.mp4, image.png
if (file_exists($filePath)) {
    $email->addAttachment(
        base64_encode(file_get_contents($filePath)),
        mime_content_type($filePath),
        basename($filePath),
        'attachment'
    );
}

// Send the email using SendGrid
$sendgrid = new \SendGrid('SEND_GREID_API_KEY'); // Replace with your real key

try {
    $response = $sendgrid->send($email);
    echo "✅ Email Sent!<br>Status Code: " . $response->statusCode() . "<br>";
    echo "Response Body: " . $response->body() . "<br>";
    echo "<pre>Headers: " . print_r($response->headers(), true) . "</pre>";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

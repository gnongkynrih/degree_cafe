<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Our Service</title>
    <style>
        /* Some basic resets for email clients */
        body, html {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f7fafc;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            overflow: hidden;
        }
        .header {
            background-color: #4299e1;
            color: #ffffff;
            padding: 20px;
            text-align: center;
        }
        .content {
            padding: 20px;
            color: #4a5568;
        }
        .footer {
            background-color: #edf2f7;
            color: #718096;
            padding: 20px;
            text-align: center;
            font-size: 14px;
        }
        .button {
            display: inline-block;
            background-color: #4299e1;
            color: #ffffff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 4px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header Section -->
        <div class="header">
            <h1 style="font-size: 24px; margin: 0;">Welcome to Our Service!</h1>
        </div>

        <!-- Content Section -->
        <div class="content">
            <p style="font-size: 16px; line-height: 1.5;">Hi {{$data['name']}},</p>
            <p style="font-size: 16px; line-height: 1.5;">We're thrilled to have you on board. Thank you for joining our community. We aim to provide you with the best experience possible.</p>
            <p style="font-size: 16px; line-height: 1.5;">To get started, please verify your email address by clicking the button below:</p>
            <a href="[Verification Link]" class="button" style="font-size: 16px;">Verify Email Address</a>
            <p style="font-size: 16px; line-height: 1.5; margin-top: 20px;">If you have any questions or need assistance, feel free to reach out to our support team at <a href="mailto:support@example.com" style="color: #4299e1;">support@example.com</a>.</p>
        </div>

        <!-- Footer Section -->
        <div class="footer">
            <p style="margin: 0;">&copy; 2023 Your Company. All rights reserved.</p>
            <p style="margin: 0; font-size: 12px;">You are receiving this email because you signed up for our service.</p>
            <p style="margin: 0; font-size: 12px;"><a href="[Unsubscribe Link]" style="color: #4299e1;">Unsubscribe</a> from this list.</p>
        </div>
    </div>
</body>
</html>
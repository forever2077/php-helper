<?php

use PHPUnit\Framework\TestCase;
use Forever2077\PhpHelper\EmailHelper;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class EmailHelperTest extends TestCase
{
    public function testInstance()
    {
        $this->assertEquals('Forever2077\PhpHelper\EmailHelper', _email()::class);
    }

    public function testPhpMailer()
    {
        $this->assertInstanceOf(PHPMailer::class, EmailHelper::phpMailer());
    }

    public function testSend()
    {
        $mail = EmailHelper::phpMailer();
        $this->assertInstanceOf(PHPMailer::class, $mail);

        if (false) {
            try {
                // Server settings
                $mail->SMTPDebug = SMTP::DEBUG_SERVER;                    // Enable verbose debug output
                $mail->isSMTP();                                          // Send using SMTP
                $mail->Host = 'smtp.example.com';                         // Set the SMTP server to send through
                $mail->SMTPAuth = true;                                   // Enable SMTP authentication
                $mail->Username = 'user@example.com';                     // SMTP username
                $mail->Password = 'secret';                               // SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;          // Enable implicit TLS encryption
                $mail->Port = 465;                                        // TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                // Recipients
                $mail->setFrom('from@example.com', 'Mailer');
                $mail->addAddress('joe@example.net', 'Joe User');     // Add a recipient
                $mail->addAddress('ellen@example.com');                     // Name is optional
                $mail->addReplyTo('info@example.com', 'Information');
                $mail->addCC('cc@example.com');
                $mail->addBCC('bcc@example.com');

                // Attachments
                $mail->addAttachment('/var/tmp/file.tar.gz');                  // Add attachments
                $mail->addAttachment('/tmp/image.jpg', 'new.jpg');       // Optional name

                // Content
                $mail->isHTML(true);                                          // Set email format to HTML
                $mail->Subject = 'Here is the subject';
                $mail->Body = 'This is the HTML message body <b>in bold!</b>';
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                $mail->send();
                echo 'Message has been sent';
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }
    }
}
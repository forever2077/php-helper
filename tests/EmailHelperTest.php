<?php

use PHPUnit\Framework\TestCase;
use Helpful\Helper;
use Helpful\EmailHelper;
use PHPMailer\PHPMailer\PHPMailer;
use Egulias\EmailValidator\Validation\RFCValidation;

class EmailHelperTest extends TestCase
{
    public function testInstance()
    {
        $this->assertEquals('PHPMailer\PHPMailer\PHPMailer', Helper::email()::class);
    }

    public function testPhpMailer()
    {
        $this->assertInstanceOf(PHPMailer::class, EmailHelper::phpMailer());
    }

    public function testSend()
    {
        $mail = EmailHelper::phpMailer();
        $this->assertInstanceOf(PHPMailer::class, $mail);
    }

    public function testValidator()
    {
        $this->assertIsBool(EmailHelper::validator()->isValid("example@example.com", new RFCValidation()));
    }
}
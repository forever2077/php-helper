<?php

use PHPUnit\Framework\TestCase;
use Forever2077\PhpHelper\Helper;
use Forever2077\PhpHelper\EmailHelper;
use PHPMailer\PHPMailer\PHPMailer;

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
}
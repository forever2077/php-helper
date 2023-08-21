<?php

use PHPUnit\Framework\TestCase;
use Forever2077\PhpHelper\Helper;
use Forever2077\PhpHelper\ValidateHelper;
use Respect\Validation\Validator;

class ValidateHelperTest extends TestCase
{
    public function testInstance()
    {
        $this->assertEquals(Validator::Class, Helper::validate()::class);
    }

    public function testValidateEmail()
    {
        $this->assertTrue(ValidateHelper::rule()::email()->validate('alganet@gmail.com'));
    }

    public function testAssert()
    {
        try {
            ValidateHelper::email('alganet.gmail.com', 'Email (%s) is invalid');
        } catch (\Webmozart\Assert\InvalidArgumentException $e) {
            $this->assertIsString($e->getMessage());
        }
    }

    public function testPassport()
    {
        $this->assertTrue(ValidateHelper::isPassportNumber('EA1234567'));
    }
}
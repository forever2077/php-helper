<?php

use PHPUnit\Framework\TestCase;
use Helpful\Helper;
use Helpful\ValidateHelper;
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

    public function testCommon()
    {
        $this->assertTrue(ValidateHelper::isPassport('EA1234567'));
        $this->assertTrue(ValidateHelper::isIdentityCard('42032319930606629x'));
        $this->assertTrue(ValidateHelper::isLicensePlate('京Q58A77'));
        $this->assertEquals('135****0001', ValidateHelper::formatMobile('13500000001'));
    }

    public function testIsValidFilename()
    {
        $this->assertTrue(ValidateHelper::isValidFilename('test.txt'));
        $this->assertFalse(ValidateHelper::isValidFilename('my|file.txt'));
        $this->assertEquals('my_file.txt', ValidateHelper::isValidFilename("my|file.txt", true));
    }
}
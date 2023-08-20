<?php

use PHPUnit\Framework\TestCase;
use Forever2077\PhpHelper\Helper;
use Forever2077\PhpHelper\IdentityHelper;

class IdentityHelperTest extends TestCase
{
    public function testInstance()
    {
        $this->assertInstanceOf(IdentityHelper::class, Helper::identity());
    }

    public function testChineseIdentityCard()
    {
        $ID = IdentityHelper::parseChineseID();

        $pid = '42032319930606629x';
        $passed = $ID->validateIDCard($pid);
        $area = $ID->getArea($pid);
        $gender = $ID->getGender($pid);
        $birthday = $ID->getBirth($pid);
        $age = $ID->getAge($pid);
        $constellation = $ID->getConstellation($pid);

        $this->assertIsBool($passed);
        $this->assertIsArray($area);
        $this->assertEquals('m', $gender);
        $this->assertEquals('1993-06-06', $birthday);
        $this->assertEquals(30, $age);
        $this->assertEquals('双子座', $constellation);
    }
}
<?php

use Forever2077\PhpHelper\UuidHelper;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Provider\Node\StaticNodeProvider;
use Ramsey\Uuid\Type\Hexadecimal;
use Ramsey\Uuid\Type\Integer;
use Ramsey\Uuid\Uuid;

class UuidHelperTest extends TestCase
{
    public function testInstance()
    {
        $this->assertInstanceOf(UuidHelper::class, _uuid());
    }

    public function testUuid1()
    {
        $uuid = UuidHelper::uuid1();
        $this->assertIsString($uuid->toString());
    }

    public function testUuid2()
    {
        $localId = new Integer(1001);
        $nodeProvider = new StaticNodeProvider(new Hexadecimal('121212121212'));
        $clockSequence = 63;
        $uuid = UuidHelper::uuid2(
            Uuid::DCE_DOMAIN_ORG,
            $localId,
            $nodeProvider->getNode(),
            $clockSequence
        );
        $this->assertIsString($uuid->toString());
    }

    public function testUuid3()
    {
        $uuid = UuidHelper::uuid3(Uuid::NAMESPACE_URL, 'https://www.php.net');
        $this->assertIsString($uuid->toString());
    }

    public function testUuid4()
    {
        $uuid = UuidHelper::uuid4();
        $this->assertIsString($uuid->toString());
    }

    public function testUuid5()
    {
        $uuid = UuidHelper::uuid5(Uuid::NAMESPACE_URL, 'https://www.php.net');
        $this->assertIsString($uuid->toString());
    }

    public function testUuid6()
    {
        $uuid = UuidHelper::uuid6();
        $this->assertIsString($uuid->toString());
    }

    public function testUuid7()
    {
        $uuid = UuidHelper::uuid7();
        $this->assertIsString($uuid->toString());
    }

    public function testUuid8()
    {
        $uuid = UuidHelper::uuid8("\x00\x11\x22\x33\x44\x55\x66\x77\x88\x99\xaa\xbb\xcc\xdd\xee\xff");
        $this->assertIsString($uuid->toString());
    }

    public function testGuid()
    {
        $guid = UuidHelper::guid();
        $this->assertIsString($guid);
    }
}
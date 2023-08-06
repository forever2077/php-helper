<?php

use PHPUnit\Framework\TestCase;
use Forever2077\PhpHelper\FileHelper;

class FileHelperTest extends TestCase
{
    public function testFormat()
    {
        $this->assertIsString(FileHelper::format(1024));
    }

    public function testCreateDir()
    {
        $path = __DIR__ . '/test1';
        $this->assertTrue(FileHelper::createDir($path));
        $this->assertTrue(FileHelper::removeDir($path, true));
    }

    public function testGetExt()
    {
        $this->assertEquals('txt', FileHelper::getExt('test.txt'));
    }

    public function testScanDirectory()
    {
        $this->assertIsArray(FileHelper::scanDirectory(__DIR__));
    }
}
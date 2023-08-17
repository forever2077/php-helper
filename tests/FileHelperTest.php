<?php

use PHPUnit\Framework\TestCase;
use Forever2077\PhpHelper\Helper;
use Forever2077\PhpHelper\FileHelper;

class FileHelperTest extends TestCase
{
    public function testInstance()
    {
        $this->assertEquals(FileHelper::Class, Helper::file()::class);
    }

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

    public function testCreateAndRemoveFile1()
    {
        $path = __DIR__ . '/test.txt';
        try {
            $this->assertTrue(FileHelper::createFile($path, 'test1'));
            $this->assertTrue(FileHelper::removeFile([
                'filename' => $path,
                'secure' => true,
                'backupDir' => __DIR__ . '/backup'
            ]));
        } catch (Exception $e) {
            $this->fail($e->getMessage());
        }
    }

    public function testCreateAndRemoveFile2()
    {
        $path = __DIR__ . '/backup/test.txt';
        try {
            $this->assertTrue(FileHelper::createFile([
                'filename' => $path,
                'content' => 'test2',
                'append' => true,
            ]));
            $this->assertTrue(FileHelper::removeDir(__DIR__ . '/backup', true));
        } catch (Exception $e) {
            $this->fail($e->getMessage());
        }
    }
}
<?php

use Forever2077\PhpHelper\FileHelper;
use Forever2077\PhpHelper\ZipHelper;
use PHPUnit\Framework\TestCase;

class ZipHelperTest extends TestCase
{
    private string $path = __DIR__ . '/zip';

    public function testInstance()
    {
        $this->assertInstanceOf(ZanySoft\Zip\Zip::class, ZipHelper::instance());
    }

    public function testZipPrepare()
    {
        FileHelper::createDir($this->path);
        try {
            FileHelper::createFile($this->path . '/test1.txt', str_repeat('1', 10000));
            FileHelper::createFile($this->path . '/test2.txt', str_repeat('0', 10000));
            $this->assertFileExists($this->path . '/test1.txt');
            $this->assertFileExists($this->path . '/test2.txt');
        } catch (Exception $e) {
            $this->fail($e->getMessage());
        }
    }

    public function testZip()
    {
        $zip = _zip();
        try {
            $zip->create($this->path . '/test.zip');
            $zip->add($this->path . '/test1.txt');
            $zip->add($this->path . '/test2.txt');
            $zip->close();
            $this->assertFileExists($this->path . '/test.zip');
        } catch (Exception $e) {
            $this->fail($e->getMessage());
        }
    }

    public function testZipManage()
    {
        try {
            $zip = _zip();
            $manager = _zip(true);
            $manager->addZip($zip->open($this->path . '/test.zip'));
            $manager->listFiles();
            $manager->extract($this->path . '/unzip', true);
            $manager->close();
            $this->assertFileExists($this->path . '/unzip/test1.txt');
            $this->assertFileExists($this->path . '/unzip/test2.txt');
        } catch (Exception $e) {
            $this->fail($e->getMessage());
        } finally {
            FileHelper::removeDir($this->path, true);
        }
    }
}
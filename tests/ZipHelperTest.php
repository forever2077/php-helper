<?php

use Forever2077\PhpHelper\FileHelper;
use Forever2077\PhpHelper\ZipHelper;
use PHPUnit\Framework\TestCase;

class ZipHelperTest extends TestCase
{
    private string $path = __DIR__ . '/zip';

    public function testZipPrepare()
    {
        try {
            FileHelper::createDir($this->path);
            FileHelper::createFile($this->path . '/test.txt', str_repeat('1', 10000));
            $this->assertFileExists($this->path . '/test.txt');
        } catch (Exception $e) {
            $this->fail($e->getMessage());
        }
    }

    public function testZip()
    {
        try {
            $zip = ZipHelper::instance();
            $zip->create($this->path . '/test.zip');
            $zip->add($this->path . '/test.txt');
            $zip->close();
            $this->assertFileExists($this->path . '/test.zip');
        } catch (Exception $e) {
            $this->fail($e->getMessage());
        }
    }

    public function testZipPassword()
    {
        try {
            $zip = ZipHelper::instance();
            $zip->create($this->path . '/test.pw.zip');
            $zip->setPath($this->path);
            $zip->add('test.txt');
            $zip->getArchive()->setEncryptionName('test.txt', ZipArchive::EM_AES_256, 's123123');
            $zip->close();
            $this->assertFileExists($this->path . '/test.pw.zip');
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
            $this->assertFileExists($this->path . '/unzip/test.txt');
        } catch (Exception $e) {
            $this->fail($e->getMessage());
        } finally {
            FileHelper::removeDir($this->path, true);
        }
    }
}
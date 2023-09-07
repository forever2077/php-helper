<?php

use PHPUnit\Framework\TestCase;
use Forever2077\PhpHelper\Helper;
use Forever2077\PhpHelper\DeviceIdHelper;

class DeviceIdHelperTest extends TestCase
{
    public function testInstance()
    {
        $this->assertInstanceOf(DeviceIdHelper::class, Helper::deviceId());
    }

    public function testSetUp()
    {
        DeviceIdHelper::setBin('deviceId_windows_amd64.exe');
        DeviceIdHelper::setPath(dirname(__DIR__) . '/data/device');
        $this->assertFileExists(DeviceIdHelper::getPath() . DIRECTORY_SEPARATOR . DeviceIdHelper::getBin());
    }

    public function testGetCpuUuid()
    {
        $this->assertIsString(DeviceIdHelper::getCpuUuid());
    }

    public function testGetDiskUuid()
    {
        $this->assertIsString(DeviceIdHelper::getDiskUuid());
    }

    public function testGetMacUuid()
    {
        $this->assertIsString(DeviceIdHelper::getMacUuid());
    }

    public function testGetTimestamp()
    {
        $this->assertIsString(DeviceIdHelper::getTimestamp());
    }
}
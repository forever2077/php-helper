<?php

use PHPUnit\Framework\TestCase;
use Forever2077\PhpHelper\Helper;
use Forever2077\PhpHelper\ConfigHelper;
use Noodlehaus\Writer\Ini;

class ConfigHelperTest extends TestCase
{
    private string $settingsJson = <<<FOOBAR
{
  "application": {
    "name": "configuration",
    "secret": "s3cr3t"
  },
  "host": "localhost",
  "port": 80,
  "servers": [
    "host1",
    "host2",
    "host3"
  ]
}
FOOBAR;

    public function testInstance()
    {
        $this->assertEquals('Noodlehaus\Config', Helper::config([])::class);
    }

    public function testLoad()
    {
        $jsonConfig = ConfigHelper::instance($this->settingsJson);
        $this->assertEquals('configuration', $jsonConfig['application.name']);
    }

    public function testToIni()
    {
        $filename = __DIR__ . '/settings.ini';
        $jsonConfig = ConfigHelper::instance($this->settingsJson);
        $jsonConfig->toFile($filename, new Ini());
        $this->assertFileExists($filename);
        unlink($filename);
    }
}
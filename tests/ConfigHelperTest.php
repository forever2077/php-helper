<?php

use PHPUnit\Framework\TestCase;
use Helpful\Helper;
use Helpful\ConfigHelper;
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
        $this->assertEquals(ConfigHelper::class, Helper::config([])::class);
    }

    public function testLoad()
    {
        $json = ConfigHelper::load($this->settingsJson, 'json', true);
        $this->assertEquals('configuration', $json['application.name']);
        $this->assertEquals('configuration', $json->get('application.name'));
    }

    public function testToIni()
    {
        $filename = __DIR__ . '/settings.ini';
        $jsonConfig = ConfigHelper::load($this->settingsJson, 'json', true);
        $jsonConfig->toFile($filename, new Ini());
        $this->assertFileExists($filename);
        unlink($filename);
    }
}
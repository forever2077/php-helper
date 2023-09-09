<?php

use PHPUnit\Framework\TestCase;
use Helpful\Helper;
use Helpful\EmbedMapHelper;

class EmbedMapHelperTest extends TestCase
{
    public function testWorldMap()
    {
        $this->assertEquals(EmbedMapHelper::class, Helper::embedMap()::class);
    }

    private function testBaiduMap()
    {
        $wm = new EmbedMapHelper();
        $wm::$apiKey = '******';
        $location = $wm::baiduGeocode('北京市海淀区上地十街10号');

        $lat = $location['lat'];
        $lng = $location['lng'];
        $html = $wm::baiduMap(['lat' => $lat, 'lng' => $lng]);

        $uuid = Helper::uuid()::uuid4();
        $filepath = dirname(__DIR__) . "/data/temp/map/baidu_{$uuid}.html";
        $file = Helper::file();
        $file::createFile($filepath, $html);
        $this->assertFileExists($filepath);
        $file::removeFile($filepath);
    }

    private function testGoogleMap()
    {
        $wm = new EmbedMapHelper();
        $wm::$apiKey = '******';
        $wm::$proxy = 'http://127.0.0.1:7890';
        $location = $wm::googleGeocode('北京市海淀区上地十街10号');

        $lat = $location['lat'];
        $lng = $location['lng'];
        $html = $wm::googleMap(['lat' => $lat, 'lng' => $lng]);

        $uuid = Helper::uuid()::uuid4();
        $filepath = dirname(__DIR__) . "/data/temp/map/google_{$uuid}.html";
        $file = Helper::file();
        $file::createFile($filepath, $html);
        $this->assertFileExists($filepath);
        $file::removeFile($filepath);
    }
}
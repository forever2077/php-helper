<?php

use PHPUnit\Framework\TestCase;
use Forever2077\PhpHelper\Helper;
use Forever2077\PhpHelper\GeoHelper;
use Rinvex\Country\CountryLoaderException;

class GeoHelperTest extends TestCase
{
    public function testInstance()
    {
        $this->assertInstanceOf(GeoHelper::class, Helper::geo());
    }

    public function testConstruct()
    {
        try {
            $geo = GeoHelper::country('cn');
            $this->assertEquals('People\'s Republic of China', $geo->getOfficialName());
            $this->assertEquals('People\'s Republic of China', $geo->getTranslation('eng')['official']);
        } catch (CountryLoaderException $e) {
            $this->fail($e->getMessage());
        }
    }

    public function testCountries()
    {
        try {
            $geo = GeoHelper::countries();
            $this->assertIsArray($geo);
        } catch (CountryLoaderException $e) {
            $this->fail($e->getMessage());
        }
    }

    public function testGetCHN()
    {
        try {
            $geo = GeoHelper::countries();
            $this->assertEquals('CHN', $geo['cn']['iso_3166_1_alpha3']);
        } catch (CountryLoaderException $e) {
            $this->fail($e->getMessage());
        }
    }

    public function testGetAllCountries()
    {
        $world = GeoHelper::getAllCountries('zh-tw', 'world');
        $this->assertEquals('奧蘭', $world[248]['name']);
    }

    public function testGetChinaArea()
    {
        try {
            $area = GeoHelper::getChinaArea(542500000000);
            $this->assertEquals('措勤', $area[6]['name']);
        } catch (Exception $e) {
            $this->fail($e->getMessage());
        }
    }
}
<?php

use PHPUnit\Framework\TestCase;
use Forever2077\PhpHelper\Helper;
use Forever2077\PhpHelper\ColorHelper;

class ColorHelperTest extends TestCase
{
    public function testInstance()
    {
        $this->assertEquals(ColorHelper::class, Helper::color()::class);
    }

    public function testConvertColorArrayToRGBA()
    {
        $this->assertEquals('rgb(0,0,1)', ColorHelper::array2value([0, 0, 1], 'rgb'));
        $this->assertEquals('rgba(0,0,0,1)', ColorHelper::array2value([0, 0, 0, 1]));
        $this->assertEquals('rgba(0,0,0,1)', ColorHelper::array2value(['r' => 0, 'g' => 0, 'b' => 0, 'a' => 1]));
        $this->assertEquals('#ff00ff', ColorHelper::array2value([255, 0, 255, 0.5], 'hex'));
        $this->assertEquals('cmyk(255,0,255,0.5)', ColorHelper::array2value([255, 0, 255, 0.5], 'cmyk'));
        $this->assertEquals('hsl(50,0%,100%)', ColorHelper::array2value([50, 0, 100], 'hsl'));
        $this->assertEquals('xyz(50,0,100)', ColorHelper::array2value([50, 0, 100], 'xyz'));
        $this->assertEquals('CIELab(50,0,100)', ColorHelper::array2value([50, 0, 100], 'CIELab'));
    }

    public function testConvert()
    {
        $color = ColorHelper::convert(ColorHelper::array2value([255, 255, 0, 0.5]));
        $this->assertEquals('ff', $color->toHex()->red());
        $this->assertEquals('ff', $color->toHex()->green());
        $this->assertEquals('00', $color->toHex()->blue());
        $this->assertEquals('ff', $color->toHex()->alpha());
    }

    public function testDistance()
    {
        $this->assertIsFloat(ColorHelper::distance('rgb(0,255,0)', 'rgb(255,0,50)'));
        $this->assertIsFloat(ColorHelper::distance('rgb(0,255,0)', 'rgb(255,0,50)', ColorHelper::CIE76));
        $this->assertIsFloat(ColorHelper::distance('rgb(0,255,0)', 'rgb(255,0,50)', ColorHelper::CIE94));
        $this->assertIsFloat(ColorHelper::distance('rgb(0,255,0)', 'rgb(255,0,50)', ColorHelper::CIE94, false));
    }

    public function testContrast()
    {
        $color1 = ColorHelper::convert(ColorHelper::array2value([255, 255, 0, 0.5]));
        $color2 = ColorHelper::convert(ColorHelper::array2value([255, 0, 0, 0.5]));
        $this->assertEquals(3.0, ColorHelper::contrast($color1, $color2));
    }
}
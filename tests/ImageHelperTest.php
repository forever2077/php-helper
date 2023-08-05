<?php

use PHPUnit\Framework\TestCase;
use Forever2077\PhpHelper\ImageHelper;

class ImageHelperTest extends TestCase
{
    public function testIntervention()
    {
        $intervention = ImageHelper::intervention(['driver' => 'gd']);
        $image = $intervention->canvas(400, 300, '#000000');
        $image->text('Hello, world!', 200, 150, function ($font) {
            $font->size(60);
            $font->color('#FFFFFF');
            $font->align('center');
            $font->valign('middle');
        });
        $path = __DIR__ . '/output.jpg';
        $image->save($path);
        $this->assertFileExists($path);
        unlink($path);
    }
}
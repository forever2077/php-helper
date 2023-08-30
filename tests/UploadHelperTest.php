<?php

use PHPUnit\Framework\TestCase;
use Forever2077\PhpHelper\Helper;
use Verot\Upload\Upload;

class UploadHelperTest extends TestCase
{
    public function testInstance()
    {
        $helper = Helper::upload('');
        $this->assertEquals(Upload::class, $helper::class);
    }

    private function testUpload()
    {
        $handle = Helper::upload($_FILES['image_field']);
        if ($handle->uploaded) {
            $handle->file_new_name_body = 'image_resized';
            $handle->image_resize = true;
            $handle->image_x = 100;
            $handle->image_ratio_y = true;
            $handle->process(dirname(__DIR__) . '/data/temp/image');
            if ($handle->processed) {
                $handle->clean();
            } else {
                $this->fail($handle->error);
            }
        }
    }
}
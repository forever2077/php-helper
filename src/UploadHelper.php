<?php

namespace Helpful;

use Verot\Upload\Upload;

class UploadHelper extends Upload
{
    /**
     * @link https://github.com/verot/class.upload.php
     * @param $file
     * @param string $lang
     * @return Upload
     */
    public static function instance($file, string $lang = 'zn_CN'): Upload
    {
        return new Upload($file, $lang);
    }
}
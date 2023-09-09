<?php

namespace Helpful;

use Intervention\Image\ImageManager;

class ImageHelper
{
    /**
     * 默认实例
     * @param array $config 配置
     * @return object
     */
    public static function instance(array $config = []): object
    {
        return self::Intervention($config);
    }

    /**
     * Intervention 实例
     * @link https://image.intervention.io/v2/
     * @param array $config 配置
     * @return ImageManager
     */
    public static function intervention(array $config = []): ImageManager
    {
        return new ImageManager($config);
    }
}
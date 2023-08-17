<?php

namespace Forever2077\PhpHelper;

use Overtrue\Pinyin\Pinyin;

class PinyinHelper extends Pinyin
{
    /**
     * @link https://github.com/overtrue/pinyin
     * @return Pinyin
     */
    public static function instance(): Pinyin
    {
        return new self();
    }
}
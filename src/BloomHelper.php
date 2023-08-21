<?php

namespace Forever2077\PhpHelper;

use Pleo\BloomFilter\BloomFilter;

/**
 * Class BloomHelper 布隆过滤器
 */
class BloomHelper extends BloomFilter
{
    public static function instance(int $approxSize, float $falsePosProb): BloomFilter
    {
        return BloomFilter::init($approxSize, $falsePosProb);
    }
}
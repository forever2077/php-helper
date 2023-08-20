<?php

namespace Forever2077\PhpHelper;

use Forever2077\RandomString\RandomString;
use Forever2077\RandomString\StringConfig;
use Campo\UserAgent;

class RandomHelper
{
    public static function instance(): RandomHelper
    {
        return new self();
    }

    /**
     * 生成随机字符串
     * @link https://github.com/stfndamjanovic/php-random-string
     * @param int|null $length
     * @param StringConfig|null $config
     * @return RandomString
     */
    public static function string(?int $length = 16, StringConfig $config = null): RandomString
    {
        $config = $config ?? StringConfig::make($length);
        return new RandomString($config);
    }

    /**
     * 生成随机UserAgent
     * @link https://github.com/joecampo/random-user-agent
     * @param array $filterBy
     * @return string
     */
    public static function userAgent(array $filterBy = []): string
    {
        try {
            return UserAgent::random($filterBy);
        } catch (\Exception $e) {
            return '';
        }
    }
}
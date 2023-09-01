<?php

namespace Forever2077\PhpHelper;

use Tqdev\PhpCrudApi\Api;
use Tqdev\PhpCrudApi\Config\Config;

class ApiHelper
{
    /**
     * @param array $config
     * @return Api
     * @throws \Exception
     */
    public static function restful(array $config): Api
    {
        try {
            return new Api(new Config($config));
        } catch (\Exception $e) {
            throw new \Exception($e);
        }
    }
}
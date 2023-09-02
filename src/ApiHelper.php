<?php

namespace Forever2077\PhpHelper;

use Tqdev\PhpCrudApi\Api;
use Tqdev\PhpCrudApi\Config\Config;

class ApiHelper
{
    /**
     * @link https://github.com/mevdschee/php-crud-api
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

    /**
     * 将Workerman的HTTP响应头转换为RFC7230兼容
     * @param string $head Request $request->rawHead()
     * @param string $body Request $request->rawBody()
     * @return string
     */
    public static function convert2Rfc7230(string $head, string $body): string
    {
        $lines = explode("\n", $head);
        $lines = array_map(function ($line) {
            return trim($line);
        }, $lines);
        $lines[0] = trim(preg_replace("/HTTP\/\d+(\.\d+)?/", "", $lines[0]));
        $head = implode("\n", $lines);
        return $head . "\n\n" . $body;
    }

    /**
     * 将PhpCrudApi的Json结果格式化
     * @param string $responseString
     * @return string
     */
    public static function convertResponse2Json(string $responseString): string
    {
        $json_start = strpos($responseString, '{');
        return substr($responseString, $json_start);
    }
}
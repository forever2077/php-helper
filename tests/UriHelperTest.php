<?php

use PHPUnit\Framework\TestCase;
use Forever2077\PhpHelper\Helper;
use Forever2077\PhpHelper\UriHelper;

class UriHelperTest extends TestCase
{
    public function testInstance()
    {
        $this->assertEquals('GuzzleHttp\Psr7\Uri', Helper::uri()::class);
    }

    public function testUri()
    {
        $uri = UriHelper::instance('https://www.baidu.com/s?wd=php%20uri%20helper#hash');
        $this->assertEquals('https', $uri->getScheme());
        $this->assertEquals('www.baidu.com', $uri->getHost());
        $this->assertEquals('/s', $uri->getPath());
        $this->assertEquals('wd=php%20uri%20helper', $uri->getQuery());
        $this->assertEquals('hash', $uri->getFragment());
    }
}
<?php

use PHPUnit\Framework\TestCase;
use Forever2077\PhpHelper\Helper;
use Forever2077\PhpHelper\HttpHelper;
use GuzzleHttp\Exception\GuzzleException;

class HttpHelperTest extends TestCase
{
    public function testInstance()
    {
        $this->assertEquals(GuzzleHttp\Client::class, Helper::http()::class);
    }

    public function testGet()
    {
        try {
            $response = HttpHelper::get([
                'url' => 'https://www.baidu.com',
                'options' => [
                    'verify' => dirname(__DIR__) . '/data/http/cacert.pem',
                ],
            ]);
            $this->assertEquals(200, $response->getStatusCode());
        } catch (GuzzleException $e) {
            echo $e->getMessage();
        }
    }

    public function testPost()
    {
        try {
            $response = HttpHelper::post([
                'url' => 'https://www.baidu.com',
                'options' => [
                    'verify' => dirname(__DIR__) . '/data/http/cacert.pem',
                ],
            ]);
            $this->assertEquals(200, $response->getStatusCode());
        } catch (GuzzleException $e) {
            echo $e->getMessage();
        }
    }

    /*public function testGetWithClient()
    {
        try {
            $client = HttpHelper::guzzle();
            $response = HttpHelper::get([
                'client' => $client,
                'url' => 'https://www.baidu.com',
                'options' => [
                    'verify' => __DIR__ . '/cacert.pem',
                ],
            ]);
            $this->assertEquals(200, $response->getStatusCode());
        } catch (GuzzleException $e) {
            echo $e->getMessage();
        }
    }*/
}
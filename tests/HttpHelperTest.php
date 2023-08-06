<?php

use PHPUnit\Framework\TestCase;
use Forever2077\PhpHelper\HttpHelper;
use GuzzleHttp\Exception\GuzzleException;

class HttpHelperTest extends TestCase
{
    public function testInstance()
    {
        try {
            $client = HttpHelper::instance();
            $response = $client->request('GET', 'https://httpbin.org', [
                'verify' => __DIR__ . '/cacert.pem',
            ]);
            $this->assertEquals(200, $response->getStatusCode());
        } catch (GuzzleException $e) {
            echo $e->getMessage();
        }
    }

    public function testGuzzle()
    {
        try {
            $client = HttpHelper::guzzle();
            $response = $client->request('GET', 'https://www.baidu.com', [
                'verify' => __DIR__ . '/cacert.pem',
            ]);
            $this->assertEquals(200, $response->getStatusCode());
        } catch (GuzzleException $e) {
            echo $e->getMessage();
        }
    }

    public function testGet()
    {
        try {
            $response = HttpHelper::get([
                'url' => 'https://www.baidu.com',
                'options' => [
                    'verify' => __DIR__ . '/cacert.pem',
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
                    'verify' => __DIR__ . '/cacert.pem',
                ],
            ]);
            $this->assertEquals(200, $response->getStatusCode());
        } catch (GuzzleException $e) {
            echo $e->getMessage();
        }
    }

    public function testGetWithClient()
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
    }

    public function testPostWithClient()
    {
        try {
            $client = HttpHelper::guzzle();
            $response = HttpHelper::post([
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
    }

    public function testGetWithClientAndUrlAndOptions()
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
    }

    public function testPostWithClientAndUrlAndOptions()
    {
        try {
            $client = HttpHelper::guzzle();
            $response = HttpHelper::post([
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
    }

    public function testSendJson()
    {
        try {
            $response = HttpHelper::sendJson([
                'url' => 'https://www.baidu.com',
                'options' => [
                    'verify' => __DIR__ . '/cacert.pem',
                ],
            ]);
            $this->assertEquals(200, $response->getStatusCode());
        } catch (GuzzleException $e) {
            echo $e->getMessage();
        }
    }

    public function testSendForm()
    {
        try {
            $response = HttpHelper::sendForm([
                'url' => 'https://www.baidu.com',
                'options' => [
                    'verify' => __DIR__ . '/cacert.pem',
                ],
            ]);
            $this->assertEquals(200, $response->getStatusCode());
        } catch (GuzzleException $e) {
            echo $e->getMessage();
        }
    }
}
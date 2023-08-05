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
            $response = $client->request('GET', 'https://www.baidu.com', [
                'verify' => __DIR__ . '/cacert.pem',
            ]);
            $this->assertEquals(200, $response->getStatusCode());
        } catch (GuzzleException $e) {
            echo $e->getMessage();
        }
    }
}
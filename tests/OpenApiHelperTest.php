<?php

use Forever2077\PhpHelper\JsonHelper;
use Forever2077\PhpHelper\ValidateHelper;
use PHPUnit\Framework\TestCase;
use Forever2077\PhpHelper\Helper;
use Forever2077\PhpHelper\OpenApiHelper;

class OpenApiHelperTest extends TestCase
{
    public function testInstance()
    {
        $this->assertInstanceOf(OpenApiHelper::class, Helper::openapi());
    }

    public function testReader()
    {
        $paths = [];
        $openapi = Helper::openapi()->reader(dirname(__DIR__) . '/data/openapi/checkout_orders_v1.json');
        foreach ($openapi->paths as $path => $definition) {
            $paths[] = $path;
        }
        $this->assertNotEmpty($paths);
    }

    public function testWriter()
    {
        $data = [
            'openapi' => '3.0.2',
            'info' => [
                'title' => 'Test API',
                'version' => '1.0.0',
            ],
            'paths' => [
                '/test' => [
                    'description' => 'something'
                ],
            ],
        ];
        try {
            $openapi = Helper::openapi()->writer($data);
        } catch (Exception $e) {
            $this->fail($e->getMessage());
        }
        $this->assertIsBool(ValidateHelper::isValidJson($openapi));
        $this->assertIsBool(JsonHelper::isJson($openapi));

        $filePath = dirname(__DIR__) . '/data/temp/test.json';
        try {
            Helper::openapi()->writer($data, $filePath);
        } catch (Exception $e) {
            $this->fail($e->getMessage());
        }
        $this->assertFileExists($filePath);
    }
}
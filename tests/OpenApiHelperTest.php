<?php

use PHPUnit\Framework\TestCase;
use Helpful\JsonHelper;
use Helpful\ValidateHelper;
use Helpful\Helper;
use Helpful\OpenApiHelper;
use Helpful\OpenApi;

class OpenApiHelperTest extends TestCase
{
    public function testInstance()
    {
        $this->assertInstanceOf(OpenApiHelper::class, Helper::openapi());
    }

    public function testReader()
    {
        $paths = [];
        $openapi = Helper::openapi()->reader(dirname(__DIR__) . '/data/openapi/test.json');
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

    public function testGenerator()
    {
        try {
            $rtn = OpenApiHelper::generator([
                'src' => dirname(__DIR__) . '/data/openapi/test.json',
                'out' => dirname(__DIR__) . '/src/OpenApi/Test.php',
                'namespace' => 'Helpful\OpenApi',
                'top-level' => 'test',
                'lang' => 'php',
                'with-get' => true,
                'with-set' => true,
                'fast-get' => false,
                'with-closing' => false,
                'acronym-styl' => 'original',
                'alphabetize-properties' => true,
                'all-properties-option' => true,
            ]);
            $this->assertIsBool($rtn);
            $this->assertEquals(OpenApi\Test::class, OpenApi\Test::sample()::class);
        } catch (Exception $e) {
            $this->fail($e->getMessage());
        }
    }
}
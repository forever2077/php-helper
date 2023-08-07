<?php

use Forever2077\PhpHelper\FileHelper;
use Forever2077\PhpHelper\JsonHelper;
use PHPUnit\Framework\TestCase;
use Seld\JsonLint\ParsingException;

class Contact
{
    public string $name;
    public Address $address;
}

class Address
{
    public $street;
    public $city;

    public function getGeoCoords()
    {
    }
}

class JsonHelperTest extends TestCase
{
    public function testEncode()
    {
        $this->assertEquals('{"a":1,"b":2,"c":3,"d":4,"e":5}', _json()::encode(['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5]));
    }

    public function testDecode()
    {
        $this->assertEquals(['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5], JsonHelper::decode('{"a":1,"b":2,"c":3,"d":4,"e":5}'));
    }

    public function testSearch()
    {
        try {
            $this->assertEquals(1, JsonHelper::search('foo', ['foo' => 1]));
            $this->assertEquals(1, JsonHelper::search('foo.bar', ['foo' => ['bar' => 1]]));
            $this->assertEquals([1, 2], JsonHelper::search('foo[*].bar', ['foo' => [['bar' => 1], ['bar' => 2]]]));
            $this->assertNull(JsonHelper::search('foo.bar', ['foo' => [['bar' => 1], ['bar' => 2]]]));
        } catch (Exception $e) {
            $this->fail($e->getMessage());
        }
    }

    public function testSearchJson()
    {
        try {
            $this->assertEquals(1, JsonHelper::search('foo', '{"foo":1}'));
            $this->assertEquals(1, JsonHelper::search('foo.bar', '{"foo":{"bar":1}}'));
            $this->assertEquals([1, 2], JsonHelper::search('foo[*].bar', '{"foo":[{"bar":1},{"bar":2}]}'));
            $this->assertNull(JsonHelper::search('foo.bar', '{"foo":[{"bar":1},{"bar":2}]}'));
        } catch (Exception $e) {
            $this->fail($e->getMessage());
        }
    }

    public function testSearchAst()
    {
        try {
            $this->assertEquals(1, JsonHelper::search('foo', ['foo' => 1], ['mode' => 'ast']));
            $this->assertEquals(1, JsonHelper::search('foo.bar', ['foo' => ['bar' => 1]], ['mode' => 'ast']));
            $this->assertEquals([1, 2], JsonHelper::search('foo[*].bar', ['foo' => [['bar' => 1], ['bar' => 2]]], ['mode' => 'ast']));
            $this->assertNull(JsonHelper::search('foo.bar', ['foo' => [['bar' => 1], ['bar' => 2]]], ['mode' => 'ast']));
        } catch (Exception $e) {
            $this->fail($e->getMessage());
        }
    }

    public function testSearchCompiler()
    {
        $path = __DIR__ . '/compiler';
        FileHelper::createDir($path);
        try {
            $this->assertEquals(1, JsonHelper::search('foo', ['foo' => 1], ['mode' => 'compiler', 'path' => $path]));
            $this->assertEquals(1, JsonHelper::search('foo.bar', ['foo' => ['bar' => 1]], ['mode' => 'compiler', 'path' => $path]));
            $this->assertEquals([1, 2], JsonHelper::search('foo[*].bar', ['foo' => [['bar' => 1], ['bar' => 2]]], ['mode' => 'compiler', 'path' => $path]));
            $this->assertNull(JsonHelper::search('foo.bar', ['foo' => [['bar' => 1], ['bar' => 2]]], ['mode' => 'compiler', 'path' => $path]));
        } catch (Exception $e) {
            $this->fail($e->getMessage());
        } finally {
            FileHelper::removeDir($path, true);
        }
    }

    public function testLint()
    {
        try {
            $this->assertIsObject(JsonHelper::lint('{"foo":1}'));
        } catch (ParsingException $e) {
            $this->fail($e->getMessage());
        }
    }

    public function testLintArray()
    {
        try {
            $this->assertIsObject(JsonHelper::lint(['foo' => 1, 'bar']));
        } catch (ParsingException $e) {
            $this->fail($e->getMessage());
        }
    }

    public function testMapper()
    {
        $json = '{"name":"Sheldon Cooper","address":{"street":"2311 N. Los Robles Avenue","city":"Pasadena"}}';
        try {
            $this->assertIsObject(JsonHelper::mapper($json, new Contact));
            $this->assertEquals("Sheldon Cooper", JsonHelper::mapper($json, new Contact)->name);
        } catch (Exception $e) {
            $this->fail($e->getMessage());
        }
    }

    public function testMapperArray()
    {
        $json = [
            'name' => 'Sheldon Cooper',
            'address' => [
                'street' => '2311 N. Los Robles Avenue',
                'city' => 'Pasadena'
            ]
        ];
        try {
            $this->assertIsObject(JsonHelper::mapper($json, new Contact));
            $this->assertEquals("Sheldon Cooper", JsonHelper::mapper($json, new Contact)->name);
        } catch (Exception $e) {
            $this->fail($e->getMessage());
        }
    }

    public function testMapArrayJson()
    {
        $json = '{"name":"Sheldon Cooper","address":{"street":"2311 N. Los Robles Avenue","city":"Pasadena"}}';
        try {
            $this->assertIsArray(JsonHelper::mapArray($json, []));
            $this->assertEquals("Sheldon Cooper", JsonHelper::mapArray($json, [])['name']);
        } catch (Exception $e) {
            $this->fail($e->getMessage());
        }
    }

    public function testMapArrayArray()
    {
        $json = [
            'name' => 'Sheldon Cooper',
            'address' => [
                'street' => '2311 N. Los Robles Avenue',
                'city' => 'Pasadena'
            ]
        ];
        try {
            $this->assertIsArray(JsonHelper::mapArray($json, []));
            $this->assertEquals("Sheldon Cooper", JsonHelper::mapArray($json, [])['name']);
        } catch (Exception $e) {
            $this->fail($e->getMessage());
        }
    }

    public function testParseStreamFile()
    {
        $path = __DIR__ . '/stream';
        FileHelper::createDir($path);
        try {
            $testData = [];
            for ($i = 0; $i < 1000; $i++) {
                $testData[] = [
                    'key' . $i => 'value' . $i,
                    'nested' => [
                        'subkey' . $i => 'subvalue' . $i
                    ]
                ];
            }
            file_put_contents($path . '/test.json', json_encode($testData));
            $items = JsonHelper::parseStream($path . '/test.json');
            /*foreach ($items as $key => $val) {
                print_r($val);
            }*/
            $this->assertIsObject($items);
        } catch (Exception $e) {
            $this->fail($e->getMessage());
        } finally {
            FileHelper::removeDir($path, true);
        }
    }
}
<?php

use Forever2077\PhpHelper\FileHelper;
use Forever2077\PhpHelper\JsonHelper;
use PHPUnit\Framework\TestCase;

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
}
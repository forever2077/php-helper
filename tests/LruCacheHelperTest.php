<?php

use PHPUnit\Framework\TestCase;
use Forever2077\PhpHelper\Helper;
use Forever2077\PhpHelper\LruCacheHelper;

class LruCacheHelperTest extends TestCase
{
    public function testLruCacheHelper()
    {
        try {
            ini_set("memory_limit", "128M");

            $size = 500000;
            $lruCache = new LruCacheHelper($size);

            for ($i = 0; $i < $size; $i++) {
                $lruCache->set("k{$i}", str_repeat('1', 10));
            }

            $this->assertIsString((string)$lruCache->get('k1000'));
            $this->assertEquals($size, $lruCache->count());

            $lruCache->remove('k1');
            $this->assertEquals($size - 1, $lruCache->count());

            dump(Helper::system()::getMemoryUsage());

        } catch (Exception $e) {
            $this->fail($e->getMessage());
        }
    }
}
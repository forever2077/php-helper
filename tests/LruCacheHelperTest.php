<?php

use PHPUnit\Framework\TestCase;
use Helpful\Helper;
use Helpful\LruCacheHelper;

class LruCacheHelperTest extends TestCase
{
    public function testInstance()
    {
        try {
            $lruCache = new LruCacheHelper(1);
            $this->assertInstanceOf(Helper::lruCache(1)::class, $lruCache);
        } catch (Exception $e) {
            $this->fail($e->getMessage());
        }
    }

    public function testLruCacheHelper()
    {
        try {
            $size = 100;
            $lruCache = new LruCacheHelper($size);

            for ($i = 0; $i < $size; $i++) {
                $lruCache->set("k{$i}", str_repeat('1', 1));
            }

            $this->assertIsString((string)$lruCache->get('k1'));
            $this->assertEquals($size, $lruCache->count());

            $lruCache->remove('k1');
            $this->assertEquals($size - 1, $lruCache->count());
        } catch (Exception $e) {
            $this->fail($e->getMessage());
        }
    }
}
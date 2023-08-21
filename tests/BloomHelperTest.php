<?php

use PHPUnit\Framework\TestCase;
use Forever2077\PhpHelper\Helper;
use Pleo\BloomFilter\BloomFilter;

class BloomHelperTest extends TestCase
{
    private int $approximateItemCount = 100000;
    private float $falsePositiveProbability = 0.001;

    public function testInstance()
    {
        $this->assertEquals(BloomFilter::class, Helper::bloom($this->approximateItemCount, $this->falsePositiveProbability)::class);
    }

    public function testAdd()
    {
        $bf = Helper::bloom($this->approximateItemCount, $this->falsePositiveProbability);
        $bf->add('item1');
        $bf->add('item2');
        $bf->add('item3');
        $this->assertTrue($bf->exists('item1'));
        $this->assertTrue($bf->exists('item2'));
        $this->assertTrue($bf->exists('item3'));
        $this->assertFalse($bf->exists('non-existing-item'));
    }

    public function testJsonSerialized()
    {
        $bf = Helper::bloom($this->approximateItemCount, $this->falsePositiveProbability);
        $bf->add('item1');
        $bf->add('item2');
        $bf->add('item3');

        $serialized = json_encode($bf);
        unset($bf);

        $bf = BloomFilter::initFromJson(json_decode($serialized, true));

        $this->assertTrue($bf->exists('item1'));
        $this->assertTrue($bf->exists('item2'));
        $this->assertTrue($bf->exists('item3'));
        $this->assertFalse($bf->exists('non-existing-item'));
    }
}
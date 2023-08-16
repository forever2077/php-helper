<?php

use Alipay\OpenAPISDK\Api\AlipayTradeApi;
use Forever2077\PhpHelper\AlipayHelper;
use PHPUnit\Framework\TestCase;
use Alipay\EasySDK\Kernel\Factory;
use Alipay\EasySDK\Kernel\Payment;

class AlipayHelperTest extends TestCase
{
    public function testInstance()
    {
        $this->assertInstanceOf(AlipayHelper::class, AlipayHelper::instance());
    }

    public function testV3()
    {
        $this->assertInstanceOf(AlipayTradeApi::class, AlipayHelper::v3());
    }

    public function testEasy()
    {
        $this->assertEquals(Factory::class, AlipayHelper::easy()::class);
    }

    public function testEasyPayment()
    {
        try {
            $result = AlipayHelper::easy()::payment();
            $this->assertEquals(Payment::class, $result::class);
        } catch (Exception $e) {
            $this->fail($e->getMessage());
        }
    }

    public function testAlipay()
    {
        $this->assertEquals(AlipayHelper::class, _alipay()::class);
    }
}
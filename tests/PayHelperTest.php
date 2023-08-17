<?php

use Forever2077\PhpHelper\PayHelper;
use PHPUnit\Framework\TestCase;
use Yansongda\Pay\Provider\Alipay;
use Yansongda\Pay\Provider\Wechat;
use Yansongda\Pay\Provider\Unipay;

class PayHelperTest extends TestCase
{
    public function testInstance()
    {
        $this->assertInstanceOf(PayHelper::class, PayHelper::instance());
    }

    public function testPay()
    {
        $this->assertInstanceOf(PayHelper::class, _pay());
    }

    public function testAlipay()
    {
        $alipay = PayHelper::alipay([]);
        $this->assertInstanceOf(Alipay::class, $alipay);
    }

    public function testWechat()
    {
        $wechat = PayHelper::wechat([]);
        $this->assertInstanceOf(Wechat::class, $wechat);
    }

    public function testUnipay()
    {
        $unipay = PayHelper::unipay([]);
        $this->assertInstanceOf(Unipay::class, $unipay);
    }
}

<?php

use PHPUnit\Framework\TestCase;
use Forever2077\PhpHelper\Helper;
use Forever2077\PhpHelper\PayHelper;
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
        $this->assertInstanceOf(PayHelper::class, Helper::pay());
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

    public function testPaypal()
    {
        $gateway = PayHelper::paypal();
        $gateway->setUsername('adrian');
        $gateway->setPassword('12345');
        $parameters = $gateway->getDefaultParameters();
        //dump($parameters);
        $this->assertIsArray($parameters);
    }

    public function testStripe()
    {
        $gateway = PayHelper::stripe();
        $gateway->setApiKey('abc123');
        $parameters = $gateway->getDefaultParameters();
        //dump($parameters);
        $this->assertIsArray($parameters);
    }
}

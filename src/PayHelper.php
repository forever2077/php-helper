<?php

namespace Forever2077\PhpHelper;

use Yansongda\Pay\Pay;
use Yansongda\Pay\Provider\Alipay;
use Yansongda\Pay\Provider\Unipay;
use Yansongda\Pay\Provider\Wechat;
use Omnipay\Omnipay;
use Omnipay\Common\GatewayInterface;

/**
 * 支付辅助类
 * @link https://pay.yansongda.cn/docs/v3/
 * @link https://github.com/yansongda/pay
 * @link https://github.com/thephpleague/omnipay
 */
class PayHelper
{
    /**
     * @return PayHelper
     */
    public static function instance(): PayHelper
    {
        return new self();
    }

    /**
     * 支付宝
     * @param array $config
     * @return Alipay
     */
    public static function alipay(array $config): Alipay
    {
        return Pay::alipay($config);
    }

    /**
     * 微信支付
     * @param array $config
     * @return Wechat
     */
    public static function wechat(array $config): Wechat
    {
        return Pay::wechat($config);
    }

    /**
     * 云闪付
     * @param array $config
     * @return Unipay
     */
    public static function unipay(array $config): Unipay
    {
        return Pay::unipay($config);
    }

    /**
     * paypal
     * @link https://github.com/thephpleague/omnipay-paypal
     * @link https://github.com/paypal/paypal-rest-api-specifications
     * @link https://github.com/paypal/PayPal-PHP-SDK
     */
    public static function paypal(): GatewayInterface
    {
        return Omnipay::create('PayPal_Express');
    }

    /**
     * stripe
     * @link https://github.com/thephpleague/omnipay-stripe
     */
    public static function stripe(): GatewayInterface
    {
        return Omnipay::create('Stripe');
    }
}
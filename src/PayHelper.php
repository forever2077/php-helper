<?php

namespace Forever2077\PhpHelper;

use Yansongda\Pay\Pay;
use Yansongda\Pay\Provider\Alipay;
use Yansongda\Pay\Provider\Unipay;
use Yansongda\Pay\Provider\Wechat;

/**
 * 支付辅助类
 * @link https://pay.yansongda.cn/docs/v3/
 * @link https://github.com/yansongda/pay
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
     * PayPal
     * @param array $config
     * @return void
     */
    private static function paypal(array $config)
    {
        // https://github.com/Payum/Payum
        // https://github.com/paypal/PayPal-PHP-SDK
        // https://packagist.org/packages/omnipay/paypal
    }
}
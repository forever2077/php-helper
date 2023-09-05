## 支付 Payment

```php
// 支付宝
PayHelper::alipay($config);
// 微信支付
PayHelper::wechat($config);
// 银联
PayHelper::unipay($config);
文档 https://pay.yansongda.cn/docs/v3/

// Paypal
PayHelper::paypal();
文档 https://github.com/thephpleague/omnipay-paypal
// Stripe
PayHelper::stripe();
文档 https://github.com/thephpleague/omnipay-stripe
```

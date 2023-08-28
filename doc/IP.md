## 网际协议 IP

```php
// 获取客户端真实IP
IPHelper::remoteIp($useProxy = false);

// 生成随机中国IP（爬虫伪造ip）
IPHelper::randIprandChineseIp();

// 网络地址类型判断
$address = IpHelper::networkAddress('127.0.0.1');
$this->assertInstanceOf(IPv4Address::class, $address);
$address = IpHelper::networkAddress('127.0.0.1/8');
$this->assertInstanceOf(CIDRv4Address::class, $address);
$address = IpHelper::networkAddress('::1');
$this->assertInstanceOf(IPv6Address::class, $address);
$address = IpHelper::networkAddress('ff80::1/64');
$this->assertInstanceOf(CIDRv6Address::class, $address);
$address = IpHelper::networkAddress('84:34:ff:ff:ff:ff');
$this->assertInstanceOf(MACAddress::class, $address);
// 网络地址对比
$this->assertIsBool(IpHelper::networkAddress('::1')->equals(IpHelper::networkAddress('::1')));
// 判断目标IP是否在CIDR域内
$cidr = IpHelper::networkAddress('192.168.0.7/8');
$network = $cidr->toNetwork();
$this->assertIsBool($network->containsAddress(IpHelper::networkAddress('192.168.0.1')));
文档 https://github.com/lukanetconsult/network-address-types
```
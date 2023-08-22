<?php

use LUKA\Network\IPv4\IPv4Address;
use LUKA\Network\IPv4\CIDRv4Address;
use LUKA\Network\IPv6\CIDRv6Address;
use LUKA\Network\IPv6\IPv6Address;
use LUKA\Network\MACAddress;
use PHPUnit\Framework\TestCase;
use Forever2077\PhpHelper\Helper;
use Forever2077\PhpHelper\IpHelper;

class IpHelperTest extends TestCase
{
    public function testRemoteIp()
    {
        $ip = Helper::ip()::remoteIp();
        $this->assertEmpty($ip);
    }

    public function testRandChineseIp()
    {
        $ip = IpHelper::randChineseIp();
        $this->assertNotEmpty($ip);
    }

    public function testIpAnalysis()
    {
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

        $this->assertIsBool(IpHelper::networkAddress('::1')->equals(IpHelper::networkAddress('::1')));

        $cidr = IpHelper::networkAddress('192.168.0.7/8');
        $network = $cidr->toNetwork();
        $this->assertIsBool($network->containsAddress(IpHelper::networkAddress('192.168.0.1')));
    }
}
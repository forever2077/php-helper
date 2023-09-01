<?php

use PHPUnit\Framework\TestCase;
use Forever2077\PhpHelper\Helper;
use Forever2077\PhpHelper\NetHelper;

class NetHelperTest extends TestCase
{
    public function testInstance()
    {
        $this->assertEquals(NetHelper::class, Helper::net()::class);
    }

    private function testDnsQuery()
    {
        $rtn = NetHelper::dnsQuery('baidu.com', DNS_MX);
        $this->assertEquals('baidu.com', $rtn[0]['host']);
    }

    private function testWhoisQuery()
    {
        $rs = NetHelper::whoisQueryOnline('www.baidu.com');
        $this->assertStringContainsString('Domain Name: baidu.com', $rs);

        $rs = NetHelper::whoisQueryOnline('www.baidu.com', 'who');
        $this->assertStringContainsString('Domain Name: baidu.com', $rs);
    }

    private function testDnsQueryOnline()
    {
        $rtn = NetHelper::dnsQueryOnline('baidu.com');
        $this->assertEquals('baidu.com', $rtn[1][0]);
    }

    private function testPing()
    {
        $this->assertTrue(NetHelper::ping('www.baidu.com'));
    }

    private function testPortScanner()
    {
        //dump(NetHelper::portScanner('www.baidu.com', '80-100'));
        $rtn = NetHelper::portScanner('www.baidu.com', [80, 443, 8080]);
        $this->assertEquals([80, 443], $rtn);
    }
}
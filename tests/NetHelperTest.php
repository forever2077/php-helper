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

    public function testDnsQuery()
    {
        /*$rtn = Helper::net()::dnsQuery('baidu.com', DNS_MX);
        $this->assertEquals('baidu.com', $rtn['0']['host']);*/
    }

    public function testWhoisQuery()
    {
        //dump(Helper::net()::whoisQuery('www.qq.com'));
    }
}
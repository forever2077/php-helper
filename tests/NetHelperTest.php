<?php

use PHPUnit\Framework\TestCase;
use Helpful\Helper;
use Helpful\NetHelper;

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

    private function testTraceroute()
    {
        $rtn = NetHelper::traceroute('www.baidu.com', 3, 1);
        $this->assertIsArray($rtn);
        $this->assertNotEmpty($rtn);
    }

    private function testNslookup()
    {
        $rtn = NetHelper::nslookup('www.baidu.com');
        $this->assertIsArray($rtn);
        $this->assertNotEmpty($rtn);
    }

    private function testNslookupWithServer()
    {
        $rtn = NetHelper::nslookup('www.baidu.com', 'A', '114.114.114.114', 1);
        $this->assertIsArray($rtn);
    }

    private function testArpLookup()
    {
        $rtn = NetHelper::arpLookup();
        $this->assertIsArray($rtn);
        $this->assertNotEmpty($rtn);
    }

    private function testMtuTest()
    {
        $mtu = NetHelper::mtuTest('www.baidu.com', 500, 1500);
        $this->assertTrue($mtu >= 500 && $mtu <= 1500);
    }

    private function testSslCertificateInfo()
    {
        $certInfo = NetHelper::sslCertificateInfo('www.baidu.com', 443, 10);
        $this->assertArrayHasKey('issuer', $certInfo);
        $this->assertArrayHasKey('subject', $certInfo);
        if (isset($certInfo['validTo_time_t'])) {
            // 证书是否在有效期内
            $this->assertIsBool(time() > $certInfo['validTo_time_t']);
        }
    }

    private function testHttpHeaders()
    {
        $headers = NetHelper::httpHeaders('https://www.baidu.com', 5);
        $this->assertIsArray($headers);
        $this->assertNotEmpty($headers);
        $this->assertStringContainsString('HTTP/', $headers[0]);
    }

    private function testNtpTimeSyncWithPrefix()
    {
        $time = NetHelper::ntpTimeSync('global', 123);
        $this->assertIsInt($time);
        $this->assertGreaterThan(0, $time);

        /**
         * 腾讯云 ntp.tencent.com
         * 苹果 time.apple.com
         * 香港天文台 stdtime.gov.hk
         * 中国计量科学研究院 ntp1.nim.ac.cn
         */
        $time = NetHelper::ntpTimeSync('ntp.tencent.com');
        $this->assertIsInt($time);
        $this->assertGreaterThan(0, $time);
    }

    private function testCorsConfigChecker()
    {
        $domains = [
            'https://ecs.aliyuncs.com',
            'https://restapi.amap.com'
        ];
        foreach ($domains as $domain) {
            $cors_headers = NetHelper::corsConfigChecker($domain);
            if ($cors_headers) {
                $this->assertIsArray($cors_headers);
                $this->assertNotEmpty($cors_headers);
            }
        }
    }

    private function testEmailServerBlacklistCheck()
    {
        $rtn = NetHelper::emailServerBlacklistCheck('www.baidu.com');
        $this->assertIsBool($rtn['isListed']);
    }

    private function testEmailServerBlacklistCheckByDefined()
    {
        $dnsblServers = [
            "all.s5h.net", "b.barracudacentral.org", "bl.spamcop.net",
            "blacklist.woody.ch", "bogons.cymru.com", "cbl.abuseat.org",
            "combined.abuse.ch", "db.wpbl.info", "dnsbl-1.uceprotect.net",
            "dnsbl-2.uceprotect.net", "dnsbl-3.uceprotect.net", "dnsbl.dronebl.org",
            "dnsbl.sorbs.net", "drone.abuse.ch", "duinv.aupads.org",
            "dul.dnsbl.sorbs.net", "dyna.spamrats.com", "http.dnsbl.sorbs.net",
            "ips.backscatterer.org", "ix.dnsbl.manitu.net", "korea.services.net",
            "misc.dnsbl.sorbs.net", "noptr.spamrats.com", "orvedb.aupads.org",
            "pbl.spamhaus.org", "proxy.bl.gweep.ca", "psbl.surriel.com",
            "relays.bl.gweep.ca", "relays.nether.net", "sbl.spamhaus.org",
            "singular.ttk.pte.hu", "smtp.dnsbl.sorbs.net", "socks.dnsbl.sorbs.net",
            "spam.abuse.ch", "spam.dnsbl.anonmails.de", "spam.dnsbl.sorbs.net",
            "spam.spamrats.com", "spambot.bls.digibase.ca", "spamrbl.imp.ch",
            "spamsources.fabel.dk", "ubl.lashback.com", "ubl.unsubscore.com",
            "virus.rbl.jp", "web.dnsbl.sorbs.net", "wormrbl.imp.ch",
            "xbl.spamhaus.org", "z.mailspike.net", "zen.spamhaus.org",
            "zombie.dnsbl.sorbs.net"
        ];
        $rtn = NetHelper::emailServerBlacklistCheck('www.baidu.com', $dnsblServers);
        $this->assertIsBool($rtn['isListed']);
    }
}
## 网络 Net

```php
// 测试DNS查询，检查是否能正确解析特定类型的DNS记录（MX类型）
$rtn = NetHelper::dnsQuery('baidu.com', DNS_MX);
$this->assertEquals('baidu.com', $rtn[0]['host']);

// 测试在线Whois查询，对比是否能得到期望的域名信息（默认设置）
$rs = NetHelper::whoisQueryOnline('www.baidu.com');
$this->assertStringContainsString('Domain Name: baidu.com', $rs);

// 测试在线Whois查询，对比是否能得到期望的域名信息（特定whois服务器）
$rs = NetHelper::whoisQueryOnline('www.baidu.com', 'who');
$this->assertStringContainsString('Domain Name: baidu.com', $rs);

// 测试在线DNS查询，检查是否能得到期望的域名解析结果
$rtn = NetHelper::dnsQueryOnline('baidu.com');
$this->assertEquals('baidu.com', $rtn[1][0]);

// 测试Ping功能，检查目标网站是否可达
$this->assertTrue(NetHelper::ping('www.baidu.com'));

// 测试端口扫描功能，检查目标网站特定端口范围是否开放
NetHelper::portScanner('www.baidu.com', '80-100');
$rtn = NetHelper::portScanner('www.baidu.com', [80, 443, 8080]);
$this->assertEquals([80, 443], $rtn);

// 测试Traceroute功能，获取到目标网站的路由跳转情况
$rtn = NetHelper::traceroute('www.baidu.com', 3, 1);
$this->assertIsArray($rtn);

// 测试NSlookup功能，获取到目标网站的DNS信息
$rtn = NetHelper::nslookup('www.baidu.com');
$this->assertIsArray($rtn);

// 测试NSlookup功能，使用特定的DNS服务器和查询类型进行查询
$rtn = NetHelper::nslookup('www.baidu.com', 'A', '114.114.114.114', 1);
$this->assertIsArray($rtn);

// 测试ARP查询功能，获取本地网络的ARP缓存信息
$rtn = NetHelper::arpLookup();
$this->assertIsArray($rtn);

// 测试MTU大小，确认是否在预定范围内
$mtu = NetHelper::mtuTest('www.baidu.com', 500, 1500);
$this->assertTrue($mtu >= 500 && $mtu <= 1500);

// 测试SSL证书信息，确认证书的发行者和有效期等信息
$certInfo = NetHelper::sslCertificateInfo('www.baidu.com', 443, 10);
$this->assertArrayHasKey('issuer', $certInfo);
$this->assertArrayHasKey('subject', $certInfo);
if (isset($certInfo['validTo_time_t'])) {
    $this->assertIsBool(time() > $certInfo['validTo_time_t']);
}

// 测试HTTP头部信息，确认返回的头部信息是否正确
$headers = NetHelper::httpHeaders('https://www.baidu.com', 5);
$this->assertIsArray($headers);
$this->assertNotEmpty($headers);
$this->assertStringContainsString('HTTP/', $headers[0]);

// 测试NTP时间同步功能，确认能够获得有效的时间戳
$time = NetHelper::ntpTimeSync('global', 123);
$this->assertIsInt($time);
$this->assertGreaterThan(0, $time);

// 测试NTP时间同步功能，使用特定的NTP服务器进行测试
$time = NetHelper::ntpTimeSync('ntp.tencent.com');
$this->assertIsInt($time);
$this->assertGreaterThan(0, $time);

// 测试CORS配置，确认目标网站是否支持跨域请求
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

// 测试电子邮件服务器黑名单，确认是否在已知的黑名单中
$rtn = NetHelper::emailServerBlacklistCheck('www.baidu.com');
$this->assertIsBool($rtn['isListed']);

// 测试电子邮件服务器黑名单，使用自定义的DNSBL服务器列表进行测试
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
```

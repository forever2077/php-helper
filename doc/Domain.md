## 域名 Domain

```php
// 域名解析
$domain = 'a.www.baidu.com';

$result = DomainHelper::resolve($domain, DomainHelper::PUBLIC_SUFFIX);
$this->assertEquals('a.www.baidu.com', $result->domain()->toString());
$this->assertEquals('a.www', $result->subDomain()->toString());
$this->assertEquals('baidu', $result->secondLevelDomain()->toString());
$this->assertEquals('baidu.com', $result->registrableDomain()->toString());
$this->assertEquals('com', $result->suffix()->toString());
$this->assertTrue($result->suffix()->isICANN());

$result = DomainHelper::resolve($domain, DomainHelper::TOP_LEVEL_DOMAINS);
$this->assertEquals('a.www.baidu.com', $result->domain()->toString());
$this->assertEquals('a.www', $result->subDomain()->toString());
$this->assertEquals('baidu', $result->secondLevelDomain()->toString());
$this->assertEquals('baidu.com', $result->registrableDomain()->toString());
$this->assertEquals('com', $result->suffix()->toString());
$this->assertTrue($result->suffix()->isIANA());

// 严格模式 (生产模式不建议使用，因为顶级域名来源不断更新中)
$domain = 'a.www.baidu.unknownTLD';
try {
    DomainHelper::resolve($domain, DomainHelper::PUBLIC_SUFFIX, true);
} catch (Exception $e) {
    $this->assertStringContainsString('does not contain a "ICANN" TLD', $e->getMessage());
}
try {
    DomainHelper::resolve($domain, DomainHelper::TOP_LEVEL_DOMAINS, true);
} catch (Exception $e) {
    $this->assertStringContainsString('does not contain a "IANA" TLD', $e->getMessage());
}

文档 https://github.com/jeremykendall/php-domain-parser
```

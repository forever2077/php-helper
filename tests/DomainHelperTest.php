<?php

use PHPUnit\Framework\TestCase;
use Forever2077\PhpHelper\Helper;
use Forever2077\PhpHelper\DomainHelper;

class DomainHelperTest extends TestCase
{
    public function testInstance()
    {
        $this->assertEquals(DomainHelper::class, Helper::domain()::class);
    }

    public function testResolve()
    {
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
    }

    public function testResolveStrict()
    {
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
    }

    private function testSuffix()
    {
        $domain = 'ac.be';
        $unknown = DomainHelper::suffix($domain, DomainHelper::FROM_UNKNOWN);
        $this->assertIsBool($unknown->isKnown());
        $iana = DomainHelper::suffix($domain, DomainHelper::FROM_IANA);
        $this->assertIsBool($iana->isIANA());
        $icann = DomainHelper::suffix($domain, DomainHelper::FROM_ICANN);
        $this->assertIsBool($icann->isICANN());
        $private = DomainHelper::suffix($domain, DomainHelper::FROM_PRIVATE);
        $this->assertIsBool($private->isPrivate());
    }
}
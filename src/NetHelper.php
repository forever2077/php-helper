<?php

namespace Forever2077\PhpHelper;

class NetHelper
{
    /**
     * DNS查询
     * @param string $hostname
     * @param int $type
     * @param $authoritative_name_servers
     * @param $additional_records
     * @param bool $raw
     * @return array|string
     */
    public static function dnsQuery(string $hostname, int $type = DNS_ANY, &$authoritative_name_servers = null, &$additional_records = null, bool $raw = false): array|string
    {
        return dns_get_record($hostname, $type, $authoritative_name_servers, $additional_records, $raw);
    }

    /**
     * DNS在线查询
     * @param string $domainName
     * @return bool|array
     */
    public static function dnsQueryOnline(string $domainName): bool|array
    {
        try {
            $domainName = DomainHelper::resolve($domainName);
        } catch (\Exception $e) {
            return false;
        }

        $domainName = $domainName->domain()->toString();
        $data = [];
        $i = 0;

        try {
            $document = DomHelper::load("https://who.is/dns/{$domainName}");
            $thead = $document->find('.queryResponseBodyKey table thead th');
            $tbody = $document->find('.queryResponseBodyKey table tbody tr');
            foreach ($thead as $th) {
                $data[$i][] = $th->text();
            }
            foreach ($tbody as $tr) {
                $i++;
                foreach ($tr->find('td') as $td) {
                    $data[$i][] = $td->text();
                }
            }
            return $data;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Whois在线查询
     * @param string $domainName 域名
     * @param string $mode : whois / who
     * @return string|false
     */
    public static function whoisQueryOnline(string $domainName, string $mode = 'whois'): string|false
    {
        try {
            $domainName = DomainHelper::resolve($domainName);
        } catch (\Exception $e) {
            return false;
        }

        $registrableDomain = $domainName->registrableDomain()->toString();

        try {
            switch ($mode) {
                case 'who':
                    $document = DomHelper::load("https://who.is/whois/{$registrableDomain}");
                    $content = $document->find('.queryResponseBodyValue > pre');
                    return $content[0]->text();
                default:
                    $document = DomHelper::load("https://www.whois.com/whois/{$registrableDomain}");
                    $content = $document->find('#registrarData');
                    return $content[0]->text();
            }
        } catch (\Exception $e) {
            return false;
        }
    }

    // Ping 工具
    public static function ping($ipAddress)
    {
        // TODO: 实现 Ping 逻辑
    }

    // 端口扫描器
    public static function portScanner($ipAddress, $ports)
    {
        // TODO: 实现端口扫描逻辑
    }

    // Traceroute 工具
    public static function traceroute($ipAddress)
    {
        // TODO: 实现 Traceroute 逻辑
    }

    // SMTP 验证器
    public static function smtpValidator($server, $username, $password)
    {
        // TODO: 实现 SMTP 验证逻辑
    }

    // 证书信息查询
    public static function sslCertificateInfo($domainName)
    {
        // TODO: 实现 SSL 证书信息查询逻辑
    }

    // IP 子网计算器
    public static function ipSubnetCalculator($ipAddress, $subnetMask)
    {
        // TODO: 实现 IP 子网计算逻辑
    }

    // HTTP 头信息查询
    public static function httpHeaders($url)
    {
        // TODO: 实现 HTTP 头信息查询逻辑
    }

    // NTP 时间校准工具
    public static function ntpTimeSync($server)
    {
        // TODO: 实现 NTP 时间校准逻辑
    }

    // 域名可用性检查器
    public static function domainAvailability($domainName)
    {
        // TODO: 实现域名可用性检查逻辑
    }

    // API 状态检查器
    public static function apiStatusCheck($apiUrl)
    {
        // TODO: 实现 API 状态检查逻辑
    }

    // 邮件服务器黑名单查询
    public static function emailServerBlacklistCheck($server)
    {
        // TODO: 实现邮件服务器黑名单查询逻辑
    }

    // ARP 查询工具
    public static function arpLookup()
    {
        // TODO: 实现 ARP 查询逻辑
    }

    // 代理测试器
    public static function proxyTester($proxyAddress)
    {
        // TODO: 实现代理测试逻辑
    }

    // GeoIP 映射
    public static function geoIpMapping($ipAddress)
    {
        // TODO: 实现 GeoIP 映射逻辑
    }

    // IPv6 兼容性检查器
    public static function ipv6CompatibilityCheck($url)
    {
        // TODO: 实现 IPv6 兼容性检查逻辑
    }

    // CORS 配置检查器
    public static function corsConfigChecker($url)
    {
        // TODO: 实现 CORS 配置检查逻辑
    }

    // 网站安全头检查器
    public static function websiteSecurityHeaderCheck($url)
    {
        // TODO: 实现网站安全头检查逻辑
    }

    // MTU 测试工具
    public static function mtuTest($ipAddress)
    {
        // TODO: 实现 MTU 测试逻辑
    }
}

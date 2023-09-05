<?php

namespace Forever2077\PhpHelper;

use Exception;
use Pdp\Rules;
use Pdp\Domain;
use Pdp\Suffix;
use Pdp\TopLevelDomains;
use Pdp\ResolvedDomainName;
use Pdp\CannotProcessHost;
use Pdp\UnableToResolveDomain;

class DomainHelper
{
    const PUBLIC_SUFFIX = 1;
    const TOP_LEVEL_DOMAINS = 2;

    const FROM_IANA = 3;
    const FROM_ICANN = 4;
    const FROM_PRIVATE = 5;
    const FROM_UNKNOWN = 6;

    /**
     * 域名解析
     * @param string $domain 域名
     * @param int $source 校验数据来源
     * @param bool $strict 严格模式 (生产模式不建议使用，因为顶级域名来源不断更新中)
     * @return bool|ResolvedDomainName
     * @throws Exception
     */
    public static function resolve(string $domain, int $source = DomainHelper::PUBLIC_SUFFIX, bool $strict = false): bool|ResolvedDomainName
    {
        $resolver = null;

        try {
            $domain = Domain::fromIDNA2008($domain);
        } catch (CannotProcessHost $e) {
            throw new Exception($e);
        }

        try {
            switch ($source) {
                case DomainHelper::PUBLIC_SUFFIX:
                    $resolver = Rules::fromPath(dirname(__DIR__) . '/data/http/public_suffix_list.dat');
                    if ($strict) {
                        $resolver->getICANNDomain($domain);
                    }
                    break;
                case DomainHelper::TOP_LEVEL_DOMAINS:
                    $resolver = TopLevelDomains::fromPath(dirname(__DIR__) . '/data/http/top_level_domain.txt');
                    if ($strict) {
                        $resolver->getIANADomain($domain);
                    }
                    break;
            }
        } catch (UnableToResolveDomain $e) {
            throw new Exception($e);
        }

        return $resolver ? $resolver->resolve($domain) : false;
    }

    /**
     * @param string $domain 域名
     * @param int $mode 模式
     * @return Suffix
     * @throws Exception
     */
    public static function suffix(string $domain, int $mode = DomainHelper::FROM_UNKNOWN): Suffix
    {
        if ($mode >= 3 && $mode <= 6) {
            try {
                return match ($mode) {
                    DomainHelper::FROM_IANA => Suffix::fromIANA($domain),
                    DomainHelper::FROM_ICANN => Suffix::fromICANN($domain),
                    DomainHelper::FROM_PRIVATE => Suffix::fromPrivate($domain),
                    default => Suffix::fromUnknown($domain),
                };
            } catch (CannotProcessHost $e) {
                throw new Exception($e);
            }
        } else {
            throw new Exception('mode error');
        }
    }
}
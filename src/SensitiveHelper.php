<?php

namespace Forever2077\PhpHelper;

use DfaFilter\SensitiveHelper as DfaSensitiveHelper;
use DfaFilter\Exceptions\PdsBusinessException;
use Forever2077\PhpHelper\Sensitive\Ahocorasick;

/**
 * Class SensitiveHelper 敏感词过滤器
 */
class SensitiveHelper
{
    public static function instance(): SensitiveHelper
    {
        return new self();
    }

    /**
     * DFA算法过滤器
     * @link https://github.com/FireLustre/php-dfa-sensitive
     * @throws PdsBusinessException
     */
    public static function dfa(array|string $source): DfaSensitiveHelper
    {
        try {
            if (is_array($source)) {
                return DfaSensitiveHelper::init()->setTree($source);
            } else if (is_string($source)) {
                return DfaSensitiveHelper::init()->setTreeByFile($source);
            } else {
                throw new PdsBusinessException('source must be array or string');
            }
        } catch (PdsBusinessException $e) {
            throw new PdsBusinessException($e->getMessage());
        }
    }

    /**
     * AC算法过滤器
     * @link https://github.com/codeplea/ahocorasickphp
     * @return Ahocorasick
     */
    public static function ac(): Ahocorasick
    {
        return new Ahocorasick();
    }
}
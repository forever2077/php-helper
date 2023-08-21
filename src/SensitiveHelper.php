<?php

namespace Forever2077\PhpHelper;

use DfaFilter\SensitiveHelper as DfaSensitiveHelper;
use DfaFilter\Exceptions\PdsBusinessException;

/**
 * Class DfaHelper 确定有穷自动机算法
 */
class SensitiveHelper
{
    public static function instance(): SensitiveHelper
    {
        return new self();
    }

    /**
     * 敏感词过滤器
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
}
<?php

namespace Helpful;

use DfaFilter\SensitiveHelper as DfaSensitiveHelper;
use DfaFilter\Exceptions\PdsBusinessException;
use Helpful\Sensitive\Ahocorasick;

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
     * @param array|string $source 敏感词数组或者敏感词文件路径
     * @return DfaSensitiveHelper
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
     * @param array $source 敏感词数组
     * @return Ahocorasick
     * @throws \Exception
     */
    public static function ac(array $source = []): Ahocorasick
    {
        $ac = new Ahocorasick();
        if (!empty($source) && is_array($source)) {
            foreach ($source as $item) {
                try {
                    if (is_string($item)) {
                        $ac->add($item);
                    } else {
                        throw new \Exception('source must be string[]');
                    }
                } catch (\Exception $e) {
                    throw new \Exception($e->getMessage());
                }
            }
        }
        return $ac;
    }
}
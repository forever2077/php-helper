<?php

namespace Forever2077\PhpHelper;

use Exception;
use Forever2077\PhpHelper\Lru\LRUCache;

/**
 * Class LruCacheHelper LRU缓存
 */
class LruCacheHelper extends LRUCache
{
    /**
     * 不希望收到原作者命名空间影响，所以直接植入代码
     * @link https://github.com/Zubs/lru-cache
     * @param int $cacheSize
     * @throws Exception
     */
    public function __construct(int $cacheSize)
    {
        parent::__construct($cacheSize);
    }
}

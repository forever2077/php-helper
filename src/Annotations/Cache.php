<?php

namespace Forever2077\PhpHelper\Annotations;

use Attribute;
use Forever2077\PhpHelper\Annotations\Interface\Annotations;

#[Attribute(Attribute::TARGET_METHOD | Attribute::IS_REPEATABLE)]
final class Cache implements Annotations
{
    public int $ttl;
    public string $driver;
    public string $key;

    public function __construct(int $ttl = 300, string $driver = 'files', string $key = '')
    {
        $this->ttl = $ttl;
        $this->driver = $driver;
        $this->key = $key;
    }

    public function getHandler(): string
    {
        return 'Cache';
    }
}
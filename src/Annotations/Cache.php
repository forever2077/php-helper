<?php

namespace Forever2077\PhpHelper\Annotations;

use Attribute;
use Forever2077\PhpHelper\Annotations\Interface\Annotations;

#[Attribute(Attribute::TARGET_METHOD | Attribute::IS_REPEATABLE)]
final class Cache implements Annotations
{
    public string $type;
    public array $args;

    public function __construct(string $type = 'file', array $args = [])
    {
        $this->type = $type;
        $this->args = $args;
    }

    public function getHandler(): string
    {
        return 'CacheMethod';
    }
}
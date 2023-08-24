<?php

namespace Forever2077\PhpHelper\Annotations;

use \Attribute;

#[Attribute(Attribute::TARGET_METHOD | Attribute::IS_REPEATABLE)]
final class Limit implements Annotations
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
        return 'LimitMethod';
    }
}
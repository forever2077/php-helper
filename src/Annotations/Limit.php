<?php

namespace Helpful\Annotations;

use Attribute;
use Helpful\Annotations\Interface\Annotations;

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
        return 'Limit';
    }
}
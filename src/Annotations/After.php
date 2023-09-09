<?php

namespace Helpful\Annotations;

use Attribute;
use Helpful\Annotations\Interface\Annotations;

#[Attribute(Attribute::TARGET_METHOD)]
final class After implements Annotations
{
    public string|array $methodName;
    public array $args;

    public function __construct(string|array $methodName, array $args = [])
    {
        $this->methodName = $methodName;
        $this->args = $args;
    }

    public function getHandler(): string
    {
        return 'BeforeAfter';
    }
}
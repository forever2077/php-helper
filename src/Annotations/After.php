<?php

namespace Forever2077\PhpHelper\Annotations;

use Attribute;
use Forever2077\PhpHelper\Annotations\Interface\Annotations;

#[Attribute(Attribute::TARGET_METHOD)]
final class After implements Annotations
{
    public string|array $methodName;
    public array $args;

    public function __construct(string|array $methodName, array $args)
    {
        $this->methodName = $methodName;
        $this->args = $args;
    }

    public function getHandler(): string
    {
        return 'BeforeAfterMethod';
    }
}
<?php

namespace Forever2077\PhpHelper\Annotations;

use \Attribute;

#[Attribute(Attribute::TARGET_METHOD)]
final class BeforeMethod implements MethodInterface
{
    public string|array $methodName;
    public array $args;

    public function __construct(string|array $methodName, array $args)
    {
        $this->methodName = $methodName;
        $this->args = $args;
    }
}
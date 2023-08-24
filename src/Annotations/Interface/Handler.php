<?php

namespace Forever2077\PhpHelper\Annotations\Interface;

interface Handler
{
    public static function run(array $methodName, object $annotationInstance): void;
}
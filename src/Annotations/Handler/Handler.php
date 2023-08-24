<?php

namespace Forever2077\PhpHelper\Annotations\Handler;

interface Handler
{
    public static function run(array $annotations, string $targetAnnotation, object $classInstance): void;
}
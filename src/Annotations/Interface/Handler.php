<?php

namespace Forever2077\PhpHelper\Annotations\Interface;

use ReflectionClass;

interface Handler
{
    public static function run(ReflectionClass $class, object $annotationInstance): void;
}
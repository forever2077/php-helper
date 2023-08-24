<?php

namespace Forever2077\PhpHelper\Annotations\Handler;

use Forever2077\PhpHelper\Annotations\Interface\Handler;
use ReflectionClass;
use ReflectionException;

class Limit implements Handler
{
    /**
     * @param ReflectionClass $class
     * @param object $annotationInstance
     * @return void
     * @throws ReflectionException
     */
    public static function run(ReflectionClass $class, object $annotationInstance): void
    {
        try {
            dump($class);
            dump($annotationInstance);
        } catch (ReflectionException $e) {
            throw new ReflectionException(__CLASS__, 0, $e);
        }
    }
}
<?php

namespace Forever2077\PhpHelper\Annotations\Handler;

use Forever2077\PhpHelper\Annotations\Interface\Handler;
use ReflectionClass;
use ReflectionException;

class Log implements Handler
{
    /**
     * @param ReflectionClass $class
     * @param object $annotationInstance
     * @param mixed|null $targetMethodRtn
     * @return void
     * @throws ReflectionException
     */
    public static function run(ReflectionClass $class, object $annotationInstance, mixed $targetMethodRtn = null): void
    {
        try {
            dump($class);
            dump($annotationInstance);
            dump($targetMethodRtn);
        } catch (ReflectionException $e) {
            throw new ReflectionException(__CLASS__, 0, $e);
        }
    }
}
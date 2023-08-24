<?php

namespace Forever2077\PhpHelper\Annotations\Handler;

use Forever2077\PhpHelper\Annotations\Interface\Handler;
use ReflectionClass;

class Cache implements Handler
{
    /**
     * @param ReflectionClass $class
     * @param object $annotationInstance
     * @param mixed|null $targetMethodRtn
     * @return void
     */
    public static function run(ReflectionClass $class, object $annotationInstance, mixed $targetMethodRtn = null): void
    {
        /*dump($class);
        dump($annotationInstance);
        dump($targetMethodRtn);*/
    }
}
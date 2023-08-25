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
     * @return mixed
     */
    public static function run(ReflectionClass $class, object $annotationInstance, mixed $targetMethodRtn = null): mixed
    {
        /*dump($class);
        dump($annotationInstance);
        dump($targetMethodRtn);*/

        return true;
    }
}
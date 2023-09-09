<?php

namespace Helpful\Annotations\Handler;

use Helpful\Annotations\Interface\Handler;
use ReflectionClass;

class Limit implements Handler
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
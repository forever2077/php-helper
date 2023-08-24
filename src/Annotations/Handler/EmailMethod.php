<?php

namespace Forever2077\PhpHelper\Annotations\Handler;

use Forever2077\PhpHelper\Annotations\Interface\Handler;
use ReflectionException;
use ReflectionMethod;

class EmailMethod implements Handler
{
    /**
     * @param array $methodName
     * @param object $annotationInstance
     * @return void
     * @throws ReflectionException
     */
    public static function run(array $methodName, object $annotationInstance): void
    {
        try {
            $_method = new ReflectionMethod($methodName[0], $methodName[1]);
            if ($_method->isStatic()) {
                $_method->invokeArgs(null, $annotationInstance->args);
            } else {
                $_method->invokeArgs(is_object($methodName[0]) ? $methodName[0] : new $methodName[0], $annotationInstance->args);
            }
        } catch (ReflectionException $e) {
            throw new ReflectionException('handler: ' . $methodName[1], 0, $e);
        }
    }
}
<?php

namespace Forever2077\PhpHelper\Annotations\Handler;

use Forever2077\PhpHelper\Annotations\Interface\Handler;
use ReflectionClass;
use ReflectionMethod;
use ReflectionException;

class BeforeAfter implements Handler
{
    /**
     * @param ReflectionClass $class
     * @param object $annotationInstance
     * @param mixed|null $targetMethodRtn
     * @return mixed
     * @throws ReflectionException
     */
    public static function run(ReflectionClass $class, object $annotationInstance, mixed $targetMethodRtn = null): mixed
    {
        if (!is_string($annotationInstance->methodName) && !is_array($annotationInstance->methodName)) {
            throw new ReflectionException('methodName must be string or array');
        }

        if (is_array($annotationInstance->methodName)) {
            $methodName = $annotationInstance->methodName;
        } else {
            $instanceOfClass = $class->newInstance();
            $methodName = [$instanceOfClass, $annotationInstance->methodName];
        }

        if (!method_exists($methodName[0], $methodName[1])) {
            throw new ReflectionException('method not exists');
        }

        try {
            $_method = new ReflectionMethod($methodName[0], $methodName[1]);
            if ($_method->isStatic()) {
                return $_method->invokeArgs(null, $annotationInstance->args);
            } else {
                return $_method->invokeArgs(is_object($methodName[0]) ? $methodName[0] : new $methodName[0], $annotationInstance->args);
            }
        } catch (ReflectionException $e) {
            throw new ReflectionException(__CLASS__, 0, $e);
        }
    }
}
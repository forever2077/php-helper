<?php

namespace Forever2077\PhpHelper\Annotations\Handler;

use ReflectionAttribute;
use ReflectionException;
use ReflectionMethod;

class LimitMethod implements Handler
{
    /**
     * @param array $annotations
     * @param string $targetAnnotation
     * @param object $classInstance
     * @return void
     * @throws ReflectionException
     */
    public static function run(array $annotations, string $targetAnnotation, object $classInstance): void
    {
        /** @var ReflectionAttribute $annotation */
        foreach ($annotations as $annotation) {
            if ($annotation->getName() === $targetAnnotation) {

                $instance = $annotation->newInstance();

                if (!is_string($instance->methodName) && !is_array($instance->methodName)) {
                    throw new ReflectionException('methodName must be string or array');
                }

                $methodName = is_array($instance->methodName) ? $instance->methodName : [$classInstance, $instance->methodName];

                if (!method_exists($methodName[0], $methodName[1])) {
                    throw new ReflectionException('method not exists');
                }

                $_method = new ReflectionMethod($methodName[0], $methodName[1]);

                try {
                    if ($_method->isStatic()) {
                        $_method->invokeArgs(null, $instance->args);
                    } else {
                        $_method->invokeArgs(is_object($methodName[0]) ? $methodName[0] : new $methodName[0], $instance->args);
                    }
                } catch (ReflectionException $e) {
                    throw new ReflectionException('handleAnnotations: ' . $methodName[1], 0, $e);
                }
            }
        }
    }
}
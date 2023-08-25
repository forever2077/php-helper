<?php

namespace Forever2077\PhpHelper\Annotations\Interface;

use ReflectionClass;

interface Handler
{
    /**
     * @param ReflectionClass $class 执行方法所在类对象
     * @param object $annotationInstance 注解对象
     * @param mixed|null $targetMethodRtn 执行方法返回值
     * @return mixed
     */
    public static function run(ReflectionClass $class, object $annotationInstance, mixed $targetMethodRtn = null): mixed;
}
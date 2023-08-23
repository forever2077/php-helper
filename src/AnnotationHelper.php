<?php

namespace Forever2077\PhpHelper;

use ReflectionClass;
use ReflectionMethod;
use ReflectionException;
use Exception;

class AnnotationHelper
{
    /**
     * @param $callback
     * @param array $args
     * @return mixed
     * @throws Exception
     */
    public static function process($callback, array $args = []): mixed
    {
        if (is_array($callback)) {
            try {
                $class = new ReflectionClass($callback[0]);
                $method = $class->getMethod($callback[1]);
                return self::processMethodAnnotations($class, $method, $args);
            } catch (Exception $e) {
                throw new Exception($e->getMessage());
            }
        } else {
            throw new Exception('callback must be array');
        }
    }

    /**
     * @param ReflectionClass $class
     * @param ReflectionMethod $method
     * @param array $args
     * @return mixed
     * @throws ReflectionException
     */
    private static function processMethodAnnotations(ReflectionClass $class, ReflectionMethod $method, array $args): mixed
    {
        // 获取目标所有注解
        $annotations = $method->getAttributes();
        // 获取目标类所有方法
        $methods = $class->getMethods(ReflectionMethod::IS_PUBLIC);

        //dump($annotations);
        //dump($methods);

        foreach ($annotations as $annotation) {
            if ($annotation->getName() === Annotations\BeforeMethod::class) {
                //$callback = $method->isStatic() ? [$annotation->newInstance(), $annotation->getName()] : [$objectOrClass, $annotation->getName()];
                //call_user_func_array($callback, []);

                $instance = $annotation->newInstance();
                dump($instance->methodName);
                dump($instance->args);
            }
        }

        foreach ($annotations as $annotation) {
            if ($annotation->getName() === Annotations\AfterMethod::class) {
                //$callback = $method->isStatic() ? [$annotation->newInstance(), $annotation->getName()] : [$objectOrClass, $annotation->getName()];
                //call_user_func_array($callback, []);

                $instance = $annotation->newInstance();
                dump($instance->methodName);
                dump($instance->args);
            }
        }

        try {
            // 执行目标方法体
            $rtn = $method->invokeArgs(null, $args);
        } catch (ReflectionException $e) {
            throw new ReflectionException($e->getMessage());
        }

        return $rtn;
    }
}

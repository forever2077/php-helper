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
        // 目标类实例化
        $instanceOfClass = $class->newInstance();
        // 获取目标所有注解
        $annotations = $method->getAttributes();
        // 获取目标类所有方法
        //$methods = $class->getMethods(ReflectionMethod::IS_PUBLIC);
        // 类方法前置注解处理
        self::handleAnnotations($annotations, Annotations\BeforeMethod::class, $instanceOfClass);
        // 执行目标方法体
        $rtn = $method->invokeArgs(null, $args);
        // 类方法后置注解处理
        self::handleAnnotations($annotations, Annotations\AfterMethod::class, $instanceOfClass);
        // 返回目标方法执行结果
        return $rtn;
    }

    /**
     * @param array $annotations
     * @param string $targetAnnotation
     * @param $classInstance
     * @return void
     * @throws ReflectionException
     */
    private static function handleAnnotations(array $annotations, string $targetAnnotation, $classInstance): void
    {
        foreach ($annotations as $annotation) {
            if ($annotation->getName() === $targetAnnotation) {
                $instance = $annotation->newInstance();
                if (is_string($instance->methodName)) {
                    call_user_func_array([$classInstance, $instance->methodName], $instance->args);
                } else if (is_array($instance->methodName)) {
                    call_user_func_array([$instance->methodName[0], $instance->methodName[1]], $instance->args);
                } else {
                    throw new ReflectionException('methodName must be string or array');
                }
            }
        }
    }
}

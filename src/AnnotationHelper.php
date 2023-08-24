<?php

namespace Forever2077\PhpHelper;

use ReflectionAttribute;
use ReflectionClass;
use ReflectionMethod;
use ReflectionException;
use Exception;

class AnnotationHelper
{
    private static array $beforeMethodAttribute = [
        Annotations\Before::class,
        Annotations\Limit::class,
    ];

    private static array $afterMethodAttribute = [
        Annotations\After::class,
        Annotations\Cache::class,
        Annotations\Email::class,
        Annotations\Log::class,
    ];

    /**
     * @param array $callback
     * @param array $args
     * @return mixed
     * @throws Exception
     */
    public static function process(array $callback, array $args = []): mixed
    {
        if (!empty($callback)) {
            try {
                $class = new ReflectionClass($callback[0]);
                $method = $class->getMethod($callback[1]);
                return self::processAnnotations($class, $method, $args);
            } catch (Exception $e) {
                throw new Exception('process', 0, $e);
            }
        } else {
            throw new Exception('callback is empty');
        }
    }

    /**
     * @param ReflectionClass $class
     * @param ReflectionMethod $method
     * @param array $args
     * @return mixed
     * @throws ReflectionException
     */
    private static function processAnnotations(ReflectionClass $class, ReflectionMethod $method, array $args = []): mixed
    {
        // 目标类实例化
        $instanceOfClass = $class->newInstance();
        // 获取目标所有注解
        $annotations = $method->getAttributes();

        // 类方法前置注解处理
        foreach ($annotations as $annotation) {
            if (in_array($annotation->getName(), self::$beforeMethodAttribute)) {
                self::handlerAdapter($annotation, $instanceOfClass);
            }
        }

        // 执行目标方法体
        $rtn = $method->invokeArgs(null, $args);

        // 类方法后置注解处理
        foreach ($annotations as $annotation) {
            if (in_array($annotation->getName(), self::$afterMethodAttribute)) {
                self::handlerAdapter($annotation, $instanceOfClass);
            }
        }

        // 返回目标方法执行结果
        return $rtn;
    }

    /**
     * @param ReflectionAttribute $annotation
     * @param object $classInstance
     * @return void
     * @throws ReflectionException
     */
    private static function handlerAdapter(ReflectionAttribute $annotation, object $classInstance): void
    {
        $annotationInstance = $annotation->newInstance();
        $_handlerMethod = 'run';
        $_handlerClass = __NAMESPACE__ . '\Annotations\Handler\\' . ucfirst($annotationInstance->getHandler());

        if (!method_exists($_handlerClass, $_handlerMethod)) {
            throw new ReflectionException('handler not exists');
        }

        if (!is_string($annotationInstance->methodName) && !is_array($annotationInstance->methodName)) {
            throw new ReflectionException('methodName must be string or array');
        }

        $methodName = is_array($annotationInstance->methodName) ? $annotationInstance->methodName : [$classInstance, $annotationInstance->methodName];

        if (!method_exists($methodName[0], $methodName[1])) {
            throw new ReflectionException('method not exists');
        }

        call_user_func([$_handlerClass, $_handlerMethod], $methodName, $annotationInstance);
    }
}

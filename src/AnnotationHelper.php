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
        Annotations\Before::class
    ];

    private static array $afterMethodAttribute = [
        Annotations\After::class, Annotations\Cache::class, Annotations\Log::class
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
        foreach (self::$beforeMethodAttribute as $beforeMethodAttribute) {
            self::handlerAdapter($annotations, $beforeMethodAttribute, $instanceOfClass);
        }

        // 执行目标方法体
        $rtn = $method->invokeArgs(null, $args);

        // 类方法后置注解处理
        foreach (self::$afterMethodAttribute as $afterMethodAttribute) {
            self::handlerAdapter($annotations, $afterMethodAttribute, $instanceOfClass);
        }

        // 返回目标方法执行结果
        return $rtn;
    }

    /**
     * @param array $annotations
     * @param string $targetAnnotation
     * @param object $classInstance
     * @return void
     * @throws ReflectionException
     */
    private static function handlerAdapter(array $annotations, string $targetAnnotation, object $classInstance): void
    {
        /** @var ReflectionAttribute $annotation */
        foreach ($annotations as $annotation) {
            if ($annotation->getName() === $targetAnnotation) {

                $instance = $annotation->newInstance();

                $_handlerMethod = 'run';
                $_handlerClass = __NAMESPACE__ . '\Annotations\Handler\\' . ucfirst($instance->getHandler());

                if (!method_exists($_handlerClass, $_handlerMethod)) {
                    throw new ReflectionException('handler not exists');
                }

                call_user_func([$_handlerClass, $_handlerMethod], $annotations, $targetAnnotation, $classInstance);
            }
        }
    }
}

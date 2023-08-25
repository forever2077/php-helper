<?php

namespace Forever2077\PhpHelper;

use ReflectionAttribute;
use ReflectionClass;
use ReflectionMethod;
use ReflectionException;
use Exception;

class AnnotationHelper
{
    /**
     * 类方法前置注解处理
     * @var array|string[]
     */
    private static array $beforeMethodAttribute = [
        Annotations\Before::class,
        Annotations\Limit::class,
    ];

    /**
     * 类方法后置注解处理
     * @var array|string[]
     */
    private static array $afterMethodAttribute = [
        Annotations\After::class,
        Annotations\Cache::class,
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
        try {
            if (!empty($callback)) {
                $class = new ReflectionClass($callback[0]);
                $method = $class->getMethod($callback[1]);
                return self::processAnnotations($class, $method, $args);
            } else {
                throw new Exception('callback type error');
            }
        } catch (Exception $e) {
            throw new Exception('process', 0, $e);
        }
    }

    /**
     * @param ReflectionClass $class
     * @param ReflectionMethod $method
     * @param array $args
     * @return mixed
     * @throws ReflectionException
     */
    private static function processAnnotations(ReflectionClass &$class, ReflectionMethod &$method, array $args = []): mixed
    {
        $rtn = [];
        $annotations = $method->getAttributes();

        foreach ($annotations as $annotation) {
            if (in_array($annotation->getName(), self::$beforeMethodAttribute)) {
                $rtn[$annotation->getName()] = self::handlerAdapter($annotation, $class);
            }
        }

        if ($method->isStatic()) {
            $rtn['targetMethod'] = $method->invokeArgs(null, $args);
        } else {
            $rtn['targetMethod'] = $method->invokeArgs($class->newInstance(), $args);
        }

        foreach ($annotations as $annotation) {
            if (in_array($annotation->getName(), self::$afterMethodAttribute)) {
                $rtn[$annotation->getName()] = self::handlerAdapter($annotation, $class, $rtn['targetMethod']);
            }
        }

        return $rtn;
    }

    /**
     * @param ReflectionAttribute $annotation
     * @param ReflectionClass $class
     * @param mixed|null $targetMethodRtn
     * @return mixed
     * @throws ReflectionException
     */
    private static function handlerAdapter(ReflectionAttribute $annotation, ReflectionClass &$class, mixed $targetMethodRtn = null): mixed
    {
        $annotationInstance = $annotation->newInstance();
        $_handlerMethod = 'run';
        $_handlerClass = __NAMESPACE__ . '\Annotations\Handler\\' . ucfirst($annotationInstance->getHandler());

        if (!method_exists($_handlerClass, $_handlerMethod)) {
            throw new ReflectionException('handler not exists');
        }

        return call_user_func([$_handlerClass, $_handlerMethod], $class, $annotationInstance, $targetMethodRtn);
    }
}

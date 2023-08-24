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
     * 通过继承触发
     * @throws Exception
     */
    public function __construct()
    {
        self::process();
    }

    /**
     * @param array|string|object $callback
     * @param array $args
     * @return mixed
     * @throws Exception
     */
    public static function process(array|string|object $callback = [], array $args = []): mixed
    {
        try {
            if (is_array($callback) && !empty($callback)) {
                $class = new ReflectionClass($callback[0]);
                $method = $class->getMethod($callback[1]);
                return self::processAnnotations($class, $method, $args);
            } elseif (is_string($callback) || is_object($callback)) {
                $rtn = [];
                $class = new ReflectionClass($callback);
                $methods = $class->getMethods(ReflectionMethod::IS_PUBLIC);
                foreach ($methods as $method) {
                    if ($method->getDeclaringClass()->getName() == $class->getName()) {
                        if ($method->getAttributes()) {
                            $rtn[$method->getName()] = self::processAnnotations($class, $method, $args);
                        }
                    }
                }
                return $rtn;
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
        // 获取目标所有注解
        $annotations = $method->getAttributes();

        foreach ($annotations as $annotation) {
            if (in_array($annotation->getName(), self::$beforeMethodAttribute)) {
                self::handlerAdapter($annotation, $class);
            }
        }

        // 执行目标方法体
        $rtn = $method->invokeArgs(null, $args);

        foreach ($annotations as $annotation) {
            if (in_array($annotation->getName(), self::$afterMethodAttribute)) {
                self::handlerAdapter($annotation, $class);
            }
        }

        return $rtn;
    }

    /**
     * @param ReflectionAttribute $annotation
     * @param ReflectionClass $class
     * @return void
     * @throws ReflectionException
     */
    private static function handlerAdapter(ReflectionAttribute $annotation, ReflectionClass &$class): void
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

        if (is_array($annotationInstance->methodName)) {
            $methodName = $annotationInstance->methodName;
        } else {
            $instanceOfClass = $class->newInstance();
            $methodName = [$instanceOfClass, $annotationInstance->methodName];
        }

        if (!method_exists($methodName[0], $methodName[1])) {
            throw new ReflectionException('method not exists');
        }

        call_user_func([$_handlerClass, $_handlerMethod], $methodName, $annotationInstance);
    }
}

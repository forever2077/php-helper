<?php

namespace Forever2077\PhpHelper;

use ReflectionClass;
use ReflectionMethod;
use ReflectionAttribute;
use ReflectionException;
use Exception;
use Forever2077\PhpHelper\Annotations\{After, Before, Cache, Log, Limit};

class AnnotationHelper
{
    /**
     * 类方法前置注解处理
     * @var array|string[]
     */
    private static array $beforeMethodAttribute = [
        Cache::class, Before::class, Limit::class,
    ];

    /**
     * 类方法后置注解处理
     * @var array|string[]
     */
    private static array $afterMethodAttribute = [
        Cache::class, After::class, Log::class,
    ];

    /**
     * @link https://github.com/PHPSocialNetwork/phpfastcache
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
                return self::processMethodAnnotations($class, $method, $args);
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
    private static function processMethodAnnotations(ReflectionClass &$class, ReflectionMethod &$method, array $args = []): mixed
    {
        $rtn = [
            '__className' => $class->getName(),
            '__methodName' => $method->getName(),
            '__createTime' => microtime(true),
        ];
        $annotations = $method->getAttributes();

        foreach ($annotations as $annotation) {
            if (in_array($annotation->getName(), self::$beforeMethodAttribute)) {
                $rtn[$annotation->getName()] = self::handlerAdapter($annotation, $class, $rtn);
            }
        }

        // Bool类型不被作为缓存结果返回
        if (isset($rtn[Cache::class]) && !is_bool($rtn[Cache::class])) {
            $rtn[$method->getName()] = $rtn[Cache::class];
            unset(self::$afterMethodAttribute[Cache::class]);
        } else {
            if ($method->isStatic()) {
                $rtn[$method->getName()] = $method->invokeArgs(null, $args);
            } else {
                $rtn[$method->getName()] = $method->invokeArgs($class->newInstance(), $args);
            }
        }

        foreach ($annotations as $annotation) {
            if (in_array($annotation->getName(), self::$afterMethodAttribute)) {
                $rtn[$annotation->getName()] = self::handlerAdapter($annotation, $class, $rtn);
            }
        }

        $rtn['__endTime'] = microtime(true);
        $rtn['__timeConsuming'] = $rtn['__endTime'] - $rtn['__createTime'];

        return $rtn;
    }

    /**
     * @param ReflectionAttribute $annotation
     * @param ReflectionClass $class
     * @param mixed|null $methodRtn
     * @return mixed
     * @throws ReflectionException
     */
    private static function handlerAdapter(ReflectionAttribute $annotation, ReflectionClass &$class, mixed $methodRtn = null): mixed
    {
        $annotationInstance = $annotation->newInstance();
        $_handlerMethod = 'run';
        $_handlerClass = __NAMESPACE__ . '\Annotations\Handler\\' . ucfirst($annotationInstance->getHandler());

        if (!method_exists($_handlerClass, $_handlerMethod)) {
            throw new ReflectionException('handler not exists');
        }

        return call_user_func([$_handlerClass, $_handlerMethod], $class, $annotationInstance, $methodRtn);
    }
}

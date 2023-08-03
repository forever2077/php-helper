<?php

namespace Forever2077\PhpHelper;

use Error;
use Exception;
use ReflectionClass;

class PhpHelper
{
    /**
     * 存储所有辅助类的单例
     * @var array
     */
    private static array $helpers = [];

    /**
     * 使用魔术方法 __callStatic 处理对未定义的静态方法的调用
     * @param string $name 未定义的静态方法的名称
     * @param mixed $arguments 调用静态方法时传递的参数
     * @return mixed 对应的辅助类的单例
     * @throws Exception 如果对应的辅助类不存在
     */
    public static function __callStatic(string $name, mixed $arguments): mixed
    {
        // 获取当前命名空间
        $namespace = (new ReflectionClass(__CLASS__))->getNamespaceName();

        // 构造完整类名
        $class = ucfirst($name) . 'Helper';
        $fullClassName = $namespace . '\\' . $class;

        // 如果该类的单例还未创建，则创建该类的单例
        if (!isset(self::$helpers[$class])) {
            try {
                // 尝试创建该类的单例
                self::$helpers[$class] = new $fullClassName($arguments);
            } catch (Error $e) {
                // 如果该类不存在，则抛出异常
                throw new Exception("Class $fullClassName does not exist");
            }
        }

        // 返回该类的单例
        return self::$helpers[$class];
    }
}

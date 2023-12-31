<?php

namespace Helpful;

use Error;
use Exception;
use ReflectionClass;

class PhpHelper
{
    /**
     * PHP辅助类版本号
     * @var string
     */
    public static string $version = '0.73.1';

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
    private static function ___callStatic(string $name, mixed $arguments): mixed
    {
        $namespace = (new ReflectionClass(__CLASS__))->getNamespaceName();
        $class = ucfirst($name) . 'Helper';
        $fullClassName = $namespace . '\\' . $class;

        if (!isset(self::$helpers[$class])) {
            try {
                self::$helpers[$class] = new $fullClassName($arguments);
            } catch (Error $e) {
                throw new Exception("Class $fullClassName does not exist");
            }
        }

        return self::$helpers[$class];
    }

    /**
     * 获取PhpHelper类的公共方法数量
     * .\vendor\bin\phpunit.bat --log-junit junit-log.xml .\tests\
     * @return string 返回PhpHelper类的公共方法数量
     * @throws Exception 如果对应的辅助类不存在
     */
    public static function countPubMethod(): string
    {
        $fullClassNames = Helper::file()::scanDirectory([
            'dir' => __DIR__,
            'ext' => ['php'],
            'depth' => 1,
            'filter' => function ($file) {
                if (str_contains($file, 'Helper') && !str_contains($file, 'PhpHelper')) {
                    return true;
                }
                return false;
            }, 'callback' => function ($file) {
                return pathinfo($file, PATHINFO_FILENAME);
            }
        ]);

        $content = '';
        $odd = 0;
        $methods = 0;
        $completed = 0;
        $uncompleted = 0;
        $namespace = (new ReflectionClass(__CLASS__))->getNamespaceName();
        $totalClass = count($fullClassNames);
        $publicMethodArr = [];

        $content .= PHP_EOL . "helper class method number summary：(" . date('Y-m-d H:i:s') . ")" . PHP_EOL;

        foreach ($fullClassNames as $name) {
            $fullClassName = "{$namespace}\\{$name}";
            try {
                $reflector = new ReflectionClass($fullClassName);
                $publicMethods = $reflector->getMethods(\ReflectionMethod::IS_PUBLIC);
                if (count($publicMethods) > 0) {
                    $methods += count($publicMethods);
                    $completed++;
                } else {
                    $uncompleted++;
                }
                $publicMethodArr[] = ($name . "：" . count($publicMethods));
            } catch (\ReflectionException $e) {
                throw new Exception("Class $fullClassName does not exist");
            }
        }

        $maxNameLength = max(array_map('strlen', $publicMethodArr));
        $maxNameLength += 5;

        foreach ($publicMethodArr as $item) {
            $content .= sprintf("%-{$maxNameLength}s", $item);
            if ($odd <= 1) {
                $odd++;
            } else {
                $content .= PHP_EOL;
                $odd = 0;
            }
        }

        $content .= PHP_EOL . "--------------------------------------------------------------"
            . PHP_EOL . "total helper：" . $totalClass . " \t " . "total method：" . $methods
            . PHP_EOL . "completed：" . $completed . '（' . (round($completed / $totalClass, 2) * 100) . '%）' . " \t "
            . "uncompleted：" . $uncompleted . '（' . (round($uncompleted / $totalClass, 2) * 100) . '%）'
            . PHP_EOL;

        return $content;
    }
}

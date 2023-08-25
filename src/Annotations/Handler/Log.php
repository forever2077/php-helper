<?php

namespace Forever2077\PhpHelper\Annotations\Handler;

use Forever2077\PhpHelper\Annotations\Interface\Handler;
use Forever2077\PhpHelper\Helper;
use Monolog\Handler\TestHandler;
use Monolog\Level;
use ReflectionClass;

class Log implements Handler
{
    /**
     * @param ReflectionClass $class
     * @param object $annotationInstance
     * @param mixed|null $targetMethodRtn
     * @return mixed
     */
    public static function run(ReflectionClass $class, object $annotationInstance, mixed $targetMethodRtn = null): mixed
    {
        /*dump($class);
        dump($annotationInstance);
        dump($targetMethodRtn);*/

        /*$log = Helper::log();
        $log->pushHandler(new TestHandler(Level::Warning));
        $log->addRecord(Level::Warning, $targetMethodRtn);*/

        return true;
    }
}
<?php

namespace Helpful;

use FormBuilder\Factory\Elm;

class FormHelper extends Elm
{
    /*private static string $implementation = 'Elm';  // 默认为 'Elm'

    public static function setImplementation($implementation): void
    {
        if ($implementation === 'Elm' || $implementation === 'Iview') {
            self::$implementation = $implementation;
        } else {
            throw new \InvalidArgumentException("Invalid implementation");
        }
    }

    public static function __callStatic($method, $args)
    {
        $class = '\\FormBuilder\\Factory\\' . self::$implementation;

        if (method_exists($class, $method)) {
            return forward_static_call_array([$class, $method], $args);
        }

        throw new \BadMethodCallException("Method $method does not exist on $class");
    }*/
}

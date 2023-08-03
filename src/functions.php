<?php

namespace Forever2077\PhpHelper;

/**
 * 支持多个参数
 * 格式化打印数据
 */
function dump(): void
{
    $args = func_get_args();
    foreach ($args as $val) {
        if ('cli' !== php_sapi_name()) {
            echo '<pre style="font-size: 14px;">';
        }
        print_r($val);
        if ('cli' !== php_sapi_name()) {
            echo '</pre>';
        } else {
            echo PHP_EOL;
        }
    }
}

/**
 * 支持多个参数
 * 格式化打印数据 下断点
 */
function dd(): void
{
    call_user_func_array(__NAMESPACE__ . '\\dump', func_get_args());
    exit;
}

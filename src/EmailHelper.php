<?php

namespace Forever2077\PhpHelper;

use PHPMailer\PHPMailer\PHPMailer;

class EmailHelper
{
    /**
     * 默认实例
     * @param mixed|null $config
     * @return PHPMailer
     */
    public static function instance(mixed $config = null): PHPMailer
    {
        return self::phpMailer($config);
    }

    /**
     * PHPMailer实例
     * @param mixed|null $config
     * @return PHPMailer
     */
    public static function phpMailer(mixed $config = null): PHPMailer
    {
        return new PHPMailer($config);
    }
}
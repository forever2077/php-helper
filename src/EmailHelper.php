<?php

namespace Helpful;

use PHPMailer\PHPMailer\PHPMailer;
use Egulias\EmailValidator\EmailValidator;

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

    /**
     * 根据RFC规则验证电子邮件
     * @link https://github.com/egulias/EmailValidator
     * @return EmailValidator
     */
    public static function validator(): EmailValidator
    {
        return new EmailValidator();
    }
}
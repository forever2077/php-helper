<?php

namespace Forever2077\PhpHelper;

class ValidateHelper
{
    /**
     * 是否手机号码
     * @param $phone
     * @return bool
     */
    public static function isPhone($phone): bool
    {
        return \Jsyqw\Utils\ValidateHelper::checkPhone($phone);
    }

    /**
     * 是否邮箱地址
     * @param $email
     * @return bool
     */
    public static function isEmail($email): bool
    {
        return \Jsyqw\Utils\ValidateHelper::checkEmail($email);
    }

    /**
     * 检查是否为HTTP地址
     * @param $str
     * @return bool
     */
    public static function isHttp($str): bool
    {
        return \Jsyqw\Utils\ValidateHelper::isHttp($str);
    }

    /**
     * 验证是否是JSON字符串
     * @param $str
     * @return bool
     */
    public static function isJson($str): bool
    {
        return \Jsyqw\Utils\ValidateHelper::isJson($str);
    }
}
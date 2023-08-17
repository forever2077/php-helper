<?php

namespace Forever2077\PhpHelper;

class ValidateHelper
{
    /**
     * @return ValidateHelper
     */
    public static function instance(): ValidateHelper
    {
        return new self();
    }

    /**
     * 是否手机号码
     * @param $phone
     * @return bool
     */
    public static function isPhone($phone): bool
    {
        return (bool)preg_match("/^1[3456789]\d{9}$/", $phone);
    }

    /**
     * 是否邮箱地址
     * @param $email
     * @return bool
     */
    public static function isEmail($email): bool
    {
        return (bool)preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $email);
    }

    /**
     * 检查是否为HTTP地址
     * @param $str
     * @return bool
     */
    public static function isHttp($str): bool
    {
        if (!$str) {
            return false;
        }
        $pattern = '/(http|https):\/\/([\w.]+\/?)\S*/';
        if (preg_match($pattern, $str)) {
            return true;
        }
        return false;
    }

    /**
     * 验证是否是JSON字符串
     * @param $str
     * @return bool
     */
    public static function isJson($str): bool
    {
        json_decode($str);
        return (json_last_error() == JSON_ERROR_NONE);
    }
}
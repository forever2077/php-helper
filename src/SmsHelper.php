<?php

namespace Helpful;

use Overtrue\EasySms\EasySms;
use Overtrue\EasySms\PhoneNumber;

class SmsHelper
{
    /**
     * @param array $config
     * @return EasySms
     */
    public static function instance(array $config): EasySms
    {
        return self::easySms($config);
    }

    /**
     * @param array $config
     * @return EasySms
     */
    public static function easySms(array $config): EasySms
    {
        return new EasySms($config);
    }

    /**
     * 格式化国际手机号码
     * @param int $numberWithoutIDDCode 手机号码
     * @param string|null $IDDCode 国际电话的国家码
     * @return PhoneNumber
     */
    public static function phoneNumber(int $numberWithoutIDDCode, string $IDDCode = null): PhoneNumber
    {
        return new PhoneNumber($numberWithoutIDDCode, $IDDCode);
    }
}
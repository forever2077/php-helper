<?php

namespace Forever2077\PhpHelper;

class StrHelper
{
    /**
     * 生成短的唯一码，可以根据编码的值推算出来年、月、日
     * @param int $startYear 短唯一码的起始年份，默认是2020年
     * eg：A604571124663362【16位+】
     * 【A:对应年 A-Z】+【6：月16进制】+【04:日期】+【57112：时间戳后五位】+【46633：毫秒5位】+【随机两位】
     * 1.如果年份年份大于24年，则对第一个字符倍增操作，比如我们程序运行到2047年的时候 则以 AA 开头，
     * 2.如果传入的起始年份大于当前年份，则返回的字符串前面增加“-”符号
     * @return string
     */
    public static function uniqueShortStr(int $startYear = 2020): string
    {
        return \Jsyqw\Utils\StrHelper::shortUniqueStr($startYear);
    }

    /**
     * 生成唯一数字（日期+随机数）
     * 格式：YYYY-MMDD-HHII-SS-NNNN,NNNN-CC，其中：YYYY=年份，MM=月份，DD=日期，HH=24格式小时，II=分，SS=秒，NNNNNNNN=随机数，CC=检查码
     * @return string eg: YYYYMMDDHHIISSNNNNNNNNCC 24位
     */
    public static function uniqueDateNum(): string
    {
        return \Jsyqw\Utils\StrHelper::uniqueNum();
    }

    /**
     * 生成唯一的 guid
     * @return string  eg: 08178533-5ca4-6194-5745-607197a47faa
     */
    public static function uniqueGuid(): string
    {
        return \Jsyqw\Utils\StrHelper::guid();
    }

    /**
     * 随机字长度的随机字符串
     * @param int $length 长度
     * @param string $type 类型(支持:number/letter/string/all)
     * @return string 随机字符串
     */
    public static function randStr(int $length = 6, string $type = 'string'): string
    {
        return \Jsyqw\Utils\StrHelper::random($length, $type);
    }
}
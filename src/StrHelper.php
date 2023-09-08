<?php

namespace Forever2077\PhpHelper;

use Exception;
use NumberToWords\NumberToWords;
use NumberToWords\TransformerOptions\CurrencyTransformerOptions;
use NumberToWords\Exception\{InvalidArgumentException, NumberToWordsException};

class StrHelper
{
    /**
     * 生成唯一数字（日期+随机数）
     * 格式：YYYY-MMDD-HHII-SS-NNNN,NNNN-CC，其中：YYYY=年份，MM=月份，DD=日期，HH=24格式小时，II=分，SS=秒，NNNNNNNN=随机数，CC=检查码
     * eg: YYYYMMDDHHIISSNNNNNNNNCC 24位
     * @return string
     */
    public static function uniqueDateNum(): string
    {
        $main = date('YmdHis') . rand(10000000, 99999999);
        $len = strlen($main);
        $sum = 0;
        for ($i = 0; $i < $len; $i++) {
            $sum += (int)(substr($main, $i, 1));
        }
        return $main . str_pad((100 - $sum % 100) % 100, 2, '0', STR_PAD_LEFT);
    }

    /**
     * 过滤指定的字符集合（默认过滤键盘中常见符号集合）
     * @param string $input 输入内容
     * @param bool $removeSpaces 去除内容中所有空白字符
     * @param string $charactersToRemove 过滤字符
     * @return string
     */
    public static function filterSpecialCharacters(string $input, bool $removeSpaces = false, string $charactersToRemove = ''): string
    {
        if (empty($charactersToRemove)) {
            $charactersToRemove = '~!@#$%^&*()_+`-={}|[]\\:";\'<>?,./＼＇';
        }
        // 将全角英文字母、数字、空格转换为半角
        $input = mb_convert_kana($input, 'rnas');
        $result = str_replace(str_split($charactersToRemove), '', $input);
        // 如果 removeSpaces 参数为 true，则去除空白字符
        if ($removeSpaces) {
            $result = str_replace(" ", "", $result);
        }
        return $result;
    }

    /**
     * 全角转半角符号
     * @param string $str 输入内容
     * @return string
     */
    public static function fullToHalf(string $str): string
    {
        return mb_convert_kana($str, 'rnaskhc');
    }

    /**
     * 半角转全角符号
     * @param string $str 输入内容
     * @return string
     */
    public static function halfToFull(string $str): string
    {
        return mb_convert_kana($str, 'RNASKHCV');
    }

    /**
     * 将数字转为汉字念法，支持人民币大写汉字
     * @link https://github.com/wilon/php-number2chinese
     * @param string $number 输入数字或字符串。 当数字过大或过小时，请输入string 支持负数
     * @param bool $isRmb 默认为false，当为true时返回人民币大写汉字 人民币最大单位[仟兆]，最小单位[毫]
     * @return string
     * @throws Exception
     */
    public static function number2chinese(string $number, bool $isRmb = false): string
    {
        return number2chinese($number, $isRmb);
    }

    /**
     * 将数字转换为其单词表示形式
     * @link https://github.com/kwn/number-to-words
     * @param int $number
     * @param string $language
     * @param string|null $currency
     * @param CurrencyTransformerOptions|null $options
     * @return string
     * @throws InvalidArgumentException
     * @throws NumberToWordsException
     */
    public static function number2words(int $number, string $language = 'en', string $currency = null, ?CurrencyTransformerOptions $options = null): string
    {
        $numberToWords = new NumberToWords();

        if (!is_null($currency)) {
            $currencyTransformer = $numberToWords->getCurrencyTransformer($language);
            return $currencyTransformer->toWords($number, $currency, $options);
        } else {
            $numberTransformer = $numberToWords->getNumberTransformer($language);
            return $numberTransformer->toWords($number);
        }
    }


}
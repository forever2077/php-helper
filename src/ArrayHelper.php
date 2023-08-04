<?php

namespace Forever2077\PhpHelper;

class ArrayHelper
{
    /**
     * 把对象或者数组对象，转成数组
     * @param $object
     * @param $properties
     * @param $recursive
     * @return array|object[]|string[]
     */
    public static function toArray($object, $properties = [], $recursive = true)
    {
        return \Jsyqw\Utils\ArrayHelper::toArray($object, $properties, $recursive);
    }

    /**
     * 获取对象或者数组的指定的值
     * @param $array
     * @param $key
     * @param $default
     * @return mixed
     */
    public static function getValue($array, $key, $default = null)
    {
        return \Jsyqw\Utils\ArrayHelper::getValue($array, $key, $default);
    }

    /**
     * 根据指定的key，建立key对应索引的数组，或者分组后的索引数组
     * @param $array
     * @param $key
     * @param $groups
     * @return array
     */
    public static function index($array, $key, $groups = [])
    {
        return \Jsyqw\Utils\ArrayHelper::index($array, $key, $groups);
    }

    /**
     * 把数组转成 key-value 的形式
     * @param $array
     * @param $from
     * @param $to
     * @param $group
     * @return array
     */
    public static function map($array, $from, $to, $group = null)
    {
        return \Jsyqw\Utils\ArrayHelper::map($array, $from, $to, $group);
    }

    /**
     * 检查数组是否是列索引
     * @param array $arr
     * @return void
     */
    public static function isAssoc(array $arr)
    {
        return \Jsyqw\Utils\ArrayHelper::isAssoc($arr);
    }
}

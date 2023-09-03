<?php

namespace Forever2077\PhpHelper;

use Aimeos\Map;

class ArrayHelper extends Map
{
    /**
     * @link https://github.com/aimeos/map
     */
    public function __construct($elements = [])
    {
        parent::__construct($elements);
    }

    /**
     * 获取对象或者数组的指定的值
     * @param $array
     * @param $key
     * @param $default
     * @return mixed
     */
    public static function getValue($array, $key, $default = null): mixed
    {
        if ($key instanceof \Closure) {
            return $key($array, $default);
        }

        if (is_array($key)) {
            $lastKey = array_pop($key);
            foreach ($key as $keyPart) {
                $array = static::getValue($array, $keyPart);
            }
            $key = $lastKey;
        }

        if (is_array($array) && (isset($array[$key]) || array_key_exists($key, $array))) {
            return $array[$key];
        }

        if (($pos = strrpos($key, '.')) !== false) {
            $array = static::getValue($array, substr($key, 0, $pos), $default);
            $key = substr($key, $pos + 1);
        }

        if (is_object($array)) {
            // this is expected to fail if the property does not exist, or __get() is not implemented
            // it is not reliably possible to check whether a property is accessable beforehand
            return $array->$key;
        } elseif (is_array($array)) {
            return (isset($array[$key]) || array_key_exists($key, $array)) ? $array[$key] : $default;
        } else {
            return $default;
        }
    }

    /**
     * 递归获取指定下标数组
     * @param array $arr 数组
     * @param string $pid 父级值
     * @param string $keyName 作为主键的名称
     * @return array
     *  [{
     *      "id": "1",
     *      "pid": "0",
     *      "name": "test1",
     *      "children": [{
     *          "id": "4",
     *          "pid": "1",
     *          "name": "test1-1",
     *          "children": []
     *      }]
     *  }]
     */
    public static function getTree(array $arr, string $pid, string $keyName = 'pid'): array
    {
        $tree = [];
        foreach ($arr as $row) {
            if ($row[$keyName] == $pid) {
                $row['children'] = [];
                $children = self::getTree($arr, $row['id']);
                if (!empty($children)) {
                    $row['children'] = $children;
                }
                $tree[] = $row;
            }
        }
        return $tree;
    }

    /**
     * 检查数组是否是列索引
     * @param array $arr
     * @return bool
     */
    public static function isAssoc(array $arr): bool
    {
        if (!$arr) {
            return false;
        }
        return array_keys($arr) !== range(0, count($arr) - 1);
    }
}

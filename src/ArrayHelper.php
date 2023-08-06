<?php

namespace Forever2077\PhpHelper;

class ArrayHelper
{
    /**
     * 把对象或者数组对象，转成数组
     * @param $object
     * @param array $properties
     * @param bool $recursive
     * @return array|object[]|string[]
     */
    public static function toArray($object, array $properties = [], bool $recursive = true): array
    {
        if (is_array($object)) {
            if ($recursive) {
                foreach ($object as $key => $value) {
                    if (is_array($value) || is_object($value)) {
                        $object[$key] = static::toArray($value, $properties, true);
                    }
                }
            }

            return $object;
        } elseif (is_object($object)) {
            if (!empty($properties)) {
                $className = get_class($object);
                if (!empty($properties[$className])) {
                    $result = [];
                    foreach ($properties[$className] as $key => $name) {
                        if (is_int($key)) {
                            $result[$name] = $object->$name;
                        } else {
                            $result[$key] = static::getValue($object, $name);
                        }
                    }

                    return $recursive ? static::toArray($result, $properties) : $result;
                }
            }
            $result = [];
            foreach ($object as $key => $value) {
                $result[$key] = $value;
            }

            return $recursive ? static::toArray($result, $properties) : $result;
        } else {
            return [$object];
        }
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
     * 根据指定的key，建立key对应索引的数组，或者分组后的索引数组
     * @param $array
     * @param $key
     * @param array $groups
     * @return array
     */
    public static function index($array, $key, array $groups = []): array
    {
        $result = [];
        $groups = (array)$groups;

        foreach ($array as $element) {
            $lastArray = &$result;

            foreach ($groups as $group) {
                $value = static::getValue($element, $group);
                if (!array_key_exists($value, $lastArray)) {
                    $lastArray[$value] = [];
                }
                $lastArray = &$lastArray[$value];
            }

            if ($key === null) {
                if (!empty($groups)) {
                    $lastArray[] = $element;
                }
            } else {
                $value = static::getValue($element, $key);
                if ($value !== null) {
                    if (is_float($value)) {
                        $value = (string)$value;
                    }
                    $lastArray[$value] = $element;
                }
            }
            unset($lastArray);
        }

        return $result;
    }

    /**
     * 把数组转成 key-value 的形式
     * @param $array
     * @param $from
     * @param $to
     * @param $group
     * @return array
     */
    public static function map($array, $from, $to, $group = null): array
    {
        $result = [];
        foreach ($array as $element) {
            $key = static::getValue($element, $from);
            $value = static::getValue($element, $to);
            if ($group !== null) {
                $result[static::getValue($element, $group)][$key] = $value;
            } else {
                $result[$key] = $value;
            }
        }

        return $result;
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
}

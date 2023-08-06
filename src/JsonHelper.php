<?php

namespace Forever2077\PhpHelper;

use JmesPath;
use Exception;
use InvalidArgumentException;

class JsonHelper
{
    /**
     * 执行 JMESPath 搜索
     *
     * 使用 JMESPath 表达式搜索指定的数据。支持 default, ast 和 compiler 模式。
     *
     * @link https://github.com/jmespath/jmespath.php
     *
     * @param string $expression JMESPath 表达式
     * @param array $data 要进行搜索的数据集
     * @param array $options 配置选项，包括：
     *                       'mode'  => 'default' | 'ast' | 'compiler'，
     *                       'path'  => 在 'mode' 为 'compiler' 时必填
     *
     * @return mixed 搜索结果
     * @throws Exception 当遇到错误时抛出
     */
    public static function search(string $expression, array $data, array $options = []): mixed
    {
        $defaults = [
            'mode' => 'default',
            'path' => null,
        ];
        $options = array_merge($defaults, $options);

        try {
            switch ($options['mode']) {
                case 'ast':
                    $runtime = new JmesPath\AstRuntime();
                    return $runtime($expression, $data);
                case 'compiler':
                    if (!$options['path']) {
                        throw new InvalidArgumentException('The "path" option is required when using the "compiler" mode.');
                    }
                    $runtime = new JmesPath\CompilerRuntime($options['path']);
                    return $runtime($expression, $data);
                default:
                    return JmesPath\Env::search($expression, $data);
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * JSON 语法检查
     * @link https://github.com/Seldaek/jsonlint
     * @return void
     */
    public static function lint()
    {

    }

    /**
     * JSON 映射器
     * @link https://github.com/cweiske/jsonmapper
     * @return void
     */
    public static function mapper()
    {

    }

    /**
     * JSON 流式解析器
     * @link https://github.com/halaxa/json-machine
     * @return void
     */
    public static function parseStream()
    {

    }

    /**
     * JSON 编码
     * @param mixed $value
     * @param int $flags
     * @param int $depth
     * @return bool|string
     */
    public static function encode(mixed $value, int $flags = JSON_UNESCAPED_UNICODE, int $depth = 512): bool|string
    {
        return json_encode($value, $flags, $depth);
    }

    /**
     * JSON 解码
     * @param string $json
     * @param bool|null $associative
     * @param int $depth
     * @param int $flags
     * @return mixed
     */
    public static function decode(string $json, ?bool $associative = true, int $depth = 512, int $flags = 0): mixed
    {
        return json_decode($json, $associative, $depth, $flags);
    }
}
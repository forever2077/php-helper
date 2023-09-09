<?php

namespace Helpful;

use JmesPath;
use Exception;
use InvalidArgumentException;
use Seld\JsonLint\JsonParser;
use Seld\JsonLint\ParsingException;
use JsonMapper;
use JsonMachine;

class JsonHelper
{
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

    /**
     * 执行 JMESPath 搜索
     *
     * 使用 JMESPath 表达式搜索指定的数据。支持 default, ast 和 compiler 模式。
     *
     * @link https://github.com/jmespath/jmespath.php
     *
     * @param string $expression JMESPath 表达式
     * @param array|string $data 要进行搜索的数据集
     * @param array $options 配置选项，包括：
     *                       'mode'  => 'default' | 'ast' | 'compiler'，
     *                       'path'  => 在 'mode' 为 'compiler' 时必填
     *
     * @return mixed 搜索结果
     * @throws Exception 当遇到错误时抛出
     */
    public static function search(string $expression, array|string $data, array $options = []): mixed
    {
        $defaults = [
            'mode' => 'default',
            'path' => null,
        ];
        $options = array_merge($defaults, $options);

        if (is_string($data)) {
            $data = self::decode($data);
        }

        if (empty($data)) {
            throw new InvalidArgumentException('The "data" argument cannot be empty.');
        }

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
            throw new Exception($e);
        }
    }

    /**
     * JSON 语法检查
     * @link https://github.com/Seldaek/jsonlint
     * @param array|string $value
     * @param int $flags DETECT_KEY_CONFLICTS、ALLOW_DUPLICATE_KEYS、PARSE_TO_ASSOC
     * @return mixed
     * @throws ParsingException
     */
    public static function lint(array|string $value, int $flags = JsonParser::DETECT_KEY_CONFLICTS): mixed
    {
        if (is_array($value)) {
            $value = json_encode($value, JSON_UNESCAPED_UNICODE);
        }

        if (is_string($value) && !JsonHelper::isJson($value)) {
            throw new ParsingException('Invalid JSON string.');
        }

        $parser = new JsonParser();
        try {
            return $parser->parse($value, $flags);
        } catch (ParsingException $e) {
            throw new ParsingException($e->getMessage());
        }
    }

    /**
     * JsonMapper 初始化
     * @param array $options
     * @return JsonMapper
     */
    protected static function JsonMapperInit(array $options = []): JsonMapper
    {
        $mapper = new JsonMapper();

        if (isset($options['bExceptionOnUndefinedProperty'])) {
            $mapper->bExceptionOnUndefinedProperty = $options['bExceptionOnUndefinedProperty'];
        }
        if (isset($options['bExceptionOnMissingData'])) {
            $mapper->bExceptionOnMissingData = $options['bExceptionOnMissingData'];
        }
        if (isset($options['bEnforceMapType'])) {
            $mapper->bEnforceMapType = $options['bEnforceMapType'];
        }
        if (isset($options['bStrictObjectTypeChecking'])) {
            $mapper->bStrictObjectTypeChecking = $options['bStrictObjectTypeChecking'];
        }
        if (isset($options['bStrictNullTypes'])) {
            $mapper->bStrictNullTypes = $options['bStrictNullTypes'];
        }
        if (isset($options['bIgnoreVisibility'])) {
            $mapper->bIgnoreVisibility = $options['bIgnoreVisibility'];
        }
        if (isset($options['bRemoveUndefinedAttributes'])) {
            $mapper->bRemoveUndefinedAttributes = $options['bRemoveUndefinedAttributes'];
        }
        if (isset($options['classMap'])) {
            $mapper->classMap = $options['classMap'];
        }
        if (isset($options['undefinedPropertyHandler'])) {
            $mapper->undefinedPropertyHandler = $options['undefinedPropertyHandler'];
        }
        if (isset($options['postMappingMethod'])) {
            $mapper->postMappingMethod = $options['postMappingMethod'];
        }
        if (isset($options['setLogger'])) {
            $mapper->setLogger($options['setLogger']);
        }

        return $mapper;
    }

    /**
     * JSON 映射器
     * @link https://github.com/cweiske/jsonmapper
     * @param array|string|object $json
     * @param object $object
     * @param array $options
     * @return mixed|object|string
     * @throws Exception
     */
    public static function mapper(array|string|object $json, object $object, array $options = []): mixed
    {
        if (is_array($json)) {
            $json = json_encode($json, JSON_UNESCAPED_UNICODE);
        }

        if (is_string($json) && JsonHelper::isJson($json)) {
            $json = json_decode($json);
        }

        $mapper = self::JsonMapperInit($options);

        try {
            return $mapper->map($json, $object);
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }

    /**
     * JSON 映射器
     * @link https://github.com/cweiske/jsonmapper
     * @param array|string $json
     * @param mixed $array
     * @param array $options
     * @param string|null $class
     * @param string $parent_key
     * @return mixed
     * @throws Exception
     */
    public static function mapArray(array|string $json, mixed $array, array $options = [], string $class = null, string $parent_key = ''): mixed
    {
        if (is_string($json) && JsonHelper::isJson($json)) {
            $json = json_decode($json);
        }

        $mapper = self::JsonMapperInit($options);

        try {
            return $mapper->mapArray($json, $array, $class, $parent_key);
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }

    /**
     * JSON 流式解析器（支持超大JSON解释）
     * @link https://github.com/halaxa/json-machine
     * @throws Exception
     */
    public static function parseStream(mixed $value): JsonMachine\Items
    {
        try {
            if (is_string($value)) {
                $items = JsonMachine\Items::fromFile($value);
            } elseif (is_resource($value)) {
                $items = JsonMachine\Items::fromStream($value);
            } elseif (is_iterable($value)) {
                $items = JsonMachine\Items::fromIterable($value);
            } else {
                throw new InvalidArgumentException('Invalid value type. Expecting a string, resource, or iterable.');
            }

            return $items;

        } catch (Exception $e) {
            throw new Exception($e);
        }
    }

    /**
     * 判断给定的值是否为有效的 JSON。
     * @param mixed $value 要检查的值。
     * @return bool 如果值是有效的 JSON，则返回 true；否则返回 false。
     */
    public static function isJson(mixed $value): bool
    {
        return Helper::validate()::json()->validate($value);
    }

    /**
     * JSON Schema for PHP
     * https://github.com/justinrainbow/json-schema
     * A PHP Implementation for validating JSON Structures against a given Schema with support for Schemas of Draft-3 or Draft-4.
     * Features of newer Drafts might not be supported. See Table of All Versions of Everything to get an overview of all existing Drafts.
     */
}
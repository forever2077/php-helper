<?php

namespace Helpful;

use Noodlehaus\Config;
use Noodlehaus\Parser\{Json, Yaml, Ini, Xml, Php, Serialize, Properties};

class ConfigHelper extends Config
{
    /**
     * @param array|string $values 配置文件或字符串
     * @param string $parser 配置解析器
     * @param false $string 启用从字符串加载
     * @return Config
     * @link https://github.com/hassankhan/config
     */
    public static function load($values, $parser = 'json', $string = false): Config
    {
        if (is_string($values)) {
            $ext = pathinfo($values, PATHINFO_EXTENSION);
            if (in_array($ext, ['yaml', 'ini', 'xml', 'php', 'properties', 'serialize'])) {
                $parser = $ext;
            }
        }
        $parser = strtolower($parser);
        $parser = match ($parser) {
            'yaml' => new Yaml(),
            'ini' => new Ini(),
            'xml' => new Xml(),
            'php' => new Php(),
            'serialize' => new Serialize(),
            'properties' => new Properties(),
            default => new Json(),
        };
        return new Config($values, $parser, $string);
    }
}

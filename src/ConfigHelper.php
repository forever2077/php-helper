<?php

namespace Forever2077\PhpHelper;

use Noodlehaus\Config;
use Noodlehaus\Parser\Json;
use Noodlehaus\Parser\Yaml;
use Noodlehaus\Parser\Ini;
use Noodlehaus\Parser\Xml;
use Noodlehaus\Parser\Php;
use Noodlehaus\Parser\Serialize;
use Noodlehaus\Parser\Properties;

class ConfigHelper
{
    /**
     * 配置实例
     * @param array|string $values
     * @param string $parser
     * @return Config
     */
    public static function instance(array|string $values, string $parser = 'Json'): Config
    {
        $string = false;
        if (is_string($values)) {
            $string = true;
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

<?php

namespace Forever2077\PhpHelper;

use Sabre\Xml;

class XmlHelper
{
    /**
     * 默认实例
     * @return Xml\Service
     */
    public static function instance(): Xml\Service
    {
        return self::sabre();
    }

    /**
     * Xml实例
     * @return Xml\Service
     */
    public static function sabre(): Xml\Service
    {
        return new Xml\Service();
    }
}
<?php

namespace Forever2077\PhpHelper;

use DiDom\Query;
use DiDom\Element;
use DiDom\Document;
use InvalidArgumentException;

class DomHelper extends Query
{
    public static string $encoding = 'UTF-8';

    public static function load($input, string $type = Document::TYPE_HTML): Document
    {
        $isFile = false;

        if (is_file($input) || filter_var($input, FILTER_VALIDATE_URL)) {
            $isFile = true;
        }

        if (!in_array($type, ['xml', 'html'])) {
            throw new InvalidArgumentException('Document type must be "xml" or "html".');
        }

        return new Document($input, $isFile, self::$encoding, $type);
    }

    public static function element($tagName, $value = null, array $attributes = []): Element
    {
        return new Element($tagName, $value, $attributes);
    }
}
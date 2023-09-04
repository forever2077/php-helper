<?php

namespace Forever2077\PhpHelper;

use League\CommonMark\Exception\CommonMarkException;
use League\HTMLToMarkdown\HtmlConverter;
use League\HTMLToMarkdown\Converter\TableConverter;
use League\CommonMark\MarkdownConverter;
use League\CommonMark\CommonMarkConverter;

class MarkdownHelper
{
    /**
     * @link https://github.com/thephpleague/html-to-markdown
     * @param array $options
     * @return HtmlConverter
     */
    public static function converter(array $options = []): HtmlConverter
    {
        $converter = new HtmlConverter($options);
        $converter->getEnvironment()->addConverter(new TableConverter()); // Table support
        return $converter;
    }

    public static function toMarkdown(string $html, array $options = []): string
    {
        return self::converter($options)->convert($html);
    }

    /**
     * @link https://github.com/thephpleague/commonmark
     * @param array $options
     * @param string|null $converter
     * @return MarkdownConverter
     */
    public static function parser(array $options = [], string $converter = null): MarkdownConverter
    {
        if (is_null($converter)) {
            return new CommonMarkConverter($options);
        } else {
            return new $converter($options);
        }
    }

    public static function toHtml(string $markdown, array $options = [], string $converter = null): string
    {
        try {
            return self::parser($options, $converter)->convert($markdown)->getContent();
        } catch (CommonMarkException $e) {
            return $e->getMessage();
        }
    }
}
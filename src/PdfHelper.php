<?php

namespace Forever2077\PhpHelper;

use Dompdf\Dompdf;
use FontLib\Font;
use FontLib\TrueType\File;
use FontLib\TrueType\Collection;
use FontLib\Exception\FontNotFoundException;
use Smalot\PdfParser\Config;
use Smalot\PdfParser\Parser;

class PdfHelper
{
    /**
     * Dompdf实例
     * @link https://github.com/dompdf/dompdf
     * @param $options
     * @return Dompdf
     */
    public static function instance($options = null): Dompdf
    {
        return new Dompdf($options);
    }

    /**
     * 字体加载分析转换
     * ps: ttc 字体需用 fontCreator 导出 ttf
     * @link https://github.com/dompdf/php-font-lib
     * @param string $font
     * @return File|Collection|null
     * @throws FontNotFoundException
     */
    public static function loadFont(string $font): null|File|Collection
    {
        try {
            $font = Font::load($font);
        } catch (FontNotFoundException $e) {
            throw new FontNotFoundException($e->getMessage());
        }
        $font->parse();
        return $font;
    }

    /**
     * PDF内容解析
     * @link https://github.com/smalot/pdfparser
     * @param array $cfg
     * @param Config|null $config
     * @return Parser
     */
    public static function parser(array $cfg = [], Config $config = null): Parser
    {
        return new Parser($cfg, $config);
    }
}
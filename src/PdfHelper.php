<?php

namespace Helpful;

use Exception;
use Dompdf\Dompdf;
use FontLib\Font;
use FontLib\Exception\FontNotFoundException;
use Smalot\PdfParser\Config;
use Smalot\PdfParser\Parser;
use FontLib\TrueType\File;
use FontLib\TrueType\Collection;

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

    /**
     * 解析字体文件信息
     * @param string $fontPath
     * @return File|null
     * @throws Exception
     */
    public static function parserFont(string $fontPath)
    {
        try {
            return Font::load($fontPath);
        } catch (FontNotFoundException $e) {
            throw new Exception($e);
        }
    }

    /**
     * 字体加载分析转换
     * ps: ttc 字体需用 fontCreator 拆分导出 ttf
     * @link https://github.com/dompdf/php-font-lib
     * @param string|array $fonts
     * @param string $fontPath
     * @return array
     * @throws FontNotFoundException
     * @throws Exception
     */
    public static function loadFont(string|array $fonts, string $fontPath): array
    {
        foreach ($fonts as $font) {
            $ext = pathinfo($font, PATHINFO_EXTENSION);
            if (!in_array(strtolower($ext), ['ttc', 'ttf', 'otf', 'woff', 'woff2'])) {
                throw new FontNotFoundException("Only support ttf, otf, woff, woff2，but got {$ext}");
            }
            if (!file_exists($fontPath . DIRECTORY_SEPARATOR . $font)) {
                throw new Exception("Font {$font} not exists");
            }
        }

        $result = [];
        $installedFonts = [];
        $installedFontsFileName = 'installed-fonts.json';

        foreach ($fonts as $font) {

            // 加载并分析字体
            $fontObj = Font::load($fontPath . DIRECTORY_SEPARATOR . $font);
            $fontObj->parse();

            // 字体加载失败
            if (!($fontObj instanceof File)) {
                if ($fontObj instanceof Collection) {
                    $result[$font] = [
                        'installed' => false,
                        'error' => 'Please extract the font file',
                    ];
                } else {
                    $result[$font] = [
                        'installed' => false,
                        'error' => 'Font is not a file',
                    ];
                }
                continue;
            }

            // 文件保存路径
            $fileName = pathinfo($font, PATHINFO_FILENAME);
            $fontUfmPath = realpath($fontPath) . DIRECTORY_SEPARATOR . $fileName;
            $ufmFilepath = $fontUfmPath . ".ufm";
            $fontPostscriptName = strtolower(StrHelper::fullToHalf($fontObj->getFontPostscriptName()));

            // 安装字体Json
            $installedFonts[$fontPostscriptName] = [
                // 所有类型字体默认单独一组且下标为normal
                'normal' => $fontUfmPath,
            ];

            // 安装信息
            $result[$font] = [
                'installed' => true,
                'postscript' => $fontPostscriptName,
                'fullname' => $fontObj->getFontFullName(),
                'subfamily' => $fontObj->getFontSubfamily(),
                'weight' => $fontObj->getFontWeight(),
                'file' => $ufmFilepath,
            ];

            // 保存字体指标
            if (!file_exists($ufmFilepath)) {
                $fontObj->saveAdobeFontMetrics($ufmFilepath);
            }
            $fontObj->close();
        }

        // 保存安装字体Json
        if (!empty($installedFonts)) {
            file_put_contents(
                $fontPath . DIRECTORY_SEPARATOR . $installedFontsFileName,
                json_encode($installedFonts, JSON_UNESCAPED_UNICODE)
            );
        } else {
            throw new Exception("No fonts installed");
        }

        return $result;
    }
}
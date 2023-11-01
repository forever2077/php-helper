<?php

namespace Helpful;

use Exception;
use Zxing\Result;
use Zxing\QrReader;
use Milon\Barcode\DNS1D;
use Milon\Barcode\DNS2D;
use InvalidArgumentException;

class BarcodeHelper
{
    /* 2D Barcodes */
    const QRCODE = 'QRCODE';
    const PDF417 = 'PDF417';
    const DATAMATRIX = 'DATAMATRIX';

    /* 1D Barcodes */
    const C39 = 'C39';
    const C39_PLUS = 'C39+';
    const C39E = 'C39E';
    const C39E_PLUS = 'C39E+';
    const C93 = 'C93';
    const S25 = 'S25';
    const S25_PLUS = 'S25+';
    const I25 = 'I25';
    const I25_PLUS = 'I25+';
    const C128 = 'C128';
    const C128A = 'C128A';
    const C128B = 'C128B';
    const C128C = 'C128C';
    const GS1_128 = 'GS1-128';
    const EAN2 = 'EAN2';
    const EAN5 = 'EAN5';
    const EAN8 = 'EAN8';
    const EAN13 = 'EAN13';
    const UPCA = 'UPCA';
    const UPCE = 'UPCE';
    const MSI = 'MSI';
    const MSI_PLUS = 'MSI+';
    const POSTNET = 'POSTNET';
    const PLANET = 'PLANET';
    const RMS4CC = 'RMS4CC';
    const KIX = 'KIX';
    const IMB = 'IMB';
    const CODABAR = 'CODABAR';
    const CODE11 = 'CODE11';
    const PHARMA = 'PHARMA';
    const PHARMA2T = 'PHARMA2T';

    const OUTPUT_TYPE_PNG = 1001;
    const OUTPUT_TYPE_SVG = 1002;
    const OUTPUT_TYPE_HTML = 1003;

    /* 仅作兼容处理 */
    private static string $storePath = '';

    /* 编码输出类型 */
    public static int $outputDataType = BarcodeHelper::OUTPUT_TYPE_PNG;

    /**
     * 内容编码
     * @link https://github.com/milon/barcode
     * @param string $content
     * @param string $type
     * @param int $w
     * @param int $h
     * @param array|string $color RGB颜色格式
     * @param bool $showCode 显示内容，仅支持 1D Barcode
     * @param bool $inline SVG版本声明，默认开启
     * @return bool|string
     */
    public static function encode(
        string       $content,
        string       $type = BarcodeHelper::QRCODE,
        int          $w = 0,
        int          $h = 0,
        array|string $color = [0, 0, 0],
        bool         $showCode = false,
        bool         $inline = false
    ): bool|string
    {
        if (in_array($type, ['QRCODE', 'PDF417', 'DATAMATRIX'])) {
            $encode = new DNS2D();
            if ($w === 0 && $h === 0) {
                $w = 3;
                $h = 3;
            }
        } else {
            $encode = new DNS1D();
            if ($w === 0 && $h === 0) {
                $w = 2;
                $h = 30;
            }
        }

        self::setStorePath($encode);

        if (in_array(self::$outputDataType, [BarcodeHelper::OUTPUT_TYPE_SVG, BarcodeHelper::OUTPUT_TYPE_HTML]) && is_array($color)) {
            $color = ColorHelper::array2value($color, 'rgb');
        }

        return match (self::$outputDataType) {
            BarcodeHelper::OUTPUT_TYPE_PNG => $encode->getBarcodePNG($content, $type, $w, $h, $color, $showCode),
            BarcodeHelper::OUTPUT_TYPE_SVG => $encode->getBarcodeSVG($content, $type, $w, $h, $color, $showCode, $inline),
            BarcodeHelper::OUTPUT_TYPE_HTML => $encode->getBarcodeHTML($content, $type, $w, $h, $color, $showCode),
            default => throw new InvalidArgumentException('Invalid output type: ' . self::$outputDataType),
        };
    }

    /**
     * 设置条码输出类型
     * @param string $type (png、svg、html)
     * @return void
     */
    public static function setOutputDataType(string $type): void
    {
        $type = strtolower($type);
        self::$outputDataType = match ($type) {
            'png' => BarcodeHelper::OUTPUT_TYPE_PNG,
            'svg' => BarcodeHelper::OUTPUT_TYPE_SVG,
            'html' => BarcodeHelper::OUTPUT_TYPE_HTML,
            default => throw new InvalidArgumentException('Invalid output type: ' . $type),
        };
    }

    /**
     * 二维码内容解码
     * @link https://github.com/khanamiryan/php-qrcode-detector-decoder
     * @param mixed $imgSource
     * @param string $sourceType
     * @param bool $useImagickIfAvailable
     * @return bool|Result|null
     * @throws Exception
     */
    public static function decode(mixed $imgSource, string $sourceType = QrReader::SOURCE_TYPE_FILE, bool $useImagickIfAvailable = true): bool|null|Result
    {
        $QrReader = new QrReader($imgSource, $sourceType, $useImagickIfAvailable);
        $QrReader->decode();
        $err = $QrReader->getError();
        $rtn = $QrReader->getResult();
        if ($err) {
            throw new Exception($err);
        }
        return $rtn;
    }

    /**
     * 仅作兼容处理
     * @param DNS1D|DNS2D $encode
     * @return void
     */
    private static function setStorePath(DNS1D|DNS2D $encode): void
    {
        if (empty(self::$storePath)) {
            self::$storePath = sys_get_temp_dir();
        }

        if (!file_exists(self::$storePath)) {
            throw new InvalidArgumentException('Invalid storage path: ' . self::$storePath);
        }

        $encode->setStorPath(self::$storePath);
    }
}
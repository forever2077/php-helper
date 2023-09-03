<?php

use PHPUnit\Framework\TestCase;
use Forever2077\PhpHelper\Helper;
use Forever2077\PhpHelper\PdfHelper;
use Dompdf\Options;

class PdfHelperTest extends TestCase
{
    public function testInstance()
    {
        $this->assertEquals('Dompdf\Dompdf', Helper::pdf()::class);
    }

    private function testFontMetricsGeneration()
    {
        ini_set("memory_limit", "256M");
        $filepath = dirname(__DIR__) . '/data/temp/fonts/msyh.ufm';
        $font = PdfHelper::loadFont(dirname(__DIR__) . '/data/temp/fonts/msyh.ttf');
        $font->parse();
        $font->saveAdobeFontMetrics($filepath);
        $this->assertFileExists($filepath);
        $font->close();
        $filepath = dirname(__DIR__) . '/data/temp/fonts/msyhbd.ufm';
        $font = PdfHelper::loadFont(dirname(__DIR__) . '/data/temp/fonts/msyhbd.ttf');
        $font->parse();
        $font->saveAdobeFontMetrics($filepath);
        $this->assertFileExists($filepath);
        $font->close();
    }

    private function testBaseFontInformation()
    {
        // Read TrueType, OpenType (with TrueType glyphs), WOFF font files
        $font = PdfHelper::loadFont(dirname(__DIR__) . '/data/temp/fonts/msyh.ttf');
        /*dump($font->getFontName());
        dump($font->getFontSubfamily());
        dump($font->getFontSubfamilyID());
        dump($font->getFontFullName());
        dump($font->getFontVersion());
        dump($font->getFontWeight());
        dump($font->getFontPostscriptName());*/
        $this->assertIsObject($font);
        $font->close();
    }

    private function testCreateFontSubset()
    {
        $filepath = dirname(__DIR__) . '/data/temp/fonts/fontfile.subset.ttf';
        $font = PdfHelper::loadFont(dirname(__DIR__) . '/data/temp/fonts/msyh.ttf');
        $font->parse();
        $font->setSubset("abcdefghijklmnopqrstuvwxyz ABCDEFGHIJKLMNOPQRSTUVWXYZ.:,;' (!?)+-*/== 1234567890");
        $font->reduce();
        touch($filepath);
        $font->open($filepath, FontLib\BinaryStream::modeReadWrite);
        $font->encode(array("OS/2"));
        $font->close();
        $this->assertFileExists($filepath);
    }

    public function testCreatePdf()
    {
        $options = new Options();
        $options->setDebugPng(false);
        $options->setIsPhpEnabled(true);
        $options->setIsRemoteEnabled(true);
        $options->setChroot([
            dirname(__DIR__) . '/data/temp',
            dirname(__DIR__) . '/data/captcha',
        ]);
        $options->setTempDir(dirname(__DIR__) . '/data/temp');
        $options->setFontDir(dirname(__DIR__) . '/data/temp/fonts');
        $options->setFontCache(dirname(__DIR__) . '/data/temp/fonts');

        //dump($options->getAllowedProtocols());

        $html = <<<html
<img width="100%" src="https://seasonppt.oss-cn-hangzhou.aliyuncs.com/20230831/logo.png" alt=""/>
<p style="font-family:msyh,serif;font-size:20px;padding:15px;background-color:#00a74d;color:#ffffff;">
    hello world
</p>
<p style="font-family:msyh,serif;font-size:20px;padding:15px;background-color:#eb0808;color:#fee900;">
    你好中国 2023！
</p>
<p style="font-family:msyh,serif;font-size:20px;font-weight:bold;padding:15px;background-color:#00a74d;color:#ffffff;">
    hello world（bold）
</p>
<p style="font-family:msyh,serif;font-size:20px;font-weight:bold;padding:15px;background-color:#eb0808;color:#fee900;">
    你好中国 2023！（字体加粗）
    <br/>
    你好中国 2023！（字体加粗）
</p>
<img width="100px" src="file://D:/expotec/php-helper/data/temp/barcode.png" alt=""/>
<img width="100px" src="file://D:/expotec/php-helper/data/captcha/bgs/1.jpg" alt=""/>
html;
        $dompdf = Helper::pdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4');
        $dompdf->render();
        $str = $dompdf->output();
        helper::file()::createFile(dirname(__DIR__) . '/data/temp/test.pdf', $str);
        $this->assertIsString($str);
        //unlink(dirname(__DIR__) . '/data/temp/test.pdf');
    }

    public function testParser()
    {
        $dompdf = Helper::pdf();
        $dompdf->loadHtml('halo world');
        $dompdf->setPaper('A4');
        $dompdf->render();
        $str = $dompdf->output();
        helper::file()::createFile(dirname(__DIR__) . '/data/temp/testParser.pdf', $str);

        $parser = PdfHelper::parser();
        $pdf = $parser->parseFile(dirname(__DIR__) . '/data/temp/testParser.pdf');
        $this->assertEquals('halo world', $pdf->getText());
        unlink(dirname(__DIR__) . '/data/temp/testParser.pdf');
    }
}
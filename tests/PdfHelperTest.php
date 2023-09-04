<?php

ini_set("memory_limit", "256M");

use PHPUnit\Framework\TestCase;
use Forever2077\PhpHelper\Helper;
use Forever2077\PhpHelper\PdfHelper;
use Forever2077\PhpHelper\StrHelper;
use Dompdf\Options;

class PdfHelperTest extends TestCase
{
    public function testInstance()
    {
        $this->assertEquals('Dompdf\Dompdf', Helper::pdf()::class);
    }

    private function testLoadFonts()
    {
        $fonts = [
            'msyh.ttc', 'msyh.ttf', 'msyhbd.ttf', 'stxinwei.ttf',
            'LXGWWenKai-Regular.ttf', 'LXGWWenKai-Bold.ttf',
        ];
        $fontPath = dirname(__DIR__) . '/data/temp/fonts';
        $rtn = PdfHelper::loadFont($fonts, $fontPath);
        dump($rtn);
        $this->assertIsBool(true);
    }

    private function testCreateFontSubset()
    {
        $filepath = dirname(__DIR__) . '/data/temp/fonts/fontfile.subset.ttf';
        $font = PdfHelper::parserFont(dirname(__DIR__) . '/data/temp/fonts/msyh.ttf');
        $font->parse();
        $font->setSubset("abcdefghijklmnopqrstuvwxyz ABCDEFGHIJKLMNOPQRSTUVWXYZ.:,;' (!?)+-*/== 1234567890");
        $font->reduce();
        touch($filepath);
        $font->open($filepath, FontLib\BinaryStream::modeReadWrite);
        $font->encode(array("OS/2"));
        $font->close();
        $this->assertFileExists($filepath);
    }

    private function testCreatePdf()
    {
        // 自定义字体安装路径
        $fontPath = dirname(__DIR__) . '/data/temp/fonts';
        // 安装字体（仅需执行一次，程序内部会判断是否已安装）
        $fonts = [
            'msyh.ttc', // 需解压成 ttf 后才能安装成功
            'msyh.ttf', 'msyhbd.ttf', 'stxinwei.ttf', // 商业字体
            'LXGWWenKai-Regular.ttf', 'LXGWWenKai-Bold.ttf', // 开源字体
        ];
        $rtn = PdfHelper::loadFont($fonts, $fontPath);
        // 执行结果中下标：postscript 为html中的font调用名称
        //dump($rtn);
        // 设置DOMPDF配置
        $options = new Options();
        // 开启PHP解析，仅在 <script type="text/php"></script> 中生效
        $options->setIsPhpEnabled(false);
        // 开启远程下载文件
        $options->setIsRemoteEnabled(true);
        // 本地资源加载白名单目录
        $options->setChroot([
            dirname(__DIR__) . '/data/temp',
        ]);
        // 自定义字体目录
        $options->setFontDir($fontPath);
        // 自定义字体缓存
        $options->setFontCache($fontPath);
        // 默认不支持中文，需通过自定义字体加载，由 installed-fonts.json 生成
        $html = <<<html
<style>*{font-size:20px;font-family:microsoftyaheiuiregular,sans-serif;}img,p{margin:15px 0;}p{font-size:14px;line-height:18px;}</style>
<img width="100%" src="http://pic.qqbizhi.com/allimg/2022/97/9mdyiit07zkg99fbepum1goi2560x1440.jpg" alt=""/>
<p style="padding:15px;background-color:#00a74d;color:#ffffff;">
    <span>hello world</span>
    &nbsp;&nbsp;&nbsp;&nbsp;
    <span style="font-family:sans-serif;font-weight:bold;">hello world</span>
    &nbsp;&nbsp;&nbsp;&nbsp;
    <span style="font-family:microsoftyaheiui-bold,sans-serif;">你好中国 2023</span>
</p>
<p style="font-family:microsoftyaheiui-bold,sans-serif;">
在广袤的编程世界中，全栈程序员如今变得越来越重要。他们不仅精通常见的WEB开发技术，如PHP、MySQL、
HTML、JavaScript和CSS，还能够应对不同操作系统环境，如Windows和Linux。全栈程序员的技能组合独特
多样，他们可以在前端和后端之间无缝切换，从而实现整个应用程序的开发。
</p>
<p style="font-family:stxinwei,sans-serif;">
在解决问题时，全栈程序员有许多选择。如果当前情况下，PHP不适合解决问题，他们可以利用自己对Go、Java、
Python等编程语言的了解，选择合适的次要语言来实现解决方案。这种灵活性使得全栈程序员成为团队中不可或
缺的一员，他们可以根据项目的需求迅速调整并采取行动。
</p>
<p style="font-family:lxgwwenkai-regular,sans-serif;">
在解决问题时，全栈程序员有许多选择。如果当前情况下，PHP不适合解决问题，他们可以利用自己对Go、Java、
Python等编程语言的了解，选择合适的次要语言来实现解决方案。这种灵活性使得全栈程序员成为团队中不可或
缺的一员，他们可以根据项目的需求迅速调整并采取行动。
</p>
<p style="font-family:lxgwwenkai-bold,sans-serif;">
综合来看，全栈程序员在今天的技术领域中扮演着重要角色。他们不仅仅是技术专家，还需要具备良好的学习能
力和适应能力，以跟上不断变化的技术潮流。无论是构建精美的前端界面还是处理复杂的后端逻辑，全栈程序员
都能够胜任，为软件开发的不同阶段提供宝贵的支持。
</p>
<p style="padding-top:10px;">
    <img width="100px" src="file://D:/expotec/php-helper/data/temp/barcode.png" alt=""/>
</p>
<script type="text/php">
    echo date('Y-m-d H:i:s');
</script>
html;
        // 创建DOMPDF实例
        $dompdf = Helper::pdf($options);
        $dompdf->loadHtml($html);
        // 设置纸张
        $dompdf->setPaper('A4');
        // 渲染内容
        $dompdf->render();
        // 输出PDF并开启压缩
        $str = $dompdf->output(['compress' => 1]);
        // 保存PDF
        helper::file()::createFile(dirname(__DIR__) . '/data/temp/test.pdf', $str);
        $this->assertIsString($str);
    }

    private function testParser()
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
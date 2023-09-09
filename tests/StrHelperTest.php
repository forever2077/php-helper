<?php

use PHPUnit\Framework\TestCase;
use Helpful\Helper;
use Helpful\StrHelper;

class StrHelperTest extends TestCase
{
    public function testInstance()
    {
        $this->assertEquals(StrHelper::Class, Helper::str()::class);
    }

    public function testUniqueDateNum()
    {
        $this->assertEquals(24, strlen(StrHelper::uniqueDateNum()));
    }

    public function testFilterSpecialCharacters()
    {
        $input = 'Ｈello~！@＃$％^&＊(）_+｀-＝｛｝｜[］＼:\";＇<＞?,./ Ｗorld！';
        $output = StrHelper::filterSpecialCharacters($input, true);
        $this->assertEquals("HelloWorld", $output);
    }

    public function testFullToHalf()
    {
        $this->assertEquals('!＂#$%&＇()*+,-./:;<=>?@[＼]^_`{|}～', StrHelper::fullToHalf("！＂＃＄％＆＇（）＊＋，－．／：；＜＝＞？＠［＼］＾＿｀｛｜｝～"));
    }

    public function testHalfToFull()
    {
        $this->assertEquals('！＂＃＄％＆＇（）＊＋，－．／：；＜＝＞？＠［＼］＾＿｀｛｜｝～', StrHelper::halfToFull("!＂#$%&＇()*+,-./:;<=>?@[＼]^_`{|}～"));
    }

    public function testNumber2chinese()
    {
        $num1 = 0.1234567890; // 末尾零去掉，若是字符串则补上
        $this->assertEquals('零点一二三四五六七八九', StrHelper::number2chinese($num1));
        $this->assertEquals('零元壹角贰分叁厘肆毫', StrHelper::number2chinese($num1, true));
        $num2 = '20000000000000000';
        $this->assertEquals('两兆', StrHelper::number2chinese($num2));
        $this->assertEquals('贰兆元整', StrHelper::number2chinese($num2, true));
        $num3 = '-1202030';
        $this->assertEquals('负一百二十万零两千零三十', StrHelper::number2chinese($num3));
        $this->assertEquals('负壹佰贰拾万零贰仟零叁拾元整', StrHelper::number2chinese($num3, true));
        $num4 = '1234567890.0123456789';
        $this->assertEquals('十二亿三千四百五十六万七千八百九十点零一二三四五六七八九', StrHelper::number2chinese($num4));
        $this->assertEquals('壹拾贰亿叁仟肆佰伍拾陆万柒仟捌佰玖拾元零壹分贰厘叁毫', StrHelper::number2chinese($num4, true));
    }

    public function testNumber2words()
    {
        $this->assertEquals('five thousand one hundred twenty', StrHelper::number2words(5120));
        $this->assertEquals('five thousand one hundred twenty', StrHelper::number2words(5120, 'en'));
        $this->assertEquals('fifty-one dollars twenty cents', StrHelper::number2words(5120, 'en', 'USD'));
    }

    public function testStatic()
    {
        $this->assertEquals('FÒÔBÀŘ', StrHelper::utf8()::strtoupper('fòôbàř'));
        $this->assertEquals('Duesseldorf', StrHelper::ascii()::to_ascii('�Düsseldorf�', 'de'));
        $this->assertEquals('FÒÔ BÀŘ', StrHelper::string('fòô bàř')->collapseWhitespace()->swapCase()->toString());
        $this->assertEquals('FÒÔ BÀŘ', StrHelper::string('fòô bàř')->toUpperCase()->toString());
    }
}
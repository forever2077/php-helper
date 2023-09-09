<?php

use PHPUnit\Framework\TestCase;
use Helpful\Helper;
use Helpful\XmlHelper;
use Sabre\Xml\ParseException;

class XmlHelperTest extends TestCase
{
    public function testInstance()
    {
        $this->assertEquals(Sabre\Xml\Service::class, Helper::xml()::class);
    }

    public function testWriter()
    {
        $xmlService = XmlHelper::instance();
        $xmlService->namespaceMap = ['http://example.org' => 'b'];
        $xmlStr = $xmlService->write('{http://example.org}book', [
            '{http://example.org}title' => 'Cryptonomicon',
            '{http://example.org}author' => 'Neil Stephenson',
        ]);
        $this->assertIsString($xmlStr);
    }

    public function testReader()
    {
        $input = <<<XML
<article xmlns="http://example.org/">
    <title>Hello world</title>
    <content>Fuzzy Pickles</content>
</article>
XML;

        $xmlService = XmlHelper::instance();
        $xmlService->elementMap = [
            '{http://example.org/}article' => 'Sabre\Xml\Element\KeyValue',
        ];
        try {
            $output = $xmlService->parse($input);
            $this->assertIsArray($output);
        } catch (ParseException $e) {
            $this->fail($e->getMessage());
        }
    }
}
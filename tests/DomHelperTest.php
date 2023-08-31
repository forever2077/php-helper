<?php

use PHPUnit\Framework\TestCase;
use DiDom\Document;
use Forever2077\PhpHelper\Helper;
use Forever2077\PhpHelper\DomHelper;

class DomHelperTest extends TestCase
{
    public function testInstance()
    {
        $this->assertEquals(DomHelper::class, Helper::dom()::class);
    }

    private function htmlDemo()
    {
        return <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Test HTML</title>
</head>
<body>
<h1>Hello, World!</h1>
<p>This is a paragraph.</p>
<ul>
    <li>Item 1</li>
    <li>Item 2</li>
    <li>Item 3</li>
</ul>
<div id="container">
    <span class="label">Label 1</span>
    <span class="label">Label 2</span>
</div>
</body>
</html>
HTML;
    }

    private function xmlDemo()
    {
        return <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<catalog>
    <book id="bk101">
        <author>Gambardella, Matthew</author>
        <title>XML Developer's Guide</title>
        <genre>Computer</genre>
        <price>44.95</price>
        <publish_date>2000-10-01</publish_date>
        <description>An in-depth look at creating applications with XML.</description>
    </book>
    <book id="bk102">
        <author>Ralls, Kim</author>
        <title>Midnight Rain</title>
        <genre>Fantasy</genre>
        <price>5.95</price>
        <publish_date>2000-12-16</publish_date>
        <description>A former architect battles corporate zombies.</description>
    </book>
</catalog>
XML;
    }

    public function testLoad()
    {
        /*$document = DomHelper::load('https://www.whois.com/whois/baidu.com');
        $content = $document->find('#registrarData');
        dump($content[0]->text());
        $this->assertIsString($content[0]->text());*/

        /*$document = DomHelper::load('https://who.is/whois/baidu.com');
        $content = $document->find('.queryResponseBodyValue > pre');
        dump($content[0]->text());
        $this->assertIsString($content[0]->text());*/

        $document = DomHelper::load($this->htmlDemo());
        $query = $document->find('#container > .label');
        $this->assertEquals('Label 1', $query[0]->firstChild()->text());

        $document = DomHelper::load(dirname(__DIR__) . '/data/http/test.html');
        $query = $document->find('#container > .label');
        $this->assertEquals('Label 1', $query[0]->firstChild()->text());

        $document = DomHelper::load($this->xmlDemo(), Document::TYPE_XML);
        $query = $document->find('#bk102 > author');
        $this->assertEquals('Ralls, Kim', $query[0]->text());

        $document = DomHelper::load(dirname(__DIR__) . '/data/http/test.xml', Document::TYPE_XML);
        $query = $document->find('#bk102 > author');
        $this->assertEquals('Ralls, Kim', $query[0]->text());
    }

    public function testElement()
    {
        $element = DomHelper::element('span', 'Hello');
        $this->assertEquals('<span>Hello</span>', $element->html());

        $attributes = ['name' => 'description', 'placeholder' => 'Enter description of item'];
        $element = DomHelper::element('textarea', 'Text', $attributes);
        $this->assertEquals('<textarea name="description" placeholder="Enter description of item">Text</textarea>', $element->html());

        $domElement = new \DOMElement('span', 'Hello');
        $element = DomHelper::element($domElement);
        $this->assertEquals('<span>Hello</span>', $element->html());
    }

    public function testQuery()
    {
        $xpath = DomHelper::compile('h2');
        $compiled = DomHelper::getCompiled();
        $this->assertEquals($xpath, $compiled['h2']);
    }
}
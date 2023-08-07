<?php

use League\Csv\Reader;
use League\Csv\Writer;
use PHPUnit\Framework\TestCase;
use Forever2077\PhpHelper\CsvHelper;

class CsvHelperTest extends TestCase
{
    public function testInstance()
    {
        try {
            $instance = CsvHelper::instance();
            $writerClass = $instance::writer();
            $filePath = __DIR__ . '/output.csv';
            $fileObject = new SplFileObject($filePath, 'w');
            $csv = $writerClass::createFromFileObject($fileObject);
            $csv->setNewline("\r\n");
            $csv->insertOne(["foo", "bar"]);
        } catch (Exception|RuntimeException $e) {
            echo $e->getMessage(), PHP_EOL;
        }

        $this->assertEquals(Writer::class, CsvHelper::writer());
    }

    public function testWriteFromArray()
    {
        $data = [
            ['foo', 'bar'],
            ['baz', 'qux'],
        ];
        $headers = ['header1', 'header2'];
        $filePath = __DIR__ . '/output.csv';
        try {
            CsvHelper::writeFromArray($data, $filePath, $headers);
            $csv = Reader::createFromPath($filePath);
            $csv->setHeaderOffset(0);
            $this->assertIsArray($csv->getHeader());
            $this->assertIsObject($csv->getRecords());
        } catch (Exception $e) {
            dump($e->getMessage());
        } finally {
            unlink($filePath);
        }
    }

    public function testReadToArray()
    {
        $filePath = __DIR__ . '/test.csv';
        $data = [
            ['foo', 'bar'],
            ['baz', 'qux'],
        ];
        $headers = ['header1', 'header2'];
        try {
            CsvHelper::writeFromArray($data, $filePath, $headers);
            $result = CsvHelper::readToArray($filePath);
            $this->assertIsArray($result);
        } catch (Exception $e) {
            dump($e->getMessage());
        } finally {
            unlink($filePath);
        }
    }
}
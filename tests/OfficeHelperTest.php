<?php

use PHPUnit\Framework\TestCase;
use Forever2077\PhpHelper\Helper;
use Forever2077\PhpHelper\OfficeHelper;

class OfficeHelperTest extends TestCase
{
    public function testInstance()
    {
        $this->assertEquals(OfficeHelper::Class, Helper::office()::class);
    }

    public function testExcel()
    {
        $this->assertInstanceOf('PhpOffice\PhpSpreadsheet\Spreadsheet', OfficeHelper::excel());
    }

    public function testWorld()
    {
        $this->assertInstanceOf('PhpOffice\PhpWord\PhpWord', OfficeHelper::world());
    }

    public function testSaveToExcel()
    {
        $titles = range('A', 'Z');
        for ($i = 0; $i < 10; $i++) {
            $titles[] = 'A' . chr(ord('A') + $i);
        }

        $data = [];
        for ($i = 0; $i < 100; $i++) {
            $row = [];
            for ($j = 0; $j < count($titles); $j++) {
                $row[] = $titles[$j] . ($i + 1);
            }
            $data[] = $row;
        }

        $options = [
            'data' => $data,
            'titles' => $titles,
            'filePath' => __DIR__ . '/test.xlsx',
            'dataFilter' => function ($value) {
                return $value . 'x';
            },
            'dataCallback' => function ($spreadsheet) {
                $spreadsheet->getActiveSheet()->setTitle('test');
            },
        ];

        try {
            OfficeHelper::saveToExcel($options);
            $this->assertFileExists($options['filePath']);
        } catch (\PhpOffice\PhpSpreadsheet\Writer\Exception $e) {
            $this->fail($e->getMessage());
        }
    }

    public function testReadFromExcel()
    {
        $options = [
            'filePath' => __DIR__ . '/test.xlsx',
            'dataCallback' => function ($spreadsheet) {
                $spreadsheet->getActiveSheet()->setTitle('test');
            },
        ];

        try {
            $data = OfficeHelper::readFromExcel($options);
            $this->assertIsArray($data);
            $this->assertNotEmpty($data);
            $this->assertNotEmpty($data[0]);
            $this->assertNotEmpty($data[0][0]);
            $this->assertEquals('A1x', $data[1][0]);
            unlink($options['filePath']);
        } catch (\PhpOffice\PhpSpreadsheet\Reader\Exception $e) {
            $this->fail($e->getMessage());
        }
    }
}
<?php

namespace Helpful;

use Exception;
use SplFileObject;
use League\Csv\Reader;
use League\Csv\Writer;
use League\Csv\ByteSequence;

class CsvHelper
{
    /**
     * CSV辅助类
     * @return CsvHelper
     */
    public static function instance(): CsvHelper
    {
        return new self();
    }

    /**
     * CSV写入器
     * @return string|Writer
     */
    public static function writer(): string|Writer
    {
        return Writer::class;
    }

    /**
     * CSV读取器
     * @return string|Reader
     */
    public static function reader(): string|Reader
    {
        return Reader::class;
    }

    /**
     * 将数组写入CSV文件
     * @param array $data 数据数组
     * @param string $filepath 保存文件的路径
     * @param array|null $headers 可选的CSV文件头数组
     * @param string $mode 打开文件的模式，默认为'w'（写入模式）
     * @param string $encoding CSV的字符编码，默认为'UTF-8'
     * @return void
     * @throws Exception 如果写入过程中发生错误
     */
    public static function writeFromArray(array $data, string $filepath, array $headers = null, string $mode = 'w', string $encoding = ByteSequence::BOM_UTF8): void
    {
        try {
            $fileObject = new SplFileObject($filepath, $mode);
            $csvWriter = Writer::createFromFileObject($fileObject)->setOutputBOM($encoding);

            if ($headers !== null) {
                $csvWriter->insertOne($headers);
            }

            foreach ($data as $row) {
                $csvWriter->insertOne($row);
            }
        } catch (Exception $e) {
            throw new Exception("Error writing to CSV: " . $e->getMessage());
        }
    }

    /**
     * 从CSV文件读取数据并返回数组
     * @param string $filepath CSV文件路径
     * @param int $headerOffset 表头行号，如果设为 null 则不使用表头
     * @return array 读取的数据数组
     * @throws \League\Csv\Exception
     * @throws Exception
     */
    public static function readToArray(string $filepath, int $headerOffset = 0): array
    {
        if (!file_exists($filepath) || !is_readable($filepath)) {
            throw new Exception("The file is unreadable or does not exist: " . $filepath);
        }

        $csv = Reader::createFromPath($filepath);
        $csv->setHeaderOffset($headerOffset);

        return iterator_to_array($csv->getRecords());
    }
}
<?php

namespace Forever2077\PhpHelper;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Exception;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpWord\PhpWord;

class OfficeHelper
{
    /**
     * @return OfficeHelper
     */
    public static function instance(): OfficeHelper
    {
        return new self();
    }

    /**
     * @link https://phpspreadsheet.readthedocs.io/
     * @return Spreadsheet
     */
    public static function excel(): Spreadsheet
    {
        return new Spreadsheet();
    }

    /**
     * @link https://phpword.readthedocs.io/
     * @return PhpWord
     */
    public static function world(): PhpWord
    {
        return new PhpWord();
    }

    /**
     * 生成Excel序号列字母
     * @param int $n 序号
     * @return string
     */
    private static function _numToAlpha(int $n): string
    {
        $alphabet = range('A', 'Z');
        $alpha = '';

        while ($n > 0) {
            $remainder = $n % 26;
            $n = intval($n / 26);

            if ($remainder == 0) {
                $alpha = 'Z' . $alpha;
                $n--;
            } else {
                $alpha = $alphabet[$remainder - 1] . $alpha;
            }
        }

        return $alpha;
    }

    /**
     * 将数据保存到 Excel 文件中。
     *
     * @link https://phpspreadsheet.readthedocs.io/
     * @param array $options 选项数组。可能的键值包括：
     * - 'data' (array) - 写入到电子表格的二维数组数据。每个子数组都是一行，其元素是单元格。
     * - 'titles' (array) - 列的标题数组。
     * - 'filePath' (string) - 保存电子表格的文件路径。
     * - 'dataFilter' (callable|null) - 一个回调函数，接受单元格值并返回过滤后的值。
     * - 'dataCallback' (callable|null) - 一个回调函数，接受 Spreadsheet 对象进行额外的操作。
     * - 'spreadsheet' (Spreadsheet|null) - 可选的 Spreadsheet 对象，用于高级配置。
     * @throws Exception
     */
    public static function saveToExcel(array $options = []): void
    {
        $defaults = [
            'data' => [],
            'titles' => [],
            'filePath' => 'file.xlsx',
            'dataFilter' => null,
            'dataCallback' => null,
            'spreadsheet' => null,
        ];
        // 合并选项与默认值
        $options = array_merge($defaults, $options);

        // 使用提供的 Spreadsheet 对象或创建新的
        $spreadsheet = $options['spreadsheet'] ?? new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // 设置标题
        $col = 1;
        foreach ($options['titles'] as $title) {
            $sheet->setCellValue(self::_numToAlpha($col++) . '1', $title);
        }

        // 设置数据
        $row = 2;
        foreach ($options['data'] as $dataRow) {
            $col = 1;
            foreach ($dataRow as $dataCell) {
                // Apply data filter if provided
                if ($options['dataFilter'] !== null) {
                    $dataCell = ($options['dataFilter'])($dataCell);
                }
                $sheet->setCellValue(self::_numToAlpha($col++) . $row, $dataCell);
            }
            $row++;
        }

        // 如有提供数据回调，则应用
        if ($options['dataCallback'] !== null) {
            ($options['dataCallback'])($spreadsheet);
        }

        // 保存文件
        $writer = new Xlsx($spreadsheet);
        try {
            $writer->save($options['filePath']);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * 从 Excel 文件中读取数据。
     *
     * @param array $options 选项数组。可能的键是：
     * - 'filePath' (string) - 要读取的电子表格的路径。
     * - 'dataFilter' (callable|null) - 一个回调函数，接受单元格值并返回过滤后的值。
     * - 'dataCallback' (callable|null) - 一个回调函数，接受 Spreadsheet 对象进行额外的操作。
     * - 'spreadsheet' (Spreadsheet|null) - 可选的 Spreadsheet 对象，用于高级配置。
     * @return array 二维数组，表示电子表格的内容。每个子数组都是一行，其元素是单元格。
     * @throws \PhpOffice\PhpSpreadsheet\Reader\Exception
     */
    public static function readFromExcel(array $options = []): array
    {
        $defaults = [
            'filePath' => 'file.xlsx',
            'dataFilter' => null,
            'dataCallback' => null,
            'spreadsheet' => null,
        ];
        // 合并选项与默认值
        $options = array_merge($defaults, $options);

        // 使用提供的 Spreadsheet 对象或加载新文件
        if ($options['spreadsheet'] === null) {
            $reader = IOFactory::createReaderForFile($options['filePath']);
            $spreadsheet = $reader->load($options['filePath']);
        } else {
            $spreadsheet = $options['spreadsheet'];
        }

        // 应用数据回调
        if ($options['dataCallback'] !== null) {
            ($options['dataCallback'])($spreadsheet);
        }

        // 读取数据
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray();
        if ($options['dataFilter'] !== null) {
            array_walk_recursive($rows, $options['dataFilter']);
        }

        return $rows;
    }
}
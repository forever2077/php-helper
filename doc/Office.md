## 文档处理 Office

```php
// 生成36列100行模拟数据并保存到excel
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
        // 回调方法
    },
];

try {
    OfficeHelper::saveToExcel($options);
} catch (\PhpOffice\PhpSpreadsheet\Writer\Exception $e) {}

// 读取excel
$options = [
    'filePath' => __DIR__ . '/test.xlsx',
    'dataCallback' => function ($spreadsheet) {
        // 回调方法
    },
];
try {
    $data = OfficeHelper::readFromExcel($options);
} catch (\PhpOffice\PhpSpreadsheet\Reader\Exception $e) {}

// excel文档处理实例
OfficeHelper::excel();
文档 https://phpspreadsheet.readthedocs.io

// word文档处理实例
OfficeHelper::world();
文档 https://phpword.readthedocs.io
```
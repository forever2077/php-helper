## 文档处理 CSV

```php
// 将数组写入CSV文件
$data = [
    ['foo', 'bar'],
    ['baz', 'qux'],
];
$headers = ['header1', 'header2'];
$filePath = __DIR__ . '/output.csv';
try {
    CsvHelper::writeFromArray($data, $filePath, $headers);
} catch (Exception $e) {
    echo $e->getMessage();
}
// 从CSV文件读取数据并返回数组
try {
    $result = CsvHelper::readToArray($filePath);
} catch (Exception $e) {
    echo $e->getMessage();
}
// CSV写入器
CsvHelper::writer();
// CSV读取器
CsvHelper::reader();
文档 https://csv.thephpleague.com/9.0/
```
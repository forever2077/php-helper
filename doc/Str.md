## 字符串 Str

```php
// 生成唯一数字 eg: YYYYMMDDHHIISSNNNNNNNNCC 24
StrHelper::uniqueShortStr();
// 生成短的唯一码，可以根据编码的值推算出来年、月、日
// 短唯一码的起始年份，默认是2020年
//【A:对应年】+【6：月16进制】+【04:日期】+【57112：时间戳后五位】+【46633：毫秒5位】+【随机两位】
// 注意：
// 1.如果年份年份大于24年，则对第一个字符倍增操作，比如我们程序运行到2047年的时候 则以 AA 开头，
// 2.如果传入的起始年份大于当前年份，则返回的字符串前面增加“-”符号
StrHelper::uniqueDateNum();
//随机字长度的随机字符串
StrHelper::randStr($length = 6, $type = 'string');
```
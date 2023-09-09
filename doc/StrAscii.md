## 字符串 Str（ASCII）

```php
/**
 * 获取ASCII字符数组
 * @return array ASCII字符数组
 */
StrHelper::ascii()::charsArray(): array {}

/**
 * 获取支持多种语言的ASCII字符数组
 * @return array 支持多种语言的ASCII字符数组
 */
StrHelper::ascii()::charsArrayWithMultiLanguageValues(): array {}

/**
 * 获取单一语言的ASCII字符数组
 * @param string $language 指定的语言
 * @return array 单一语言的ASCII字符数组
 */
StrHelper::ascii()::charsArrayWithOneLanguage(string $language): array {}

/**
 * 获取单一语言值的ASCII字符数组
 * @param string $language 指定的语言
 * @return array 单一语言值的ASCII字符数组
 */
StrHelper::ascii()::charsArrayWithSingleLanguageValues(string $language): array {}

/**
 * 清理字符串中的非ASCII字符
 * @param string $str 输入字符串
 * @return string 清理后的字符串
 */
StrHelper::ascii()::clean(string $str): string {}

/**
 * 获取所有支持的语言
 * @return array 支持的语言列表
 */
StrHelper::ascii()::getAllLanguages(): array {}

/**
 * 检查字符串是否为ASCII
 * @param string $str 输入字符串
 * @return bool 是否为ASCII
 */
StrHelper::ascii()::is_ascii(string $str): bool {}

/**
 * 规范化MS Word中的特殊字符
 * @param string $str 输入字符串
 * @return string 规范化后的字符串
 */
StrHelper::ascii()::normalize_msword(string $str): string {}

/**
 * 规范化字符串中的空白字符
 * @param string $str 输入字符串
 * @return string 规范化后的字符串
 */
StrHelper::ascii()::normalize_whitespace(string $str): string {}

/**
 * 移除字符串中的不可见字符
 * @param string $str 输入字符串
 * @return string 移除后的字符串
 */
StrHelper::ascii()::remove_invisible_characters(string $str): string {}

/**
 * 转换字符串为ASCII
 * @param string $str 输入字符串
 * @return string ASCII字符串
 */
StrHelper::ascii()::to_ascii(string $str): string {}

/**
 * 重新映射字符串为ASCII
 * @param string $str 输入字符串
 * @return string 重新映射后的ASCII字符串
 */
StrHelper::ascii()::to_ascii_remap(string $str): string {}

/**
 * 转换字符串为文件名
 * @param string $str 输入字符串
 * @return string 文件名
 */
StrHelper::ascii()::to_filename(string $str): string {}

/**
 * 转换字符串为slug形式
 * @param string $str 输入字符串
 * @return string slug字符串
 */
StrHelper::ascii()::to_slugify(string $str): string {}

/**
 * 转换字符串为转写文本
 * @param string $str 输入字符串
 * @return string 转写后的文本
 */
StrHelper::ascii()::to_transliterate(string $str): string {}

文档 https://github.com/voku/portable-ascii
```

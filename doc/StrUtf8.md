## 字符串 Str（UTF-8）

```php
/**
 * 返回指定位置的字符
 * @param string $str      一个 UTF-8 字符串
 * @param int    $pos      要返回的字符的位置
 * @param string $encoding 可选。设置字符集，例如用于 "mb_" 函数
 * @return string 返回单个多字节字符。
 * @example UTF8::access('fòô', 1); // 返回 'ò'
 */
StrHelper::utf8()::access(string $str, int $pos, string $encoding = 'UTF-8'): string {}

/**
 * 在字符串前添加 UTF-8 BOM 字符
 * @param string $str 需要添加 BOM 的 UTF-8 字符串
 * @return string 带有 BOM 的字符串。
 */
StrHelper::utf8()::add_bom_to_string(string $str): string {}

/**
 * 更改数组键的大小写
 * @param array $array 输入的数组
 * @param int   $case  可选。CASE_UPPER 或 CASE_LOWER
 * @return array 返回键大小写已更改的数组。
 */
StrHelper::utf8()::array_change_key_case(array $array, int $case = CASE_LOWER): array {}

/**
 * 获取两个子字符串之间的字符串
 * @param string $str   输入字符串
 * @param string $start 起始子字符串
 * @param string $end   结束子字符串
 * @return string 返回起始和结束子字符串之间的字符串。
 */
StrHelper::utf8()::between(string $str, string $start, string $end): string {}

/**
 * 将二进制数据转换为字符串
 * @param string $binary 二进制数据
 * @return string 转换后的字符串。
 */
StrHelper::utf8()::binary_to_str(string $binary): string {}

/**
 * 返回 UTF-8 的 BOM 字符
 * @return string 返回 UTF-8 的 BOM 字符。
 */
StrHelper::utf8()::bom(): string {}

/**
 * 对字符串执行回调函数
 * @param string   $str     输入字符串
 * @param callable $callback 回调函数
 * @return string 回调函数执行后的字符串。
 */
StrHelper::utf8()::callback(string $str, callable $callback): string {}

/**
 * 返回字符串中所有字符的数组
 * @param string $str 输入字符串
 * @return array 字符数组。
 */
StrHelper::utf8()::chars(string $str): array {}

/**
 * 检查当前环境是否支持 UTF-8 操作
 * @return bool 如果支持返回 true，否则返回 false。
 */
StrHelper::utf8()::checkForSupport(): bool {}

/**
 * 将 Unicode 码点转换为 UTF-8 字符
 * @param int $codepoint Unicode 码点
 * @return string 对应的 UTF-8 字符
 */
StrHelper::utf8()::chr(int $codepoint): string {}

/**
 * 对数组中的每个 Unicode 码点应用 chr 函数
 * @param array $array Unicode 码点数组
 * @return array 转换后的 UTF-8 字符数组
 */
StrHelper::utf8()::chr_map(array $array): array {}

/**
 * 获取 UTF-8 字符串中每个字符的字节大小列表
 * @param string $str 输入的 UTF-8 字符串
 * @return array 每个字符的字节大小列表
 */
StrHelper::utf8()::chr_size_list(string $str): array {}

/**
 * 将 UTF-8 字符转换为其对应的十进制 Unicode 码点
 * @param string $char 输入的 UTF-8 字符
 * @return int 对应的十进制 Unicode 码点
 */
StrHelper::utf8()::chr_to_decimal(string $char): int {}

/**
 * 将 UTF-8 字符转换为其对应的十六进制 Unicode 码点
 * @param string $char 输入的 UTF-8 字符
 * @return string 对应的十六进制 Unicode 码点
 */
StrHelper::utf8()::chr_to_hex(string $char): string {}

/**
 * 在每个指定长度的字符串后添加一个字符串
 * @param string $str  输入的字符串
 * @param int    $len  每个块的长度
 * @param string $glue 添加的字符串
 * @return string 分割后的字符串
 */
StrHelper::utf8()::chunk_split(string $str, int $len, string $glue): string {}

/**
 * 清理字符串，删除无效的 UTF-8 字符
 * @param string $str 输入的 UTF-8 字符串
 * @return string 清理后的字符串
 */
StrHelper::utf8()::clean(string $str): string {}

/**
 * 进一步清理字符串，转换为规范形式
 * @param string $str 输入的 UTF-8 字符串
 * @return string 清理和规范化后的字符串
 */
StrHelper::utf8()::cleanup(string $str): string {}

/**
 * 获取 UTF-8 字符串中所有字符的 Unicode 码点
 * @param string $str 输入的 UTF-8 字符串
 * @return array 所有字符的 Unicode 码点列表
 */
StrHelper::utf8()::codepoints(string $str): array {}

/**
 * 折叠字符串中的多个空白为单个空格
 * @param string $str 输入的字符串
 * @return string 折叠后的字符串
 */
StrHelper::utf8()::collapse_whitespace(string $str): string {}

/**
 * 计算字符串中各个字符出现的次数
 * @param string $str 输入的 UTF-8 字符串
 * @return array 字符出现的次数统计
 */
StrHelper::utf8()::count_chars(string $str): array {}

/**
 * 将字符串转换为 CSS 标识符
 * @param string $str 输入的字符串
 * @return string 转换后的 CSS 标识符
 */
StrHelper::utf8()::css_identifier(string $str): string {}

/**
 * 从 CSS 字符串中提取媒体查询
 * @param string $str 输入的 CSS 字符串
 * @return array 提取的媒体查询列表
 */
StrHelper::utf8()::css_stripe_media_queries(string $str): array {}

/**
 * 检查 ctype 扩展是否已加载
 * @return bool 如果已加载返回 true，否则返回 false
 */
StrHelper::utf8()::ctype_loaded(): bool {}

/**
 * 将十进制 Unicode 码点转换为 UTF-8 字符
 * @param int $decimal 十进制 Unicode 码点
 * @return string 对应的 UTF-8 字符
 */
StrHelper::utf8()::decimal_to_chr(int $decimal): string {}

/**
 * 解码 MIME 头部字符串
 * @param string $str MIME 头部字符串
 * @return string 解码后的字符串
 */
StrHelper::utf8()::decode_mimeheader(string $str): string {}

/**
 * 将字符串中的 Emoji 编码转换为别名
 * @param string $str 输入的字符串
 * @return string 转换后的字符串
 */
StrHelper::utf8()::emoji_decode(string $str): string {}

/**
 * 将字符串中的 Emoji 别名转换为编码
 * @param string $str 输入的字符串
 * @return string 转换后的字符串
 */
StrHelper::utf8()::emoji_encode(string $str): string {}

/**
 * 通过国家代码生成 Emoji 标志
 * @param string $country_code 国家代码
 * @return string 对应的 Emoji 标志
 */
StrHelper::utf8()::emoji_from_country_code(string $country_code): string {}

/**
 * 对字符串进行编码
 * @param string $str 输入的字符串
 * @param string $encoding 目标编码
 * @return string 编码后的字符串
 */
StrHelper::utf8()::encode(string $str, string $encoding): string {}

/**
 * 对 MIME 头部字符串进行编码
 * @param string $str MIME 头部字符串
 * @return string 编码后的字符串
 */
StrHelper::utf8()::encode_mimeheader(string $str): string {}

/**
 * 从文本中提取特定的字符串或标签
 * @param string $str 输入的文本
 * @param string $tag 要提取的标签或字符串
 * @return string 提取的内容
 */
StrHelper::utf8()::extract_text(string $str, string $tag): string {}

/**
 * 读取文件的内容
 * @param string $filename 文件名
 * @return string 文件的内容
 */
StrHelper::utf8()::file_get_contents(string $filename): string {}

/**
 * 检查文件是否包含 BOM
 * @param string $filename 文件名
 * @return bool 如果包含返回 true，否则返回 false
 */
StrHelper::utf8()::file_has_bom(string $filename): bool {}

/**
 * 过滤字符串中的特定字符或模式
 * @param string $str 输入的字符串
 * @param string $pattern 要过滤的字符或模式
 * @return string 过滤后的字符串
 */
StrHelper::utf8()::filter(string $str, string $pattern): string {}

/**
 * 过滤输入变量
 * @param int $type 输入类型（例如：INPUT_GET, INPUT_POST）
 * @param string $variable_name 变量名
 * @param int $filter 过滤器 ID
 * @return mixed 过滤后的值
 */
StrHelper::utf8()::filter_input(int $type, string $variable_name, int $filter): mixed {}

/**
 * 以数组形式过滤多个输入变量
 * @param int $type 输入类型（例如：INPUT_GET, INPUT_POST）
 * @param array $definition 过滤器和变量的关联数组
 * @return array 过滤后的值的数组
 */
StrHelper::utf8()::filter_input_array(int $type, array $definition): array {}

/**
 * 使用特定的过滤器过滤变量
 * @param mixed $variable 要过滤的变量
 * @param int $filter 过滤器 ID
 * @return mixed 过滤后的值
 */
StrHelper::utf8()::filter_var(mixed $variable, int $filter): mixed {}

/**
 * 使用特定的过滤器以数组形式过滤多个变量
 * @param array $data 要过滤的变量数组
 * @param array $args 过滤器和变量的关联数组
 * @return array 过滤后的值的数组
 */
StrHelper::utf8()::filter_var_array(array $data, array $args): array {}

/**
 * 检查文件信息扩展（finfo）是否已加载
 * @return bool 如果已加载返回 true，否则返回 false
 */
StrHelper::utf8()::finfo_loaded(): bool {}

/**
 * 获取字符串的第一个字符
 * @param string $str 输入的字符串
 * @return string 第一个字符
 */
StrHelper::utf8()::first_char(string $str): string {}

/**
 * 检查字符串是否适合在指定宽度内显示
 * @param string $str 输入的字符串
 * @param int $width 指定的宽度
 * @return bool 如果适合返回 true，否则返回 false
 */
StrHelper::utf8()::fits_inside(string $str, int $width): bool {}

/**
 * 修复包含简单 UTF-8 编码错误的字符串
 * @param string $str 输入的字符串
 * @return string 修复后的字符串
 */
StrHelper::utf8()::fix_simple_utf8(string $str): string {}

/**
 * 修复包含任何 UTF-8 编码错误的字符串
 * @param string $str 输入的字符串
 * @return string 修复后的字符串
 */
StrHelper::utf8()::fix_utf8(string $str): string {}

/**
 * 获取字符方向（LTR或RTL）
 * @param string $char 输入的字符
 * @return string 字符方向（'LTR' 或 'RTL'）
 */
StrHelper::utf8()::getCharDirection(string $char): string {}

/**
 * 获取库支持的功能信息
 * @return array 支持的功能列表
 */
StrHelper::utf8()::getSupportInfo(): array {}

/**
 * 从数组生成 URL 参数
 * @param array $array 输入的数组
 * @return string 生成的 URL 参数字符串
 */
StrHelper::utf8()::getUrlParamFromArray(array $array): string {}

/**
 * 获取文件类型
 * @param string $filename 文件名
 * @return string 文件类型
 */
StrHelper::utf8()::get_file_type(string $filename): string {}

/**
 * 生成随机字符串
 * @param int $length 字符串长度
 * @return string 生成的随机字符串
 */
StrHelper::utf8()::get_random_string(int $length): string {}

/**
 * 生成唯一字符串
 * @return string 生成的唯一字符串
 */
StrHelper::utf8()::get_unique_string(): string {}

/**
 * 检查字符串是否包含小写字母
 * @param string $str 输入的字符串
 * @return bool 如果包含返回 true，否则返回 false
 */
StrHelper::utf8()::has_lowercase(string $str): bool {}

/**
 * 检查字符串是否包含大写字母
 * @param string $str 输入的字符串
 * @return bool 如果包含返回 true，否则返回 false
 */
StrHelper::utf8()::has_uppercase(string $str): bool {}

/**
 * 检查字符串是否包含空白字符
 * @param string $str 输入的字符串
 * @return bool 如果包含返回 true，否则返回 false
 */
StrHelper::utf8()::has_whitespace(string $str): bool {}

/**
 * 将十六进制 Unicode 码点转换为 UTF-8 字符
 * @param string $hex 十六进制 Unicode 码点
 * @return string 对应的 UTF-8 字符
 */
StrHelper::utf8()::hex_to_chr(string $hex): string {}

/**
 * 将十六进制字符串转换为整数
 * @param string $hex 十六进制字符串
 * @return int 对应的整数
 */
StrHelper::utf8()::hex_to_int(string $hex): int {}

/**
 * 对 HTML 字符串进行编码
 * @param string $str 输入的 HTML 字符串
 * @return string 编码后的字符串
 */
StrHelper::utf8()::html_encode(string $str): string {}

/**
 * 对 HTML 实体进行解码
 * @param string $str 输入的 HTML 实体字符串
 * @return string 解码后的字符串
 */
StrHelper::utf8()::html_entity_decode(string $str): string {}

/**
 * 对 HTML 字符串进行转义
 * @param string $str 输入的 HTML 字符串
 * @return string 转义后的字符串
 */
StrHelper::utf8()::html_escape(string $str): string {}

/**
 * 从 HTML 字符串中剥离空标签
 * @param string $str 输入的 HTML 字符串
 * @return string 剥离空标签后的字符串
 */
StrHelper::utf8()::html_stripe_empty_tags(string $str): string {}

/**
 * 对 HTML 字符串进行编码，等同于 htmlentities
 * @param string $str 输入的 HTML 字符串
 * @return string 编码后的字符串
 */
StrHelper::utf8()::htmlentities(string $str): string {}

/**
 * 对 HTML 字符串进行转义，等同于 htmlspecialchars
 * @param string $str 输入的 HTML 字符串
 * @return string 转义后的字符串
 */
StrHelper::utf8()::htmlspecialchars(string $str): string {}

/**
 * 检查 iconv 扩展是否已加载
 * @return bool 如果已加载返回 true，否则返回 false
 */
StrHelper::utf8()::iconv_loaded(): bool {}

/**
 * 将整数转换为十六进制字符串
 * @param int $int 输入的整数
 * @return string 对应的十六进制字符串
 */
StrHelper::utf8()::int_to_hex(int $int): string {}

/**
 * 检查 IntlChar 扩展是否已加载
 * @return bool 如果已加载返回 true，否则返回 false
 */
StrHelper::utf8()::intlChar_loaded(): bool {}

/**
 * 检查 intl 扩展是否已加载
 * @return bool 如果已加载返回 true，否则返回 false
 */
StrHelper::utf8()::intl_loaded(): bool {}

/**
 * 检查字符串是否仅包含字母
 * @param string $str 输入的字符串
 * @return bool 如果仅包含字母返回 true，否则返回 false
 */
StrHelper::utf8()::is_alpha(string $str): bool {}

/**
 * 检查字符串是否仅包含字母和数字
 * @param string $str 输入的字符串
 * @return bool 如果仅包含字母和数字返回 true，否则返回 false
 */
StrHelper::utf8()::is_alphanumeric(string $str): bool {}

/**
 * 检查字符串是否为 ASCII 字符串
 * @param string $str 输入的字符串
 * @return bool 如果是 ASCII 字符串返回 true，否则返回 false
 */
StrHelper::utf8()::is_ascii(string $str): bool {}

/**
 * 检查字符串是否为 Base64 编码
 * @param string $str 输入的字符串
 * @return bool 如果是 Base64 编码返回 true，否则返回 false
 */
StrHelper::utf8()::is_base64(string $str): bool {}

/**
 * 检查字符串是否包含二进制数据
 * @param string $str 输入的字符串
 * @return bool 如果包含二进制数据返回 true，否则返回 false
 */
StrHelper::utf8()::is_binary(string $str): bool {}

/**
 * 检查文件是否为二进制文件
 * @param string $filename 文件名
 * @return bool 如果是二进制文件返回 true，否则返回 false
 */
StrHelper::utf8()::is_binary_file(string $filename): bool {}

/**
 * 检查字符串是否为空或仅包含空白字符
 * @param string $str 输入的字符串
 * @return bool 如果为空或仅包含空白字符返回 true，否则返回 false
 */
StrHelper::utf8()::is_blank(string $str): bool {}

/**
 * 检查字符串是否以 BOM（字节顺序标记）开始
 * @param string $str 输入的字符串
 * @return bool 如果以 BOM 开始返回 true，否则返回 false
 */
StrHelper::utf8()::is_bom(string $str): bool {}

/**
 * 检查字符串是否为空
 * @param string $str 输入的字符串
 * @return bool 如果为空返回 true，否则返回 false
 */
StrHelper::utf8()::is_empty(string $str): bool {}

/**
 * 检查字符串是否为十六进制字符串
 * @param string $str 输入的字符串
 * @return bool 如果是十六进制字符串返回 true，否则返回 false
 */
StrHelper::utf8()::is_hexadecimal(string $str): bool {}

/**
 * 检查字符串是否包含 HTML 标签
 * @param string $str 输入的字符串
 * @return bool 如果包含 HTML 标签返回 true，否则返回 false
 */
StrHelper::utf8()::is_html(string $str): bool {}

/**
 * 检查字符串是否为有效的 JSON
 * @param string $str 输入的字符串
 * @return bool 如果是有效的 JSON 返回 true，否则返回 false
 */
StrHelper::utf8()::is_json(string $str): bool {}

/**
 * 检查字符串是否全为小写字母
 * @param string $str 输入的字符串
 * @return bool 如果全为小写字母返回 true，否则返回 false
 */
StrHelper::utf8()::is_lowercase(string $str): bool {}

/**
 * 检查字符串是否可打印
 * @param string $str 输入的字符串
 * @return bool 如果可打印返回 true，否则返回 false
 */
StrHelper::utf8()::is_printable(string $str): bool {}

/**
 * 检查字符串是否包含标点符号
 * @param string $str 输入的字符串
 * @return bool 如果包含标点符号返回 true，否则返回 false
 */
StrHelper::utf8()::is_punctuation(string $str): bool {}

/**
 * 检查字符串是否为序列化字符串
 * @param string $str 输入的字符串
 * @return bool 如果是序列化字符串返回 true，否则返回 false
 */
StrHelper::utf8()::is_serialized(string $str): bool {}

/**
 * 检查字符串是否全为大写字母
 * @param string $str 输入的字符串
 * @return bool 如果全为大写字母返回 true，否则返回 false
 */
StrHelper::utf8()::is_uppercase(string $str): bool {}

/**
 * 检查字符串是否为有效的 URL
 * @param string $str 输入的字符串
 * @return bool 如果是有效的 URL 返回 true，否则返回 false
 */
StrHelper::utf8()::is_url(string $str): bool {}

/**
 * 检查字符串是否为 UTF-8 编码
 * @param string $str 输入的字符串
 * @return bool 如果是 UTF-8 编码返回 true，否则返回 false
 */
StrHelper::utf8()::is_utf8(string $str): bool {}

/**
 * 检查字符串是否为 UTF-16 编码
 * @param string $str 输入的字符串
 * @return bool 如果是 UTF-16 编码返回 true，否则返回 false
 */
StrHelper::utf8()::is_utf16(string $str): bool {}

/**
 * 检查字符串是否为 UTF-32 编码
 * @param string $str 输入的字符串
 * @return bool 如果是 UTF-32 编码返回 true，否则返回 false
 */
StrHelper::utf8()::is_utf32(string $str): bool {}

/**
 * 将 JSON 字符串解码为 PHP 值
 * @param string $json 输入的 JSON 字符串
 * @return mixed 解码后的 PHP 值
 */
StrHelper::utf8()::json_decode(string $json): mixed {}

/**
 * 将 PHP 值编码为 JSON 字符串
 * @param mixed $value 输入的 PHP 值
 * @return string 编码后的 JSON 字符串
 */
StrHelper::utf8()::json_encode(mixed $value): string {}

/**
 * 检查 JSON 扩展是否已加载
 * @return bool 如果已加载返回 true，否则返回 false
 */
StrHelper::utf8()::json_loaded(): bool {}

/**
 * 将字符串的首字母转换为小写
 * @param string $str 输入的字符串
 * @return string 首字母小写的字符串
 */
StrHelper::utf8()::lcfirst(string $str): string {}

/**
 * 将字符串中每个单词的首字母转换为小写
 * @param string $str 输入的字符串
 * @return string 转换后的字符串
 */
StrHelper::utf8()::lcwords(string $str): string {}

/**
 * 计算两个字符串之间的 Levenshtein 距离
 * @param string $str1 第一个字符串
 * @param string $str2 第二个字符串
 * @return int Levenshtein 距离
 */
StrHelper::utf8()::levenshtein(string $str1, string $str2): int {}

/**
 * 删除字符串左侧的空白字符
 * @param string $str 输入的字符串
 * @return string 删除左侧空白后的字符串
 */
StrHelper::utf8()::ltrim(string $str): string {}

/**
 * 获取字符串中的最大值
 * @param string $str 输入的字符串
 * @return string 最大值字符
 */
StrHelper::utf8()::max(string $str): string {}

/**
 * 获取 UTF-8 字符串中字符的最大字节宽度
 * @param string $str 输入的 UTF-8 字符串
 * @return int 最大字节宽度
 */
StrHelper::utf8()::max_chr_width(string $str): int {}

/**
 * 检查 mbstring 扩展是否已加载
 * @return bool 如果已加载返回 true，否则返回 false
 */
StrHelper::utf8()::mbstring_loaded(): bool {}

/**
 * 获取字符串中的最小值
 * @param string $str 输入的字符串
 * @return string 最小值字符
 */
StrHelper::utf8()::min(string $str): string {}

/**
 * 标准化字符编码名称
 * @param string $encoding 输入的字符编码名称
 * @return string 标准化后的字符编码名称
 */
StrHelper::utf8()::normalize_encoding(string $encoding): string {}

/**
 * 标准化字符串中的换行符
 * @param string $str 输入的字符串
 * @return string 标准化后的字符串
 */
StrHelper::utf8()::normalize_line_ending(string $str): string {}

/**
 * 标准化从 Microsoft Word 复制的字符串
 * @param string $str 输入的字符串
 * @return string 标准化后的字符串
 */
StrHelper::utf8()::normalize_msword(string $str): string {}

/**
 * 标准化字符串中的空白字符
 * @param string $str 输入的字符串
 * @return string 标准化后的字符串
 */
StrHelper::utf8()::normalize_whitespace(string $str): string {}

/**
 * 将 UTF-8 字符转换为其对应的 Unicode 码点
 * @param string $char 输入的 UTF-8 字符
 * @return int 对应的 Unicode 码点
 */
StrHelper::utf8()::ord(string $char): int {}

/**
 * 解析字符串为变量
 * @param string $str 输入的字符串
 * @return array 解析后的变量数组
 */
StrHelper::utf8()::parse_str(string $str): array {}

/**
 * 检查 PCRE 库是否支持 UTF-8
 * @return bool 如果支持返回 true，否则返回 false
 */
StrHelper::utf8()::pcre_utf8_support(): bool {}

/**
 * 创建一个包含指定范围内字符的数组
 * @param string $start 起始字符
 * @param string $end 结束字符
 * @return array 字符数组
 */
StrHelper::utf8()::range(string $start, string $end): array {}

/**
 * 对使用 rawurlencode 编码的字符串进行解码
 * @param string $str 输入的编码字符串
 * @return string 解码后的字符串
 */
StrHelper::utf8()::rawurldecode(string $str): string {}

/**
 * 使用正则表达式替换字符串中的内容
 * @param string $pattern 正则表达式
 * @param string $replacement 替换内容
 * @param string $str 输入的字符串
 * @return string 替换后的字符串
 */
StrHelper::utf8()::regex_replace(string $pattern, string $replacement, string $str): string {}

/**
 * 从字符串中删除 BOM（字节顺序标记）
 * @param string $str 输入的字符串
 * @return string 删除 BOM 后的字符串
 */
StrHelper::utf8()::remove_bom(string $str): string {}

/**
 * 从字符串中删除重复的字符
 * @param string $str 输入的字符串
 * @return string 删除重复字符后的字符串
 */
StrHelper::utf8()::remove_duplicates(string $str): string {}

/**
 * 从字符串中删除所有 HTML 标签
 * @param string $str 输入的字符串
 * @return string 删除 HTML 标签后的字符串
 */
StrHelper::utf8()::remove_html(string $str): string {}

/**
 * 从字符串中删除 HTML 换行符
 * @param string $str 输入的字符串
 * @return string 删除 HTML 换行符后的字符串
 */
StrHelper::utf8()::remove_html_breaks(string $str): string {}

/**
 * 删除字符串左侧的不可见字符
 * @param string $str 输入的字符串
 * @return string 删除左侧不可见字符后的字符串
 */
StrHelper::utf8()::remove_ileft(string $str): string {}

/**
 * 删除字符串中的不可见字符
 * @param string $str 输入的字符串
 * @return string 删除不可见字符后的字符串
 */
StrHelper::utf8()::remove_invisible_characters(string $str): string {}

/**
 * 删除字符串右侧的不可见字符
 * @param string $str 输入的字符串
 * @return string 删除右侧不可见字符后的字符串
 */
StrHelper::utf8()::remove_iright(string $str): string {}

/**
 * 删除字符串左侧的字符
 * @param string $str 输入的字符串
 * @param string $substring 子字符串
 * @return string 删除左侧字符后的字符串
 */
StrHelper::utf8()::remove_left(string $str, string $substring): string {}

/**
 * 删除字符串右侧的字符
 * @param string $str 输入的字符串
 * @param string $substring 子字符串
 * @return string 删除右侧字符后的字符串
 */
StrHelper::utf8()::remove_right(string $str, string $substring): string {}

/**
 * 替换字符串中的子串
 * @param string $str 输入的字符串
 * @param string $search 要查找的子串
 * @param string $replace 替换内容
 * @return string 替换后的字符串
 */
StrHelper::utf8()::replace(string $str, string $search, string $replace): string {}

/**
 * 替换字符串中的所有指定子串
 * @param string $str 输入的字符串
 * @param array $searchReplaceArray 查找和替换的关联数组
 * @return string 替换后的字符串
 */
StrHelper::utf8()::replace_all(string $str, array $searchReplaceArray): string {}

/**
 * 替换字符串中的钻石问号（�）
 * @param string $str 输入的字符串
 * @param string $replacement 替换内容
 * @return string 替换后的字符串
 */
StrHelper::utf8()::replace_diamond_question_mark(string $str, string $replacement): string {}

/**
 * 删除字符串右侧的空白字符
 * @param string $str 输入的字符串
 * @return string 删除右侧空白后的字符串
 */
StrHelper::utf8()::rtrim(string $str): string {}

/**
 * 显示库支持的功能信息
 * @return array 支持的功能列表
 */
StrHelper::utf8()::showSupport(): array {}

/**
 * 对单个 UTF-8 字符进行 HTML 编码
 * @param string $char 输入的 UTF-8 字符
 * @return string HTML 编码后的字符
 */
StrHelper::utf8()::single_chr_html_encode(string $char): string {}

/**
 * 将字符串中的空格转换为制表符
 * @param string $str 输入的字符串
 * @return string 转换后的字符串
 */
StrHelper::utf8()::spaces_to_tabs(string $str): string {}

/**
 * 将字符串转换为驼峰式命名
 * @param string $str 输入的字符串
 * @return string 转换后的字符串
 */
StrHelper::utf8()::str_camelize(string $str): string {}

/**
 * 将字符串中的名字首字母大写
 * @param string $str 输入的字符串
 * @return string 转换后的字符串
 */
StrHelper::utf8()::str_capitalize_name(string $str): string {}

/**
 * 检查字符串是否包含指定子串
 * @param string $str 输入的字符串
 * @param string $substring 子串
 * @return bool 如果包含返回 true，否则返回 false
 */
StrHelper::utf8()::str_contains(string $str, string $substring): bool {}

/**
 * 检查字符串是否包含所有指定子串
 * @param string $str 输入的字符串
 * @param array $substrings 子串数组
 * @return bool 如果包含所有返回 true，否则返回 false
 */
StrHelper::utf8()::str_contains_all(string $str, array $substrings): bool {}

/**
 * 检查字符串是否包含任一指定子串
 * @param string $str 输入的字符串
 * @param array $substrings 子串数组
 * @return bool 如果包含任一返回 true，否则返回 false
 */
StrHelper::utf8()::str_contains_any(string $str, array $substrings): bool {}

/**
 * 将字符串转换为破折号命名
 * @param string $str 输入的字符串
 * @return string 转换后的字符串
 */
StrHelper::utf8()::str_dasherize(string $str): string {}

/**
 * 使用指定的分隔符分隔字符串
 * @param string $str 输入的字符串
 * @param string $delimiter 分隔符
 * @return string 分隔后的字符串
 */
StrHelper::utf8()::str_delimit(string $str, string $delimiter): string {}

/**
 * 检测字符串的字符编码
 * @param string $str 输入的字符串
 * @return string 字符编码
 */
StrHelper::utf8()::str_detect_encoding(string $str): string {}

/**
 * 检查字符串是否以指定子串结束
 * @param string $str 输入的字符串
 * @param string $substring 子串
 * @return bool 如果以指定子串结束返回 true，否则返回 false
 */
StrHelper::utf8()::str_ends_with(string $str, string $substring): bool {}

/**
 * 检查字符串是否以任一指定子串结束
 * @param string $str 输入的字符串
 * @param array $substrings 子串数组
 * @return bool 如果以任一指定子串结束返回 true，否则返回 false
 */
StrHelper::utf8()::str_ends_with_any(string $str, array $substrings): bool {}

/**
 * 确保字符串以指定子串开头
 * @param string $str 输入的字符串
 * @param string $substring 子串
 * @return string 修改后的字符串
 */
StrHelper::utf8()::str_ensure_left(string $str, string $substring): string {}

/**
 * 确保字符串以指定子串结束
 * @param string $str 输入的字符串
 * @param string $substring 子串
 * @return string 修改后的字符串
 */
StrHelper::utf8()::str_ensure_right(string $str, string $substring): string {}

/**
 * 将字符串转换为人类可读形式
 * @param string $str 输入的字符串
 * @return string 转换后的字符串
 */
StrHelper::utf8()::str_humanize(string $str): string {}

/**
 * 检查字符串是否以指定子串结束（不区分大小写）
 * @param string $str 输入的字符串
 * @param string $substring 子串
 * @return bool 如果以指定子串结束返回 true，否则返回 false
 */
StrHelper::utf8()::str_iends_with(string $str, string $substring): bool {}

/**
 * 检查字符串是否以任一指定子串结束（不区分大小写）
 * @param string $str 输入的字符串
 * @param array $substrings 子串数组
 * @return bool 如果以任一指定子串结束返回 true，否则返回 false
 */
StrHelper::utf8()::str_iends_with_any(string $str, array $substrings): bool {}

/**
 * 在字符串的指定位置插入子串
 * @param string $str 输入的字符串
 * @param string $insert 子串
 * @param int $position 位置
 * @return string 插入后的字符串
 */
StrHelper::utf8()::str_insert(string $str, string $insert, int $position): string {}

/**
 * 不区分大小写地替换字符串中的子串
 * @param string $str 输入的字符串
 * @param string $search 要查找的子串
 * @param string $replace 替换内容
 * @return string 替换后的字符串
 */
StrHelper::utf8()::str_ireplace(string $str, string $search, string $replace): string {}

/**
 * 不区分大小写地替换字符串开始部分的子串
 * @param string $str 输入的字符串
 * @param string $search 要查找的子串
 * @param string $replace 替换内容
 * @return string 替换后的字符串
 */
StrHelper::utf8()::str_ireplace_beginning(string $str, string $search, string $replace): string {}

/**
 * 不区分大小写地替换字符串结尾部分的子串
 * @param string $str 输入的字符串
 * @param string $search 要查找的子串
 * @param string $replace 替换内容
 * @return string 替换后的字符串
 */
StrHelper::utf8()::str_ireplace_ending(string $str, string $search, string $replace): string {}

/**
 * 检查字符串是否以指定子串开始（不区分大小写）
 * @param string $str 输入的字符串
 * @param string $substring 子串
 * @return bool 如果以指定子串开始返回 true，否则返回 false
 */
StrHelper::utf8()::str_istarts_with(string $str, string $substring): bool {}

/**
 * 检查字符串是否以任一指定子串开始（不区分大小写）
 * @param string $str 输入的字符串
 * @param array $substrings 子串数组
 * @return bool 如果以任一指定子串开始返回 true，否则返回 false
 */
StrHelper::utf8()::str_istarts_with_any(string $str, array $substrings): bool {}

/**
 * 不区分大小写地在字符串中查找第一个分隔符之后的子串
 * @param string $str 输入的字符串
 * @param string $separator 分隔符
 * @return string 查找到的子串
 */
StrHelper::utf8()::str_isubstr_after_first_separator(string $str, string $separator): string {}

/**
 * 不区分大小写地在字符串中查找最后一个分隔符之后的子串
 * @param string $str 输入的字符串
 * @param string $separator 分隔符
 * @return string 查找到的子串
 */
StrHelper::utf8()::str_isubstr_after_last_separator(string $str, string $separator): string {}

/**
 * 不区分大小写地在字符串中查找第一个分隔符之前的子串
 * @param string $str 输入的字符串
 * @param string $separator 分隔符
 * @return string 查找到的子串
 */
StrHelper::utf8()::str_isubstr_before_first_separator(string $str, string $separator): string {}

/**
 * 不区分大小写地在字符串中查找最后一个分隔符之前的子串
 * @param string $str 输入的字符串
 * @param string $separator 分隔符
 * @return string 查找到的子串
 */
StrHelper::utf8()::str_isubstr_before_last_separator(string $str, string $separator): string {}

/**
 * 不区分大小写地获取字符串中的第一个子串
 * @param string $str 输入的字符串
 * @param string $substring 子串
 * @return string 查找到的第一个子串
 */
StrHelper::utf8()::str_isubstr_first(string $str, string $substring): string {}

/**
 * 不区分大小写地获取字符串中的最后一个子串
 * @param string $str 输入的字符串
 * @param string $substring 子串
 * @return string 查找到的最后一个子串
 */
StrHelper::utf8()::str_isubstr_last(string $str, string $substring): string {}

/**
 * 获取字符串中的最后一个字符
 * @param string $str 输入的字符串
 * @return string 最后一个字符
 */
StrHelper::utf8()::str_last_char(string $str): string {}

/**
 * 限制字符串的长度
 * @param string $str 输入的字符串
 * @param int $limit 限制长度
 * @return string 截断后的字符串
 */
StrHelper::utf8()::str_limit(string $str, int $limit): string {}

/**
 * 在保留完整单词的情况下限制字符串的长度
 * @param string $str 输入的字符串
 * @param int $limit 限制长度
 * @return string 截断后的字符串
 */
StrHelper::utf8()::str_limit_after_word(string $str, int $limit): string {}

/**
 * 获取两个字符串之间的最长公共前缀
 * @param string $str1 第一个字符串
 * @param string $str2 第二个字符串
 * @return string 最长公共前缀
 */
StrHelper::utf8()::str_longest_common_prefix(string $str1, string $str2): string {}

/**
 * 获取两个字符串之间的最长公共子串
 * @param string $str1 第一个字符串
 * @param string $str2 第二个字符串
 * @return string 最长公共子串
 */
StrHelper::utf8()::str_longest_common_substring(string $str1, string $str2): string {}

/**
 * 获取两个字符串之间的最长公共后缀
 * @param string $str1 第一个字符串
 * @param string $str2 第二个字符串
 * @return string 最长公共后缀
 */
StrHelper::utf8()::str_longest_common_suffix(string $str1, string $str2): string {}

/**
 * 检查字符串是否与指定模式匹配
 * @param string $str 输入的字符串
 * @param string $pattern 模式
 * @return bool 如果匹配返回 true，否则返回 false
 */
StrHelper::utf8()::str_matches_pattern(string $str, string $pattern): bool {}

/**
 * 对字符串进行模糊化处理
 * @param string $str 输入的字符串
 * @return string 模糊化后的字符串
 */
StrHelper::utf8()::str_obfuscate(string $str): string {}

/**
 * 检查给定的偏移量是否存在于字符串中
 * @param string $str 输入的字符串
 * @param int $offset 偏移量
 * @return bool 如果存在返回 true，否则返回 false
 */
StrHelper::utf8()::str_offset_exists(string $str, int $offset): bool {}

/**
 * 获取字符串中给定偏移量处的字符
 * @param string $str 输入的字符串
 * @param int $offset 偏移量
 * @return string 获取到的字符
 */
StrHelper::utf8()::str_offset_get(string $str, int $offset): string {}

/**
 * 使用字符串填充输入字符串到指定长度
 * @param string $str 输入的字符串
 * @param int $pad_length 指定的长度
 * @param string $pad_string 填充的字符串
 * @param int $pad_type 填充的类型（STR_PAD_RIGHT, STR_PAD_LEFT, or STR_PAD_BOTH）
 * @return string 填充后的字符串
 */
StrHelper::utf8()::str_pad(string $str, int $pad_length, string $pad_string = ' ', int $pad_type = STR_PAD_RIGHT): string {}

/**
 * 在字符串两侧添加字符以达到指定长度
 * @param string $str 输入的字符串
 * @param int $length 指定的长度
 * @param string $pad_string 填充的字符串
 * @return string 填充后的字符串
 */
StrHelper::utf8()::str_pad_both(string $str, int $length, string $pad_string = ' '): string {}

/**
 * 在字符串左侧添加字符以达到指定长度
 * @param string $str 输入的字符串
 * @param int $length 指定的长度
 * @param string $pad_string 填充的字符串
 * @return string 填充后的字符串
 */
StrHelper::utf8()::str_pad_left(string $str, int $length, string $pad_string = ' '): string {}

/**
 * 在字符串右侧添加字符以达到指定长度
 * @param string $str 输入的字符串
 * @param int $length 指定的长度
 * @param string $pad_string 填充的字符串
 * @return string 填充后的字符串
 */
StrHelper::utf8()::str_pad_right(string $str, int $length, string $pad_string = ' '): string {}

/**
 * 重复字符串
 * @param string $str 输入的字符串
 * @param int $multiplier 重复次数
 * @return string 重复后的字符串
 */
StrHelper::utf8()::str_repeat(string $str, int $multiplier): string {}

/**
 * 替换字符串开始部分的子串
 * @param string $str 输入的字符串
 * @param string $search 要查找的子串
 * @param string $replace 替换内容
 * @return string 替换后的字符串
 */
StrHelper::utf8()::str_replace_beginning(string $str, string $search, string $replace): string {}

/**
 * 替换字符串结尾部分的子串
 * @param string $str 输入的字符串
 * @param string $search 要查找的子串
 * @param string $replace 替换内容
 * @return string 替换后的字符串
 */
StrHelper::utf8()::str_replace_ending(string $str, string $search, string $replace): string {}

/**
 * 替换字符串中的第一个指定子串
 * @param string $str 输入的字符串
 * @param string $search 要查找的子串
 * @param string $replace 替换内容
 * @return string 替换后的字符串
 */
StrHelper::utf8()::str_replace_first(string $str, string $search, string $replace): string {}

/**
 * 替换字符串中的最后一个指定子串
 * @param string $str 输入的字符串
 * @param string $search 要查找的子串
 * @param string $replace 替换内容
 * @return string 替换后的字符串
 */
StrHelper::utf8()::str_replace_last(string $str, string $search, string $replace): string {}

/**
 * 随机打乱字符串中的字符
 * @param string $str 输入的字符串
 * @return string 打乱后的字符串
 */
StrHelper::utf8()::str_shuffle(string $str): string {}

/**
 * 截取字符串的一部分
 * @param string $str 输入的字符串
 * @param int $start 开始位置
 * @param int $length 截取长度
 * @return string 截取的字符串
 */
StrHelper::utf8()::str_slice(string $str, int $start, int $length): string {}

/**
 * 将字符串转换为蛇形命名
 * @param string $str 输入的字符串
 * @return string 转换后的字符串
 */
StrHelper::utf8()::str_snakeize(string $str): string {}

/**
 * 对字符串中的字符进行排序
 * @param string $str 输入的字符串
 * @return string 排序后的字符串
 */
StrHelper::utf8()::str_sort(string $str): string {}

/**
 * 将字符串分割为数组
 * @param string $str 输入的字符串
 * @param int $length 每个数组元素的长度
 * @return array 分割后的字符串数组
 */
StrHelper::utf8()::str_split(string $str, int $length = 1): array {}

/**
 * 根据指定的数组分割字符串
 * @param string $str 输入的字符串
 * @param array $array 分割依据的数组
 * @return array 分割后的字符串数组
 */
StrHelper::utf8()::str_split_array(string $str, array $array): array {}

/**
 * 根据指定的模式分割字符串
 * @param string $str 输入的字符串
 * @param string $pattern 分割依据的模式
 * @return array 分割后的字符串数组
 */
StrHelper::utf8()::str_split_pattern(string $str, string $pattern): array {}

/**
 * 检查字符串是否以指定子串开始
 * @param string $str 输入的字符串
 * @param string $substring 子串
 * @return bool 如果以指定子串开始返回 true，否则返回 false
 */
StrHelper::utf8()::str_starts_with(string $str, string $substring): bool {}

/**
 * 检查字符串是否以任一指定子串开始
 * @param string $str 输入的字符串
 * @param array $substrings 子串数组
 * @return bool 如果以任一指定子串开始返回 true，否则返回 false
 */
StrHelper::utf8()::str_starts_with_any(string $str, array $substrings): bool {}

/**
 * 在字符串中查找第一个分隔符之后的子串
 * @param string $str 输入的字符串
 * @param string $separator 分隔符
 * @return string 查找到的子串
 */
StrHelper::utf8()::str_substr_after_first_separator(string $str, string $separator): string {}

/**
 * 在字符串中查找最后一个分隔符之后的子串
 * @param string $str 输入的字符串
 * @param string $separator 分隔符
 * @return string 查找到的子串
 */
StrHelper::utf8()::str_substr_after_last_separator(string $str, string $separator): string {}

/**
 * 在字符串中查找第一个分隔符之前的子串
 * @param string $str 输入的字符串
 * @param string $separator 分隔符
 * @return string 查找到的子串
 */
StrHelper::utf8()::str_substr_before_first_separator(string $str, string $separator): string {}

/**
 * 在字符串中查找最后一个分隔符之前的子串
 * @param string $str 输入的字符串
 * @param string $separator 分隔符
 * @return string 查找到的子串
 */
StrHelper::utf8()::str_substr_before_last_separator(string $str, string $separator): string {}

/**
 * 获取字符串中的第一个子串
 * @param string $str 输入的字符串
 * @param string $substring 子串
 * @return string 查找到的第一个子串
 */
StrHelper::utf8()::str_substr_first(string $str, string $substring): string {}

/**
 * 获取字符串中的最后一个子串
 * @param string $str 输入的字符串
 * @param string $substring 子串
 * @return string 查找到的最后一个子串
 */
StrHelper::utf8()::str_substr_last(string $str, string $substring): string {}

/**
 * 在字符串两侧添加字符
 * @param string $str 输入的字符串
 * @param string $substring 添加的子串
 * @return string 添加后的字符串
 */
StrHelper::utf8()::str_surround(string $str, string $substring): string {}

/**
 * 将字符串转换为标题形式
 * @param string $str 输入的字符串
 * @return string 转换后的字符串
 */
StrHelper::utf8()::str_titleize(string $str): string {}

/**
 * 将字符串转换为适合人类阅读的标题形式
 * @param string $str 输入的字符串
 * @return string 转换后的字符串
 */
StrHelper::utf8()::str_titleize_for_humans(string $str): string {}

/**
 * 将字符串转换为二进制格式
 * @param string $str 输入的字符串
 * @return string 转换后的二进制字符串
 */
StrHelper::utf8()::str_to_binary(string $str): string {}

/**
 * 将字符串按行分割为数组
 * @param string $str 输入的字符串
 * @return array 分割后的数组
 */
StrHelper::utf8()::str_to_lines(string $str): array {}

/**
 * 将字符串按单词分割为数组
 * @param string $str 输入的字符串
 * @return array 分割后的数组
 */
StrHelper::utf8()::str_to_words(string $str): array {}

/**
 * 截断字符串至指定长度
 * @param string $str 输入的字符串
 * @param int $limit 截断长度
 * @return string 截断后的字符串
 */
StrHelper::utf8()::str_truncate(string $str, int $limit): string {}

/**
 * 安全地截断字符串至指定长度，不破坏单词
 * @param string $str 输入的字符串
 * @param int $limit 截断长度
 * @return string 截断后的字符串
 */
StrHelper::utf8()::str_truncate_safe(string $str, int $limit): string {}

/**
 * 将字符串转换为下划线形式
 * @param string $str 输入的字符串
 * @return string 转换后的字符串
 */
StrHelper::utf8()::str_underscored(string $str): string {}

/**
 * 将字符串转换为UpperCamelCase形式
 * @param string $str 输入的字符串
 * @return string 转换后的字符串
 */
StrHelper::utf8()::str_upper_camelize(string $str): string {}

/**
 * 计算字符串中的单词数量
 * @param string $str 输入的字符串
 * @return int 单词数量
 */
StrHelper::utf8()::str_word_count(string $str): int {}

/**
 * 比较两个字符串（不区分大小写）
 * @param string $str1 第一个字符串
 * @param string $str2 第二个字符串
 * @return int 比较结果
 */
StrHelper::utf8()::strcasecmp(string $str1, string $str2): int {}

/**
 * 比较两个字符串
 * @param string $str1 第一个字符串
 * @param string $str2 第二个字符串
 * @return int 比较结果
 */
StrHelper::utf8()::strcmp(string $str1, string $str2): int {}

/**
 * 计算字符串中字符集合的长度
 * @param string $str 输入的字符串
 * @param string $charlist 字符集合
 * @return int 长度
 */
StrHelper::utf8()::strcspn(string $str, string $charlist): int {}

/**
 * 创建一个字符串实例
 * @param string $str 输入的字符串
 * @return StrHelper 字符串实例
 */
StrHelper::utf8()::string(string $str): StrHelper {}

/**
 * 检查字符串是否包含BOM（字节顺序标记）
 * @param string $str 输入的字符串
 * @return bool 如果包含返回 true，否则返回 false
 */
StrHelper::utf8()::string_has_bom(string $str): bool {}

/**
 * 去除字符串中的HTML标签
 * @param string $str 输入的字符串
 * @return string 去除HTML后的字符串
 */
StrHelper::utf8()::strip_tags(string $str): string {}

/**
 * 去除字符串中的空白字符
 * @param string $str 输入的字符串
 * @return string 去除空白后的字符串
 */
StrHelper::utf8()::strip_whitespace(string $str): string {}

/**
 * 查找字符串首次出现的位置（不区分大小写）
 * @param string $haystack 主字符串
 * @param string $needle 需要查找的字符串
 * @return int|false 首次出现的位置，如果没有找到则返回false
 */
StrHelper::utf8()::stripos(string $haystack, string $needle): int|false {}

/**
 * 在字节级别查找字符串首次出现的位置（不区分大小写）
 * @param string $haystack 主字符串
 * @param string $needle 需要查找的字符串
 * @return int|false 首次出现的位置，如果没有找到则返回false
 */
StrHelper::utf8()::stripos_in_byte(string $haystack, string $needle): int|false {}

/**
 * 查找字符串首次出现的位置（不区分大小写）
 * @param string $haystack 主字符串
 * @param string $needle 需要查找的字符串
 * @return string|false 首次出现的字符串，如果没有找到则返回false
 */
StrHelper::utf8()::stristr(string $haystack, string $needle): string|false {}

/**
 * 计算字符串长度
 * @param string $str 输入的字符串
 * @return int 字符串长度
 */
StrHelper::utf8()::strlen(string $str): int {}

/**
 * 在字节级别计算字符串长度
 * @param string $str 输入的字符串
 * @return int 字符串长度
 */
StrHelper::utf8()::strlen_in_byte(string $str): int {}

/**
 * 使用自然排序算法比较两个字符串（不区分大小写）
 * @param string $str1 第一个字符串
 * @param string $str2 第二个字符串
 * @return int 比较结果
 */
StrHelper::utf8()::strnatcasecmp(string $str1, string $str2): int {}

/**
 * 使用自然排序算法比较两个字符串
 * @param string $str1 第一个字符串
 * @param string $str2 第二个字符串
 * @return int 比较结果
 */
StrHelper::utf8()::strnatcmp(string $str1, string $str2): int {}

/**
 * 比较两个字符串前n个字符（不区分大小写）
 * @param string $str1 第一个字符串
 * @param string $str2 第二个字符串
 * @param int $len 比较的长度
 * @return int 比较结果
 */
StrHelper::utf8()::strncasecmp(string $str1, string $str2, int $len): int {}

/**
 * 比较两个字符串前n个字符
 * @param string $str1 第一个字符串
 * @param string $str2 第二个字符串
 * @param int $len 长度
 * @return int 比较结果
 */
StrHelper::utf8()::strncmp(string $str1, string $str2, int $len): int {}

/**
 * 在字符串中查找一组字符的任何一个字符
 * @param string $haystack 主字符串
 * @param string $charlist 字符列表
 * @return string|false 返回找到的字符或false
 */
StrHelper::utf8()::strpbrk(string $haystack, string $charlist): string|false {}

// ... 其他方法

/**
 * 将字符串转换为utf8编码
 * @param string $str 输入字符串
 * @return string 转换后的字符串
 */
StrHelper::utf8()::to_utf8(string $str): string {}

/**
 * 将字符串转换为utf8字符串表示
 * @param string $str 输入字符串
 * @return string 转换后的字符串表示
 */
StrHelper::utf8()::to_utf8_string(string $str): string {}

/**
 * 去除字符串两端的空白字符
 * @param string $str 输入字符串
 * @return string 去除空白后的字符串
 */
StrHelper::utf8()::trim(string $str): string {}

/**
 * 将字符串的首字母转换为大写
 * @param string $str 输入字符串
 * @return string 首字母大写的字符串
 */
StrHelper::utf8()::ucfirst(string $str): string {}

/**
 * 将字符串中每个单词的首字母转换为大写
 * @param string $str 输入字符串
 * @return string 每个单词首字母大写的字符串
 */
StrHelper::utf8()::ucwords(string $str): string {}

/**
 * 解码URL编码的字符串
 * @param string $str 输入字符串
 * @return string 解码后的字符串
 */
StrHelper::utf8()::urldecode(string $str): string {}

/**
 * 将utf8字符串解码为ISO-8859-1
 * @param string $str 输入字符串
 * @return string 解码后的字符串
 */
StrHelper::utf8()::utf8_decode(string $str): string {}

/**
 * 将ISO-8859-1字符串编码为utf8
 * @param string $str 输入字符串
 * @return string 编码后的字符串
 */
StrHelper::utf8()::utf8_encode(string $str): string {}

/**
 * 获取所有可能的空白字符的表
 * @return array 空白字符的数组表
 */
StrHelper::utf8()::whitespace_table(): array {}

/**
 * 限制字符串中的单词数量
 * @param string $str 输入字符串
 * @param int $limit 单词数量限制
 * @return string 限制单词数量后的字符串
 */
StrHelper::utf8()::words_limit(string $str, int $limit): string {}

/**
 * 对字符串进行自动换行处理
 * @param string $str 输入字符串
 * @param int $width 换行宽度
 * @return string 自动换行后的字符串
 */
StrHelper::utf8()::wordwrap(string $str, int $width): string {}

/**
 * 对字符串进行每行自动换行处理
 * @param string $str 输入字符串
 * @param int $width 换行宽度
 * @return string 每行自动换行后的字符串
 */
StrHelper::utf8()::wordwrap_per_line(string $str, int $width): string {}

/**
 * 处理字符串中的空白字符
 * @param string $str 输入字符串
 * @return string 处理后的字符串
 */
StrHelper::utf8()::ws(string $str): string {}

```

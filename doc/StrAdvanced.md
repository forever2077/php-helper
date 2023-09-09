## 字符串 Str（Advanced）

```php
/**
 * 返回特定字符串后面出现的字符串部分
 * @param string $string 分隔字符串
 * @return static 返回分隔字符串后的新字符串
 * @example s('宮本 茂')->after('本'); // 返回 ' 茂'
 */
StrHelper::string()->after(string $string): static {}

/**
 * 获取分隔符第一次出现后的子字符串
 * @param string $separator 分隔符
 * @return static 如果找不到匹配项，则返回新的空Stringy对象
 * @example s('')->afterFirst('b'); // 返回 '>'
 */
StrHelper::string()->afterFirst(string $separator): static {}

/**
 * 获取分隔符第一次出现后的子字符串（不区分大小写）
 * @param string $separator 分隔符
 * @return static 如果找不到匹配项，则返回新的空Stringy对象
 */
StrHelper::string()->afterFirstIgnoreCase(string $separator): static {}

/**
 * 获取分隔符最后一次出现后的子字符串
 * @param string $separator 分隔符
 * @return static 如果找不到匹配项，则返回新的空Stringy对象
 */
StrHelper::string()->afterLast(string $separator): static {}

/**
 * 获取分隔符最后一次出现后的子字符串（不区分大小写）
 * @param string $separator 分隔符
 * @return static 如果找不到匹配项，则返回新的空Stringy对象
 */
StrHelper::string()->afterLastIgnoreCase(string $separator): static {}

/**
 * 在字符串末尾追加内容
 * @param string $string 追加的字符串
 * @return static 返回追加后的新字符串
 */
StrHelper::string()->append(string $string): static {}

/**
 * 在字符串末尾追加密码
 * @param string $password 密码字符串
 * @return static 返回追加密码后的新字符串
 */
StrHelper::string()->appendPassword(string $password): static {}

// ... 上面的部分代码

/**
 * 在字符串末尾追加随机字符串
 * @param int $length 随机字符串的长度
 * @return static 返回追加随机字符串后的新字符串
 */
StrHelper::string()->appendRandomString(int $length): static {}

/**
 * 在字符串末尾追加Stringy对象
 * @param Stringy $stringy Stringy对象
 * @return static 返回追加Stringy对象后的新字符串
 */
StrHelper::string()->appendStringy(Stringy $stringy): static {}

/**
 * 在字符串末尾追加唯一标识符
 * @return static 返回追加唯一标识符后的新字符串
 */
StrHelper::string()->appendUniqueIdentifier(): static {}

/**
 * 获取字符串中指定索引处的字符
 * @param int $index 字符的索引
 * @return static 返回指定索引处的字符
 */
StrHelper::string()->at(int $index): static {}

/**
 * 对字符串进行Base64解码
 * @return static 返回Base64解码后的字符串
 */
StrHelper::string()->base64Decode(): static {}

/**
 * 对字符串进行Base64编码
 * @return static 返回Base64编码后的字符串
 */
StrHelper::string()->base64Encode(): static {}

/**
 * 对字符串进行bcrypt加密
 * @return static 返回bcrypt加密后的字符串
 */
StrHelper::string()->bcrypt(): static {}

/**
 * 获取字符串中指定子串之前的内容
 * @param string $substring 指定的子串
 * @return static 返回指定子串之前的内容
 */
StrHelper::string()->before(string $substring): static {}

/**
 * 获取字符串中第一个指定子串之前的内容
 * @param string $substring 指定的子串
 * @return static 返回第一个指定子串之前的内容
 */
StrHelper::string()->beforeFirst(string $substring): static {}

/**
 * 获取字符串中第一个指定子串之前的内容（不区分大小写）
 * @param string $substring 指定的子串
 * @return static 返回第一个指定子串之前的内容（不区分大小写）
 */
StrHelper::string()->beforeFirstIgnoreCase(string $substring): static {}

/**
 * 获取字符串中最后一个指定子串之前的内容
 * @param string $substring 指定的子串
 * @return static 返回最后一个指定子串之前的内容
 */
StrHelper::string()->beforeLast(string $substring): static {}

/**
 * 获取字符串中最后一个指定子串之前的内容（不区分大小写）
 * @param string $substring 指定的子串
 * @return static 返回最后一个指定子串之前的内容（不区分大小写）
 */
StrHelper::string()->beforeLastIgnoreCase(string $substring): static {}

/**
 * 获取字符串中两个指定子串之间的内容
 * @param string $start 开始的子串
 * @param string $end 结束的子串
 * @return static 返回两个指定子串之间的内容
 */
StrHelper::string()->between(string $start, string $end): static {}

/**
 * 对字符串进行用户自定义函数操作
 * @param callable $function 用户自定义函数
 * @return static 返回用户自定义函数处理后的字符串
 */
StrHelper::string()->callUserFunction(callable $function): static {}

/**
 * 将字符串转换为驼峰命名
 * @return static 返回驼峰命名的字符串
 */
StrHelper::string()->camelize(): static {}

/**
 * 将字符串中的名字进行首字母大写处理
 * @return static 返回首字母大写的名字字符串
 */
StrHelper::string()->capitalizePersonalName(): static {}

/**
 * 获取字符串中所有的字符
 * @return array 返回包含所有字符的数组
 */
StrHelper::string()->chars(): array {}

/**
 * 将字符串分割成等长的子串
 * @param int $length 每个子串的长度
 * @return static 返回分割后的字符串数组
 */
StrHelper::string()->chunk(int $length): static {}

/**
 * 将字符串分割成等长的子串，并返回集合
 * @param int $length 每个子串的长度
 * @return Collection 返回包含所有子串的集合
 */
StrHelper::string()->chunkCollection(int $length): Collection {}

/**
 * 去除字符串中多余的空白字符
 * @return static 返回去除多余空白后的字符串
 */
StrHelper::string()->collapseWhitespace(): static {}

/**
 * 检查字符串是否包含指定的子串
 * @param string $substring 指定的子串
 * @return bool 返回是否包含指定子串
 */
StrHelper::string()->contains(string $substring): bool {}

/**
 * 检查字符串是否包含所有指定的子串
 * @param array $substrings 指定的子串数组
 * @return bool 返回是否包含所有指定子串
 */
StrHelper::string()->containsAll(array $substrings): bool {}

/**
 * 检查字符串是否包含任何指定的子串
 * @param array $substrings 指定的子串数组
 * @return bool 返回是否包含任何指定子串
 */
StrHelper::string()->containsAny(array $substrings): bool {}

/**
 * 检查字符串是否包含字节顺序标记（BOM）
 * @return bool 返回是否包含BOM
 */
StrHelper::string()->containsBom(): bool {}

/**
 * 计算字符串中字符的数量
 * @return int 返回字符数量
 */
StrHelper::string()->count(): int {}

/**
 * 计算字符串中指定子串的出现次数
 * @param string $substring 指定的子串
 * @return int 返回指定子串的出现次数
 */
StrHelper::string()->countSubstr(string $substring): int {}

/**
 * 计算字符串的CRC32校验和
 * @return int 返回CRC32校验和
 */
StrHelper::string()->crc32(): int {}

/**
 * 创建一个新的Stringy对象
 * @param string $string 创建Stringy对象的字符串
 * @return static 返回新的Stringy对象
 */
StrHelper::string()->create(string $string): static {}

/**
 * 对字符串进行crypt加密
 * @return static 返回crypt加密后的字符串
 */
StrHelper::string()->crypt(): static {}

/**
 * 将字符串转换为破折号连接
 * @return static 返回破折号连接的字符串
 */
StrHelper::string()->dasherize(): static {}

/**
 * 对字符串进行解密
 * @return static 返回解密后的字符串
 */
StrHelper::string()->decrypt(): static {}

/**
 * 使用指定的分隔符连接字符串中的字符
 * @param string $delimiter 指定的分隔符
 * @return static 返回使用分隔符连接的字符串
 */
StrHelper::string()->delimit(string $delimiter): static {}

/**
 * 对字符串进行编码处理
 * @return static 返回编码后的字符串
 */
StrHelper::string()->encode(): static {}

/**
 * 对字符串进行加密
 * @return static 返回加密后的字符串
 */
StrHelper::string()->encrypt(): static {}

/**
 * 检查字符串是否以指定的子串结尾
 * @param string $substring 指定的子串
 * @return bool 返回是否以指定子串结尾
 */
StrHelper::string()->endsWith(string $substring): bool {}

/**
 * 检查字符串是否以任何指定的子串结尾
 * @param array $substrings 指定的子串数组
 * @return bool 返回是否以任何指定子串结尾
 */
StrHelper::string()->endsWithAny(array $substrings): bool {}

/**
 * 确保字符串以指定的子串开头
 * @param string $substring 指定的子串
 * @return static 返回确保以指定子串开头的字符串
 */
StrHelper::string()->ensureLeft(string $substring): static {}

/**
 * 确保字符串以指定的子串结尾
 * @param string $substring 指定的子串
 * @return static 返回确保以指定子串结尾的字符串
 */
StrHelper::string()->ensureRight(string $substring): static {}

/**
 * 对字符串中的特殊字符进行转义
 * @return static 返回转义后的字符串
 */
StrHelper::string()->escape(): static {}

/**
 * 使用指定的分隔符分割字符串
 * @param string $delimiter 指定的分隔符
 * @return array 返回分割后的字符串数组
 */
StrHelper::string()->explode(string $delimiter): array {}

/**
 * 使用指定的分隔符分割字符串，并返回集合
 * @param string $delimiter 指定的分隔符
 * @return Collection 返回包含所有分割子串的集合
 */
StrHelper::string()->explodeCollection(string $delimiter): Collection {}

/**
 * 从字符串中提取所有整数
 * @return array 返回包含所有整数的数组
 */
StrHelper::string()->extractIntegers(): array {}

/**
 * 从字符串中提取所有特殊字符
 * @return array 返回包含所有特殊字符的数组
 */
StrHelper::string()->extractSpecialCharacters(): array {}

/**
 * 从字符串中提取文本内容
 * @return static 返回提取后的文本内容
 */
StrHelper::string()->extractText(): static {}

/**
 * 获取字符串的第一个字符
 * @return static 返回第一个字符
 */
StrHelper::string()->first(): static {}

/**
 * 使用指定的格式化字符串格式化当前字符串
 * @param string $format 格式化字符串
 * @return static 返回格式化后的字符串
 */
StrHelper::string()->format(string $format): static {}

/**
 * 获取字符串的编码
 * @return string 返回字符串的编码
 */
StrHelper::string()->getEncoding(): string {}

/**
 * 获取迭代器用于遍历字符串的每一个字符
 * @return Iterator 返回字符迭代器
 */
StrHelper::string()->getIterator(): Iterator {}

/**
 * 对字符串进行硬换行处理
 * @return static 返回硬换行后的字符串
 */
StrHelper::string()->hardWrap(): static {}

/**
 * 检查字符串是否包含小写字母
 * @return bool 返回是否包含小写字母
 */
StrHelper::string()->hasLowerCase(): bool {}

/**
 * 检查字符串是否包含大写字母
 * @return bool 返回是否包含大写字母
 */
StrHelper::string()->hasUpperCase(): bool {}

/**
 * 计算字符串的哈希值
 * @return string 返回哈希值
 */
StrHelper::string()->hash(): string {}

/**
 * 对字符串进行十六进制解码
 * @return static 返回十六进制解码后的字符串
 */
StrHelper::string()->hexDecode(): static {}

/**
 * 对字符串进行十六进制编码
 * @return static 返回十六进制编码后的字符串
 */
StrHelper::string()->hexEncode(): static {}

/**
 * 对字符串进行HTML解码
 * @return static 返回HTML解码后的字符串
 */
StrHelper::string()->htmlDecode(): static {}

/**
 * 对字符串进行HTML编码
 * @return static 返回HTML编码后的字符串
 */
StrHelper::string()->htmlEncode(): static {}

/**
 * 使字符串更适合人类阅读
 * @return static 返回更适合人类阅读的字符串
 */
StrHelper::string()->humanize(): static {}

/**
 * 检查字符串是否在指定的范围内
 * @param string $range 指定的范围
 * @return bool 返回是否在指定范围内
 */
StrHelper::string()->in(string $range): bool {}

/**
 * 返回指定子串首次出现的位置
 * @param string $substring 指定的子串
 * @return int|bool 返回首次出现的位置或false
 */
StrHelper::string()->indexOf(string $substring) {}

/**
 * 返回指定子串首次出现的位置（不区分大小写）
 * @param string $substring 指定的子串
 * @return int|bool 返回首次出现的位置或false
 */
StrHelper::string()->indexOfIgnoreCase(string $substring) {}

/**
 * 返回指定子串最后一次出现的位置
 * @param string $substring 指定的子串
 * @return int|bool 返回最后一次出现的位置或false
 */
StrHelper::string()->indexOfLast(string $substring) {}

/**
 * 返回指定子串最后一次出现的位置（不区分大小写）
 * @param string $substring 指定的子串
 * @return int|bool 返回最后一次出现的位置或false
 */
StrHelper::string()->indexOfLastIgnoreCase(string $substring) {}

/**
 * 在指定的位置插入子串
 * @param string $substring 要插入的子串
 * @param int $position 插入的位置
 * @return static 返回插入子串后的新字符串
 */
StrHelper::string()->insert(string $substring, int $position): static {}

/**
 * 检查字符串是否符合给定的模式
 * @param string $pattern 要检查的模式
 * @return bool 返回是否符合模式
 */
StrHelper::string()->is(string $pattern): bool {}

/**
 * 检查字符串是否只包含字母
 * @return bool 返回是否只包含字母
 */
StrHelper::string()->isAlpha(): bool {}

/**
 * 检查字符串是否只包含字母和数字
 * @return bool 返回是否只包含字母和数字
 */
StrHelper::string()->isAlphanumeric(): bool {}

/**
 * 检查字符串是否为ASCII
 * @return bool 返回是否为ASCII
 */
StrHelper::string()->isAscii(): bool {}

/**
 * 检查字符串是否为Base64编码
 * @return bool 返回是否为Base64编码
 */
StrHelper::string()->isBase64(): bool {}

/**
 * 检查字符串是否为二进制
 * @return bool 返回是否为二进制
 */
StrHelper::string()->isBinary(): bool {}

/**
 * 检查字符串是否为空白
 * @return bool 返回是否为空白
 */
StrHelper::string()->isBlank(): bool {}

/**
 * 检查字符串是否包含字节顺序标记（BOM）
 * @return bool 返回是否包含BOM
 */
StrHelper::string()->isBom(): bool {}

/**
 * 检查字符串是否为有效的电子邮件地址
 * @return bool 返回是否为有效的电子邮件地址
 */
StrHelper::string()->isEmail(): bool {}

/**
 * 检查字符串是否为空
 * @return bool 返回是否为空
 */
StrHelper::string()->isEmpty(): bool {}

/**
 * 检查字符串是否等于给定的字符串（不区分大小写）
 * @param string $string 给定的字符串
 * @return bool 返回是否等于给定的字符串
 */
StrHelper::string()->isEqualsCaseInsensitive(string $string): bool {}

/**
 * 检查字符串是否等于给定的字符串（区分大小写）
 * @param string $string 给定的字符串
 * @return bool 返回是否等于给定的字符串
 */
StrHelper::string()->isEqualsCaseSensitive(string $string): bool {}

/**
 * 检查字符串是否为十六进制
 * @return bool 返回是否为十六进制
 */
StrHelper::string()->isHexadecimal(): bool {}

/**
 * 检查字符串是否为HTML
 * @return bool 返回是否为HTML
 */
StrHelper::string()->isHtml(): bool {}

/**
 * 检查字符串是否为JSON格式
 * @return bool 返回是否为JSON格式
 */
StrHelper::string()->isJson(): bool {}

/**
 * 检查字符串是否全部为小写
 * @return bool 返回是否全部为小写
 */
StrHelper::string()->isLowerCase(): bool {}

/**
 * 检查字符串是否不为空
 * @return bool 返回是否不为空
 */
StrHelper::string()->isNotEmpty(): bool {}

/**
 * 检查字符串是否为数字
 * @return bool 返回是否为数字
 */
StrHelper::string()->isNumeric(): bool {}

/**
 * 检查字符串是否为可打印字符
 * @return bool 返回是否为可打印字符
 */
StrHelper::string()->isPrintable(): bool {}

/**
 * 检查字符串是否包含标点符号
 * @return bool 返回是否包含标点符号
 */
StrHelper::string()->isPunctuation(): bool {}

/**
 * 检查字符串是否为序列化字符串
 * @return bool 返回是否为序列化字符串
 */
StrHelper::string()->isSerialized(): bool {}

/**
 * 检查字符串是否与给定字符串相似
 * @param string $string 给定的字符串
 * @return bool 返回是否与给定字符串相似
 */
StrHelper::string()->isSimilar(string $string): bool {}

/**
 * 检查字符串是否全部为大写
 * @return bool 返回是否全部为大写
 */
StrHelper::string()->isUpperCase(): bool {}

/**
 * 检查字符串是否为有效的URL
 * @return bool 返回是否为有效的URL
 */
StrHelper::string()->isUrl(): bool {}

/**
 * 检查字符串是否为UTF-8编码
 * @return bool 返回是否为UTF-8编码
 */
StrHelper::string()->isUtf8(): bool {}

/**
 * 检查字符串是否为UTF-16编码
 * @return bool 返回是否为UTF-16编码
 */
StrHelper::string()->isUtf16(): bool {}

/**
 * 检查字符串是否为UTF-32编码
 * @return bool 返回是否为UTF-32编码
 */
StrHelper::string()->isUtf32(): bool {}

/**
 * 检查字符串是否只包含空白字符
 * @return bool 返回是否只包含空白字符
 */
StrHelper::string()->isWhitespace(): bool {}

/**
 * 返回字符串的JSON序列化表示
 * @return string 返回JSON序列化表示
 */
StrHelper::string()->jsonSerialize(): string {}

/**
 * 将字符串转换为kebab-case（短横线分隔）
 * @return static 返回转换后的字符串
 */
StrHelper::string()->kebabCase(): static {}

/**
 * 获取字符串的最后一个字符
 * @return static 返回最后一个字符
 */
StrHelper::string()->last(): static {}

/**
 * 返回字符串中最后一个指定子串的位置
 * @param string $substring 要查找的子串
 * @return int|bool 返回最后一个子串的位置或false
 */
StrHelper::string()->lastSubstringOf(string $substring) {}

/**
 * 返回字符串中最后一个指定子串的位置（不区分大小写）
 * @param string $substring 要查找的子串
 * @return int|bool 返回最后一个子串的位置或false
 */
StrHelper::string()->lastSubstringOfIgnoreCase(string $substring) {}

/**
 * 返回字符串的长度
 * @return int 返回字符串的长度
 */
StrHelper::string()->length(): int {}

/**
 * 对字符串进行行包装
 * @param int $width 指定行宽
 * @return static 返回行包装后的字符串
 */
StrHelper::string()->lineWrap(int $width): static {}

/**
 * 在单词后进行行包装
 * @param int $width 指定行宽
 * @return static 返回行包装后的字符串
 */
StrHelper::string()->lineWrapAfterWord(int $width): static {}

/**
 * 获取字符串中的所有行
 * @return array 返回包含所有行的数组
 */
StrHelper::string()->lines(): array {}

/**
 * 获取字符串中的所有行（作为集合返回）
 * @return Collection 返回包含所有行的集合
 */
StrHelper::string()->linesCollection(): Collection {}

/**
 * 获取字符串与另一个字符串的最长公共前缀
 * @param string $other 另一个字符串
 * @return static 返回最长公共前缀
 */
StrHelper::string()->longestCommonPrefix(string $other): static {}

/**
 * 获取字符串与另一个字符串的最长公共子串
 * @param string $other 另一个字符串
 * @return static 返回最长公共子串
 */
StrHelper::string()->longestCommonSubstring(string $other): static {}

/**
 * 获取字符串与另一个字符串的最长公共后缀
 * @param string $other 另一个字符串
 * @return static 返回最长公共后缀
 */
StrHelper::string()->longestCommonSuffix(string $other): static {}

/**
 * 将字符串的首字母转换为小写
 * @return static 返回首字母转换为小写的字符串
 */
StrHelper::string()->lowerCaseFirst(): static {}

/**
 * 使用不区分大小写的匹配查找子串
 * @param string $pattern 要匹配的模式
 * @return array 返回所有匹配的子串
 */
StrHelper::string()->matchCaseInsensitive(string $pattern): array {}

/**
 * 使用区分大小写的匹配查找子串
 * @param string $pattern 要匹配的模式
 * @return array 返回所有匹配的子串
 */
StrHelper::string()->matchCaseSensitive(string $pattern): array {}

/**
 * 对字符串进行MD5哈希
 * @return static 返回MD5哈希后的字符串
 */
StrHelper::string()->md5(): static {}

/**
 * 将字符串中的新行字符转换为HTML换行标签
 * @return static 返回转换后的字符串
 */
StrHelper::string()->newLineToHtmlBreak(): static {}

/**
 * 返回字符串中的第n个字符
 * @param int $n 第n个字符的位置
 * @return static 返回第n个字符
 */
StrHelper::string()->nth(int $n): static {}

/**
 * 检查指定的偏移量是否存在
 * @param int $offset 偏移量
 * @return bool 返回是否存在
 */
StrHelper::string()->offsetExists(int $offset): bool {}

/**
 * 获取指定偏移量上的字符
 * @param int $offset 偏移量
 * @return static 返回指定偏移量上的字符
 */
StrHelper::string()->offsetGet(int $offset): static {}

/**
 * 设置指定偏移量上的字符
 * @param int $offset 偏移量
 * @param string $value 要设置的值
 */
StrHelper::string()->offsetSet(int $offset, string $value): void {}

/**
 * 删除指定偏移量上的字符
 * @param int $offset 偏移量
 */
StrHelper::string()->offsetUnset(int $offset): void {}

/**
 * 用指定字符填充字符串
 * @param int $length 目标长度
 * @param string $padStr 填充字符
 * @return static 返回填充后的字符串
 */
StrHelper::string()->pad(int $length, string $padStr = ' '): static {}

/**
 * 在字符串两侧用指定字符填充
 * @param int $length 目标长度
 * @param string $padStr 填充字符
 * @return static 返回填充后的字符串
 */
StrHelper::string()->padBoth(int $length, string $padStr = ' '): static {}

/**
 * 在字符串左侧用指定字符填充
 * @param int $length 目标长度
 * @param string $padStr 填充字符
 * @return static 返回填充后的字符串
 */
StrHelper::string()->padLeft(int $length, string $padStr = ' '): static {}

/**
 * 在字符串右侧用指定字符填充
 * @param int $length 目标长度
 * @param string $padStr 填充字符
 * @return static 返回填充后的字符串
 */
StrHelper::string()->padRight(int $length, string $padStr = ' '): static {}

/**
 * 将字符串转换为PascalCase（首字母大写的驼峰式）
 * @return static 返回转换后的字符串
 */
StrHelper::string()->pascalCase(): static {}

/**
 * 在字符串前面添加指定字符串
 * @param string $string 要添加的字符串
 * @return static 返回添加后的字符串
 */
StrHelper::string()->prepend(string $string): static {}

/**
 * 在字符串前面添加另一个Stringy对象
 * @param Object $stringy Stringy对象
 * @return static 返回添加后的字符串
 */
StrHelper::string()->prependStringy(Object $stringy): static {}

/**
 * 使用正则表达式替换字符串中的内容
 * @param string $pattern 正则表达式
 * @param string $replacement 替换的内容
 * @return static 返回替换后的字符串
 */
StrHelper::string()->regexReplace(string $pattern, string $replacement): static {}

/**
 * 从字符串中删除HTML标签
 * @return static 返回删除HTML后的字符串
 */
StrHelper::string()->removeHtml(): static {}

/**
 * 从字符串中删除HTML换行标签
 * @return static 返回删除HTML换行后的字符串
 */
StrHelper::string()->removeHtmlBreak(): static {}

/**
 * 从字符串中删除左侧指定的子串
 * @param string $substring 要删除的子串
 * @return static 返回删除后的字符串
 */
StrHelper::string()->removeLeft(string $substring): static {}

/**
 * 从字符串中删除右侧指定的子串
 * @param string $substring 要删除的子串
 * @return static 返回删除后的字符串
 */
StrHelper::string()->removeRight(string $substring): static {}

/**
 * 从字符串中删除XSS攻击代码
 * @return static 返回删除XSS攻击代码后的字符串
 */
StrHelper::string()->removeXss(): static {}

/**
 * 重复字符串指定次数
 * @param int $multiplier 重复次数
 * @return static 返回重复后的字符串
 */
StrHelper::string()->repeat(int $multiplier): static {}

/**
 * 替换字符串中的子串
 * @param string $search 要查找的子串
 * @param string $replace 要替换的子串
 * @return static 返回替换后的字符串
 */
StrHelper::string()->replace(string $search, string $replace): static {}

/**
 * 替换字符串中所有指定的子串
 * @param array $searchReplaceMap 键值对数组，键为要查找的子串，值为要替换的子串
 * @return static 返回替换后的字符串
 */
StrHelper::string()->replaceAll(array $searchReplaceMap): static {}

/**
 * 替换字符串开始的子串
 * @param string $search 要查找的子串
 * @param string $replace 要替换的子串
 * @return static 返回替换后的字符串
 */
StrHelper::string()->replaceBeginning(string $search, string $replace): static {}

/**
 * 替换字符串结尾的子串
 * @param string $search 要查找的子串
 * @param string $replace 要替换的子串
 * @return static 返回替换后的字符串
 */
StrHelper::string()->replaceEnding(string $search, string $replace): static {}

/**
 * 替换字符串中第一次出现的指定子串
 * @param string $search 要查找的子串
 * @param string $replace 要替换的子串
 * @return static 返回替换后的字符串
 */
StrHelper::string()->replaceFirst(string $search, string $replace): static {}

/**
 * 替换字符串中最后一次出现的指定子串
 * @param string $search 要查找的子串
 * @param string $replace 要替换的子串
 * @return static 返回替换后的字符串
 */
StrHelper::string()->replaceLast(string $search, string $replace): static {}

/**
 * 反转字符串
 * @return static 返回反转后的字符串
 */
StrHelper::string()->reverse(): static {}

/**
 * 安全地截断字符串，确保不会截断单词
 * @param int $length 截断长度
 * @return static 返回截断后的字符串
 */
StrHelper::string()->safeTruncate(int $length): static {}

/**
 * 设置内部编码
 * @param string $encoding 编码类型
 */
StrHelper::string()->setInternalEncoding(string $encoding): void {}

/**
 * 对字符串进行SHA-1哈希
 * @return static 返回SHA-1哈希后的字符串
 */
StrHelper::string()->sha1(): static {}

/**
 * 对字符串进行SHA-256哈希
 * @return static 返回SHA-256哈希后的字符串
 */
StrHelper::string()->sha256(): static {}

/**
 * 对字符串进行SHA-512哈希
 * @return static 返回SHA-512哈希后的字符串
 */
StrHelper::string()->sha512(): static {}

/**
 * 在单词后截断字符串
 * @param int $length 截断长度
 * @return static 返回截断后的字符串
 */
StrHelper::string()->shortenAfterWord(int $length): static {}

/**
 * 随机打乱字符串中的字符
 * @return static 返回打乱后的字符串
 */
StrHelper::string()->shuffle(): static {}

/**
 * 计算与另一个字符串的相似度
 * @param string $other 另一个字符串
 * @return float 返回相似度百分比
 */
StrHelper::string()->similarity(string $other): float {}

/**
 * 截取字符串的一部分
 * @param int $start 开始位置
 * @param int $end 结束位置
 * @return static 返回截取的字符串
 */
StrHelper::string()->slice(int $start, int $end): static {}

/**
 * 将字符串转换为URL友好的形式
 * @return static 返回URL友好的字符串
 */
StrHelper::string()->slugify(): static {}

/**
 * 将字符串转换为snake_case（蛇形命名）
 * @return static 返回转换后的字符串
 */
StrHelper::string()->snakeCase(): static {}

/**
 * 将字符串转换为snake_case（蛇形命名）（别名）
 * @return static 返回转换后的字符串
 */
StrHelper::string()->snakeize(): static {}

/**
 * 执行软换行，保留单词完整性
 * @param int $width 每行的最大字符数
 * @return static 返回执行软换行后的字符串
 */
StrHelper::string()->softWrap(int $width): static {}

/**
 * 使用指定分隔符拆分字符串
 * @param string $delimiter 分隔符
 * @return static 返回拆分后的字符串数组
 */
StrHelper::string()->split(string $delimiter): static {}

/**
 * 使用指定分隔符拆分字符串并返回集合
 * @param string $delimiter 分隔符
 * @return static 返回拆分后的字符串集合
 */
StrHelper::string()->splitCollection(string $delimiter): static {}

/**
 * 检查字符串是否以指定子串开头
 * @param string $substring 子串
 * @return bool 返回是否以指定子串开头
 */
StrHelper::string()->startsWith(string $substring): bool {}

/**
 * 检查字符串是否以任何给定的子串开头
 * @param array $substrings 子串数组
 * @return bool 返回是否以任何给定的子串开头
 */
StrHelper::string()->startsWithAny(array $substrings): bool {}

/**
 * 去除字符串中所有HTML标签
 * @return static 返回去除HTML标签后的字符串
 */
StrHelper::string()->strip(): static {}

/**
 * 去除字符串中的所有空白
 * @return static 返回去除空白后的字符串
 */
StrHelper::string()->stripWhitespace(): static {}

/**
 * 去除CSS中的所有媒体查询
 * @return static 返回去除媒体查询后的字符串
 */
StrHelper::string()->stripeCssMediaQueries(): static {}

/**
 * 去除HTML中的所有空标签
 * @return static 返回去除空标签后的字符串
 */
StrHelper::string()->stripeEmptyHtmlTags(): static {}

/**
 * 将字符串转换为StudlyCase
 * @return static 返回转换为StudlyCase后的字符串
 */
StrHelper::string()->studlyCase(): static {}

/**
 * 返回字符串的子串
 * @param int $start 开始位置
 * @param int $length 长度
 * @return static 返回子串
 */
StrHelper::string()->substr(int $start, int $length): static {}

/**
 * 返回字符串中的子串
 * @param string $start 开始位置的子串
 * @param string $end 结束位置的子串
 * @return static 返回子串
 */
StrHelper::string()->substring(string $start, string $end): static {}

/**
 * 返回字符串中第一次出现的指定子串
 * @param string $substring 子串
 * @return static 返回第一次出现的指定子串
 */
StrHelper::string()->substringOf(string $substring): static {}

/**
 * 忽略大小写，返回字符串中第一次出现的指定子串
 * @param string $substring 子串
 * @return static 返回第一次出现的指定子串
 */
StrHelper::string()->substringOfIgnoreCase(string $substring): static {}

/**
 * 使用指定字符串包围当前字符串
 * @param string $substring 要包围的字符串
 * @return static 返回包围后的字符串
 */
StrHelper::string()->surround(string $substring): static {}

/**
 * 交换字符串中的大小写
 * @return static 返回大小写交换后的字符串
 */
StrHelper::string()->swapCase(): static {}

/**
 * 整理字符串，清除不必要的空白和字符
 * @return static 返回整理后的字符串
 */
StrHelper::string()->tidy(): static {}

/**
 * 将字符串转换为标题形式
 * @return static 返回转换为标题形式的字符串
 */
StrHelper::string()->titleize(): static {}

/**
 * 将字符串转换为适合人类阅读的标题形式
 * @return static 返回适合人类阅读的标题形式的字符串
 */
StrHelper::string()->titleizeForHumans(): static {}

/**
 * 将字符串转换为ASCII形式
 * @return static 返回转换为ASCII的字符串
 */
StrHelper::string()->toAscii(): static {}

/**
 * 将字符串转换为布尔值
 * @return bool 返回转换后的布尔值
 */
StrHelper::string()->toBoolean(): bool {}

/**
 * 将字符串转换为小写
 * @return static 返回转换为小写的字符串
 */
StrHelper::string()->toLowerCase(): static {}

/**
 * 将字符串中的制表符转换为空格
 * @return static 返回转换后的字符串
 */
StrHelper::string()->toSpaces(): static {}

/**
 * 将对象转换为字符串
 * @return string 返回转换后的字符串
 */
StrHelper::string()->toString(): string {}

/**
 * 将字符串中的空格转换为制表符
 * @return static 返回转换后的字符串
 */
StrHelper::string()->toTabs(): static {}

/**
 * 将字符串转换为标题大小写
 * @return static 返回转换为标题大小写的字符串
 */
StrHelper::string()->toTitleCase(): static {}

/**
 * 将字符串转录为 ASCII
 * @return static 返回转录后的字符串
 */
StrHelper::string()->toTransliterate(): static {}

/**
 * 将字符串转换为大写
 * @return static 返回转换为大写的字符串
 */
StrHelper::string()->toUpperCase(): static {}

/**
 * 去除字符串两端的空白
 * @return static 返回去除两端空白的字符串
 */
StrHelper::string()->trim(): static {}

/**
 * 去除字符串左侧的空白
 * @return static 返回去除左侧空白的字符串
 */
StrHelper::string()->trimLeft(): static {}

/**
 * 去除字符串右侧的空白
 * @return static 返回去除右侧空白的字符串
 */
StrHelper::string()->trimRight(): static {}

/**
 * 截断字符串到指定长度
 * @param int $length 指定长度
 * @return static 返回截断后的字符串
 */
StrHelper::string()->truncate(int $length): static {}

/**
 * 将字符串转换为下划线形式
 * @return static 返回转换为下划线形式的字符串
 */
StrHelper::string()->underscored(): static {}

/**
 * 将字符串转换为 UpperCamelize 形式
 * @return static 返回转换为 UpperCamelize 的字符串
 */
StrHelper::string()->upperCamelize(): static {}

/**
 * 将字符串的首字母转换为大写
 * @return static 返回首字母大写的字符串
 */
StrHelper::string()->upperCaseFirst(): static {}

/**
 * 对字符串进行 URL 解码
 * @return static 返回 URL 解码后的字符串
 */
StrHelper::string()->urlDecode(): static {}

/**
 * 对字符串进行多次 URL 解码
 * @return static 返回多次 URL 解码后的字符串
 */
StrHelper::string()->urlDecodeMulti(): static {}

/**
 * 对字符串进行原始 URL 解码
 * @return static 返回原始 URL 解码后的字符串
 */
StrHelper::string()->urlDecodeRaw(): static {}

/**
 * 对字符串进行多次原始 URL 解码
 * @return static 返回多次原始 URL 解码后的字符串
 */
StrHelper::string()->urlDecodeRawMulti(): static {}

/**
 * 对字符串进行 URL 编码
 * @return static 返回 URL 编码后的字符串
 */
StrHelper::string()->urlEncode(): static {}

/**
 * 对字符串进行原始 URL 编码
 * @return static 返回原始 URL 编码后的字符串
 */
StrHelper::string()->urlEncodeRaw(): static {}

/**
 * 将字符串转换为 URL 友好的形式
 * @return static 返回 URL 友好的字符串
 */
StrHelper::string()->urlify(): static {}

/**
 * 将字符串转换为 UTF-8 编码
 * @return static 返回转换为 UTF-8 编码的字符串
 */
StrHelper::string()->utf8ify(): static {}

/**
 * 获取字符串中的所有单词
 * @return static 返回包含所有单词的字符串数组
 */
StrHelper::string()->words(): static {}

/**
 * 获取字符串中的所有单词并返回集合
 * @return static 返回包含所有单词的字符串集合
 */
StrHelper::string()->wordsCollection(): static {}

/**
 * 对字符串进行换行处理
 * @return static 返回换行处理后的字符串
 */
StrHelper::string()->wrap(): static {}

文档 https://github.com/voku/Stringy
```

```php
$arr = ArrayHelper::create([...]);
$arr->unique()
    ->reverse()
    ->implode(',');

文档 https://github.com/voku/Arrayy
```

```php
// 添加新值（可选使用点符号表示法）
add(mixed $value, int|string|null $key): static

// 将（键）+ 值追加到当前数组
append(mixed $value, mixed $key): $this

// 将（键）+ 值追加到当前数组
appendArrayValues(array $values, mixed $key): $this

// 将（键）+ 值追加到当前数组
appendImmutable(mixed $value, mixed $key): $this

// 为每个键添加后缀
appendToEachKey(int|string $prefix): static

// 为每个值添加前缀
appendToEachValue(float|int|string $prefix): static

// 以相反的顺序对数组进行排序并保持索引关联
arsort(): $this

// 以相反的顺序对数组进行排序并保持索引关联
arsortImmutable(): $this

// 按值对条目进行排序
asort(int $sort_flags): $this

// 按值对条目进行排序
asortImmutable(int $sort_flags): $this

// 遍历当前数组，并对每个循环执行回调
at(\Closure $closure): static

// 返回当前数组的平均值
average(int $decimals): float|int

// 更改数组中的所有键
changeKeyCase(int $case): static

// 更改数组包装器的路径分隔符
changeSeparator(string $separator): $this

// 创建当前数组的分块版本
chunk(int $size, bool $preserveKeys): static|static[]

// 从当前数组中清除所有假值
clean(): static

// 清除当前完整数组或其中的 $key
clear(int|int[]|string|string[]|null $key): $this

// 检查项目是否在当前数组中
contains(float|int|string $value, bool $recursive, bool $strict): bool

// 检查（不区分大小写）字符串是否在当前数组中
containsCaseInsensitive(mixed $value, bool $recursive): bool

// 检查给定的键/索引是否存在于数组中
containsKey(int|string $key): bool

// 检查数组中是否存在所有给定的键/索引
containsKeys(array $needles, bool $recursive): bool

// 检查数组中是否存在所有给定的键/索引
containsKeysRecursive(array $needles): bool

// 检查项目是否在当前数组中
containsOnly(float|int|string $value, bool $recursive, bool $strict): bool

// 别名：用于 "Arrayy->contains()"
containsValue(float|int|string $value): bool

// 别名：用于 "Arrayy->contains($value, true)"
containsValueRecursive(float|int|string $value): bool

// 检查数组中是否存在所有给定的值
containsValues(array $needles): bool

// 计算数组中的所有元素或对象中的某些内容
count(int $mode): int

// 计算数组的所有值
countValues(): static

// 创建一个 Arrayy 对象
create(mixed $data, string $iteratorClass, bool $checkPropertiesInConstructor): static

// 警告：通过引用创建一个 Arrayy 对象
createByReference(array $array): $this

// 通过 JSON 创建一个新的 Arrayy 对象
createFromArray(array $array): static

// 从可调用函数创建一个新实例，该函数将返回一个生成器
createFromGeneratorFunction(callable $generatorFunction): static

// 创建一个新实例，其中包含来自 "Generator" 对象的值副本
createFromGeneratorImmutable(\Generator $generator): static

// 通过 JSON 创建一个新的 Arrayy 对象
createFromJson(string $json): static

// 通过 JSON 创建一个新的 Arrayy 对象
createFromJsonMapper(string $json): static

// 创建一个新实例，其中包含来自可迭代对象的值
createFromObject(\Traversable $object): static

// 创建一个新实例，其中包含来自对象的值
createFromObjectVars(object $object): static

// 通过字符串创建一个新的 Arrayy 对象
createFromString(string $str, string|null $delimiter, string|null $regEx): static

// 创建一个新实例，其中包含来自 "Traversable" 对象的值副本
createFromTraversableImmutable(\Traversable $traversable, bool $use_keys): static

// 创建一个包含一系列元素的新实例
createWithRange(float|int|string $low, float|int|string $high, float|int $step): static

// 获取数组中当前内部迭代器位置的元素
current(): false|mixed

// 通过 "uksort" 自定义按索引排序
customSortKeys(callable $callable): $this

// 通过 "uksort" 自定义按索引排序
customSortKeysImmutable(callable $callable): $this

// 通过 "usort" 自定义按值排序
customSortValues(callable $callable): $this

// 通过 "usort" 自定义按值排序
customSortValuesImmutable(callable $callable): $this

// 删除给定的键或键
delete(int|int[]|string|string[] $keyOrKeys): void

// 返回仅在当前数组中存在的值元素
diff(array $array): static

// 返回仅在当前数组中存在的键元素
diffKey(array $array): static

// 返回仅在当前数组中存在的值和键元素
diffKeyAndValue(array $array): static

// 返回仅在当前多维数组中存在的值元素
diffRecursive(array $array, array|\Generator|null $helperVariableForRecursion): static

// 返回仅在新 $array 中存在的值元素
diffReverse(array $array): static

// 将数组分成两个数组，一个包含键，另一个包含值
divide(): static

// 遍历当前数组并修改数组的值
each(\Closure $closure): static

// 将内部迭代器设置为数组中的最后一个元素，并返回此元素
end(): false|mixed

// 将数组替换为另一个数组
exchangeArray(array|mixed|static $data): array

// 使用闭包检查当前数组中是否存在值
exists(\Closure $closure): bool

// 将数组填充到 "$num" 以包含 "$default" 值
fillWithDefaults(int $num, mixed $default): static

// 查找通过真值测试的数组中的所有项目
filter(\Closure|null $closure, int $flag): static

// 根据其中一个属性的值过滤对象数组（或关联数组的数值数组）
filterBy(string $property, mixed $value, string|null $comparisonOp): static

// 查找通过真值测试的数组中的第一个项目，否则返回 false
find(\Closure $closure): false|mixed

// 根据其中一个属性的值过滤对象数组（或关联数组的数值数组）
findBy(string $property, mixed $value, string $comparisonOp): static

// 从当前数组中获取第一个值
first(): mixed|null

// 从当前数组中获取第一个键
firstKey(): mixed|null

// 从当前数组中获取第一个值（值）
firstsImmutable(int|null $number): static

// 从当前数组中获取第一个值（值）
firstsKeys(int|null $number): static

// 获取并移除当前数组中的第一个值（值）
firstsMutable(int|null $number): $this

// 使用给定的字符作为键分隔符来扁平化数组
flatten(string $delimiter, string $prepend, array|null $items): array

// 交换数组中所有键和它们关联的值
flip(): static

// 从数组中获取一个值（可选使用点符号表示法）
get(int|string $key, mixed $fallback, array|null $array, bool $useByReference): mixed|static

// 别名：用于 "Arrayy->toArray()"
getAll(): array

// 创建 ArrayyObject 的副本
getArrayCopy(): array

// 从 "Arrayy"-对象中获取当前数组作为生成器
getBackwardsGenerator(): Generator

// 返回输入数组的单个列的值，由 $columnKey 标识，可用于从多维数组中提取数据列
// INFO: 可选地，您可以提供一个 $indexKey，以通过输入数组中 $indexKey 列的值来索引返回的数组中的值
getColumn(int|string|null $columnKey, int|string|null $indexKey): static

// 获取当前数组的标志
getFlags(): int

// 从 "Arrayy"-对象中获取当前数组作为生成器
getGenerator(): Generator

// 从 "Arrayy"-对象中获取当前数组作为引用生成器
getGeneratorByReference(): Generator

// 返回一个新的迭代器，从而实现 \Iterator 接口
getIterator(): Iterator<mixed,mixed>

// 获取 ArrayObject 的迭代器类名
getIteratorClass(): string

// 别名：用于 "Arrayy->keys()"
getKeys(): static

// 从 "Arrayy"-对象中获取当前数组作为列表
getList(bool $convertAllArrayyElements): array

// 从 "Arrayy"-对象中获取当前数组作为对象
getObject(): stdClass

// 获取所有值
getValues(): static

// 通过生成器获取所有值
getValuesYield(): Generator

// 根据闭包的结果对数组中的值进行分组
group(callable|int|string $grouper, bool $saveKeys): static

// 检查数组是否具有给定的键
has(mixed $key): bool

// 检查数组是否具有给定的值
hasValue(mixed $value): bool

// 将数组的值连接成字符串
implode(string $glue, string $prefix): string

// 将数组的键连接成字符串
implodeKeys(string $glue): string

// 给定一个列表和一个返回列表中每个元素的键的迭代函数（或属性名称），
// 返回一个具有每个项目索引的对象
indexBy(int|string $key): static

// 别名：用于 "Arrayy->searchIndex()"
indexOf(mixed $value): false|int|string

// 获取除最后 $to 个项目之外的所有项目
initial(int $to): static

// 返回一个包含在输入数组中找到的所有元素的数组
intersection(array $search, bool $keepKeys): static

// 返回一个包含在输入数组中找到的所有元素的数组
intersectionMulti(array $array): static

// 返回一个布尔标志，指示两个输入数组是否具有任何共同的元素
intersects(array $search): bool

// 在数组的所有值上调用函数
invoke(callable $callable, mixed $arguments): static

// 检查数组是否是关联数组
isAssoc(bool $recursive): bool

// 检查给定的键或键是否为空
isEmpty(int|int[]|string|string[]|null $keys): bool

// 检查当前数组是否等于给定的 "$array"
isEqual(array $array): bool

// 检查当前数组是否是多维数组
isMultiArray(): bool

// 检查数组是否为数值数组
isNumeric(): bool

// 检查当前数组是否是连续数组 [0, 1, 2, 3, 4, 5 ...]
isSequential(bool $recursive): bool

// 返回一个具有当前数组的 JSON 表示形式的数组
jsonSerialize(): array

// 获取当前内部迭代器位置的键/索引
key(): int|string|null

// 检查提供的数组中是否存在给定的键
// INFO：此方法仅在使用 "array_key_exists()" 时使用，
// 如果要使用 "点" 符号表示法，则需要使用 "Arrayy->offsetExists()"
keyExists(int|string $key): bool

// 从当前数组中获取所有键
keys(bool $recursive, mixed|null $search_values, bool $strict): static

// 按键以逆序排序数组
krsort(int $sort_flags): $this

// 按键以逆序排序数组
krsortImmutable(int $sort_flags): $this

// 按键排序条目
ksort(int $sort_flags): $this

// 按键排序条目
ksortImmutable(int $sort_flags): $this

// 从当前数组中获取最后一个值
last(): mixed|null

// 从当前数组中获取最后一个键
lastKey(): mixed|null

// 从当前数组中获取最后一个值（值）
lastsImmutable(int|null $number): static

// 从当前数组中获取最后一个值（值）
lastsMutable(int|null $number): $this

// 计算当前数组的值数量
length(int $mode): int

// 将给定函数应用于数组的每个元素，收集结果
map(callable $callable, bool $useKeyAsSecondParameter, mixed $arguments): static

// 检查当前数组中的所有项是否符合真值测试
matches(\Closure $closure): bool

// 检查当前数组中是否有任何项符合真值测试
matchesAny(\Closure $closure): bool

// 从数组中获取最大值
max(): false|float|int|string

// 将新的 $array 合并到当前数组中
mergeAppendKeepIndex(array $array, bool $recursive): static

// 将新的 $array 合并到当前数组中
mergeAppendNewIndex(array $array, bool $recursive): static

// 将当前数组合并到 $array 中
mergePrependKeepIndex(array $array, bool $recursive): static

// 将当前数组合并到新的 $array 中
mergePrependNewIndex(array $array, bool $recursive): static

// 从数组中获取最小值
min(): false|mixed

// 从数组中获取最常用的值
mostUsedValue(): mixed|null

// 从数组中获取最常用的值
mostUsedValues(int|null $number): static

// 将数组元素移动到新索引
moveElement(int|string $from, int $to): static

// 将数组元素移动到第一个位置
moveElementToFirstPlace(int|string $key): static

// 将数组元素移动到最后一个位置
moveElementToLastPlace(int|string $key): static

// 使用不区分大小写的 "自然顺序" 算法对数组进行排序
natcasesort(): $this

// 使用不区分大小写的 "自然顺序" 算法对数组进行排序
natcasesortImmutable(): $this

// 使用 "自然顺序" 算法对条目进行排序
natsort(): $this

// 使用 "自然顺序" 算法对条目进行排序
natsortImmutable(): $this

// 将内部迭代器位置移动到下一个元素并返回该元素
next(): false|mixed

// 从数组中获取下一个 nth 个键和值
nth(int $step, int $offset): static

// 检查偏移是否存在
offsetExists(bool|int|string $offset): bool

// 返回指定偏移处的值
offsetGet(int|string $offset): mixed

// 将值分配给指定的偏移 + 检查类型
offsetSet(int|string|null $offset, mixed $value): void

// 取消设置偏移
offsetUnset(int|string $offset): void

// 从给定的数组中获取子集项目
only(int[]|string[] $keys): static

// 使用给定值填充数组到指定大小
pad(int $size, mixed $value): static

// 根据谓词将数组分为两个数组
partition(\Closure $closure): array<int,static>

// 在当前数组的前面添加（键）+ 值
prepend(mixed $value, mixed $key): $this

// 在当前数组的前面添加（键）+ 值
prependImmutable(mixed $value, mixed $key): $this

// 为每个键添加后缀
prependToEachKey(float|int|string $suffix): static

// 为每个值添加后缀
prependToEachValue(float|int|string $suffix): static

// 返回给定键的值并删除该键
pull(int|int[]|string|string[]|null $keyOrKeys, mixed $fallback): mixed

// 一次将一个或多个值推送到数组的末尾
push(mixed $args): $this

// 从当前数组中获取一个随机值
randomImmutable(int|null $number): static

// 从此数组的键中选择一个随机键/索引
randomKey(): mixed|null

// 从此数组中选择给定数量的随机键/索引
randomKeys(int $number): static

// 从当前数组中获取一个随机值
randomMutable(int|null $number): $this

// 从此数组的值中选择一个随机值
randomValue(): mixed

// 从此数组中选择给定数量的随机值
randomValues(int $number): static

// 通过可调用函数（例如匿名函数）减少当前数组并返回最终结果
randomWeighted(array $array, int $number):reduce(callable $callable, mixed $initial): static

// 从当前数组中删除一个值（可选使用点表示法）
remove(mixed $key): static

// 别名：用于 "Arrayy->removeValue()"
removeElement(mixed $element): static

// 从当前数组中删除第一个值
removeFirst(): static

// 从当前数组中删除最后一个值
removeLast(): static

// 从数组（数字或关联数组）中删除特定值
removeValue(mixed $value): static

// 生成重复数组
repeat(int $times): static

// 用新的键/值对替换一个键
replace(mixed $oldKey, mixed $newKey, mixed $newValue): static

// 使用当前数组作为键和其他数组作为值创建数组
replaceAllValues(array $array): static

// 替换数组中的第一个匹配值
replaceOneValue(mixed $search, mixed $replacement): static

// 替换当前数组中的值
replaceValues(string $search, string $replacement): static

// 从索引 $from 到数组末尾获取最后的元素
rest(int $from): static

// 返回数组的逆序
reverse(): $this

// 返回带有逆序键的数组
reverseKeepIndex(): $this

// 将数组按逆序排序
rsort(int $sort_flags): $this

// 将数组按逆序排序
rsortImmutable(int $sort_flags): $this

// 通过 $value 搜索当前数组的第一个索引
searchIndex(mixed $value): false|int|string

// 通过 $index 搜索当前数组的值
searchValue(mixed $index): static

// 序列化当前的 "Arrayy" 对象
serialize(): string

// 设置当前数组的值（可选使用点表示法）
set(string $key, mixed $value): $this

// 从数组中获取一个值并在必要时设置它
setAndGet(mixed $key, mixed $fallback): mixed

// 设置当前 "Arrayy" 对象的迭代器类名
setIteratorClass(string $iteratorClass): void

// 从数组的开头移除一个指定的值
shift(): mixed|null

// 随机打乱当前数组
shuffle(bool $secure, array|null $array): static

// 计算当前数组的值数量
size(int $mode): int

// 检查数组是否具有完全 $size 个项目
sizeIs(int $size): bool

// 检查数组是否具有从 $fromSize 到 $toSize 个项目$toSize 可以小于 $fromSize
sizeIsBetween(int $fromSize, int $toSize): bool

// 检查数组是否具有超过 $size 个项目
sizeIsGreaterThan(int $size): bool

// 检查数组是否具有少于 $size 个项目
sizeIsLessThan(int $size): bool

// 计算数组中的所有元素，或者对象中的某些元素
sizeRecursive(): int

// 提取数组的一个切片
slice(int $offset, int|null $length, bool $preserveKeys): static

// 对当前数组进行排序，可选保留键
sort(int|string $direction, int $strategy, bool $keepKeys): static

// 对当前数组进行排序，可选保留键
sortImmutable(int|string $direction, int $strategy, bool $keepKeys): static

// 按键对当前数组进行排序
sortKeys(int|string $direction, int $strategy): $this

// 按键对当前数组进行排序
sortKeysImmutable(int|string $direction, int $strategy): $this

// 按值对当前数组进行排序
sortValueKeepIndex(int|string $direction, int $strategy): static

// 按值对当前数组进行排序
sortValueNewIndex(int|string $direction, int $strategy): static

// 使用值或闭包对数组进行排序
sorter(callable|mixed|null $sorter, int|string $direction, int $strategy): static

// 删除所有空项
stripEmpty(): static

// 通过键交换两个位置的值
swap(int|string $swapA, int|string $swapB): static

// 从 "Arrayy" 对象中获取当前数组
toArray(bool $convertAllArrayyElements, bool $preserveKeys): array

// 将当前数组转换为 JSON
toJson(int $options, int $depth): string

// 从 "Arrayy" 对象中获取当前数组作为列表
toList(bool $convertAllArrayyElements): array

// 使用指定的分隔符将数组转换为字符串
toString(string $separator): string

// 使用用户定义的比较函数对条目进行排序，并保持键关联
uasort(callable $callable): $this

// 使用用户定义的比较函数对条目进行排序，并保持键关联
uasortImmutable(callable $callable): $this

// 使用用户定义的比较函数按键对条目进行排序
uksort(callable $callable): static

// 使用用户定义的比较函数按键对条目进行排序
uksortImmutable(callable $callable): static

// 别名：用于 "Arrayy->uniqueNewIndex()"
unique(): static

// 返回当前数组的去重副本（带有旧键）
uniqueKeepIndex(): $this

// 返回当前数组的去重副本
uniqueNewIndex(): $this

// 反序列化字符串并返回 "Arrayy" 类的实例
unserialize(string $string): $this

// 一次在数组的开头添加一个或多个值
unshift(mixed $args): $this

// 测试给定闭包是否对该数组的所有元素都返回有效结果
validate(\Closure $closure): bool

// 获取数组的所有值
values(): static

// 将给定函数应用于数组中的每个元素，并丢弃结果
walk(callable $callable, bool $recursive, mixed $userData): $this

// 返回匹配项目的集合
where(string $keyOrPropertyOrMethod, mixed $value): static
```

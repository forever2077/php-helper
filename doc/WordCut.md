## 中文分词 chinese Word Segmentation

```php
$this->assertEquals(['你好', '中国'], WordCutHelper::cut('你好中国'));
$this->assertEquals(['你', '你好', '好', '中', '中国', '国'], WordCutHelper::cutAll('你好中国'));
$this->assertEquals(['你好', '中国'], WordCutHelper::cutForSearch('你好中国'));

array cut(string $sentence, bool $hmm = true)
array cutAll(string $sentence)
array cutForSearch(string $sentence, bool $hmm = true)
array TFIDFExtract(string $sentence, int $topK = 20, array $allowedPOS = [])
array textRankExtract(string $sentence, int $topK = 20, array $allowedPOS = [])
array tokenize(string $sentence, string $mode = 'default', bool $hmm = true)
array tag(string $sentence, bool $hmm = true)
int   suggestFrequency(string $segment)
self  addWord(string $word, ?int $frequency = null, ?string $tag = null)
self  useDictionary(string $path)

安装 composer require forever2077/jieba-php
```

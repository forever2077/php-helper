## 敏感词过滤器 Sensitive

```php
// DFA算法过滤器
$handle = SensitiveHelper::dfa($wordData = []);
$handle->islegal($badWord);
$handle->replace($badWord, '*', true);
$handle->replace($badWord, '***');
$handle->mark($badWord, '<mark>', '</mark>');
$handle->getBadWord($badWord)[0];
文档 https://github.com/FireLustre/php-dfa-sensitive

// AC算法过滤器
$handle = SensitiveHelper::ac($wordData = []);
$handle->add('...');
$handle->finalize();
$found = $handle->search($badWord);
文档 https://github.com/codeplea/ahocorasickphp
```
<?php

namespace Helpful;

use LanguageDetection\{Language, Tokenizer\TokenizerInterface, Trainer};

class LanguageHelper
{
    /**
     * 语言检测
     * 该函数用于检测给定字符串中的语言。可以通过选项数组来自定义行为
     * @param string $str 待检测的字符串
     * @param array $options 选项数组，包括：
     *    - 'whitelist' (array): 白名单中的语言将被优先考虑
     *    - 'blacklist' (array): 黑名单中的语言将被排除
     *    - 'bestResults' (bool): 如果为true，只返回最佳匹配结果
     *    - 'offset' (int): 结果数组的偏移量
     *    - 'length' (int): 返回结果的最大数量
     * @return array 返回检测到的语言信息数组
     */
    public static function detection(string $str, array $options = []): array
    {
        $options['whitelist'] = $options['whitelist'] ?? [];
        $options['blacklist'] = $options['blacklist'] ?? [];
        $options['bestResults'] = $options['bestResults'] ?? false;
        $options['offset'] = $options['offset'] ?? 0;
        $options['length'] = $options['length'] ?? 10;

        $ld = new Language();
        $lang = $ld->detect($str);

        if (!empty($options['whitelist']) && is_array($options['whitelist'])) {
            $lang->whitelist($options['whitelist']);
        }

        if (!empty($options['blacklist']) && is_array($options['blacklist'])) {
            $lang->blacklist($options['blacklist']);
        }

        if ($options['bestResults']) {
            return $lang->bestResults()->close();
        } else {
            if (isset($options['offset']) && isset($options['length'])) {
                return $lang->limit($options['offset'], $options['length'])->close();
            } else {
                return $lang->close();
            }
        }
    }

    /**
     * 训练语言文本
     * 该函数用于基于指定目录中的文本数据进行语言模型训练
     * @param string $dirname 存储训练文本数据的目录名
     * @param array $options 选项数组，包括：
     *    - 'tokenizer' (TokenizerInterface): 自定义的分词器实例
     *    - 'maxNgrams' (int): 设置最大N-gram值
     * @return void 无返回值
     */
    public static function trainer(string $dirname = '', array $options = []): void
    {
        $options['tokenizer'] = $options['tokenizer'] ?? null;
        $options['maxNgrams'] = $options['maxNgrams'] ?? 9000;

        $t = new Trainer();

        if ($options['tokenizer'] instanceof TokenizerInterface) {
            $t->setTokenizer($options['tokenizer']);
        }

        if (is_int($options['maxNgrams'])) {
            $t->setMaxNgrams($options['maxNgrams']);
        }

        $t->learn($dirname);
    }
}
<?php

namespace Forever2077\PhpHelper\Validation;

trait Custom
{
    /**
     * 检查文件名是否符合 Windows 和 Linux 系统的命名规范
     * @param string $filename 待检查的文件名
     * @param bool $replaceInvalid 是否替换不合规范的字符
     * @param array $options 其他选项，包括自定义的替换字符、无效字符和保留名称
     * @return string|array|bool        如果 $replaceInvalid 为 true，返回替换后的文件名；
     *                                  否则，如果文件名合规返回 true，不合规返回 false。
     */
    public static function isValidFilename(string $filename, bool $replaceInvalid = false, array $options = []): string|array|bool
    {
        // 设置替换字符，默认为空字符串
        $replaceChar = $options['replaceChar'] ?? '_';
        // 自定义保留名称，默认为空数组
        $customReserved = $options['customReserved'] ?? [];
        // 自定义无效字符，默认为空字符串
        $customInvalidChars = $options['customInvalidChars'] ?? '';

        // 合并内置和自定义无效字符
        $invalidChars = '\/:*?"<>|' . $customInvalidChars;
        // 合并内置和自定义保留名称
        $reservedNames = array_merge([
            'CON', 'PRN', 'AUX', 'NUL',
            'COM1', 'COM2', 'COM3', 'COM4', 'COM5', 'COM6', 'COM7', 'COM8', 'COM9',
            'LPT1', 'LPT2', 'LPT3', 'LPT4', 'LPT5', 'LPT6', 'LPT7', 'LPT8', 'LPT9',
        ], $customReserved);

        // 如果设置了替换非法字符
        if ($replaceInvalid) {
            $filename = str_replace(str_split($invalidChars), $replaceChar, $filename);
        } else {
            // 检查是否包含非法字符
            if (preg_match("/[" . preg_quote($invalidChars, '/') . "]/", $filename)) {
                return false;
            }
        }

        // 检查文件名长度
        if (strlen($filename) == 0 || strlen($filename) > 255) {
            return false;
        }

        // 检查是否是保留名称
        if (in_array(strtoupper($filename), $reservedNames)) {
            return false;
        }

        // 如果设置了替换非法字符，则返回替换后的文件名，否则返回 true
        return $replaceInvalid ? $filename : true;
    }
}
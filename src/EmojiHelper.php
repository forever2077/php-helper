<?php

namespace Helpful;

use Helpful\Emoji\Data;

/**
 * @link https://github.com/iamcal/php-emoji
 * @link https://github.com/iamcal/emoji-data
 */
class EmojiHelper
{
    public static function docomo2unified($text): array|string
    {
        return self::convert($text, 'docomo_to_unified');
    }

    public static function kddi2unified($text): array|string
    {
        return self::convert($text, 'kddi_to_unified');
    }

    public static function softbank2unified($text): array|string
    {
        return self::convert($text, 'softbank_to_unified');
    }

    public static function google2unified($text): array|string
    {
        return self::convert($text, 'google_to_unified');
    }

    public static function unified2docomo($text): array|string
    {
        return self::convert($text, 'unified_to_docomo');
    }

    public static function unified2kddi($text): array|string
    {
        return self::convert($text, 'unified_to_kddi');
    }

    public static function unified2softbank($text): array|string
    {
        return self::convert($text, 'unified_to_softbank');
    }

    public static function unified2google($text): array|string
    {
        return self::convert($text, 'unified_to_google');
    }

    public static function unified2html($text): array|string|null
    {
        return preg_replace_callback(Data::toArray('unified_rx'), function ($m) {
            if (isset($m[2]) && $m[2] == "\xEF\xB8\x8E") {
                return $m[0];
            }
            $cp = Data::toArray('unified_to_html')[$m[1]];
            return "<span class=\"emoji-outer emoji-sizer\"><span class=\"emoji-inner emoji{$cp}\"></span></span>";
        }, $text);
    }

    public static function html2unified($text): array|string|null
    {
        $html_to_unified = array_flip(Data::toArray('unified_to_html'));
        return preg_replace_callback("!<span class=\"emoji-outer emoji-sizer\"><span class=\"emoji-inner emoji([0-9a-f]+)\"></span></span>!", function ($m) use ($html_to_unified) {
            if (isset($html_to_unified[$m[1]])) {
                return $html_to_unified[$m[1]];
            }
            return $m[0];
        }, $text);
    }

    public static function convert($text, $map): array|string
    {
        return str_replace(array_keys(Data::toArray($map)), Data::toArray($map), $text);
    }

    public static function getName($unified_cp)
    {
        return Data::toArray('names')[$unified_cp] ? Data::toArray('names')[$unified_cp] : '?';
    }

    public static function contains($text): bool
    {
        $count = 0;
        str_replace(Data::toArray('prefixes'), '00', $text, $count);
        return $count > 0;
    }

    public static function byteify($s): string
    {
        $out = '';
        for ($i = 0; $i < strlen($s); $i++) {
            $c = ord(substr($s, $i, 1));
            if ($c >= 0x20 && $c <= 0x80) {
                $out .= chr($c);
            } else {
                $out .= sprintf('0x%02x ', $c);
            }
        }
        return trim($out);
    }

    public static function utf82bytes($cp): string
    {

        if ($cp > 0x10000) {
            # 4 bytes
            return chr(0xF0 | (($cp & 0x1C0000) >> 18)) .
                chr(0x80 | (($cp & 0x3F000) >> 12)) .
                chr(0x80 | (($cp & 0xFC0) >> 6)) .
                chr(0x80 | ($cp & 0x3F));
        } else if ($cp > 0x800) {
            # 3 bytes
            return chr(0xE0 | (($cp & 0xF000) >> 12)) .
                chr(0x80 | (($cp & 0xFC0) >> 6)) .
                chr(0x80 | ($cp & 0x3F));
        } else if ($cp > 0x80) {
            # 2 bytes
            return chr(0xC0 | (($cp & 0x7C0) >> 6)) .
                chr(0x80 | ($cp & 0x3F));
        } else {
            # 1 byte
            return chr($cp);
        }
    }

    public static function htmlEmoji($codepoint): string
    {
        return "<span class=\"emoji-outer emoji-sizer\"><span class=\"emoji-inner emoji{$codepoint}\"></span></span>";
    }

    public static function getEmojiCss(): bool|string
    {
        return file_get_contents(dirname(__DIR__) . '/data/emoji/emoji.css');
    }

    public static function getEmojiImage(): bool|string
    {
        return file_get_contents(dirname(__DIR__) . '/data/emoji/emoji.png');
    }
}
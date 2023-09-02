<?php

namespace Forever2077\PhpHelper;

use Spatie\Color\Color;
use Spatie\Color\Distance;
use Spatie\Color\Contrast;
use Spatie\Color\{Exceptions\InvalidColorValue, Factory, CIELab, Cmyk, Hex, Hsb, Hsl, Hsla, Rgb, Rgba, Xyz};
use InvalidArgumentException;

class ColorHelper
{
    const CIE76 = 'CIE76';
    const CIE94 = 'CIE94';
    const CIEDE2000 = 'CIEDE2000';

    /**
     * 将颜色数组转换为不同格式的颜色表示
     * @param array $color
     * @param string $type
     * @return string
     */
    public static function array2value(array $color, string $type = 'rgba'): string
    {
        if (!in_array(strtolower($type), ['rgb', 'rgba', 'hex', 'cmyk', 'hsl', 'cielab', 'xyz'])) {
            return 'Invalid type';
        }

        // 判断是否为关联数组
        $isAssoc = array_keys($color) !== range(0, count($color) - 1);

        // RGB & RGBA & HEX
        if ($type === 'rgb' || $type === 'rgba' || $type === 'hex') {
            if ($isAssoc ? isset($color['r'], $color['g'], $color['b']) : count($color) >= 3) {
                $r = $isAssoc ? $color['r'] : $color[0];
                $g = $isAssoc ? $color['g'] : $color[1];
                $b = $isAssoc ? $color['b'] : $color[2];

                if ($type === 'rgb') {
                    return "rgb($r,$g,$b)";
                } elseif ($type === 'rgba') {
                    $a = $isAssoc ? ($color['a'] ?? 1) : ($color[3] ?? 1);
                    return "rgba($r,$g,$b,$a)";
                } elseif ($type === 'hex') {
                    return '#' . sprintf("%02x%02x%02x", $r, $g, $b);
                }
            }
        }

        // CMYK
        if ($type === 'cmyk') {
            if (($isAssoc ? isset($color['c'], $color['m'], $color['y'], $color['k']) : count($color) == 4)) {
                $components = $isAssoc ? [$color['c'], $color['m'], $color['y'], $color['k']] : $color;
                return "cmyk(" . implode(',', $components) . ")";
            }
        }

        // HSL
        if ($type === 'hsl') {
            if ($isAssoc ? isset($color['h'], $color['s'], $color['l']) : count($color) == 3) {
                $h = $isAssoc ? $color['h'] : $color[0];
                $s = $isAssoc ? $color['s'] : $color[1];
                $l = $isAssoc ? $color['l'] : $color[2];
                return "hsl($h,{$s}%,{$l}%)";
            }
        }

        // CIELab
        if ($type === 'CIELab') {
            if ($isAssoc ? isset($color['L'], $color['a'], $color['b']) : count($color) == 3) {
                $L = $isAssoc ? $color['L'] : $color[0];
                $a = $isAssoc ? $color['a'] : $color[1];
                $b = $isAssoc ? $color['b'] : $color[2];
                return "CIELab($L,$a,$b)";
            }
        }

        // XYZ
        if ($type === 'xyz') {
            if ($isAssoc ? isset($color['x'], $color['y'], $color['z']) : count($color) == 3) {
                $x = $isAssoc ? $color['x'] : $color[0];
                $y = $isAssoc ? $color['y'] : $color[1];
                $z = $isAssoc ? $color['z'] : $color[2];
                return "xyz($x,$y,$z)";
            }
        }

        return 'Invalid color parameters';
    }

    /**
     * 生成不同颜色值实例对象
     * @param string $string
     * @return Color
     * @throws InvalidColorValue
     */
    public static function convert(string $string): Color
    {
        try {
            return Factory::fromString($string);
        } catch (InvalidColorValue $e) {
            throw new InvalidColorValue($e->getMessage());
        }
    }

    /**
     * 计算两个颜色之间的距离
     * @param string|Color $color1
     * @param string|Color $color2
     * @param string $type
     * @param int $textiles
     * @return float
     */
    public static function distance(string|Color $color1, string|Color $color2, string $type = ColorHelper::CIEDE2000, int $textiles = 0): float
    {
        return match ($type) {
            ColorHelper::CIE76 => Distance::CIE76($color1, $color2),
            ColorHelper::CIE94 => Distance::CIE94($color1, $color2, $textiles),
            ColorHelper::CIEDE2000 => Distance::CIEDE2000($color1, $color2),
            default => throw new InvalidArgumentException('Unsupported distance type: ' . $type),
        };
    }

    /**
     * 颜色对比度差异
     * @param Color $color1
     * @param Color $color2
     * @return float
     */
    public static function contrast(Color $color1, Color $color2): float
    {
        return Contrast::ratio($color1, $color2);
    }
}
<?php

namespace Forever2077\PhpHelper\WorldMap;

use Exception;

trait Baidu
{
    /**
     * 百度地理编码
     * @link https://lbsyun.baidu.com/faq/api?title=webapi/guide/webservice-geocoding-base
     * @param string $address 地址
     * @return array|mixed|string
     */
    public static function baiduGeocode(string $address): mixed
    {
        if (!self::$apiKey) {
            return "API Key not set";
        }

        $url = self::$baiduGeocodeUrl . self::$apiKey . '&address=' . urlencode($address);

        try {
            $json = self::fetchJson($url);

            if ($json['status'] !== 0) {
                return $json;
            }

            return $json['result']['location'];
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * 百度静态地图
     * @link https://api.map.baidu.com/lbsapi/cloud/static-1.htm
     * @param array $options {
     * 可选参数：
     * @type int $width 图片宽度。取值范围：(0, 1024]
     * @type int $height 图片高度。取值范围：(0, 1024]
     * @type int $zoom 地图级别，默认为15。高清图范围[3, 18]；低清图范围[3,19]
     * @type string $center 地图中心点，默认为经纬度。格式：lng<经度>，lat<纬度>
     * @type int $copyright 静态图版权样式，默认为0
     * @type int $scale 返回图片大小会根据此标志调整。取值范围为1或2
     * @type string $bbox 地图视野范围。格式：minX,minY;maxX,maxY
     * @type string $markers 标注，可通过经纬度或地址/地名描述
     * @type string $markerStyles 标注样式
     * @type string $labels 标签，可通过经纬度或地址/地名描述
     * @type string $labelStyles 标签样式
     * @type string $paths 折线，可通过经纬度或地址/地名描述
     * @type string $pathStyles 折线样式
     * }
     * @return string
     */
    public static function baiduMap(array $options = []): string
    {
        if (!self::$apiKey) {
            return "API Key not set";
        }

        if (!isset($options['lat'], $options['lng'])) {
            return "Missing required parameters";
        }

        $width = $options['width'] ?? self::$width;
        $height = $options['height'] ?? self::$height;
        $zoom = $options['zoom'] ?? 15;
        $center = $options['center'] ?? "{$options['lng']},{$options['lat']}";
        $copyright = $options['copyright'] ?? 0;
        $scale = $options['scale'] ?? null;
        $bbox = $options['bbox'] ?? null;
        $markers = $options['markers'] ?? null;
        $markerStyles = $options['markerStyles'] ?? null;
        $labels = $options['labels'] ?? null;
        $labelStyles = $options['labelStyles'] ?? null;
        $paths = $options['paths'] ?? null;
        $pathStyles = $options['pathStyles'] ?? null;

        $url = self::$baiduMapApiUrl . self::$apiKey;
        $url .= "&width={$width}&height={$height}&zoom={$zoom}&center={$center}";
        $url .= "&copyright={$copyright}";
        if ($scale) $url .= "&scale={$scale}";
        if ($bbox) $url .= "&bbox={$bbox}";
        if ($markers) $url .= "&markers={$markers}";
        if ($markerStyles) $url .= "&markerStyles={$markerStyles}";
        if ($labels) $url .= "&labels={$labels}";
        if ($labelStyles) $url .= "&labelStyles={$labelStyles}";
        if ($paths) $url .= "&paths={$paths}";
        if ($pathStyles) $url .= "&pathStyles={$pathStyles}";

        return '<iframe width="' . $width . '" height="' . $height . '" style="border:0" src="' . $url . '"></iframe>';
    }
}
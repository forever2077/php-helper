<?php

namespace Forever2077\PhpHelper\WorldMap;

use Exception;

trait Google
{
    /**
     * 谷歌地理编码
     * @link https://developers.google.com/maps/documentation/geocoding/overview?hl=zh-cn
     * @param $address
     * @return array|mixed|string
     */
    public static function googleGeocode($address)
    {
        if (!self::$apiKey) {
            return "API Key not set";
        }

        $url = self::$googleGeocodeUrl . self::$apiKey . '&address=' . urlencode($address);

        try {
            $json = self::fetchJson($url);

            if ($json['status'] !== 'OK') {
                return $json;
            }

            return $json['results'][0]['geometry']['location'];
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * 嵌入 Google 地图
     * @link https://developers.google.com/maps/documentation/embed/embedding-map?hl=zh-cn
     * @param array $options 包含以下键值对：
     *  - 'mode': 地图模式，默认为 'VIEW'。其他选项包括 'PLACE', 'DIRECTIONS', 'STREETVIEW', 'SEARCH'
     *  - 'key': API 密钥
     *  - 'width': 地图宽度
     *  - 'height': 地图高度
     *  - 'zoom': 初始缩放级别，默认为 15
     *  - 'q': 搜索或标记位置
     *  - 'center': 地图中心的经纬度
     *  - 'maptype': 地图类型，如 'roadmap', 'satellite'
     *  - 'language': 界面和标签语言
     *  - 'region': 地区代码
     *  - 'origin': 路线的起点
     *  - 'destination': 路线的终点
     *  - 'waypoints': 路线的中间点
     *  - 'avoid': 要避免的路线特点
     *  - 'units': 距离单位
     *  - 'heading': 街景模式下的相机方向
     *  - 'pitch': 街景模式下的相机倾斜角度
     *  - 'fov': 街景模式下的视野
     * @return string 嵌入的 iframe 标签
     */
    public static function googleMap(array $options = []): string
    {
        $mode = $options['mode'] ?? 'VIEW';
        $mode = strtolower($mode);
        $zoom = $options['zoom'] ?? 15;
        $width = $options['width'] ?? self::$width;
        $height = $options['height'] ?? self::$height;
        $apiKey = $options['key'] ?? self::$apiKey;
        $center = $options['center'] ?? "{$options['lat']},{$options['lng']}";

        if (!$apiKey) {
            return "API Key not set";
        }

        $url = self::$googleMapApiUrl . "/{$mode}?key={$apiKey}&zoom={$zoom}&center={$center}";

        unset($options['lng'], $options['lat']);

        foreach ($options as $key => $value) {
            if (!in_array($key, ['mode', 'key', 'zoom', 'width', 'height'])) {
                $url .= "&{$key}=" . urlencode($value);
            }
        }

        return '<iframe width="' . $width . '" height="' . $height . '" style="border:0" src="' . $url . '" allowfullscreen></iframe>';
    }
}
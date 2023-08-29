<?php


namespace Forever2077\PhpHelper;

use Exception;
use Forever2077\PhpHelper\WorldMap\Baidu;
use Forever2077\PhpHelper\WorldMap\Google;
use GuzzleHttp\Exception\GuzzleException;

class EmbedMapHelper
{
    use Google, Baidu;

    public static int $width = 600;
    public static int $height = 450;

    public static string $apiKey;
    public static string $proxy = ''; // fetchJson http代理地址

    public static string $baiduMapApiUrl = 'https://api.map.baidu.com/staticimage/v2?ak=';
    public static string $baiduGeocodeUrl = 'https://api.map.baidu.com/geocoding/v3/?output=json&ak=';

    public static string $googleMapApiUrl = 'https://www.google.com/maps/embed/v1';
    public static string $googleGeocodeUrl = 'https://maps.googleapis.com/maps/api/geocode/json?key=';

    /**
     * @param $url
     * @return string|array
     * @throws Exception
     */
    private static function fetchJson($url): string|array
    {
        try {
            $response = HttpHelper::get([
                'url' => $url,
                'options' => [
                    'timeout' => 15,
                    'verify' => false,
                    'proxy' => self::$proxy ?? '',
                ],
            ]);
            $response = json_decode($response->getBody(), true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new Exception('Invalid JSON response');
            }
            return $response;
        } catch (GuzzleException $e) {
            throw new Exception($e->getMessage());
        }
    }
}

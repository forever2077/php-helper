<?php

namespace Forever2077\PhpHelper;

use Rinvex\Country\CountryLoader;

class GeoHelper extends CountryLoader
{
    private static string $chinaAreaDB = 'chinaArea.sqlite3';
    private static string $chinaAreaDBPath = __DIR__ . "/../data/countries/";

    /**
     * 世界国家
     * @link https://github.com/rinvex/countries
     * @return GeoHelper
     */
    public static function instance(): GeoHelper
    {
        return new self();
    }

    /**
     * 获取国家列表
     * @link https://github.com/stefangabos/world_countries
     * @param string $languages 语言 zh,en,zh-tw
     * @param string $mode
     *  - countries: Files named like this contain 195 entries made up from the 193 sovereign states (commonly referred to as countries)
     *               that are members of the United Nations (UN) plus the 2 observer states of Palestine and the Vatican City State.
     *  - world: Files named like this contain all the 249 countries, territories, and areas of geographical interest that
     *           have an officially assigned ISO 3166-1 code.
     * @return array
     */
    public static function getAllCountries(string $languages = 'zh', string $mode = 'countries'): array
    {
        if (!in_array($languages, ['zh', 'en', 'zh-tw']) || !in_array($mode, ['countries', 'world'])) {
            return [];
        }
        return include_once self::$chinaAreaDBPath . "{$languages}/$mode.php";
    }

    /**
     * 获取中国一至三级行政区域
     * @link https://github.com/kakuilan/china_area_mysql
     * @param int $code 省份城市代码
     * @param string $languages 语言 zh
     * @return array
     * @throws \Exception
     */
    public static function getChinaArea(int $code = 0, string $languages = 'zh'): array
    {
        // 判断文件是否存在，否则解压 chinaArea.zip
        if (!file_exists(self::$chinaAreaDBPath . "{$languages}/" . self::$chinaAreaDB)) {
            if (!file_exists(self::$chinaAreaDBPath . "{$languages}/" . 'chinaArea.zip')) {
                throw new \Exception('chinaArea.zip not found');
            }
            $zip = new \ZipArchive();
            $res = $zip->open(self::$chinaAreaDBPath . "{$languages}/" . 'chinaArea.zip');
            if ($res === true) {
                $zip->extractTo(self::$chinaAreaDBPath . "{$languages}/");
                $zip->close();
            }
        }

        try {
            $db = new \SQLite3(self::$chinaAreaDBPath . "{$languages}/" . self::$chinaAreaDB);
            $sql = "SELECT * FROM `china_area_13` where `parent_code` = {$code}";
            $result = $db->query($sql);
            if (!$result) {
                return [];
            }

            $data = [];
            while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
                $data[] = [
                    'code' => $row['area_code'] ?: '',
                    'name' => $row['name'],
                    'zipCode' => $row['zip_code'],
                    'cityCode' => $row['city_code'],
                ];
            }
            $db->close();
            return $data;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
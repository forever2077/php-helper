## 地理国家 Geo/Country

```php
// 根据 ISO 3166-1 alpha-2 代码获取国家信息
GeoHelper::country('cn');
// 包含195个条目，来自193个联合国成员国主权国家（通常称为国家），加上巴勒斯坦和梵蒂冈城国这两个观察员国（英文版）
GeoHelper::getAllCountries('en', 'countries');
// 包含所有249个国家、地区和具有官方指定的ISO 3166-1代码的地理区域（简体版）
GeoHelper::getAllCountries('zh', 'world');
// 获取中国一至三级行政区域
GeoHelper::getChinaArea();
// 获取指定区域代码城市
GeoHelper::getChinaArea(542500000000);

文档 https://github.com/rinvex/countries
安装 composer require rinvex/countries
数据 https://github.com/stefangabos/world_countries  https://github.com/kakuilan/china_area_mysql
```
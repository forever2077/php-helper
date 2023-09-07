## 设备唯一码 DeviceId

```php
// 基础设置，由于PHP无法直接获取设备信息，现通过Go编译后可执行文件获取
// 项目 https://github.com/forever2077/device_id
DeviceIdHelper::setBin('deviceId_windows_amd64.exe');
DeviceIdHelper::setPath(dirname(__DIR__) . '/data/device');

// CPU
DeviceIdHelper::getCpuUuid();
// Disk
DeviceIdHelper::getDiskUuid();
// Mac
DeviceIdHelper::getMacUuid();
// Timestmap
DeviceIdHelper::getTimestamp();
```

<?php

namespace Forever2077\PhpHelper;

use Exception;

class DeviceIdHelper
{
    private static string $bin = '';
    private static string $path = '';

    /**
     * @return void
     * @throws Exception
     */
    private static function __init(): void
    {
        if (empty(self::$path)) {
            self::$path = dirname(__DIR__) . '/data/device';
        }
        if (empty(self::$bin)) {
            throw new Exception('This feature using https://github.com/forever2077/device_id compiled executable file, or specify the compiled file name');
        }
        $filePath = DeviceIdHelper::getPath() . DIRECTORY_SEPARATOR . DeviceIdHelper::getBin();
        if (!file_exists($filePath)) {
            throw new Exception('The executable file does not exist [' . $filePath . ']');
        }
    }

    /**
     * @return string|bool
     * @throws Exception
     */
    public static function getCpuUuid(): string|bool
    {
        self::__init();
        exec(self::$path . DIRECTORY_SEPARATOR . self::$bin . ' -method cpu', $output, $return);
        if (!$return) {
            $str = json_decode($output[0], true)['id'];
            if (json_last_error() === JSON_ERROR_NONE) {
                return $str;
            }
        }
        return false;
    }

    /**
     * @return string|bool
     * @throws Exception
     */
    public static function getDiskUuid(): string|bool
    {
        self::__init();
        exec(self::$path . DIRECTORY_SEPARATOR . self::$bin . ' -method disk', $output, $return);
        if (!$return) {
            $str = json_decode($output[0], true)['id'];
            if (json_last_error() === JSON_ERROR_NONE) {
                return $str;
            }
        }
        return false;
    }

    /**
     * @return string|bool
     * @throws Exception
     */
    public static function getMacUuid(): string|bool
    {
        self::__init();
        exec(self::$path . DIRECTORY_SEPARATOR . self::$bin . ' -method mac', $output, $return);
        if (!$return) {
            $str = json_decode($output[0], true)['id'];
            if (json_last_error() === JSON_ERROR_NONE) {
                return $str;
            }
        }
        return false;
    }

    /**
     * @return string|bool
     * @throws Exception
     */
    public static function getTimestamp(): string|bool
    {
        self::__init();
        exec(self::$path . DIRECTORY_SEPARATOR . self::$bin . ' -method time', $output, $return);
        if (!$return) {
            $str = json_decode($output[0], true)['id'];
            if (json_last_error() === JSON_ERROR_NONE) {
                return $str;
            }
        }
        return false;
    }

    public static function setBin($bin): void
    {
        self::$bin = $bin;
    }

    public static function getBin(): string
    {
        return self::$bin;
    }

    public static function setPath($path): void
    {
        self::$path = $path;
    }

    public static function getPath(): string
    {
        return self::$path;
    }
}

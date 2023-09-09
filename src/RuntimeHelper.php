<?php

namespace Helpful;

class RuntimeHelper
{
    private static ?RuntimeHelper $_instance = null;
    public int $startTime = 0;
    public int $stopTime = 0;

    private function __construct()
    {
    }

    /**
     * 计时器
     * @return RuntimeHelper|null
     */
    public static function instance(): ?RuntimeHelper
    {
        if (!self::$_instance) {
            self::$_instance = new static();
        }
        return self::$_instance;
    }

    /**
     * 获取毫秒的时间
     * @return float
     */
    public function getMicroTime(): float
    {
        list($time, $sec) = explode(' ', microtime());
        return ((float)$time + (float)$sec);
    }

    /**
     * 记录开始的时间
     * @return bool
     */
    public function start(): bool
    {
        $this->startTime = $this->getMicroTime();
        return true;
    }

    /**
     * 结束计时并返回消耗的时间（单位 毫秒）
     */
    public function stop(): float
    {
        $this->stopTime = $this->getMicroTime();
        return $this->consumeTime();
    }

    /**
     * 计算消耗多长时间 单位毫秒）
     * @return float
     */
    public function consumeTime(): float
    {
        $this->stopTime = $this->getMicroTime();
        return round(($this->stopTime - $this->startTime) * 1000, 1);
    }

    /**
     * 重新开始计时
     * @return bool
     */
    public function reset(): bool
    {
        $this->startTime = 0;
        $this->stopTime = 0;
        return true;
    }
}
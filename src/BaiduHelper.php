<?php

namespace Helpful;

use AipBodyAnalysis;
use AipContentCensor;
use AipFace;
use AipImageClassify;
use AipImageSearch;
use AipKg;
use AipNlp;
use AipOcr;
use AipSpeech;

class BaiduHelper
{
    /**
     * 百度AI开放平台
     * @link https://ai.baidu.com/sdk
     * @return BaiduHelper
     */
    public static function instance(): BaiduHelper
    {
        return new self();
    }

    public static function aipBodyAnalysis(string $appId, string $apiKey, string $secretKey): AipBodyAnalysis
    {
        return new AipBodyAnalysis($appId, $apiKey, $secretKey);
    }

    public static function aipContentCensor(string $appId, string $apiKey, string $secretKey): AipContentCensor
    {
        return new AipContentCensor($appId, $apiKey, $secretKey);
    }

    public static function aipOcr(string $appId, string $apiKey, string $secretKey): AipOcr
    {
        return new AipOcr($appId, $apiKey, $secretKey);
    }

    public static function aipFace(string $appId, string $apiKey, string $secretKey): AipFace
    {
        return new AipFace($appId, $apiKey, $secretKey);
    }

    public static function aipImageClassify(string $appId, string $apiKey, string $secretKey): AipImageClassify
    {
        return new AipImageClassify($appId, $apiKey, $secretKey);
    }

    public static function aipImageSearch(string $appId, string $apiKey, string $secretKey): AipImageSearch
    {
        return new AipImageSearch($appId, $apiKey, $secretKey);
    }

    public static function aipKg(string $appId, string $apiKey, string $secretKey): AipKg
    {
        return new AipKg($appId, $apiKey, $secretKey);
    }

    public static function aipNlp(string $appId, string $apiKey, string $secretKey): AipNlp
    {
        return new AipNlp($appId, $apiKey, $secretKey);
    }

    public static function aipSpeech(string $appId, string $apiKey, string $secretKey): AipSpeech
    {
        return new AipSpeech($appId, $apiKey, $secretKey);
    }
}
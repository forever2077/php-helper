<?php

use PHPUnit\Framework\TestCase;
use Forever2077\PhpHelper\Helper;
use Forever2077\PhpHelper\BaiduHelper;
use Forever2077\PhpHelper\EnvHelper;

class BaiduHelperTest extends TestCase
{
    public function testInstance()
    {
        $this->assertInstanceOf(BaiduHelper::class, Helper::baidu());
    }

    public function testAipOcr()
    {
        $env = EnvHelper::instance(dirname(__DIR__));
        $aipOcr = BaiduHelper::aipOcr($env->get('BAIDU_AIP_APPID'), $env->get('BAIDU_AIP_APIKEY'), $env->get('BAIDU_AIP_SECRETKEY'));
        $this->assertIsObject($aipOcr);
    }

    public function testAipFace()
    {
        $env = EnvHelper::instance(dirname(__DIR__));
        $aipFace = BaiduHelper::aipFace($env->get('BAIDU_AIP_APPID'), $env->get('BAIDU_AIP_APIKEY'), $env->get('BAIDU_AIP_SECRETKEY'));
        $this->assertIsObject($aipFace);
    }

    public function testAipImageClassify()
    {
        $env = EnvHelper::instance(dirname(__DIR__));
        $aipImageClassify = BaiduHelper::aipImageClassify($env->get('BAIDU_AIP_APPID'), $env->get('BAIDU_AIP_APIKEY'), $env->get('BAIDU_AIP_SECRETKEY'));
        $this->assertIsObject($aipImageClassify);
    }

    public function testAipImageSearch()
    {
        $env = EnvHelper::instance(dirname(__DIR__));
        $aipImageSearch = BaiduHelper::aipImageSearch($env->get('BAIDU_AIP_APPID'), $env->get('BAIDU_AIP_APIKEY'), $env->get('BAIDU_AIP_SECRETKEY'));
        $this->assertIsObject($aipImageSearch);
    }

    public function testAipKg()
    {
        $env = EnvHelper::instance(dirname(__DIR__));
        $aipKg = BaiduHelper::aipKg($env->get('BAIDU_AIP_APPID'), $env->get('BAIDU_AIP_APIKEY'), $env->get('BAIDU_AIP_SECRETKEY'));
        $this->assertIsObject($aipKg);
    }

    public function testAipNlp()
    {
        $env = EnvHelper::instance(dirname(__DIR__));
        $aipNlp = BaiduHelper::aipNlp($env->get('BAIDU_AIP_APPID'), $env->get('BAIDU_AIP_APIKEY'), $env->get('BAIDU_AIP_SECRETKEY'));
        $this->assertIsObject($aipNlp);
    }

    public function testAipBodyAnalysis()
    {
        $env = EnvHelper::instance(dirname(__DIR__));
        $aipBodyAnalysis = BaiduHelper::aipBodyAnalysis($env->get('BAIDU_AIP_APPID'), $env->get('BAIDU_AIP_APIKEY'), $env->get('BAIDU_AIP_SECRETKEY'));
        $this->assertIsObject($aipBodyAnalysis);
    }

    public function testAipContentCensor()
    {
        $env = EnvHelper::instance(dirname(__DIR__));
        $aipContentCensor = BaiduHelper::aipContentCensor($env->get('BAIDU_AIP_APPID'), $env->get('BAIDU_AIP_APIKEY'), $env->get('BAIDU_AIP_SECRETKEY'));
        $this->assertIsObject($aipContentCensor);
    }
}
<?php

use PHPUnit\Framework\TestCase;
use Helpful\Helper;
use Helpful\BaiduHelper;
use Helpful\EnvHelper;

class BaiduHelperTest extends TestCase
{
    public function testInstance()
    {
        $this->assertInstanceOf(BaiduHelper::class, Helper::baidu());
    }

    public function testAipOcr()
    {
        $env = EnvHelper::instance(dirname(__DIR__), '.env.sample');
        $aipOcr = BaiduHelper::aipOcr($env->get('BAIDU_AIP_APPID'), $env->get('BAIDU_AIP_APIKEY'), $env->get('BAIDU_AIP_SECRETKEY'));
        $this->assertIsObject($aipOcr);
    }

    public function testAipFace()
    {
        $env = EnvHelper::instance(dirname(__DIR__), '.env.sample');
        $aipFace = BaiduHelper::aipFace($env->get('BAIDU_AIP_APPID'), $env->get('BAIDU_AIP_APIKEY'), $env->get('BAIDU_AIP_SECRETKEY'));
        $this->assertIsObject($aipFace);
    }

    public function testAipImageClassify()
    {
        $env = EnvHelper::instance(dirname(__DIR__), '.env.sample');
        $aipImageClassify = BaiduHelper::aipImageClassify($env->get('BAIDU_AIP_APPID'), $env->get('BAIDU_AIP_APIKEY'), $env->get('BAIDU_AIP_SECRETKEY'));
        $this->assertIsObject($aipImageClassify);
    }

    public function testAipImageSearch()
    {
        $env = EnvHelper::instance(dirname(__DIR__), '.env.sample');
        $aipImageSearch = BaiduHelper::aipImageSearch($env->get('BAIDU_AIP_APPID'), $env->get('BAIDU_AIP_APIKEY'), $env->get('BAIDU_AIP_SECRETKEY'));
        $this->assertIsObject($aipImageSearch);
    }

    public function testAipKg()
    {
        $env = EnvHelper::instance(dirname(__DIR__), '.env.sample');
        $aipKg = BaiduHelper::aipKg($env->get('BAIDU_AIP_APPID'), $env->get('BAIDU_AIP_APIKEY'), $env->get('BAIDU_AIP_SECRETKEY'));
        $this->assertIsObject($aipKg);
    }

    public function testAipNlp()
    {
        $env = EnvHelper::instance(dirname(__DIR__), '.env.sample');
        $aipNlp = BaiduHelper::aipNlp($env->get('BAIDU_AIP_APPID'), $env->get('BAIDU_AIP_APIKEY'), $env->get('BAIDU_AIP_SECRETKEY'));
        $this->assertIsObject($aipNlp);
    }

    public function testAipBodyAnalysis()
    {
        $env = EnvHelper::instance(dirname(__DIR__), '.env.sample');
        $aipBodyAnalysis = BaiduHelper::aipBodyAnalysis($env->get('BAIDU_AIP_APPID'), $env->get('BAIDU_AIP_APIKEY'), $env->get('BAIDU_AIP_SECRETKEY'));
        $this->assertIsObject($aipBodyAnalysis);
    }

    public function testAipContentCensor()
    {
        $env = EnvHelper::instance(dirname(__DIR__), '.env.sample');
        $aipContentCensor = BaiduHelper::aipContentCensor($env->get('BAIDU_AIP_APPID'), $env->get('BAIDU_AIP_APIKEY'), $env->get('BAIDU_AIP_SECRETKEY'));
        $this->assertIsObject($aipContentCensor);
    }
}
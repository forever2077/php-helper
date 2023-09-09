<?php

namespace Helpful;

use Exception;
use Campo\UserAgent;
use donatj\UserAgent\UserAgentParser;

class UserAgentHelper
{
    /**
     * 生成随机UserAgent
     * @link https://github.com/joecampo/random-user-agent
     * @param array $filterBy
     * @return string
     * @throws Exception
     */
    public static function random(array $filterBy = []): string
    {
        try {
            return UserAgent::random($filterBy);
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }

    /**
     * 用户代理解析器
     * @link https://github.com/donatj/PhpUserAgent
     * @return array
     */
    public static function parser(): array
    {
        $parser = new UserAgentParser();
        $ua = $parser->parse();
        return [
            'browser' => $ua->browser(),
            'platform' => $ua->platform(),
            'browserVersion' => $ua->browserVersion(),
        ];
    }
}
<?php

namespace Helpful;

use voku\helper\AntiXSS;

class XssHelper
{
    /**
     * @link https://github.com/voku/anti-xss
     */
    public function __construct()
    {
        return new AntiXSS();
    }

    public static function clean($content)
    {
        return (new AntiXSS())->xss_clean($content);
    }

    public static function from($content): AntiXSS
    {
        $AntiXSS = new AntiXSS();
        $AntiXSS->xss_clean($content);
        return $AntiXSS;
    }
}
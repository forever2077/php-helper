<?php

use PHPUnit\Framework\TestCase;
use Forever2077\PhpHelper\Helper;
use Forever2077\PhpHelper\RouterHelper;

class RouterHelperTest extends TestCase
{
    public function testRouterHelper()
    {
        $this->assertEquals(RouterHelper::class, Helper::router()::class);
    }

    public function testSimpleRouter()
    {
        RouterHelper::setDefaultNamespace('Forever2077\PhpHelper');
        RouterHelper::get('/', function () {
            return 'hello';
        });
        $this->assertIsBool(RouterHelper::router()->getRoutes()[0] instanceof Pecee\SimpleRouter\Route\RouteUrl);
    }
}
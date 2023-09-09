<?php

use PHPUnit\Framework\TestCase;
use Helpful\Helper;
use Helpful\RouterHelper;

class RouterHelperTest extends TestCase
{
    public function testRouterHelper()
    {
        $this->assertEquals(RouterHelper::class, Helper::router()::class);
    }

    public function testSimpleRouter()
    {
        RouterHelper::get('/', function () {
            return 'hello';
        });

        RouterHelper::match(['get', 'post'], '/user/{id}', function ($id) {
            return "UserId：{$id}";
        })->where(['id' => '[0-9]+']);;

        RouterHelper::post('/user/{id}/profile', 'UserController@profile')
            ->addMiddleware('AuthMiddleware');

        $this->assertIsBool(RouterHelper::router()->getRoutes()[0] instanceof Pecee\SimpleRouter\Route\RouteUrl);
    }
}
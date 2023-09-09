<?php

use PHPUnit\Framework\TestCase;
use Helpful\Helper;
use Helpful\ServerHelper;

class ServerHelperTest extends TestCase
{
    public function testInstance()
    {
        $this->assertEquals(ServerHelper::class, Helper::server()::class);
    }

    public function testHttpServer()
    {
        $http = Helper::server('http://0.0.0.0:2345');
        $http->count = 2;
        $http->onMessage = function ($connection, $request) {
            //$request->get();
            //$request->post();
            //$request->header();
            //$request->cookie();
            //$request->session();
            //$request->uri();
            //$request->path();
            //$request->method();
            $connection->send("Hello World");
        };
        //$http::runAll();
        $this->assertObjectHasProperty('workerId', $http);
    }

    public function testWebsocketServer()
    {
        $ws = Helper::server('websocket://0.0.0.0:2346');
        $ws->onConnect = function ($connection) {
            echo "New connection\n";
        };
        $ws->onMessage = function ($connection, $data) {
            $connection->send('Hello ' . $data);
        };
        $ws->onClose = function ($connection) {
            echo "Connection closed\n";
        };
        //$ws::runAll();
        $this->assertObjectHasProperty('workerId', $ws);
    }
}
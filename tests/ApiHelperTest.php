<?php

use PHPUnit\Framework\TestCase;
use Forever2077\PhpHelper\Helper;
use Forever2077\PhpHelper\ApiHelper;
use Workerman\Protocols\Http\Request;
use Workerman\Connection\TcpConnection;
use Tqdev\PhpCrudApi\RequestFactory;
use Tqdev\PhpCrudApi\ResponseUtils;

class ApiHelperTest extends TestCase
{
    public function testInstance()
    {
        $this->assertEquals((new ApiHelper())::class, Helper::api()::class);
    }

    /**
     * // http://127.0.0.1:2345/records/users?filter=id,ge,2&include=username,password
     */
    private function testRestful()
    {
        $http = Helper::server('http://0.0.0.0:2345');
        $http->count = 2;
        $http->onMessage = function (TcpConnection $connection, Request $request) {
            try {
                $requestString = ApiHelper::convert2Rfc7230($request->rawHead(), $request->rawBody());
                $restful = ApiHelper::restful([
                    'debug' => false,
                    'driver' => 'mysql',
                    'address' => '127.0.0.1',
                    'port' => 3306,
                    'username' => '',
                    'password' => '',
                    'database' => 'test',
                    'cacheType' => 'TempFile',
                    'cachePath' => './runtime/cache',
                    'cacheTime' => 15,
                    'middlewares' => 'firewall',
                    'firewall.allowedIpAddresses' => '127.0.0.1',
                ]);
                $response = $restful->handle(RequestFactory::fromString($requestString));
                $responseString = ResponseUtils::toString($response);
                $responseString = ApiHelper::convertResponse2Json($responseString);
                $connection->send($responseString);
            } catch (Exception $e) {
                dump($e);
            }
        };
        $http::runAll();
    }
}
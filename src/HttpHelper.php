<?php

namespace Forever2077\PhpHelper;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

class HttpHelper
{
    /**
     * 返回一个 Guzzle HTTP 客户端实例
     *
     * @param array $config 客户端配置项，参见 Guzzle 官方文档
     * @return Client
     */
    public static function instance(array $config = []): Client
    {
        return self::guzzle($config);
    }

    /**
     * 返回一个 Guzzle HTTP 客户端实例
     *
     * @param array $config 客户端配置项，参见 Guzzle 官方文档
     * @return Client
     */
    public static function guzzle(array $config = []): Client
    {
        return new Client($config);
    }

    /**
     * 发送 GET 请求
     *
     * @param array $params 包含以下键值：
     *    - 'client'  (Client) Guzzle客户端实例，默认为新的客户端实例
     *    - 'url'     (string) 请求的 URL
     *    - 'options' (array)  请求的额外选项，参见 Guzzle 官方文档
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public static function get(array $params): ResponseInterface
    {
        $client = $params['client'] ?? self::instance();
        $url = $params['url'] ?? '';
        $options = $params['options'] ?? [];

        return $client->request('GET', $url, $options);
    }

    /**
     * 发送 POST 请求
     *
     * @param array $params 包含以下键值：
     *    - 'client'  (Client) Guzzle客户端实例，默认为新的客户端实例
     *    - 'url'     (string) 请求的 URL
     *    - 'options' (array)  请求的额外选项，参见 Guzzle 官方文档
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public static function post(array $params): ResponseInterface
    {
        $client = $params['client'] ?? self::instance();
        $url = $params['url'] ?? '';
        $options = $params['options'] ?? [];

        return $client->request('POST', $url, $options);
    }

    /**
     * 发送 PUT 请求
     *
     * @param array $params 包含以下键值：
     *    - 'client'  (Client) Guzzle客户端实例，默认为新的客户端实例
     *    - 'url'     (string) 请求的 URL
     *    - 'options' (array)  请求的额外选项，参见 Guzzle 官方文档
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public static function put(array $params): ResponseInterface
    {
        $client = $params['client'] ?? self::instance();
        $url = $params['url'] ?? '';
        $options = $params['options'] ?? [];

        return $client->request('PUT', $url, $options);
    }

    /**
     * 发送 DELETE 请求
     *
     * @param array $params 包含以下键值：
     *    - 'client'  (Client) Guzzle客户端实例，默认为新的客户端实例
     *    - 'url'     (string) 请求的 URL
     *    - 'options' (array)  请求的额外选项，参见 Guzzle 官方文档
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public static function delete(array $params): ResponseInterface
    {
        $client = $params['client'] ?? self::instance();
        $url = $params['url'] ?? '';
        $options = $params['options'] ?? [];

        return $client->request('DELETE', $url, $options);
    }

    /**
     * 发送 HEAD 请求
     *
     * @param array $params 包含以下键值：
     *    - 'client'  (Client) Guzzle客户端实例，默认为新的客户端实例
     *    - 'url'     (string) 请求的 URL
     *    - 'options' (array)  请求的额外选项，参见 Guzzle 官方文档
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public static function head(array $params): ResponseInterface
    {
        $client = $params['client'] ?? self::instance();
        $url = $params['url'] ?? '';
        $options = $params['options'] ?? [];

        return $client->request('HEAD', $url, $options);
    }

    /**
     * 发送 OPTIONS 请求
     *
     * @param array $params 包含以下键值：
     *    - 'client'  (Client) Guzzle客户端实例，默认为新的客户端实例
     *    - 'url'     (string) 请求的 URL
     *    - 'options' (array)  请求的额外选项，参见 Guzzle 官方文档
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public static function options(array $params): ResponseInterface
    {
        $client = $params['client'] ?? self::instance();
        $url = $params['url'] ?? '';
        $options = $params['options'] ?? [];

        return $client->request('OPTIONS', $url, $options);
    }

    /**
     * 发送 PATCH 请求
     *
     * @param array $params 包含以下键值：
     *    - 'client'  (Client) Guzzle客户端实例，默认为新的客户端实例
     *    - 'url'     (string) 请求的 URL
     *    - 'options' (array)  请求的额外选项，参见 Guzzle 官方文档
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public static function patch(array $params): ResponseInterface
    {
        $client = $params['client'] ?? self::instance();
        $url = $params['url'] ?? '';
        $options = $params['options'] ?? [];

        return $client->request('PATCH', $url, $options);
    }

    /**
     * 发送 TRACE 请求
     *
     * @param array $params 包含以下键值：
     *    - 'client'  (Client) Guzzle客户端实例，默认为新的客户端实例
     *    - 'url'     (string) 请求的 URL
     *    - 'options' (array)  请求的额外选项，参见 Guzzle 官方文档
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public static function trace(array $params): ResponseInterface
    {
        $client = $params['client'] ?? self::instance();
        $url = $params['url'] ?? '';
        $options = $params['options'] ?? [];

        return $client->request('TRACE', $url, $options);
    }
}

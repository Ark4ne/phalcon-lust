<?php

namespace Luxury\Support;

use Phalcon\Http\Client\Request;

/**
 * Class Http
 *
 * @package     Luxury\Support
 */
final class Http
{
    const M_GET = 'get';

    const M_POST = 'post';

    const M_PUT = 'put';

    const M_DELETE = 'delete';

    const M_PATCH = 'patch';

    /**
     * @param string        $method
     * @param string        $url
     * @param array         $params
     * @param array         $header
     * @param callable|bool $autoRedirect
     *
     * @return \Phalcon\Http\Client\Response
     * @throws \Exception
     * @throws \Phalcon\Http\Client\Provider\Exception
     */
    private static function call(
        $method,
        $url,
        array $params = [],
        array $header = [],
        $autoRedirect = null
    ) {
        $provider = Request::getProvider();

        switch ($method) {
            case self::M_GET:
                $response = $provider->get($url, $params, $header);
                break;
            case self::M_POST:
                $response = $provider->post($url, $params, false, $header);
                break;
            case self::M_PUT:
                $response = $provider->put($url, $params, false, $header);
                break;
            case self::M_DELETE:
                $response = $provider->delete($url, $params, $header);
                break;
            case self::M_PATCH:
                $response = $provider->patch($url, $params, $header);
                break;
            default:
                throw new \BadMethodCallException(
                    'Http Method "' . strval($method) . '" not implemented.'
                );
        }

        $statusCode = $response->header->statusCode;
        if ($statusCode >= 300 && $statusCode < 400) {
            if (!empty($autoRedirect) && $response->header->has('Location')) {
                $uri = $response->header->get('Location');
                if (is_callable($autoRedirect)) {
                    $uri = $autoRedirect($uri);
                }

                return self::call($method, $uri, $params, $header, $autoRedirect);
            }
        } elseif ($statusCode >= 400 && $statusCode < 600) {
            throw new \Exception($response->body, $statusCode);
        }

        return $response;
    }

    /**
     * HTTP GET Method
     *
     * @param string $url
     * @param array  $params
     * @param array  $header
     * @param bool   $full
     *
     * @return \Phalcon\Http\Client\Response
     * @throws \Exception
     * @throws \Phalcon\Http\Client\Provider\Exception
     */
    public static function get($url, array $params = [], array $header = [], $full = false)
    {
        return self::call(self::M_GET, $url, $params, $header, $full);
    }

    /**
     * HTTP POST Method
     *
     * @param string $url
     * @param array  $params
     * @param array  $header
     * @param bool   $full
     *
     * @return \Phalcon\Http\Client\Response
     * @throws \Exception
     * @throws \Phalcon\Http\Client\Provider\Exception
     */
    public static function post($url, array $params = [], array $header = [], $full = false)
    {
        return self::call(self::M_POST, $url, $params, $header, $full);
    }

    /**
     * HTTP PUT Method
     *
     * @param string $url
     * @param array  $params
     * @param array  $header
     * @param bool   $full
     *
     * @return \Phalcon\Http\Client\Response
     * @throws \Exception
     * @throws \Phalcon\Http\Client\Provider\Exception
     */
    public static function put($url, array $params = [], array $header = [], $full = false)
    {
        return self::call(self::M_PUT, $url, $params, $header, $full);
    }

    /**
     * HTTP DELETE Method
     *
     * @param string $url
     * @param array  $params
     * @param array  $header
     * @param bool   $full
     *
     * @return \Phalcon\Http\Client\Response
     * @throws \Exception
     * @throws \Phalcon\Http\Client\Provider\Exception
     */
    public static function delete($url, array $params = [], array $header = [], $full = false)
    {
        return self::call(self::M_DELETE, $url, $params, $header, $full);
    }

    /**
     * HTTP PATCH Method
     *
     * @param string $url
     * @param array  $params
     * @param array  $header
     * @param bool   $full
     *
     * @return \Phalcon\Http\Client\Response
     * @throws \Exception
     * @throws \Phalcon\Http\Client\Provider\Exception
     */
    public static function patch($url, array $params = [], array $header = [], $full = false)
    {
        return self::call(self::M_PATCH, $url, $params, $header, $full);
    }
}

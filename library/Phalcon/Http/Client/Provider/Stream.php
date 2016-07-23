<?php
/*
  +------------------------------------------------------------------------+
  | Phalcon Framework                                                      |
  +------------------------------------------------------------------------+
  | Copyright (c) 2011-2016 Phalcon Team (http://www.phalconphp.com)       |
  +------------------------------------------------------------------------+
  | This source file is subject to the New BSD License that is bundled     |
  | with this package in the file docs/LICENSE.txt.                        |
  |                                                                        |
  | If you did not receive a copy of the license and are unable to         |
  | obtain it through the world-wide-web, please send an email             |
  | to license@phalconphp.com so we can send you a copy immediately.       |
  +------------------------------------------------------------------------+
  | Author: Tuğrul Topuz <tugrultopuz@gmail.com>                           |
  +------------------------------------------------------------------------+
*/
namespace Phalcon\Http\Client\Provider;

use Phalcon\Http\Client\Exception as HttpException;
use Phalcon\Http\Client\Header;
use Phalcon\Http\Client\Provider\Exception as ProviderException;
use Phalcon\Http\Client\Request;
use Phalcon\Http\Client\Response;
use Phalcon\Http\Request\Method;
use Phalcon\Http\Uri;

/**
 * Class Stream
 *
 * @package Phalcon\Http\Client\Provider
 */
class Stream extends Request
{
    private $context = null;

    /**
     * @return bool
     */
    public static function isAvailable()
    {
        $wrappers = stream_get_wrappers();

        return in_array('http', $wrappers) && in_array('https', $wrappers);
    }

    /**
     * Stream constructor.
     */
    public function __construct()
    {
        if (!self::isAvailable()) {
            throw new ProviderException('HTTP or HTTPS stream wrappers not registered');
        }

        $this->context = stream_context_create();
        $this->initOptions();
        parent::__construct();
    }

    public function __destruct()
    {
        $this->context = null;
    }

    private function initOptions()
    {
        $this->setOptions(
            [
                'user_agent'      => 'Phalcon HTTP/' . self::VERSION . ' (Stream)',
                'follow_location' => 1,
                'max_redirects'   => 20,
                'timeout'         => 30
            ]
        );
    }

    /**
     * @param $option
     * @param $value
     *
     * @return bool
     */
    public function setOption($option, $value)
    {
        return stream_context_set_option($this->context, 'http', $option, $value);
    }

    /**
     * @param $options
     *
     * @return bool
     */
    public function setOptions($options)
    {
        return stream_context_set_option($this->context, ['http' => $options]);
    }

    /**
     * @param $timeout
     */
    public function setTimeout($timeout)
    {
        $this->setOption('timeout', $timeout);
    }

    /**
     * @param $errno
     * @param $errstr
     *
     * @throws \Phalcon\Http\Client\Exception
     */
    private function errorHandler($errno, $errstr)
    {
        throw new HttpException($errstr, $errno);
    }

    /**
     * @param Uri $uri
     *
     * @return \Phalcon\Http\Client\Response
     */
    private function send($uri)
    {
        if (count($this->header) > 0) {
            $this->setOption('header', $this->header->build(Header::BUILD_FIELDS));
        }

        set_error_handler([$this, 'errorHandler']);
        $content = file_get_contents($uri->build(), false, $this->context);
        restore_error_handler();

        $response = new Response();
        $response->header->parse($http_response_header);
        $response->body = $content;

        return $response;
    }

    /**
     * @param $params
     */
    private function initPostFields($params)
    {
        if (!empty($params) && is_array($params)) {
            $this->header->set('Content-Type', 'application/x-www-form-urlencoded');
            $this->setOption('content', http_build_query($params));
        }
    }

    /**
     * @param      $host
     * @param int  $port
     * @param null $user
     * @param null $pass
     */
    public function setProxy($host, $port = 8080, $user = null, $pass = null)
    {
        $uri = new Uri(
            [
                'scheme' => 'tcp',
                'host'   => $host,
                'port'   => $port
            ]
        );

        if (!empty($user)) {
            $uri->user = $user;
            if (!empty($pass)) {
                $uri->pass = $pass;
            }
        }

        $this->setOption('proxy', $uri->build());
    }

    /**
     * @param       $uri
     * @param array $params
     *
     * @return \Phalcon\Http\Client\Response
     */
    public function get($uri, $params = [])
    {
        $uri = $this->resolveUri($uri);

        if (!empty($params)) {
            $uri->extendQuery($params);
        }

        $this->setOptions(
            [
                'method'  => Method::GET,
                'content' => ''
            ]
        );

        $this->header->remove('Content-Type');

        return $this->send($uri);
    }

    /**
     * @param       $uri
     * @param array $params
     *
     * @return \Phalcon\Http\Client\Response
     */
    public function head($uri, $params = [])
    {
        $uri = $this->resolveUri($uri);

        if (!empty($params)) {
            $uri->extendQuery($params);
        }

        $this->setOptions(
            [
                'method'  => Method::HEAD,
                'content' => ''
            ]
        );

        $this->header->remove('Content-Type');

        return $this->send($uri);
    }

    /**
     * @param       $uri
     * @param array $params
     *
     * @return \Phalcon\Http\Client\Response
     */
    public function delete($uri, $params = [])
    {
        $uri = $this->resolveUri($uri);

        if (!empty($params)) {
            $uri->extendQuery($params);
        }

        $this->setOptions(
            [
                'method'  => Method::DELETE,
                'content' => ''
            ]
        );

        $this->header->remove('Content-Type');

        return $this->send($uri);
    }

    /**
     * @param       $uri
     * @param array $params
     *
     * @return \Phalcon\Http\Client\Response
     */
    public function post($uri, $params = [])
    {
        $this->setOption('method', Method::POST);

        $this->initPostFields($params);

        return $this->send($this->resolveUri($uri));
    }

    /**
     * @param       $uri
     * @param array $params
     *
     * @return \Phalcon\Http\Client\Response
     */
    public function put($uri, $params = [])
    {
        $this->setOption('method', Method::PUT);

        $this->initPostFields($params);

        return $this->send($this->resolveUri($uri));
    }
}

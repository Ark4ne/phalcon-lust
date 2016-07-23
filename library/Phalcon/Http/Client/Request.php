<?php
/*
  +------------------------------------------------------------------------+
  | Phalcon Framework                                                      |
  +------------------------------------------------------------------------+
  | Copyright (c) 2011-2015 Phalcon Team (http://www.phalconphp.com)       |
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

namespace Phalcon\Http\Client;

use Phalcon\Http\Client\Provider\Curl;
use Phalcon\Http\Client\Provider\Exception as ProviderException;
use Phalcon\Http\Client\Provider\Stream;
use Phalcon\Http\Uri;

/**
 * Class Request
 *
 * @package Phalcon\Http\Client
 */
abstract class Request
{
    protected $baseUri;
    public    $header = null;

    const VERSION = '0.0.1';

    /**
     * Request constructor.
     */
    public function __construct()
    {
        $this->baseUri = new Uri();
        $this->header  = new Header();
    }

    /**
     * @return \Phalcon\Http\Client\Provider\Curl|\Phalcon\Http\Client\Provider\Stream
     * @throws \Phalcon\Http\Client\Provider\Exception
     */
    public static function getProvider()
    {
        if (Curl::isAvailable()) {
            return new Curl();
        }

        if (Stream::isAvailable()) {
            return new Stream();
        }

        throw new ProviderException('There isn\'t any available provider');
    }

    /**
     * @param $baseUri
     */
    public function setBaseUri($baseUri)
    {
        $this->baseUri = new Uri($baseUri);
    }

    /**
     * @return \Phalcon\Http\Uri
     */
    public function getBaseUri()
    {
        return $this->baseUri;
    }

    /**
     * @param $uri
     *
     * @return \Phalcon\Http\Uri
     */
    public function resolveUri($uri)
    {
        return $this->baseUri->resolve($uri);
    }
}

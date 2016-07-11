<?php

namespace Luxury\Middleware;

use Luxury\Constants\Events as EventSpaces;
use Luxury\Support\Facades\Log;

/**
 * Class Throttle
 *
 * @package     Luxury\Middleware
 */
class Throttle extends MiddlewareController implements BeforeMiddleware
{
    /**
     * Called before the execution of handler
     *
     * @param \Phalcon\Events\Event|mixed $event
     * @param \Phalcon\Dispatcher|mixed   $source
     * @param mixed|null                  $data
     *
     * @throws \Exception
     * @return bool
     */
    public function before($event, $source, $data = null)
    {
        Log::notice(__METHOD__);
    }
}
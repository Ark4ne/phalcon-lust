<?php 

namespace Luxury\Constants\Events;

/**
 * Class Application
 *
 * @package Luxury\Constants\Events
 *
 * Contains a list of events related to the area 'application'
 */
final class Application
{
    const BOOT                  = 'application:boot';
    const BEFORE_START_MODULE   = 'application:beforeStartModule';
    const AFTER_START_MODULE    = 'application:afterStartModule';
    const BEFORE_HANDLE_REQUEST = 'application:beforeHandleRequest';
    const AFTER_HANDLE_REQUEST  = 'application:afterHandleRequest';
    const VIEW_RENDER           = 'application:viewRender';
    const BEFORE_SEND_RESPONSE  = 'application:beforeSendResponse';
}

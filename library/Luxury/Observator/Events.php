<?php

namespace Luxury\Observator;

use Luxury\Foundation\Application;
use Luxury\Support\Facades\Log;
use Phalcon\Di;
use Phalcon\Events\Event as PhEvent;
use Luxury\Constants\Events as EventSpaces;

/**
 * Class Events
 *
 * @package     Luxury\Observator
 */
class Events
{
    /**
     * @var \Phalcon\Events\Event[]
     */
    private static $raised = [];
    /**
     * @var bool[]
     */
    private static $logged = [];

    /**
     * @param \Luxury\Foundation\Application $app
     * @param string                         $space
     * @param string|null                    $name
     */
    public static function observe(Application $app, $space, $name = null)
    {
        if ($name == null) {
            $name = $space;
        } else {
            $name = $space . $name;
        }

        if (empty($name)) {
            return;
        }

        if (! isset(self::$logged[$name])) {
            $em = $app->getEventsManager();

            $em->attach($name, function (PhEvent $event) {
                Log::info('OEvent:observe:raised:' . get_class($event->getSource()) . ':' . $event->getType());
                Events::$raised[] = $event;
            });

            self::$logged[$name] = true;
        }
    }

    /**
     * @param \Luxury\Foundation\Application $app
     */
    public static function observeAll(Application $app)
    {
        $reflection = new \ReflectionClass(EventSpaces::class);

        $constants = $reflection->getConstants();

        foreach ($constants as $constant => $value) {
            $class = '\\Luxury\\Constants\\Events\\' . ucfirst(strtolower($value));
            $r     = new \ReflectionClass($class);

            foreach ($r->getConstants() as $c => $name) {
                self::observe($app, $name);
            }
        }
    }

    /**
     * @return \Phalcon\Events\Event[]
     */
    public static function getRaised()
    {
        return self::$raised;
    }
}

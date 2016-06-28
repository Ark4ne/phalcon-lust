<?php

$loader = new \Phalcon\Loader();

/**
 * Registery Namespaces directory
 */
$loader->registerNamespaces([
    'Phalcon' => __DIR__ . '/../library/Phalcon',
    'Luxury'  => __DIR__ . '/../library/Luxury',
    'App'     => __DIR__ . '/../app',
])->register();

return $loader;
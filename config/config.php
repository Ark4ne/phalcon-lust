<?php

return [
    'database'    => [
        'adapter'  => 'Mysql',
        'host'     => 'localhost',
        'username' => 'root',
        'password' => '',
        'dbname'   => 'test',
        'charset'  => 'utf8',
    ],
    'application' => [
        'appDir'        => __DIR__ . '/../app/',
        'migrationsDir' => __DIR__ . '/../migrations/',
        'viewsDir'      => __DIR__ . '/../resources/views/',
        'cacheDir'      => __DIR__ . '/../storage/caches/',
        'logDir'        => __DIR__ . '/../storage/logs/',
        'vendorDir'     => __DIR__ . '/../vendor/',
        'baseUri'       => '/',
    ],
    'session'     => [
        'adapter' => 'Files' // Files, Memcache, Libmemcached, Redis
    ]
];

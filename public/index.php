<?php

try {
    /**
     * Make Application
     *
     * @var \Luxury\Foundation\Application $application
     */
    $application = require_once __DIR__ . '/../bootstrap/app.php';

    $application->make(App\Http\Kernel::class);

    /**
     * Handle the request
     */
    echo $application->handle()->getContent();

} catch (\Exception $e) {
    echo $e->getMessage() . '<br>';
    echo '<pre>' . $e->getTraceAsString() . '</pre>';
}
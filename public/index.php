<?php

$mem_get_usage        = memory_get_usage();
$mem_get_usage_peak   = memory_get_peak_usage();
$mem_get_usage_r      = memory_get_usage(true);
$mem_get_usage_peak_r = memory_get_peak_usage(true);

$tb_start = microtime(true);

try {
    /**
     * Make Application
     *
     * @var \Luxury\Foundation\Application $application
     */
    $application = require_once __DIR__ . '/../bootstrap/app.php';

    $application->make(App\Http\Kernel::class);

    // \Luxury\Observator\Events::observeAll($application);

    /**
     * Handle the request
     */
    $response = $application->handle();

    $response->send();
    /*
        $events = \Luxury\Observator\Events::getRaised();

        echo '<pre>';
        foreach ($events as $event) {
            echo get_class($event->getSource()) . ':' . $event->getType() . PHP_EOL;
        }
        echo '</pre>';
    */
} catch (\Exception $e) {
    echo $e->getMessage() . '<br>';
    echo '<pre>' . $e->getTraceAsString() . '</pre>';
}

$meminfo = json_encode([
    'mem:i'     => $mem_get_usage / 1024 . 'kb',
    'mem:o'     => memory_get_usage() / 1024 . 'kb',
    'mem:p:i'   => $mem_get_usage_peak / 1024 . 'kb',
    'mem:p:o'   => memory_get_peak_usage() / 1024 . 'kb',
    'mem:i:0'   => $mem_get_usage_r / 1024 . 'kb',
    'mem:o:0'   => memory_get_usage(true) / 1024 . 'kb',
    'mem:p:i:0' => $mem_get_usage_peak_r / 1024 . 'kb',
    'mem:p:o:0' => memory_get_peak_usage(true) / 1024 . 'kb',
    'time'      => microtime(true) - $tb_start
], JSON_PRETTY_PRINT);

echo <<<HTML
<pre>{$meminfo}</pre>
HTML;

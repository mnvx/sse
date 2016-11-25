<?php

sse('my_event', 'getSomeData');

function sse(string $eventName, callable $func, int $interval = 1)
{
    header("Content-Type: text/event-stream");
    header('Cache-Control: no-cache');

    while (1) {
        echo "event: $eventName\n";
        echo 'data: ' . json_encode($func());
        echo "\n\n";

        ob_end_flush();
        flush();
        sleep($interval);
    }
}

function getSomeData()
{
    $data = [
        'time' => date('Y-m-d H:i:s'),
        'random' => rand(1, 100),
    ];
    return $data;
}
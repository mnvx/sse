<?php

header("Content-Type: text/event-stream");

sse('my_event', 'getSomeData');

function sse($eventName, callable $func)
{
    while (1) {
        echo "event: $eventName\n";
        echo 'data: ' . json_encode($func());
        echo "\n\n";

        ob_end_flush();
        flush();
        sleep(1);
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
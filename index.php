<?php 

use Revolt\EventLoop;

require __DIR__ . '/vendor/autoload.php';

EventLoop::repeat(1, function () {
   static $hasRunThisMinute = false;
    $time = date("H:i:s");
    $seconds = substr($time, 6, 2);

    if ($seconds === "00") {
        if (!$hasRunThisMinute) {
            echo "Task running at $time\n";
            $hasRunThisMinute = true;
            // Your task here
               echo "time  found$time\n";
        }
    } else {
        $hasRunThisMinute = false; // reset flag once seconds > 00
    }

     echo "$seconds\n";
});


EventLoop::run();
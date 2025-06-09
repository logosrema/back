<?php 

require 'vendor/autoload.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

// Create a log channel
$log = new Logger('my_app');
$log->pushHandler(new StreamHandler(__DIR__.'/logs/app.log', Logger::DEBUG));

// // Add records
// $log->info('This is an info log');
// $log->error('Something went wrong!');


require __DIR__ . '/vendor/autoload.php';

$client = new \Kicken\Gearman\Client('127.0.0.1:4730');
use Revolt\EventLoop;
$targetTimes = [
    "13:36:00",
    "13:37:30",
    "13:38:00"
];

EventLoop::repeat(1, function () use($client,$targetTimes){
  $time = date("H:i:s");
  echo $time . PHP_EOL;
  if (in_array($time, $targetTimes)) {
   $dat= [
    '1' => "kojo",
    '2' => "steve",
    '3' => "emmanuel",
    '4' => "joseph",
];

  $job = $client->submitBackgroundJob('rot13', json_encode($data));
  echo "✅ Job submitted at $time: $job" . PHP_EOL;
  echo $time . PHP_EOL;
  $log->error('sbdgfhsgh;hlgha',$job);
}

});

EventLoop::run();


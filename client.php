<?php
use Kicken\Gearman\Worker as worker;
class SmsWoker  extends Testworkers {

public static function wokerTest(){

}

}

$worker = new worker('127.0.0.1:4730'); // Replace with actual server if needed
foreach (Testworkers::getWorker() as [$functionName, $callback]) {
    $worker->registerFunction($functionName, function (\Kicken\Gearman\Job\WorkerJob $job) use ($callback) {
        return $callback($job->getWorkload());
    });
    echo "Registered worker: $functionName" . PHP_EOL;
}

while ($worker->work()) {
    if ($worker->returnCode() != GEARMAN_SUCCESS) {
        echo "Gearman error: " . $worker->error() . PHP_EOL;
        break;
    }
}
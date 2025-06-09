<?php
require 'vendor/autoload.php';


$client = new Predis\Client([
    'scheme' => 'tcp',
    'host'   => '127.0.0.1',
    'port'   => 6379,
]);

$pubsub = $client->pubSubLoop(['subscribe' => 'sms_notifications']);

foreach ($pubsub as $message) {
    if ($message->kind === 'message') {
        $data = json_decode($message->payload, true);
        echo "Received SMS request for {$data['to']}: {$data['message']}" . PHP_EOL;

        // Call SMS method here
        // SmsProvider::sendSmsGonline($data['to'], $data['message']);
    }
}

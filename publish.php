<?php

require 'vendor/autoload.php';

$client = new Predis\Client();

$client->publish('sms_notifications', json_encode([
    'to' => '1234567890',
    'message' => 'Hello from Redis via Predis!'
]));

echo "Message published.\n";
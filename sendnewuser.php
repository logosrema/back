<?php
$host = 'localhost';
$db = 'wsl_test';
$user = 'root';
$pass = '';
try {
    $dsn = "mysql:host=$host;dbname=$db;charset=utf8";
    $pdo = new PDO($dsn, $user, $pass);
    
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "connected";
} catch (PDOException $e) {
    die("error message: " . $e->getMessage());
}

require __DIR__ . '/vendor/autoload.php';

use Revolt\EventLoop;
use Kicken\Gearman\Client;

$client = new Client('127.0.0.1:4730'); // Gearman client

EventLoop::repeat(1, function () use ($client, $pdo) {
    static $hasRunThisMinute = false;

    $time = date("H:i:s");
    $seconds = substr($time, 6, 2);
    echo "$seconds\n";

    if ($seconds === "00") {
        if (!$hasRunThisMinute) {
            echo "Checking preferences at $time\n";
            $hasRunThisMinute = true;

            // Fetch current settings (assuming a single admin row, id = 1)
            $stmt = $pdo->prepare("SELECT deposit, withdraw FROM sms_preferences WHERE id = 0");
            $stmt->execute();
            $prefs = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($prefs) {
                $eventTypes = [];

                if ($prefs['deposit'] == 1) {
                    $eventTypes[] = 'deposit';
                }

                if ($prefs['withdraw'] == 1) {
                    $eventTypes[] = 'withdraw';
                }

                // Only send job if at least one type is enabled
                if (!empty($eventTypes)) {
                    $client->submitBackgroundJob('send_new_user_promotions', json_encode($eventTypes));
                    echo "Job submitted for: " . implode(', ', $eventTypes) . "\n";
                } else {
                    echo "No enabled event types. Job not sent.\n";
                }
            } else {
                echo "No preferences found in DB.\n";
            }
        }
    } else {
        $hasRunThisMinute = false; // reset for next minute
    }
});

EventLoop::run();
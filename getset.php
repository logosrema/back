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


// Fetch the single row (admin-level settings)
$stmt = $pdo->prepare("SELECT deposit, withdraw, security, promo, game, vip, provider FROM sms_preferences WHERE id = 0");
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ($row) {
    echo json_encode($row);
} else {
    // If no settings yet, return default values
    echo json_encode([
        "deposit" => 0,
        "withdraw" => 0,
        "security" => 0,
        "promo" => 0,
        "game" => 0,
        "vip" => 0,
        "provider" => ""
    ]);
}

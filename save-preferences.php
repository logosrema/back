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


$data = json_decode(file_get_contents("php://input"), true);

// Save preferences
$stmt = $pdo->prepare("REPLACE INTO sms_preferences 
    (deposit, withdraw, security, promo, game, vip, provider) 
    VALUES (?, ?, ?, ?, ?, ?, ?)
");

$stmt->execute([

    $data['deposit'] ? 1 : 0,
    $data['withdraw'] ? 1 : 0,
    $data['security'] ? 1 : 0,
    $data['promo'] ? 1 : 0,
    $data['game'] ? 1 : 0,
    $data['vip'] ? 1 : 0,
    $data['provider']
]);


echo json_encode(["message" => "saved preferences."]);

?>

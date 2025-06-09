<?php 
$host = 'localhost';
$db = 'wsl_test';
$user = 'root';
$pass = '';
try {
    $dsn = "mysql:host=$host;dbname=$db;charset=utf8";
    $pdo = new PDO($dsn, $user, $pass);
    
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "connected";
} catch (PDOException $e) {
    die("Verbindung fehlgeschlagen: " . $e->getMessage());
}

require 'vendor/autoload.php';
echo "Worker is ready for jobs";
$worker = new \Kicken\Gearman\Worker('127.0.0.1:4730');
$worker
    ->registerFunction('rot13', function(\Kicken\Gearman\Job\WorkerJob $job) use ($pdo){
        $workload = $job->getWorkload();
        $data = json_decode($workload);
        $stmt = $pdo->prepare("INSERT INTO logs (timestamp) VALUES (:timestamp)");
                foreach ($data as  $name) {
                $stmt->bindValue(':timestamp', $name);
                $result = $stmt->execute();
                if ($result) {
                    echo "data inserted";
                } else {
                    echo "data not inserted";
                }
            }
                        
        echo "Running rot13 task with workload {json_encode($workload})\n";

        return str_rot13($workload);
    })
    ->work()
;


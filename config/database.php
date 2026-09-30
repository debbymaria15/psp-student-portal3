<?php
$host     = "gateway01.ap-northeast-1.prod.aws.tidbcloud.com";
$port     = 4000;
$user     = "cVrS1J7ksoC3c2T.root";
$password = "XcwA2IMpPkXmo03r";
$dbname   = "test";

try {
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ];

    $conn = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4", $user, $password, $options);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
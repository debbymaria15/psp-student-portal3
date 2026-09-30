<?php
$host     = "gateway01.ap-northeast-1.prod.aws.tidbcloud.com";
$port     = 4000;
$user     = "cVrS1J7ksoC3c2T.root";
$password = "XcwA2IMpPkXmo03r";
$dbname   = "test"; // This matches the database where you ran the table import

try {
    $conn = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4", $user, $password, [
        PDO::MYSQL_ATTR_SSL_CA => true,
        PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
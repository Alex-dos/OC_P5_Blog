<?php

$host = "192.168.64.2";
$db = "blog_db";
$user = "alex";
$psw = "1304";
$port = "3306";
$charset = "utf8mb4";
$dsn = "mysql:host=$host;dbname=$db;port=$port;charset=$charset";
$options = [
    \PDO::ATTR_ERRMODE              => \PDO::ERRMODE_EXCEPTION,
    \PDO::ATTR_DEFAULT_FETCH_MODE   => \PDO::FETCH_ASSOC,
    \PDO::ATTR_EMULATE_PREPARES     => false,
];

try {
    $pdo = new \PDO($dsn, $user, $psw, $options);
    echo 'Database connection ok ! - ';
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), $e->getCode());
}

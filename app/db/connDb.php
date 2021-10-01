<?php

$host = "127.0.0.1";
$db = "blog_db";
$user = "root";
$psw = "root";
$port = "8889";
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

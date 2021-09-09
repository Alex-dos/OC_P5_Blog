<?php

// Db connect

require 'connDb.php';

$pdo->exec("SET FOREIGN_KEY_CHECKS = 0"); // Unlink Foreign Key
$pdo->exec("DROP TABLE user");
$pdo->exec("DROP TABLE post");
$pdo->exec("SET FOREIGN_KEY_CHECKS = 1"); // Link Foreign Key
echo 'Database TABLES has been deleted';

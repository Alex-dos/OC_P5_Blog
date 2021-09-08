<?php

// Db connect

require 'connDb.php';

$pdo->exec("DROP TABLE users");

echo 'Database TABLES has been deleted';

<?php

require_once "vendor/autoload.php";

use Alura\Pdo\Infrastructure\Persistence\ConnectionCreator;

$pdo = ConnectionCreator::CreateConnection();

echo 'conectei';

$pdo->exec('CREATE TABLE students (id INTEGER PRIMARY KEY,  name TEXT, birth_date TEXT);');
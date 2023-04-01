<?php

$dbPath = __DIR__ . '/banco.sqlite';
$pdo = new PDO("sqlite:{$dbPath}");

echo 'conectei';

$pdo->exec('CREATE TABLE students (id INTEGER PRIMARY KEY,  name TEXT, birth_date TEXT);');
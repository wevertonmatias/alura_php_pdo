<?php

require_once 'vendor/autoload.php';

$dbPath = __DIR__ . '/banco.sqlite';
$pdo = new PDO("sqlite:{$dbPath}");

$statment = $pdo->query("SELECT * FROM students;");

var_dump($statment->fetchAll());
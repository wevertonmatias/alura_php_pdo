<?php

use Alura\Pdo\Domain\Model\Student;

require_once 'vendor/autoload.php';

$dbPath = __DIR__ . '/banco.sqlite';
$pdo = new PDO("sqlite:{$dbPath}");

$statement = $pdo->prepare("DELETE FROM students WHERE ID = :id");
$statement->bindValue(':id', 2, PDO::PARAM_INT);

var_dump($statement->execute());
$statement->bindValue(':id', 3, PDO::PARAM_INT);

var_dump($statement->execute());

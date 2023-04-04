<?php

use Alura\Pdo\Domain\Model\Student;
use Alura\Pdo\Infrastructure\Persistence\ConnectionCreator;

require_once 'vendor/autoload.php';

$pdo = ConnectionCreator::CreateConnection();

$statement = $pdo->prepare("DELETE FROM students WHERE ID = :id");
$statement->bindValue(':id', 2, PDO::PARAM_INT);

var_dump($statement->execute());
$statement->bindValue(':id', 3, PDO::PARAM_INT);

var_dump($statement->execute());

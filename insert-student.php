<?php

use Alura\Pdo\Domain\Model\Student;

require_once 'vendor/autoload.php';

$dbPath = __DIR__ . '/banco.sqlite';
$pdo = new PDO("sqlite:{$dbPath}");

$student = new Student(null, 'Weverton Matias', new DateTimeImmutable('1995-06-14'));

$sqlInsert = "INSERT INTO students (name, birth_date) VALUES (
                '{$student->name()}', '{$student->birthDate()->format('Y-m-d')}');";

var_dump($pdo->exec($sqlInsert));
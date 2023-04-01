<?php

use Alura\Pdo\Domain\Model\Student;

require_once 'vendor/autoload.php';

$dbPath = __DIR__ . '/banco.sqlite';
$pdo = new PDO("sqlite:{$dbPath}");

//$student = new Student(null, 'Weverton Matias', new DateTimeImmutable('1995-06-14'));
//
//$sqlInsert = "INSERT INTO students (name, birth_date) VALUES (
//                '{$student->name()}', '{$student->birthDate()->format('Y-m-d')}');";

//var_dump($pdo->exec($sqlInsert));


//$student = new Student(null, "Weverton', ''); DROP TABLE students -- Matias", new DateTimeImmutable('1995-06-14'));

//$sqlInsert = "INSERT INTO students (name, birth_date) VALUES (?, ?)";
//$statement = $pdo->prepare($sqlInsert);
//$statement->bindValue(1, $student->name());
//$statement->bindValue(2, $student->birthDate()->format('Y-m-d'));

$student = new Student(null, "Pedro Matins", new DateTimeImmutable('1990-06-14'));
$sqlInsert = "INSERT INTO students (name, birth_date) VALUES (:name, :birth_date)";
$statement = $pdo->prepare($sqlInsert);
$statement->bindValue(":name", $student->name());
$statement->bindValue(":birth_date", $student->birthDate()->format('Y-m-d'));

if($statement->execute()){
    echo 'Aluno inserido com sucesso.';
};



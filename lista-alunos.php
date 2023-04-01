<?php

use Alura\Pdo\Domain\Model\Student;

require_once 'vendor/autoload.php';

$dbPath = __DIR__ . '/banco.sqlite';
$pdo = new PDO("sqlite:{$dbPath}");

$statment = $pdo->query("SELECT * FROM students;");

//while ($studantData = $statment->fetch(PDO::FETCH_ASSOC)){
//    $studant = new Student($studantData['id'],
//                $studantData['name'],
//                new DateTimeImmutable($studantData['birth_date']));
//    echo $studant->age();
//}

$studentDataList = $statment->fetchAll(PDO::FETCH_ASSOC);
$studantList = [];

foreach ($studentDataList as $studantData){
    $studantList[] = new Student($studantData['id'],
                        $studantData['name'],
                        new DateTimeImmutable($studantData['birth_date']));
}

var_dump($studantList);
<?php

use Alura\Pdo\Domain\Model\Student;
use Alura\Pdo\Infrastructure\Persistence\ConnectionCreator;

require_once 'vendor/autoload.php';

$pdo = ConnectionCreator::CreateConnection();

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
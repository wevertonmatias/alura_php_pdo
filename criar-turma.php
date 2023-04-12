<?php

require_once 'vendor/autoload.php';
use Alura\Pdo\Domain\Model\Student;
use Alura\Pdo\Infrastructure\Persistence\ConnectionCreator;
use Alura\Pdo\Infrastructure\Repository\PdoStudentRepository;


$connection = ConnectionCreator::createConnection();

$studentRepository = new PdoStudentRepository($connection);


$connection->beginTransaction();

$aStudent = new Student(null, 'Weverton M.', new DateTimeImmutable('1990-06-14'));
$studentRepository->save($aStudent);

$anotherStudent = new Student(null, 'Matias W.', new DateTimeImmutable('1999-05-05'));
$studentRepository->save($anotherStudent);

$connection->commit();
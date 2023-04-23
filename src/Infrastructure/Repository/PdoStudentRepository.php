<?php

namespace Alura\Pdo\Infrastructure\Repository;

use Alura\Pdo\Domain\Model\Phone;
use Alura\Pdo\Domain\Model\Student;
use Alura\Pdo\Domain\Repository\StudentyRepository;
use Alura\Pdo\Infrastructure\Persistence\ConnectionCreator;
use PDO;
use DateTimeImmutable;

class PdoStudentRepository implements StudentyRepository
{

    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function allStudents(): array
    {
        $sqlQuery = 'SELECT * FROM students;';
        $stmt = $this->connection->query($sqlQuery);

        return $this->hydrateStudentsList($stmt);
    }

    public function studentsBirthAt(\DateTimeInterface $birthDate): array
    {
        $sqlQuery = 'SELECT * FROM students WHERE birth_date = :birth_date';
        $stmt = $this->connection->prepare($sqlQuery);
        $stmt->bindValue(':birth_date', $birthDate->format('Y-m-d'));
        $stmt->execute();

        return $this->hydrateStudentsList($stmt);
    }

    public function hydrateStudentsList(\PDOStatement $stmt): array
    {
        $studentsDataList = $stmt->fetchAll();
        $studentsList = [];

        foreach ($studentsDataList as $studentData){
            $student = new Student(
                $studentData['id'],
                $studentData['name'],
                new DateTimeImmutable($studentData['birth_date'])
            );
            $this->fillPhonesOfStudent($student);
            $studentsList[] = $student;

        }

        return $studentsList;
    }

    private function fillPhonesOfStudent(Student $student):void
    {
        $sqlQuery = 'SELECT id, area_code, number FROM phones where student_id = :id_student';
        $stmt = $this->connection->prepare($sqlQuery);
        $stmt->bindValue('id_student', $student->id(), PDO::PARAM_INT);
        $stmt->execute();
        $phonesDataList = $stmt->fetchAll();
        foreach($phonesDataList as $phoneData){
            $phone = new Phone($phoneData['id'], $phoneData['area_code'], $phoneData['number']);
            $student->addPhone($phone);
        }

    }

    public function save(Student $student): bool
    {
        if($student->id() === null){
            return $this->insert($student);
        }
        return $this->update($student);
    }

    public function insert(Student $student): bool
    {
        $insertQuery = 'INSERT INTO students (name, birth_date) VALUES (:name, :birth_date);';
        $stmt = $this->connection->prepare($insertQuery);

        $success = $stmt->execute([
            ':name' => $student->name(),
            ':birth_date' => $student->birthDate()->format('Y-m-d')
        ]);

        if($success){
            $student->defineId($this->connection->lastInsertId());
        }
        return $success;
    }

    public function update(Student $student)
    {
        $updateQuery = 'UPDATE students SET name = :name, birth_date = :birth_date WHERE id = :id;';
        $stmt = $this->connection->prepare($updateQuery);
        $stmt->bindValue([
            ':name' => $student->name(),
            ':birth_date' => $student->birthDate()->format('Y-m-d')
            ]);
        $stmt->bindValue(':id', $student->id(), PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function remove(Student $student): bool
    {
        $stmt = $this->connection->prepare('DELETE FROM students WHERE id = :id;');
        $stmt->bindValue(':id', $student->id(), PDO::PARAM_INT);

        return $stmt->execute();
    }
}
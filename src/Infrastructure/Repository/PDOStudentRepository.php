<?php

namespace Alura\Pdo\Infrastructure\Repository;

use Alura\Pdo\Domain\Model\Phone;
use Alura\Pdo\Domain\Model\Student;
use Alura\Pdo\Domain\Repository\StudentRepository;
use Alura\Pdo\Infrastructure\Persistence\ConnectionCreator;
use PDO;

class PDOStudentRepository implements StudentRepository
{
    private PDO $pdo;

    public function __construct(PDO $connection)
    {
        $this->pdo = $connection;
    }

    public function AllStudents(): array
    {
        $statement = $this->pdo->query("SELECT * FROM students");

        return $this->hydrateStudentList($statement);
    }

    public function studentBirthAt(\DateTimeInterface $birthDate): array
    {
        $statement = $this->pdo->query("SELECT * FROM students WHERE BirthDate = :birthDate");
        return $this->hydrateStudentList($statement);
    }

    public function save(Student $student): bool
    {
        if ($student->id() === null){
            return $this->insertStudent($student);
        }

        return $this->updateStudent($student);
    }

    private function insertStudent(Student $student): bool
    {
        $insertQuery = $this->pdo->prepare("INSERT INTO students (name ,birth_date) VALUES (:name,:birthDate)");

        $preparedStatement = $this->pdo->prepare($insertQuery);
        $preparedStatement->bindValue(":name", $student->name());
        $preparedStatement->bindValue(":birth_date", $student->birthDate()->format('Y-m-d'));
        $success = $preparedStatement->execute();
        if ($success){
            $student->defineId($this->pdo->lastInsertId());
        }
        return $success;
    }

    private function updateStudent(Student $student): bool
    {
        $updateQuery = ("UPDATE students SET name = :name, birth_date = :birth_date WHERE id = :id");
        $stmt = $this->pdo->prepare($updateQuery);
        $stmt->bindValue(":name", $student->name());
        $stmt->bindValue(":birth_date", $student->birthDate()->format('Y-m-d'));
        $stmt->bindValue(":id", $student->id());

        return $stmt->execute();
    }

    public function remove(Student $student): bool
    {
        $preparedStatement = $this->pdo->prepare('DELETE FROM students WHERE id = :id');
        $preparedStatement->bindValue(':id', $student->id(), PDO::PARAM_INT);
        return ($preparedStatement->execute());

    }

    private function hydrateStudentList(\PDOStatement $statement): array
    {
        $studentDataList = $statement->fetchAll(\PDO::FETCH_ASSOC);
        $studentList = [];

        foreach ($studentDataList as $studentData){
            $studentList[] =  new Student(
                $studentData['id'],
                $studentData['name'],
                new \DateTimeImmutable($studentData['birth_date'])
            );
//            $this->fillPhonesOf($student);
//            $studentList[] = $student;
        }
        return $studentList;
//    }
//    public function fillPhonesOf(Student $student): void
//    {
//        $sqlQuery = "SELECT id, area_code, number FROM phones WHERE student_id = :student_id";
//        $statement = $this->pdo->prepare($sqlQuery);
//        $statement->bindValue(':student_id', $student->id(), PDO::PARAM_INT);
//        $statement->execute();
//
//        $phoneDataList = $statement->fetchAll();
//        foreach ($phoneDataList as $phoneData){
//            $phone = new Phone(
//                $phoneData['id'],
//                $phoneData['area_code'],
//                $phoneData['number']
//            );
//
//            $student->addPhone($phone);
//        }
//    }
}

    public function studentsWithPhones(): array
    {
        $sqlQuery = 'SELECT students.id,
                            students.name,
                            students.birth_date,
                            phones.id AS phone_id,
                            phones.area_code,
                            phones.number
                     FROM students
                     JOIN phones ON students.id = phones.student_id;';
        $statement = $this->pdo->query($sqlQuery);
        $result = $statement->fetchAll();
        $studentList = [];

        foreach ($result as $row){
            if (!array_key_exists($row['id'], $studentList)){
                $studentList[$row['id']] = new Student(
                    $row['id'],
                    $row['name'],
                    new \DateTimeImmutable($row['birth_date'])
                );
            }
            $phone = new Phone($row['phone_id'], $row['area_code'], $row['number']);
            $studentList[$row['id']]->addPhone($phone);
        }

        return $studentList;
    }

    }
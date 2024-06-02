<?php

use Alura\Pdo\Domain\Model\Student;
use Alura\Pdo\Infrastructure\Persistence\ConnectionCreator;
use Alura\Pdo\Infrastructure\Repository\PDOStudentRepository;

require_once 'vendor/autoload.php';

$pdo = ConnectionCreator::createConnection();
$studentRepository = new PDOStudentRepository($pdo);
try {
    $student = new Student(null, 'Validr Braz', new DateTimeImmutable('1007-08-12'));
    $anotherStudent = new Student(null, 'Another Validr Braz', new DateTimeImmutable('2001-08-12'));
    $pdo->beginTransaction();

    $studentRepository->save($student);
    $studentRepository->save($anotherStudent);

    $pdo->commit();
} catch (\PDOException $e) {
    echo $e->getMessage();
    $pdo->rollBack();
}


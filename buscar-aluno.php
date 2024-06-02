<?php

require_once 'vendor/autoload.php';

use Alura\Pdo\Domain\Model\Student;
use Alura\Pdo\Infrastructure\Persistence\ConnectionCreator;

$pdo = ConnectionCreator::createConnection();
$repository = new \Alura\Pdo\Infrastructure\Repository\PDOStudentRepository($pdo);
$studentList[] = $repository->AllStudents();

var_dump($studentList);
/*
$statement = $pdo->query("SELECT * FROM students");*/
//$studentDataList = $statement->fetchAll(PDO::FETCH_ASSOC);
//$studentList = [];

//foreach ($studentDataList as $studentData) {
//    $studentList[] = new Student($studentData['id'],
//        $studentData['name'],
//        new \DateTimeImmutable($studentData['birth_date']));
//}

//while ($dados = $statement->fetch(PDO::FETCH_ASSOC)) {
//    $student = new Student($dados['id'], $dados['name'], new \DateTimeImmutable($dados['birth_date']));
//
//    var_dump($student);
//}



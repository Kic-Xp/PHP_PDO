<?php


use Alura\Pdo\Infrastructure\Persistence\ConnectionCreator;
use Alura\Pdo\Infrastructure\Repository\PDOStudentRepository;

require_once 'vendor\autoload.php';

$connection = ConnectionCreator::createConnection();
$repository = new PDOStudentRepository($connection);

$studentList = $repository->studentsWithPhones();

var_dump($studentList);
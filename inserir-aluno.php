<?php

require_once 'vendor/autoload.php';

use Alura\Pdo\Domain\Model\Student;
use Alura\Pdo\Infrastructure\Persistence\ConnectionCreator;

$pdo = ConnectionCreator::createConnection();

$student = new Student(null, 'Alberto', new DateTimeImmutable('1997-10-15'));

$preparedStatement = $pdo->prepare("INSERT INTO students (name, birth_date) VALUES(:name, :birth_date)");
$preparedStatement->bindValue(":name", $student->name());
$preparedStatement->bindValue(":birth_date", $student->birthDate()->format('Y-m-d'));
var_dump($preparedStatement->execute());

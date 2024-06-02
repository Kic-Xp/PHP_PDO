<?php

namespace Alura\Pdo\Domain\Repository;

use Alura\Pdo\Domain\Model\Student;

interface StudentRepository
{
    public function AllStudents(): array;

    public function studentBirthAt(\DateTimeInterface $birthDate);

    public function studentsWithPhones(): array;

    public function save(Student $student): bool;

    public function remove(Student $student): bool;


}
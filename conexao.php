<?php

$caminhoBanco = __DIR__ . '/banco.sqlite';
$pdo = new PDO('sqlite:' . $caminhoBanco);

echo 'conexão feita!';

$sql = "INSERT INTO phones (area_code, number, student_id) VALUES ('88', '88888888', 1), ('78', '99999999', 1);";
$pdo->exec($sql);
exit();

$createTableSQL =
    'CREATE TABLE IF NOT EXISTS students (
    id INTEGER PRIMARY KEY,
    name TEXT ,
    birth_date TEXT
);

    CREATE TABLE IF NOT EXISTS phones (
        id INTEGER PRIMARY KEY,
        area_code TEXT,
        number TEXT,
        student_id INTEGER,
        FOREIGN KEY (student_id) REFERENCES students(id)
    );
';

$pdo->exec($createTableSQL);





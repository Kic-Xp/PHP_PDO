<?php

namespace Alura\Pdo\Infrastructure\Persistence;

use PDO;
class ConnectionCreator
{
    public static function createConnection(): PDO
    {
        $caminhoBanco = __DIR__ . '/../../../banco.sqlite';
        $pdo =  new PDO('sqlite:' . $caminhoBanco);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $pdo;

    }
}

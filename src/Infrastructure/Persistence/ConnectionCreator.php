<?php

namespace Alura\Pdo\Infrastructure\Persistence;

use PDO;
class ConnectionCreator
{
    public static function createConnection() : PDO
    {
        $dbPath = __DIR__ . '/../../../banco.sqlite';
        $connection = new PDO("sqlite:{$dbPath}");
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $connection;
    }
}
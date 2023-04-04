<?php

namespace Alura\Pdo\Infrastructure\Persistence;

use PDO;
class ConnectionCreator
{
    public static function CreateConnection() : PDO
    {
        $dbPath = __DIR__ . '/../../../banco.sqlite';
        return new PDO("sqlite:{$dbPath}");
    }
}
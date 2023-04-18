<?php

require_once "vendor/autoload.php";

use Alura\Pdo\Infrastructure\Persistence\ConnectionCreator;

$pdo = ConnectionCreator::CreateConnection();

echo 'conectei';

$createTableSql = <<<SQL
    CREATE TABLE IF NOT EXISTS students (id INTEGER PRIMARY KEY,
    name TEXT,
    birth_date TEXT);

    CREATE TABLE IF NOT EXISTS phones(id INTEGER PRIMARY KEY,
    area_code TEXT,
    number TEXT,
    student_id INTEGER,
    FOREIGN KEY(student_id) REFERENCES students(id)); 
SQL;


$pdo->exec($createTableSql);
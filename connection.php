<?php

$dbPath = __DIR__ . '/banco.sqlite';
$pdo = new PDO("sqlite:{$dbPath}");

echo 'conectei';
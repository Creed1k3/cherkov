<?php
$host = 'localhost';         // хост базы данных
$db   = 'korochki';          // имя базы данных
$user = 'root';              // имя пользователя
$pass = '';                  // пароль
$charset = 'utf8mb4';        // кодировка

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // ошибки через исключения
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // ассоциативный массив по умолчанию
    PDO::ATTR_EMULATE_PREPARES   => false,                  // использовать реальные prepared statements
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    die('Ошибка подключения к базе данных: ' . $e->getMessage());
}

<?php
require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username   = $_POST['username'] ?? '';
    $password   = $_POST['password'] ?? '';
    $full_name  = $_POST['full_name'] ?? '';
    $phone      = $_POST['phone'] ?? '';
    $email      = $_POST['email'] ?? '';

    // Хешируем пароль
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Простой SQL-запрос
    try {
        $stmt = $pdo->prepare("INSERT INTO users (username, password, full_name, phone, email)
                               VALUES (:username, :password, :full_name, :phone, :email)");
        $stmt->execute([
            ':username'   => $username,
            ':password'   => $hashed_password,
            ':full_name'  => $full_name,
            ':phone'      => $phone,
            ':email'      => $email
        ]);

        // Перенаправление на авторизацию
        header("Location: login.php");
        exit();
    } catch (PDOException $e) {
        die("Ошибка при регистрации: " . $e->getMessage());
    }
}

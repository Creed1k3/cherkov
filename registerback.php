<?php
require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username   = trim($_POST['username'] ?? '');
    $password   = trim($_POST['password'] ?? '');
    $full_name  = trim($_POST['full_name'] ?? '');
    $phone      = trim($_POST['phone'] ?? '');
    $email      = trim($_POST['email'] ?? '');

    // Проверки на длину логина и пароля
    if (strlen($username) < 6 || strlen($password) < 6) {
        die("Логин и пароль должны содержать минимум 6 символов.");
    }

    // Проверка, занят ли логин
    $checkStmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = :username");
    $checkStmt->execute([':username' => $username]);
    if ($checkStmt->fetchColumn() > 0) {
        die("Этот логин уже занят. Пожалуйста, выберите другой.");
    }

    // Хешируем пароль
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

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

        header("Location: login.php");
        exit();
    } catch (PDOException $e) {
        die("Ошибка при регистрации: " . $e->getMessage());
    }
}

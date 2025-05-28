<?php
require_once 'db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    try {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username LIMIT 1");
        $stmt->execute([':username' => $username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role']; // сохраняем роль

            if ($user['role'] === 'admin') {
                header("Location: admin_panel.php");
            } else {
                header("Location: dashboard.php"); // или куда обычным пользователям
            }
            exit();
        } else {
            echo "Неверный логин или пароль.";
        }
    } catch (PDOException $e) {
        die("Ошибка при входе: " . $e->getMessage());
    }
}


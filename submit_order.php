<?php
session_start();
require_once 'db.php'; // Подключение к базе
require_once 'authcheck.php'; // Проверка авторизации

// Получаем данные из формы
$course = $_POST['course'] ?? '';
$start_date = $_POST['start_date'] ?? '';
$payment_method = $_POST['payment_method'] ?? '';

// Получаем ID пользователя из сессии
$user_id = $_SESSION['user_id'] ?? null;

if (!$user_id || !$course || !$start_date || !$payment_method) {
    die('Ошибка: заполните все поля.');
}

try {
    $stmt = $pdo->prepare("INSERT INTO orders (user_id, course, start_date, payment_method, status) VALUES (?, ?, ?, ?, 'Ожидает рассмотрения')");
    $stmt->execute([$user_id, $course, $start_date, $payment_method]);

    // После успешной отправки перекидываем на dashboard
    header('Location: dashboard.php');
    exit;
} catch (PDOException $e) {
    die('Ошибка при добавлении заявки: ' . $e->getMessage());
}

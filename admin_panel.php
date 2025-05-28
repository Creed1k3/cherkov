<?php
session_start();

if (empty($_SESSION['user_id']) || ($_SESSION['role'] ?? '') !== 'admin') {
    header('Location: login.php');
    exit();
}

require_once 'db.php';

// Обработка смены статуса заявки
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_id'], $_POST['new_status'])) {
    $order_id = (int)$_POST['order_id'];
    $new_status = $_POST['new_status'];

    $allowed_statuses = ['новая', 'идет обучение', 'обучение завершено'];
    if (in_array($new_status, $allowed_statuses)) {
        $stmt = $pdo->prepare("UPDATE orders SET status = ? WHERE id = ?");
        $stmt->execute([$new_status, $order_id]);
    }
    header('Location: admin_panel.php');
    exit();
}

// Получаем все заявки с данными пользователей, добавлен phone
$stmt = $pdo->query("
    SELECT orders.*, users.username, users.email, users.full_name, users.phone
    FROM orders
    JOIN users ON orders.user_id = users.id
    ORDER BY orders.created_at DESC
");
$orders = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8" />
    <title>Панель администратора</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
        }
        th {
            background: #f0f0f0;
        }
        small {
            color: gray;
            font-size: 0.85em;
        }
    </style>
</head>
<body>
    <h1>Панель администратора</h1>
    <p><a href="logout.php" style="color: red;">Выйти из админ-панели</a></p>

    <table>
        <thead>
            <tr>
                <th>ID заявки</th>
                <th>Пользователь</th>
                <th>Курс</th>
                <th>Дата начала</th>
                <th>Способ оплаты</th>
                <th>Статус</th>
                <th>Дата создания</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($orders)): ?>
                <tr><td colspan="8" style="text-align:center;">Заявок нет</td></tr>
            <?php else: ?>
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td><?=htmlspecialchars($order['id'])?></td>
                        <td>
                            <strong><?=htmlspecialchars($order['full_name'])?></strong><br>
                            Логин: <?=htmlspecialchars($order['username'])?><br>
                            Телефон: <?=htmlspecialchars($order['phone'])?><br>
                            <small><?=htmlspecialchars($order['email'])?></small>
                        </td>
                        <td><?=htmlspecialchars($order['course'])?></td>
                        <td><?=htmlspecialchars($order['start_date'])?></td>
                        <td><?=($order['payment_method'] === 'cash') ? 'Наличные' : 'Банковский перевод'?></td>
                        <td><?=htmlspecialchars($order['status'])?></td>
                        <td><?=htmlspecialchars($order['created_at'])?></td>
                        <td>
                            <form method="POST" style="display:inline;">
                                <input type="hidden" name="order_id" value="<?= (int)$order['id'] ?>">
                                <select name="new_status" required>
                                    <option value="" disabled selected>Изменить статус</option>
                                    <option value="новая">новая</option>
                                    <option value="идет обучение">идет обучение</option>
                                    <option value="обучение завершено">обучение завершено</option>
                                </select>
                                <button type="submit">Обновить</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>

<?php
require_once 'authcheck.php';
require_once 'db.php';
?>

<?php include 'header.php'; ?>

<div style="max-width: 1380px; margin: 0 auto; padding: 20px;">
  <h2 style="margin-bottom: 20px;">Мои заявки</h2>

  <div id="orders">
    <?php
    $user_id = $_SESSION['user_id'];

    try {
        $stmt = $pdo->prepare("SELECT * FROM orders WHERE user_id = ? ORDER BY created_at DESC");
        $stmt->execute([$user_id]);
        $orders = $stmt->fetchAll();

        if (count($orders) === 0) {
            echo "<p>У вас пока нет заявок.</p>";
        } else {
            echo "<ul style='list-style: none; padding: 0;'>";
            foreach ($orders as $order) {
                echo "<li style='
                  background: #f9f9f9;
                  border: 1px solid #ddd;
                  border-radius: 12px;
                  padding: 20px;
                  margin-bottom: 20px;
                  box-shadow: 0 2px 5px rgba(0,0,0,0.05);
                '>";
                echo "<strong>Курс:</strong> " . htmlspecialchars($order['course']) . "<br>";
                echo "<strong>Дата начала:</strong> " . htmlspecialchars($order['start_date']) . "<br>";
                echo "<strong>Способ оплаты:</strong> " . ($order['payment_method'] === 'cash' ? 'Наличные' : 'Банковский перевод') . "<br>";
                echo "<strong>Статус:</strong> " . htmlspecialchars($order['status']) . "<br>";
                echo "<small style='color: #666;'>Отправлено: " . htmlspecialchars($order['created_at']) . "</small>";
                echo "</li>";
            }
            echo "</ul>";
        }
    } catch (PDOException $e) {
        echo "<p style='color: red;'>Ошибка при загрузке заявок: " . $e->getMessage() . "</p>";
    }
    ?>
  </div>

  <!-- Кнопка выхода -->
  <div style="text-align: center; margin-top: 30px;">
    <form action="logout.php" method="POST">
      <button type="submit" style="padding: 10px 20px; cursor: pointer; border-radius: 6px; border: 1px solid #ccc; background: #fff; transition: background-color 0.3s;">
        Выйти с аккаунта
      </button>
    </form>
  </div>
</div>

<?php include 'footer.php'; ?>

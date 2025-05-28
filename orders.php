<?php include 'header.php'; ?>
<?php
require_once 'authcheck.php';
?>

<div class="auth-wrapper">
  <div class="auth-container">
    <div class="auth-form">
      <h2>Формирование заявки 📄</h2>
      <p>Заполните данные для подачи заявки:</p>
      <form method="POST" action="submit_order.php">
        <!-- Выбор курса -->
        <select name="course" required>
          <option value="">Выберите курс</option>
          <option value="Основы алгоритмизации и программирования">Основы алгоритмизации и программирования</option>
          <option value="Основы веб-дизайна">Основы веб-дизайна</option>
          <option value="Основы проектирования баз данных">Основы проектирования баз данных</option>
        </select>

        <!-- Дата начала -->
        <input type="date" name="start_date" required>

        <!-- Способ оплаты -->
        <label><input type="radio" name="payment_method" value="cash" required> Наличные</label>
        <label><input type="radio" name="payment_method" value="bank" required> Перевод на банковский счёт</label>

        <!-- Кнопка отправки -->
        <button type="submit">Отправить заявку</button>
      </form>
    </div>

    <div class="auth-image">
      <img src="order.png" alt="Изображение">
    </div>
  </div>
</div>
<div style="margin-top: 20px; text-align: center;">
  <form action="logout.php" method="POST">
    <button type="submit" style="padding: 8px 16px; cursor: pointer;">Выйти с аккаунта</button>
  </form>
</div>

<?php include 'footer.php'; ?>

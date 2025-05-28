<?php include 'header.php'; ?>

<div class="auth-wrapper">
  <div class="auth-container">
    <div class="auth-form">
      <h2>Добро пожаловать 👋</h2>
      <p>Введите данные для регистрации:</p>
      <form method="POST" action="registerback.php">
        <input type="text" name="username" placeholder="Логин" required>
        <input type="password" name="password" placeholder="Пароль" required>
        <input type="text" name="full_name" placeholder="ФИО" required>
        <input type="text" name="phone" placeholder="+7(___)___-__-__" required>
        <input type="email" name="email" placeholder="Email" required>
        <button type="submit">Зарегистрироваться</button>
      </form>
      <p style="margin-top: 20px; font-size: 14px;">
        Уже есть аккаунт? <a href="login.php" style="color: #1976d2; text-decoration: none;">Войдите</a>
      </p>
    </div>
    <div class="auth-image">
      <img src="register.png" alt="Изображение">
    </div>
  </div>
</div>

<?php include 'footer.php'; ?>

<?php include 'header.php'; ?>

<div class="auth-wrapper">
  <div class="auth-container">
    <div class="auth-form">
      <h2>С возвращением 👋</h2>
      <p>Введите логин и пароль для входа:</p>
      <form method="POST" action="loginback.php">
        <input type="text" name="username" placeholder="Логин" required>
        <input type="password" name="password" placeholder="Пароль" required>
        <button type="submit">Войти</button>
      </form>
      <p style="margin-top: 20px; font-size: 14px;">
        Ещё не зарегистрированы? <a href="register.php" style="color: #1976d2; text-decoration: none;">Создайте аккаунт</a>
      </p>
    </div>
    <div class="auth-image">
      <img src="register.png" alt="Изображение">
    </div>
  </div>
</div>

<?php include 'footer.php'; ?>

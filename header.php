<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <title>Корочки есть</title>
  <link rel="stylesheet" href="style.css">
<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Amatic+SC:wght@400;700&display=swap" rel="stylesheet">

</head>
<body>
<header>
    <div class="leftheader">
      <div class="logo"><img src="logo.png" alt="logo"></div>
      <h1>Портал "Корочки есть"</h1> 
    </div>
<div class="rightheader">
    <button id=dashboard onclick="goToDash()">Ваши заявки</button>
    <button id=orders onclick="goToOrders()">Оформить заявку</button>
</div>
</header>
<main>
    <script>

    function goToDash() {
        window.location.href = 'dashboard.php';
    }
       function goToOrders() {
        window.location.href = 'orders.php';
    }


    </script>
</body>
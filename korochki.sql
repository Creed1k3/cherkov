-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 28 2025 г., 02:16
-- Версия сервера: 8.0.30
-- Версия PHP: 8.2.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `korochki`
--

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `course` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `payment_method` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT 'Ожидает рассмотрения',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `course`, `start_date`, `payment_method`, `status`, `created_at`) VALUES
(1, 3, 'Основы алгоритмизации и программирования', '2025-05-28', 'cash', 'обучение завершено', '2025-05-27 22:48:14'),
(2, 3, 'Основы проектирования баз данных', '2025-05-23', 'cash', 'идет обучение', '2025-05-27 22:50:40'),
(3, 9, 'Основы веб-дизайна', '2025-05-07', 'cash', 'обучение завершено', '2025-05-27 23:07:25'),
(4, 3, 'Основы веб-дизайна', '2025-05-30', 'cash', 'Ожидает рассмотрения', '2025-05-27 23:10:40');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `full_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('user','admin') COLLATE utf8mb4_unicode_ci DEFAULT 'user',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `full_name`, `phone`, `email`, `role`, `created_at`) VALUES
(1, '12321', '$2y$10$tZGykD/ZkLf681dp5hxIHe2.2YA9gZZaLMHsfdnT8qOZ/QoqG2VCu', '123312', '12321', '12312@ya', 'user', '2025-05-27 22:19:51'),
(2, 'Cred1k3', '$2y$10$Z3bXim6M3pNXzpWnDt10ieXI6vjisS.TNTL6b3Zu7IJw7tZS9lZHi', 'Владимир Мономах Ежикович', '+79558972211', 'ArtuR41K3@Gmail.com', 'user', '2025-05-27 22:27:43'),
(3, 'AAA', '$2y$10$im7VSx.1ni16r6mdIwPOmegjle1..0JPRitp.73XPfgSgHpgXXiDW', 'AAA', 'AAA', 'AAA@AAAA', 'user', '2025-05-27 22:28:38'),
(8, 'aaasss', '$2y$10$3N7oz/20xdDDyoX//O1e/uQsyhbvUlc2hiUsKXT3hBHKgMKLM.W1O', 'aaasss', 'aaasss', 'aaa@aaasss', 'admin', '2025-05-27 23:01:57'),
(9, 'rar', '$2y$10$BmigkySSmAQYmDESqUpU9e0O.UNWeyOlhBSal4yvOK2hteDOpyDJG', 'Ежик Арбузик Абоба', '8 951 569 07 29 ', 'Eshik@yandex.ru', 'user', '2025-05-27 23:07:15');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

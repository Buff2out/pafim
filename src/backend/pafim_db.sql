-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Авг 02 2023 г., 18:38
-- Версия сервера: 10.8.4-MariaDB-log
-- Версия PHP: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `pafim_db`
--

-- --------------------------------------------------------

--
-- Структура таблицы `bearer_tokens`
--

CREATE TABLE `bearer_tokens` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `bearer_tokens`
--

INSERT INTO `bearer_tokens` (`id`, `user_id`, `token`) VALUES
(1, 1, 'bytes1'),
(3, 4, '4299aa9cdfac7b30ae4ad01833f2869d'),
(4, 4, '7ce427a28553a4e106ee082ac0ad9af3'),
(5, 4, '7c0d983579d577ba2a91fc09b8d368b9'),
(6, 4, 'e412751d541b827553bf125cd82cbab8'),
(7, 4, 'e5d3a20c9db77c5d76f354632aef0576'),
(8, 4, '610d954bf90a6ea2f7bb2649c3d89529'),
(9, 4, '9fd99faebbb02e071cbed0a7ca4d3946'),
(10, 5, '8d0eeba3f78267d78e78d1a6513e4da3'),
(11, 4, 'afb2fbb4633122ffb1e28d2f49eb66ba4f'),
(12, 4, 'bfb086da9541dbd26b6672a53fd46169'),
(13, 4, 'c5f913ffac808b1a1535fabe6b35e16b'),
(14, 4, '3bde38f3b17851ba6d31bc13e2f3d1ae'),
(15, 5, '7cc314bd3999cc307c463290af01c0e7'),
(16, 5, 'a497799ea7de4544667a647ffe05939f'),
(17, 4, '1a2c393e89b030c911842fc5a79f459c'),
(18, 4, '2faf58027b941001ede1ec82e32eaea3'),
(19, 4, '8e29d60d53412af8a9cb2a4b533b726a'),
(20, 4, 'b81aefd9c4a8d87d40d42cccd3f2ddf4'),
(21, 4, '50ae7892fba6c000444d304b44d6c9f2'),
(22, 4, '7366744a7dab4bf33de3514e3f1b66eb'),
(23, 4, 'f128d24325e4da34433748a9b271ac9f'),
(24, 4, 'ea0c024b7d4dbb6e61cf8efe1f0b1350'),
(25, 4, 'c5376ba7d396db9cfeffc68954d94d74'),
(26, 4, '5f9fc2e1826376eeae50f469c7a4edb9'),
(27, 4, 'd5c6e10492143dc1dfb7e29d282def65'),
(28, 4, '27d24c53ac55be037f4a26b920bf5fd4'),
(29, 4, '00336b8b61683a5d8f1c414032335515'),
(30, 4, 'dffc9a3084b0c6d7062ece0c78b0368c'),
(31, 5, 'f5527be59c7ae61a98fa7cfc154c3d4f');

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `balance` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `name`, `balance`) VALUES
(1, 'product 1', 5),
(2, 'product 2', 4);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pub_access_token` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transf_balances_chbx` tinyint(1) DEFAULT NULL,
  `transf_prices_chbx` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `pub_access_token`, `transf_balances_chbx`, `transf_prices_chbx`) VALUES
(1, 'first test name', 'first email test', 'passtest', NULL, 1, 0),
(2, 'scdname', 'scdemail', 'scdpass', NULL, NULL, NULL),
(3, 'Petya', 'PetyaEmail', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', NULL, NULL, NULL),
(4, 'Petya2', 'PetyaEmail2', '2aa60a8ff7fcd473d321e0146afd9e26df395147', 'PetyaEmail3', 1, 0),
(5, 'Petya3', 'PetyaEmail3', '1119cfd37ee247357e034a08d844eea25f6fd20f', NULL, NULL, NULL),
(6, 'Petya3', 'PetyaEmail3', '1119cfd37ee247357e034a08d844eea25f6fd20f', NULL, NULL, NULL),
(7, 'Petya3', 'PetyaEmail3', '1119cfd37ee247357e034a08d844eea25f6fd20f', NULL, NULL, NULL),
(8, 'Petya3', 'PetyaEmail3', '1119cfd37ee247357e034a08d844eea25f6fd20f', NULL, NULL, NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `bearer_tokens`
--
ALTER TABLE `bearer_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `bearer_tokens`
--
ALTER TABLE `bearer_tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `bearer_tokens`
--
ALTER TABLE `bearer_tokens`
  ADD CONSTRAINT `bearer_tokens_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

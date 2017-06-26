-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Июн 26 2017 г., 19:14
-- Версия сервера: 5.7.14
-- Версия PHP: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `super_bulka`
--

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `sort_order` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`id`, `name`, `sort_order`, `status`) VALUES
(1, 'Кренделя', 1, 1),
(2, 'Пончики', 2, 1),
(3, 'Кексы', 3, 1),
(4, 'Вафли', 4, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `availability` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `image` int(11) DEFAULT NULL,
  `description` text,
  `is_new` int(11) NOT NULL,
  `is_recommended` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `product`
--

INSERT INTO `product` (`id`, `name`, `code`, `price`, `brand`, `availability`, `category_id`, `image`, `description`, `is_new`, `is_recommended`, `status`) VALUES
(1, '', 123, 65, 'abc', 1, 1, NULL, NULL, 1, 1, 1),
(2, '', 123, 65, 'abc', 1, 1, NULL, NULL, 1, 1, 1),
(3, '', 123, 65, 'abc', 1, 1, NULL, NULL, 1, 1, 1),
(4, '', 123, 65, 'abc', 1, 1, NULL, NULL, 1, 1, 1),
(5, '', 123, 65, 'abc', 1, 1, NULL, NULL, 1, 1, 1),
(6, 'Пончик 1', 987, 100, 'abc', 1, 2, NULL, NULL, 0, 1, 1),
(7, 'Пончик 2', 954, 95, 'abc', 1, 2, NULL, NULL, 1, 1, 1),
(8, 'Пончик 3', 321, 85, 'abc', 1, 2, NULL, NULL, 0, 1, 1),
(9, 'Пончик 4', 951, 90, 'abc', 1, 2, NULL, NULL, 1, 1, 1),
(10, 'Пончик 5', 159, 95, 'abc', 1, 2, NULL, NULL, 0, 1, 1),
(11, 'Кекс 1', 987, 69, 'abc', 1, 3, NULL, NULL, 0, 1, 1),
(12, 'Кекс 2', 954, 93, 'def', 1, 3, NULL, NULL, 1, 1, 1),
(13, 'Кекс 3', 321, 88, 'def', 1, 3, NULL, NULL, 0, 1, 1),
(14, 'Кекс 4', 951, 92, 'abc', 1, 3, NULL, NULL, 1, 1, 1),
(15, 'Кекс 5', 159, 87, 'ghi', 1, 3, NULL, NULL, 0, 1, 1),
(16, 'Вафля 1', 753, 70, 'abc', 1, 4, NULL, NULL, 0, 1, 1),
(17, 'Вафля 2', 357, 94, 'ghi', 1, 4, NULL, NULL, 1, 1, 1),
(18, 'Вафля 3', 852, 77, 'def', 1, 4, NULL, NULL, 0, 1, 1),
(19, 'Вафля 4', 258, 91, 'ghi', 1, 4, NULL, NULL, 1, 1, 1),
(20, 'Вафля 5', 741, 81, 'ghi', 1, 4, NULL, NULL, 0, 1, 1),
(21, 'Крендель 1', 473, 99, 'abc', 1, 1, NULL, NULL, 0, 1, 1),
(22, 'Крендель 2', 945, 82, 'ghi', 1, 1, NULL, NULL, 1, 1, 1),
(23, 'Крендель 3', 356, 71, 'def', 1, 1, NULL, NULL, 0, 1, 1),
(24, 'Крендель 4', 369, 76, 'abc', 1, 1, NULL, NULL, 1, 1, 1),
(25, 'Крендель 5', 963, 70, 'ghi', 1, 1, NULL, NULL, 0, 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `product_order`
--

CREATE TABLE `product_order` (
  `id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_phone` varchar(255) NOT NULL,
  `user_comment` text NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `products` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `role`) VALUES
(1, 'tanya', 'tanya@tanya.com', '123456789', 'admin'),
(2, 'tanya', 'ttt@tanya.com', '123456789', '0'),
(3, 'fdfsafa', 'tttt@tanya.com', '123456789', '0');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `product_order`
--
ALTER TABLE `product_order`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT для таблицы `product_order`
--
ALTER TABLE `product_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

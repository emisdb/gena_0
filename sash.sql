-- phpMyAdmin SQL Dump
-- version 3.5.7
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 30 2014 г., 02:53
-- Версия сервера: 5.1.68-community-log
-- Версия PHP: 5.4.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `sash`
--

-- --------------------------------------------------------

--
-- Структура таблицы `account`
--

CREATE TABLE IF NOT EXISTS `account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `account`
--

INSERT INTO `account` (`id`, `name`) VALUES
(1, 'Счет 12 в ВТБ'),
(2, 'Касса офис'),
(3, 'Валютный счет в ВТБ');

-- --------------------------------------------------------

--
-- Структура таблицы `city`
--

CREATE TABLE IF NOT EXISTS `city` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `city`
--

INSERT INTO `city` (`id`, `name`) VALUES
(1, 'СПб'),
(2, 'Москва'),
(3, 'Рига');

-- --------------------------------------------------------

--
-- Структура таблицы `client`
--

CREATE TABLE IF NOT EXISTS `client` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `country_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `country_id` (`country_id`),
  KEY `country_id_2` (`country_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `client`
--

INSERT INTO `client` (`id`, `name`, `country_id`) VALUES
(1, 'Астория', 1),
(2, 'Арарат-Хайят', 1),
(3, 'Silva Line', 2),
(4, 'Green Travel', 3),
(5, 'Транскосм', 1),
(6, 'Finnconcert', 3);

-- --------------------------------------------------------

--
-- Структура таблицы `concert`
--

CREATE TABLE IF NOT EXISTS `concert` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `concert`
--

INSERT INTO `concert` (`id`, `name`) VALUES
(1, 'Hackett'),
(2, 'Ленинград');

-- --------------------------------------------------------

--
-- Структура таблицы `constants`
--

CREATE TABLE IF NOT EXISTS `constants` (
  `_key` varchar(8) NOT NULL,
  `_value` varchar(64) NOT NULL,
  PRIMARY KEY (`_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `constants`
--

INSERT INTO `constants` (`_key`, `_value`) VALUES
('author', 'EMIS.DB'),
('expfrom', '2014-01-31'),
('expto', '2014-04-30'),
('incfrom', '2014-02-01'),
('incto', '2014-04-15'),
('payfrom', '2014-03-01'),
('payto', '2014-04-30');

-- --------------------------------------------------------

--
-- Структура таблицы `country`
--

CREATE TABLE IF NOT EXISTS `country` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `country`
--

INSERT INTO `country` (`id`, `name`) VALUES
(1, 'Россия'),
(2, 'Швеция'),
(3, 'Финляндия');

-- --------------------------------------------------------

--
-- Структура таблицы `currency`
--

CREATE TABLE IF NOT EXISTS `currency` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(4) NOT NULL,
  `longname` varchar(16) NOT NULL,
  `rate` float(10,2) NOT NULL DEFAULT '1.00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `currency`
--

INSERT INTO `currency` (`id`, `name`, `longname`, `rate`) VALUES
(1, 'RUR', 'Рубль', 1.00),
(2, 'EUR', 'Евро', 51.00);

-- --------------------------------------------------------

--
-- Структура таблицы `department`
--

CREATE TABLE IF NOT EXISTS `department` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `department`
--

INSERT INTO `department` (`id`, `name`) VALUES
(1, 'Бухгалтерия');

-- --------------------------------------------------------

--
-- Структура таблицы `exp`
--

CREATE TABLE IF NOT EXISTS `exp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `client_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `concert_id` int(11) NOT NULL,
  `expence_id` int(11) NOT NULL,
  `currency_id` int(11) NOT NULL,
  `amount` float DEFAULT NULL,
  `dateinserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date` date NOT NULL,
  `pay` tinyint(1) NOT NULL DEFAULT '0',
  `link` varchar(128) DEFAULT NULL,
  `city_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `country_id` (`client_id`),
  KEY `client_id` (`client_id`),
  KEY `department_id` (`department_id`),
  KEY `users_id` (`users_id`),
  KEY `concert_id` (`concert_id`),
  KEY `expence_id` (`expence_id`),
  KEY `currency_id` (`currency_id`),
  KEY `city_id` (`city_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=36 ;

--
-- Дамп данных таблицы `exp`
--

INSERT INTO `exp` (`id`, `name`, `client_id`, `department_id`, `users_id`, `concert_id`, `expence_id`, `currency_id`, `amount`, `dateinserted`, `date`, `pay`, `link`, `city_id`) VALUES
(1, 'Проживание в гостиннице', 1, 1, 5, 1, 1, 1, 5600, '2014-03-15 20:21:03', '2014-03-01', 1, 'User_Videos_Links.png', 1),
(2, 'Доп. расходы по гостиннице', 1, 1, 5, 1, 1, 2, 500, '2014-03-15 23:16:57', '2014-03-10', 1, '', 1),
(3, 'Проживание в гостиннице', 2, 1, 5, 1, 3, 1, 5800, '2014-03-15 23:38:04', '2014-03-12', 1, '', 2),
(4, 'бар в гостиннице', 2, 1, 5, 1, 1, 1, 6000, '2014-03-17 23:11:20', '2014-03-13', 1, '', 2),
(5, 'Bill #3245', 4, 1, 5, 2, 2, 2, 1000, '2014-03-19 12:37:38', '2014-03-09', 1, '', 2),
(6, '123 за проживание', 1, 1, 5, 2, 1, 1, 247, '2014-03-26 10:29:02', '2014-03-18', 1, 'direct_traffic_code.JPG', 1),
(7, '', 3, 1, 5, 1, 2, 1, 678, '2014-04-01 15:52:28', '2014-04-01', 1, '', 1),
(8, '', 3, 1, 5, 1, 2, 1, 456, '2014-04-01 15:58:17', '2014-04-28', 0, '', 1),
(9, 'за мат', 5, 1, 5, 2, 3, 1, 678, '2014-04-01 16:00:53', '2014-04-27', 0, '', 2),
(10, '', 2, 1, 5, 2, 1, 1, 7000, '2014-04-01 16:04:00', '2014-04-01', 1, '', 2),
(11, '', 2, 1, 5, 2, 1, 1, 100, '2014-04-01 16:08:08', '2014-04-02', 2, '', 2),
(12, '5 харпов', 2, 1, 5, 2, 2, 1, 1400, '2014-04-04 13:55:42', '2014-04-04', 3, '', 2),
(13, 'чтото', 3, 1, 5, 1, 2, 1, 4345, '2014-04-04 14:40:25', '2014-04-04', 1, '', 3),
(14, '', 2, 1, 5, 2, 1, 1, 234, '2014-04-09 12:21:10', '2014-04-09', 3, '', 1),
(15, '123', 3, 1, 5, 1, 1, 1, 123, '2014-04-09 12:24:10', '2014-04-09', 0, '', 1),
(16, '', 1, 1, 5, 2, 2, 1, 678, '2014-04-09 12:29:13', '2014-04-09', 0, '', 1),
(17, 'Bill #32425', 1, 1, 5, 1, 3, 1, 4343, '2014-04-09 12:31:14', '2014-04-09', 3, '', 1),
(18, '', 3, 1, 5, 2, 3, 2, 123, '2014-04-09 12:41:34', '2014-04-09', 0, '', 1),
(19, '', 3, 1, 5, 2, 3, 2, 123, '2014-04-09 12:42:05', '2014-04-09', 0, '', 1),
(20, '', 3, 1, 5, 2, 3, 2, 123, '2014-04-09 12:42:10', '2014-04-09', 0, '', 1),
(21, '', 1, 1, 5, 1, 3, 1, 700, '2014-04-09 12:43:00', '2014-04-09', 3, '', 1),
(22, '5 харпов', 3, 1, 5, 1, 2, 1, 900, '2014-04-09 12:51:53', '2014-04-09', 3, '', 1),
(23, '', 2, 1, 5, 1, 6, 1, 7890, '2014-04-09 12:55:42', '2014-04-09', 3, '', 1),
(24, '', 1, 1, 5, 2, 2, 1, 900, '2014-04-09 12:58:50', '2014-04-09', 0, '', 1),
(25, '', 1, 1, 5, 2, 1, 1, 700, '2014-04-09 12:59:38', '2014-04-09', 0, '', 1),
(26, '', 3, 1, 5, 2, 2, 1, 800, '2014-04-09 13:01:19', '2014-04-09', 0, '', 1),
(27, '', 3, 1, 5, 2, 2, 1, 678, '2014-04-09 13:07:59', '2014-04-09', 0, '', 1),
(28, 'счет №456', 3, 1, 5, 2, 3, 2, 456, '2014-04-09 13:09:44', '2014-04-09', 0, '', 1),
(29, '', 4, 1, 5, 2, 6, 1, 123, '2014-04-10 13:41:59', '2014-04-10', 0, '', 2),
(30, 'счет №456', 1, 1, 5, 2, 1, 1, 20000, '2014-04-11 15:33:06', '2014-04-11', 0, '', 1),
(31, 'er', 1, 1, 5, 1, 1, 1, 1000, '2014-04-11 19:39:50', '2014-01-02', 1, 'image01.png', 1),
(32, '', 2, 1, 5, 2, 1, 2, 200, '2014-04-11 19:45:21', '2014-01-04', 0, '', 2),
(33, '', 5, 1, 5, 2, 1, 1, 4500, '2014-04-11 19:47:39', '2014-01-06', 0, '', 2),
(34, '', 2, 1, 5, 1, 2, 1, 600, '2014-04-12 14:19:46', '2014-01-20', 2, '', 2),
(35, '', 4, 1, 5, 2, 2, 1, 567, '2014-04-12 14:39:22', '2014-01-12', 0, '', 3);

-- --------------------------------------------------------

--
-- Структура таблицы `expence`
--

CREATE TABLE IF NOT EXISTS `expence` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `type` (`type`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Дамп данных таблицы `expence`
--

INSERT INTO `expence` (`id`, `name`, `type`) VALUES
(1, 'Размещение', 0),
(2, 'Транспортирока', 0),
(3, 'Продакшен', 0),
(6, 'Выручка', 1),
(7, 'Кредит', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `inc`
--

CREATE TABLE IF NOT EXISTS `inc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) DEFAULT NULL,
  `client_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `concert_id` int(11) DEFAULT NULL,
  `expence_id` int(11) NOT NULL,
  `currency_id` int(11) NOT NULL,
  `amount` float DEFAULT NULL,
  `dateinserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date` date NOT NULL,
  `link` varchar(128) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `account_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `country_id` (`client_id`),
  KEY `client_id` (`client_id`),
  KEY `department_id` (`department_id`),
  KEY `users_id` (`users_id`),
  KEY `concert_id` (`concert_id`),
  KEY `expence_id` (`expence_id`),
  KEY `currency_id` (`currency_id`),
  KEY `city_id` (`city_id`),
  KEY `account_id` (`account_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Дамп данных таблицы `inc`
--

INSERT INTO `inc` (`id`, `name`, `client_id`, `department_id`, `users_id`, `concert_id`, `expence_id`, `currency_id`, `amount`, `dateinserted`, `date`, `link`, `city_id`, `account_id`) VALUES
(1, 'деньги', 1, 1, 5, 1, 1, 1, 345, '2014-03-23 19:20:04', '2014-03-17', '', 1, 1),
(3, 'деньги', 1, 1, 5, 1, 1, 2, 3, '2014-03-23 19:22:17', '2014-03-17', '', 1, 1),
(4, '', 1, 1, 5, NULL, 1, 2, 3, '2014-03-23 19:22:17', '2014-03-16', NULL, NULL, 1),
(5, 'деньги', 1, 1, 5, NULL, 1, 2, 34, '2014-03-23 19:22:17', '2014-03-17', NULL, NULL, 2),
(8, 'опа', 5, 1, 5, 2, 6, 1, 12340, '2014-04-02 15:23:36', '2014-03-20', NULL, 1, 1),
(9, 'приход', 4, 1, 5, 2, 6, 1, 34000, '2014-04-15 02:49:55', '2014-03-01', '', 1, 1),
(10, '', 5, 1, 5, 2, 6, 1, 45000, '2014-04-15 02:59:56', '2014-03-05', 'Attachments_2014414.zip', 2, 1),
(11, '', 4, 1, 5, 1, 6, 2, 5000, '2014-04-15 03:12:20', '2014-02-28', '', 2, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `pay`
--

CREATE TABLE IF NOT EXISTS `pay` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) DEFAULT NULL,
  `exp_id` int(11) NOT NULL,
  `amount` float DEFAULT NULL,
  `dateinserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date` date NOT NULL,
  `account_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `expence_id` (`exp_id`),
  KEY `account_id` (`account_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=42 ;

--
-- Дамп данных таблицы `pay`
--

INSERT INTO `pay` (`id`, `name`, `exp_id`, `amount`, `dateinserted`, `date`, `account_id`) VALUES
(2, 'платежка 1234', 1, 5600, '2014-03-18 04:49:45', '2014-03-04', 1),
(3, 'платежка 45', 1, 340, '2014-03-22 20:42:50', '2014-03-16', 1),
(5, 'платежка 40', 1, 30, '2014-03-22 20:42:50', '2014-03-16', 2),
(6, 'выплата', 4, 900, '2014-03-26 06:03:08', '2014-03-23', 2),
(7, 'оплата', 6, 100, '2014-03-26 10:42:14', '2014-03-26', 2),
(8, 'оплата', 6, 100, '2014-03-26 10:42:35', '2014-03-26', 2),
(9, 'опл', 6, 100, '2014-03-26 10:46:32', '2014-03-26', 2),
(12, 'про', 4, 44, '2014-03-26 10:49:23', '2014-03-26', 1),
(13, 'xnj', 3, 456, '2014-03-26 13:29:09', '2014-03-26', 1),
(14, 'xnj', 3, 456, '2014-03-26 13:30:11', '2014-03-26', 1),
(15, 'за макса', 12, 1400, '2014-04-04 14:01:17', '2014-04-04', 2),
(25, 'имхо', 2, 300, '2014-04-06 17:27:21', '2014-04-06', 1),
(26, 'опа', 4, 5056, '2014-04-06 17:30:26', '2014-04-06', 1),
(29, '', 5, 1000, '2014-04-07 08:49:52', '2014-04-07', 2),
(30, 'прверка', 2, 100, '2014-04-07 09:39:47', '2014-04-07', 1),
(31, 'плат. 234', 10, 6000, '2014-04-07 09:47:18', '2014-04-07', 1),
(32, 'Платежка 1234', 2, 80, '2014-04-09 13:11:32', '2014-04-09', 1),
(33, '', 2, 20, '2014-04-10 08:37:08', '2014-04-10', 2),
(34, '', 3, 4888, '2014-04-10 08:38:18', '2014-04-10', 1),
(35, '', 7, 678, '2014-04-11 15:36:01', '2014-04-11', 1),
(36, '', 31, 1000, '2014-04-11 19:49:54', '2014-01-26', 2),
(37, '', 34, 200, '2014-04-12 14:21:23', '2014-01-21', 2),
(38, '', 10, 1000, '2014-04-15 03:30:59', '2014-03-20', 2),
(39, '', 11, 50, '2014-04-15 03:31:50', '2014-04-01', 2),
(40, '', 11, 30, '2014-04-15 03:36:25', '2014-04-15', 2),
(41, '', 13, 4345, '2014-04-15 03:38:03', '2014-03-13', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(10) NOT NULL,
  `pwd` varchar(10) NOT NULL,
  `email` varchar(128) NOT NULL,
  `perm` enum('superadmin','admin','superuser') DEFAULT NULL,
  `title` varchar(32) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `login` (`login`),
  KEY `pwd` (`pwd`)
) ENGINE=InnoDB  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `pwd`, `email`, `perm`, `title`) VALUES
(5, 'denis', '123', '', 'superadmin', 'Денис'),
(6, 'guest', '111', 'yo', 'superuser', 'Гость');

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `client`
--
ALTER TABLE `client`
  ADD CONSTRAINT `client_ibfk_1` FOREIGN KEY (`country_id`) REFERENCES `country` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `exp`
--
ALTER TABLE `exp`
  ADD CONSTRAINT `exp_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `client` (`id`),
  ADD CONSTRAINT `exp_ibfk_2` FOREIGN KEY (`department_id`) REFERENCES `department` (`id`),
  ADD CONSTRAINT `exp_ibfk_3` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `exp_ibfk_4` FOREIGN KEY (`concert_id`) REFERENCES `concert` (`id`),
  ADD CONSTRAINT `exp_ibfk_5` FOREIGN KEY (`expence_id`) REFERENCES `expence` (`id`),
  ADD CONSTRAINT `exp_ibfk_6` FOREIGN KEY (`currency_id`) REFERENCES `currency` (`id`),
  ADD CONSTRAINT `exp_ibfk_7` FOREIGN KEY (`city_id`) REFERENCES `city` (`id`);

--
-- Ограничения внешнего ключа таблицы `inc`
--
ALTER TABLE `inc`
  ADD CONSTRAINT `inc_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `client` (`id`),
  ADD CONSTRAINT `inc_ibfk_10` FOREIGN KEY (`city_id`) REFERENCES `city` (`id`),
  ADD CONSTRAINT `inc_ibfk_2` FOREIGN KEY (`department_id`) REFERENCES `department` (`id`),
  ADD CONSTRAINT `inc_ibfk_3` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `inc_ibfk_5` FOREIGN KEY (`expence_id`) REFERENCES `expence` (`id`),
  ADD CONSTRAINT `inc_ibfk_6` FOREIGN KEY (`currency_id`) REFERENCES `currency` (`id`),
  ADD CONSTRAINT `inc_ibfk_8` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`),
  ADD CONSTRAINT `inc_ibfk_9` FOREIGN KEY (`concert_id`) REFERENCES `concert` (`id`);

--
-- Ограничения внешнего ключа таблицы `pay`
--
ALTER TABLE `pay`
  ADD CONSTRAINT `pay_ibfk_1` FOREIGN KEY (`exp_id`) REFERENCES `exp` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pay_ibfk_2` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

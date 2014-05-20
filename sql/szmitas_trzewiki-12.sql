-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Czas wygenerowania: 19 May 2014, 20:30
-- Wersja serwera: 5.5.37
-- Wersja PHP: 5.3.10-1ubuntu3.11

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Baza danych: `szmitas_trzewiki`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `admins`
--

CREATE TABLE IF NOT EXISTS `admins` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `login` text COLLATE utf8_polish_ci NOT NULL,
  `password` text COLLATE utf8_polish_ci NOT NULL,
  `salt` text COLLATE utf8_polish_ci NOT NULL,
  `email` text COLLATE utf8_polish_ci NOT NULL,
  `first_name` text COLLATE utf8_polish_ci NOT NULL,
  `last_name` text COLLATE utf8_polish_ci NOT NULL,
  `status` text COLLATE utf8_polish_ci NOT NULL,
  `deleted` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=2 ;

--
-- Zrzut danych tabeli `admins`
--

INSERT INTO `admins` (`admin_id`, `login`, `password`, `salt`, `email`, `first_name`, `last_name`, `status`, `deleted`) VALUES
(1, 'admin', 'f5bee9a055b0b000f86203b018c685ed8fbc1d22ce99ab6f59c02c03f8876dcb', '', 'aaaaa@ww.ww', 'Andrzej', 'Nowak', '1', 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `carts`
--

CREATE TABLE IF NOT EXISTS `carts` (
  `cart_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` text COLLATE utf8_polish_ci NOT NULL,
  `deleted` int(11) DEFAULT '0',
  PRIMARY KEY (`cart_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=15 ;

--
-- Zrzut danych tabeli `carts`
--

INSERT INTO `carts` (`cart_id`, `customer_id`, `create_date`, `status`, `deleted`) VALUES
(1, 4, '2014-05-18 14:33:13', 'ordered', 0),
(2, 11, '2014-05-18 17:46:03', 'new', 0),
(3, 12, '2014-05-18 17:49:52', 'new', 0),
(4, 13, '2014-05-19 17:42:35', 'ordered', 0),
(10, 13, '2014-05-19 17:43:53', 'ordered', 0),
(11, 13, '2014-05-19 17:52:11', 'new', 0),
(12, 4, '2014-05-19 18:10:35', 'new', 0),
(13, 14, '2014-05-19 18:12:01', 'ordered', 0),
(14, 14, '2014-05-19 18:12:49', 'new', 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `cart_items`
--

CREATE TABLE IF NOT EXISTS `cart_items` (
  `cart_item_id` int(11) NOT NULL AUTO_INCREMENT,
  `cart_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `deleted` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`cart_item_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=21 ;

--
-- Zrzut danych tabeli `cart_items`
--

INSERT INTO `cart_items` (`cart_item_id`, `cart_id`, `item_id`, `deleted`) VALUES
(12, 1, 198, 1),
(13, 1, 199, 0),
(14, 1, 200, 0),
(15, 1, 120, 0),
(16, 4, 129, 0),
(17, 4, 112, 0),
(18, 10, 121, 0),
(19, 13, 201, 0),
(20, 13, 34, 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `contents`
--

CREATE TABLE IF NOT EXISTS `contents` (
  `content_id` int(11) NOT NULL AUTO_INCREMENT,
  `content_key` text COLLATE utf8_polish_ci NOT NULL,
  `content_value` text COLLATE utf8_polish_ci NOT NULL,
  `deleted` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`content_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=13 ;

--
-- Zrzut danych tabeli `contents`
--

INSERT INTO `contents` (`content_id`, `content_key`, `content_value`, `deleted`) VALUES
(6, 'aaaatdfgf', 'KONTENT VALgggdfg\r\n   ', 0),
(7, 'bbbb', 'bbbbbbgh', 1),
(8, 'key heh', 'val heh', 0),
(9, 'key heh', 'val heh', 0),
(10, 'n', 'n', 0),
(11, 'fff', 'hg', 0),
(12, 'fff', 'hg', 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
  `customer_id` int(11) NOT NULL AUTO_INCREMENT,
  `login` text COLLATE utf8_polish_ci NOT NULL,
  `password` text COLLATE utf8_polish_ci NOT NULL,
  `salt` text COLLATE utf8_polish_ci NOT NULL,
  `email` text COLLATE utf8_polish_ci NOT NULL,
  `first_name` text COLLATE utf8_polish_ci,
  `last_name` text COLLATE utf8_polish_ci,
  `street` text COLLATE utf8_polish_ci,
  `street_additional` text COLLATE utf8_polish_ci,
  `zip_code` text COLLATE utf8_polish_ci,
  `city` text COLLATE utf8_polish_ci,
  `status` text COLLATE utf8_polish_ci NOT NULL,
  `deleted` int(11) DEFAULT '0',
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=15 ;

--
-- Zrzut danych tabeli `customers`
--

INSERT INTO `customers` (`customer_id`, `login`, `password`, `salt`, `email`, `first_name`, `last_name`, `street`, `street_additional`, `zip_code`, `city`, `status`, `deleted`) VALUES
(4, 'customer', '9037f08c5e4ceb583d573dd2f56c98afc2c03938d959dd612e40b16d9acbb4ce', 't0j35tr4Nd0/\\/\\0wAsool', 'customer@customer.pl', 'Marta', 'Nowak', 'Kozia 14', NULL, '62-055', 'Kraków', 'ACTIVE', 0),
(13, 'customer2', 'c831641c4edba3ca5d405a4c33280c29d91d5b3719a71ee77dffe36f2b5af411', '!{''#fsV}ll?HdCUY8\\Fz.x_C}', 'customer2@maui.pl', 'Jan', 'Kowalski', 'Klonowa 49/16a', NULL, '61-553', 'Poznań', 'INACTIVE', 0),
(14, 'customer3', '24c44aeb0b18da19ceceac86470bbfd311c785a2b1a2d69163b3ef120e0e55ca', 'B>ZiX/sdgxx;AN**z@Jj&9JnL', 'customer3@mail.pl', 'Karol', 'Wójcik', 'Polska 14', NULL, '66-666', 'Wrocław', 'ACTIVE', 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `size_id` int(11) NOT NULL,
  `price` float NOT NULL,
  `price2` float DEFAULT NULL,
  `deleted` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`item_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=254 ;

--
-- Zrzut danych tabeli `items`
--

INSERT INTO `items` (`item_id`, `product_id`, `size_id`, `price`, `price2`, `deleted`) VALUES
(5, 8, 8, 359, 300, 0),
(6, 8, 10, 359, NULL, 0),
(7, 7, 8, 459, 399, 0),
(8, 6, 7, 299, 259, 0),
(9, 2, 12, 599, NULL, 0),
(10, 3, 11, 499, NULL, 0),
(11, 4, 11, 499, NULL, 0),
(12, 6, 4, 299, 259, 0),
(13, 6, 4, 299, 259, 0),
(14, 6, 10, 299, 259, 0),
(15, 6, 10, 299, 259, 0),
(16, 6, 10, 299, 259, 0),
(17, 6, 10, 299, 259, 0),
(18, 6, 11, 299, 259, 0),
(19, 6, 11, 299, 259, 0),
(20, 6, 11, 299, 259, 0),
(21, 6, 12, 299, 259, 0),
(22, 6, 12, 299, 259, 0),
(23, 6, 13, 299, 259, 0),
(24, 6, 14, 299, 259, 0),
(25, 6, 14, 299, 259, 0),
(26, 6, 14, 299, 259, 0),
(27, 6, 14, 299, 259, 0),
(28, 6, 14, 299, 259, 0),
(29, 6, 15, 299, 259, 0),
(30, 6, 18, 299, 259, 0),
(31, 6, 18, 299, 259, 0),
(32, 6, 19, 299, 259, 0),
(34, 9, 22, 669, 559, 1),
(35, 9, 22, 669, 559, 0),
(36, 9, 22, 669, 559, 0),
(37, 9, 23, 669, 559, 0),
(38, 9, 23, 669, 559, 0),
(39, 9, 24, 669, 559, 0),
(40, 9, 24, 669, 559, 0),
(41, 9, 24, 669, 559, 0),
(42, 9, 24, 669, 559, 0),
(43, 9, 25, 669, 559, 0),
(44, 9, 25, 669, 559, 0),
(45, 9, 26, 669, 559, 0),
(46, 9, 26, 669, 559, 0),
(47, 9, 26, 669, 559, 0),
(48, 9, 26, 669, 559, 0),
(49, 9, 26, 669, 559, 0),
(50, 9, 27, 669, 559, 0),
(51, 9, 27, 669, 559, 0),
(52, 9, 27, 669, 559, 0),
(53, 9, 28, 669, 559, 0),
(54, 9, 30, 669, 559, 0),
(55, 9, 31, 669, 559, 0),
(56, 9, 31, 669, 559, 0),
(57, 10, 22, 299, NULL, 0),
(58, 10, 22, 299, NULL, 0),
(59, 10, 22, 299, NULL, 0),
(60, 10, 23, 299, NULL, 0),
(61, 10, 23, 299, NULL, 0),
(62, 10, 23, 299, NULL, 0),
(63, 10, 23, 299, NULL, 0),
(64, 10, 25, 299, NULL, 0),
(65, 10, 25, 299, NULL, 0),
(66, 10, 25, 299, NULL, 0),
(67, 10, 27, 299, NULL, 0),
(68, 10, 29, 299, NULL, 0),
(69, 10, 32, 299, NULL, 0),
(71, 11, 23, 379, 349, 0),
(72, 11, 23, 379, 349, 0),
(73, 11, 25, 379, 349, 0),
(74, 11, 25, 379, 349, 0),
(75, 11, 25, 379, 349, 0),
(76, 11, 26, 379, 349, 0),
(77, 11, 27, 379, 349, 0),
(78, 11, 28, 379, 349, 0),
(79, 11, 28, 379, 349, 0),
(80, 11, 30, 379, 349, 0),
(81, 11, 32, 379, 349, 0),
(82, 11, 32, 379, 349, 0),
(83, 11, 33, 379, 349, 0),
(84, 12, 22, 359, NULL, 0),
(85, 12, 22, 359, NULL, 0),
(86, 12, 24, 359, NULL, 0),
(87, 12, 24, 359, NULL, 0),
(88, 12, 24, 359, NULL, 0),
(89, 12, 24, 359, NULL, 0),
(90, 12, 25, 359, NULL, 0),
(91, 12, 25, 359, NULL, 0),
(92, 12, 25, 359, NULL, 0),
(93, 12, 26, 359, NULL, 0),
(94, 12, 30, 359, NULL, 0),
(95, 12, 30, 359, NULL, 0),
(96, 12, 32, 359, NULL, 0),
(97, 12, 33, 359, NULL, 0),
(98, 13, 25, 419, NULL, 0),
(99, 13, 25, 419, NULL, 0),
(100, 13, 25, 419, NULL, 0),
(101, 13, 25, 419, NULL, 0),
(102, 13, 26, 419, NULL, 0),
(103, 13, 26, 419, NULL, 0),
(104, 13, 26, 419, NULL, 0),
(105, 13, 27, 419, NULL, 0),
(106, 13, 27, 419, NULL, 0),
(107, 13, 28, 419, NULL, 0),
(108, 13, 29, 419, NULL, 0),
(109, 14, 35, 379, NULL, 0),
(110, 14, 35, 379, NULL, 0),
(111, 14, 35, 379, NULL, 0),
(112, 14, 36, 379, NULL, 1),
(113, 14, 40, 379, NULL, 0),
(114, 14, 40, 379, NULL, 0),
(115, 14, 41, 379, NULL, 0),
(116, 14, 43, 379, NULL, 0),
(117, 14, 43, 379, NULL, 0),
(118, 15, 36, 459, NULL, 0),
(119, 15, 36, 459, NULL, 0),
(120, 15, 38, 459, NULL, 1),
(121, 15, 38, 459, NULL, 0),
(122, 15, 39, 459, NULL, 0),
(123, 15, 40, 459, NULL, 0),
(124, 15, 41, 459, NULL, 0),
(125, 15, 43, 459, NULL, 0),
(126, 16, 36, 399, NULL, 0),
(127, 16, 36, 399, NULL, 0),
(128, 16, 37, 399, NULL, 0),
(129, 16, 38, 399, NULL, 0),
(130, 16, 41, 399, NULL, 0),
(131, 16, 41, 399, NULL, 0),
(132, 16, 44, 399, NULL, 0),
(133, 17, 36, 279, NULL, 0),
(134, 17, 37, 279, NULL, 0),
(135, 17, 38, 279, NULL, 0),
(136, 17, 39, 279, NULL, 0),
(137, 18, 48, 399, NULL, 0),
(138, 18, 48, 399, NULL, 0),
(139, 18, 49, 399, NULL, 0),
(140, 18, 50, 399, NULL, 0),
(141, 18, 50, 399, NULL, 0),
(142, 18, 52, 399, NULL, 0),
(143, 18, 52, 399, NULL, 0),
(144, 18, 53, 399, NULL, 0),
(145, 18, 54, 399, NULL, 0),
(146, 18, 55, 399, NULL, 0),
(147, 19, 48, 399, NULL, 0),
(148, 19, 50, 399, NULL, 0),
(149, 19, 50, 399, NULL, 0),
(150, 19, 51, 399, NULL, 0),
(151, 19, 52, 399, NULL, 0),
(152, 19, 53, 399, NULL, 0),
(153, 19, 54, 399, NULL, 0),
(154, 19, 48, 469, NULL, 0),
(155, 19, 50, 469, NULL, 0),
(156, 19, 51, 469, NULL, 0),
(157, 20, 51, 469, NULL, 0),
(158, 20, 48, 469, NULL, 0),
(159, 20, 48, 469, NULL, 0),
(160, 21, 67, 519, NULL, 0),
(161, 21, 67, 519, NULL, 0),
(162, 21, 68, 519, NULL, 0),
(163, 21, 70, 519, NULL, 0),
(164, 21, 71, 519, NULL, 0),
(165, 21, 72, 519, NULL, 0),
(166, 21, 74, 519, NULL, 0),
(167, 21, 76, 519, NULL, 0),
(168, 22, 76, 359, NULL, 0),
(169, 22, 74, 359, NULL, 0),
(170, 22, 72, 359, NULL, 0),
(171, 22, 71, 359, NULL, 0),
(172, 22, 71, 359, NULL, 0),
(173, 22, 71, 359, NULL, 0),
(174, 23, 78, 449, 359, 0),
(175, 23, 78, 449, 359, 0),
(176, 23, 79, 449, 359, 0),
(177, 23, 79, 449, 359, 0),
(178, 23, 80, 449, 359, 0),
(179, 23, 82, 449, 359, 0),
(180, 23, 82, 449, 359, 0),
(181, 23, 82, 449, 359, 0),
(182, 23, 83, 449, 359, 0),
(183, 23, 84, 449, 359, 0),
(184, 23, 85, 449, 359, 0),
(185, 24, 80, 329, NULL, 0),
(186, 24, 80, 329, NULL, 0),
(187, 24, 80, 329, NULL, 0),
(188, 24, 82, 329, NULL, 0),
(189, 24, 82, 329, NULL, 0),
(190, 25, 104, 380, NULL, 0),
(191, 25, 104, 380, NULL, 0),
(192, 25, 104, 380, NULL, 0),
(193, 25, 105, 380, NULL, 0),
(194, 25, 105, 380, NULL, 0),
(195, 25, 105, 380, NULL, 0),
(196, 25, 106, 380, NULL, 0),
(197, 25, 107, 380, NULL, 0),
(198, 26, 99, 300, NULL, 0),
(199, 26, 99, 300, NULL, 1),
(200, 26, 99, 300, NULL, 1),
(201, 2, 4, 599, NULL, 1),
(202, 2, 4, 599, NULL, 0),
(203, 2, 4, 599, NULL, 0),
(204, 2, 5, 599, NULL, 0),
(205, 2, 5, 599, NULL, 0),
(206, 2, 5, 599, NULL, 0),
(207, 2, 5, 599, NULL, 0),
(208, 2, 6, 599, NULL, 0),
(209, 2, 7, 599, NULL, 0),
(210, 2, 7, 599, NULL, 0),
(211, 2, 8, 599, NULL, 0),
(212, 2, 8, 599, NULL, 0),
(213, 2, 9, 599, NULL, 0),
(214, 2, 10, 599, NULL, 0),
(215, 2, 10, 599, NULL, 0),
(216, 2, 10, 599, NULL, 0),
(217, 2, 11, 599, NULL, 0),
(218, 2, 12, 599, NULL, 0),
(219, 2, 12, 599, NULL, 0),
(220, 2, 13, 599, NULL, 0),
(221, 2, 13, 599, NULL, 0),
(222, 2, 13, 599, NULL, 0),
(223, 2, 14, 599, NULL, 0),
(224, 2, 14, 599, NULL, 0),
(225, 2, 14, 599, NULL, 0),
(226, 2, 15, 599, NULL, 0),
(227, 2, 16, 599, NULL, 0),
(228, 2, 17, 599, NULL, 0),
(229, 2, 17, 599, NULL, 0),
(230, 3, 17, 599, NULL, 0),
(231, 3, 17, 599, NULL, 0),
(232, 3, 17, 599, NULL, 0),
(233, 3, 16, 599, NULL, 0),
(234, 3, 16, 599, NULL, 0),
(235, 3, 15, 599, NULL, 0),
(236, 3, 15, 599, NULL, 0),
(237, 3, 13, 599, NULL, 0),
(238, 4, 10, 499, NULL, 0),
(239, 4, 10, 499, NULL, 0),
(240, 4, 10, 499, NULL, 0),
(241, 4, 11, 499, NULL, 0),
(242, 4, 11, 499, NULL, 0),
(243, 4, 12, 499, NULL, 0),
(244, 4, 14, 499, NULL, 0),
(245, 4, 14, 499, NULL, 0),
(246, 4, 15, 499, NULL, 0),
(247, 4, 16, 499, NULL, 0),
(248, 4, 16, 499, NULL, 0),
(249, 4, 16, 499, NULL, 0),
(250, 4, 17, 499, NULL, 0),
(251, 4, 17, 499, NULL, 0),
(252, 4, 18, 499, NULL, 0),
(253, 4, 19, 499, NULL, 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `logs`
--

CREATE TABLE IF NOT EXISTS `logs` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `action` text COLLATE utf8_polish_ci NOT NULL,
  `custom1` text COLLATE utf8_polish_ci,
  `custom2` text COLLATE utf8_polish_ci,
  `custom3` text COLLATE utf8_polish_ci,
  `deleted` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=92 ;

--
-- Zrzut danych tabeli `logs`
--

INSERT INTO `logs` (`log_id`, `admin_id`, `customer_id`, `action`, `custom1`, `custom2`, `custom3`, `deleted`) VALUES
(47, NULL, 13, 'customer_log_in', '', '', '2014-05-18 19:05:48', 0),
(48, NULL, 4, 'customer_log_in', '', '', '2014-05-19 17:05:43', 0),
(49, NULL, 4, 'customer_log_out', '', '', '2014-05-19 18:05:18', 0),
(50, NULL, 13, 'customer_log_in', '', '', '2014-05-19 18:05:23', 0),
(51, NULL, 13, 'new_transaction', '1', '', '2014-05-19 18:05:37', 0),
(52, NULL, 13, 'customer_created_new_cart', NULL, '', '2014-05-19 18:05:37', 0),
(53, NULL, 13, 'new_transaction', '2', '', '2014-05-19 18:05:34', 0),
(54, NULL, 13, 'customer_created_new_cart', '5', '', '2014-05-19 18:05:34', 0),
(55, NULL, 13, 'customer_log_out', '', '', '2014-05-19 18:05:08', 0),
(56, NULL, 13, 'customer_log_in', '', '', '2014-05-19 18:05:12', 0),
(57, NULL, 13, 'customer_log_out', '', '', '2014-05-19 19:05:36', 0),
(58, NULL, 13, 'customer_log_in', '', '', '2014-05-19 19:05:40', 0),
(59, NULL, 13, 'new_transaction', '3', '', '2014-05-19 19:32:57', 0),
(60, NULL, 13, 'customer_created_new_cart', '6', '', '2014-05-19 19:32:57', 0),
(61, NULL, 13, 'customer_log_out', '', '', '2014-05-19 19:05:24', 0),
(62, NULL, 13, 'customer_log_in', '', '', '2014-05-19 19:05:29', 0),
(63, NULL, 13, 'new_transaction', NULL, '', '2014-05-19 19:35:36', 0),
(64, NULL, 13, 'customer_created_new_cart', '7', '', '2014-05-19 19:35:36', 0),
(65, NULL, 13, 'customer_log_out', '', '', '2014-05-19 19:05:27', 0),
(66, NULL, 13, 'customer_log_in', '', '', '2014-05-19 19:05:31', 0),
(67, NULL, 13, 'new_transaction', NULL, '', '2014-05-19 19:37:45', 0),
(68, NULL, 13, 'customer_created_new_cart', '8', '', '2014-05-19 19:37:45', 0),
(69, NULL, 13, 'customer_log_out', '', '', '2014-05-19 19:05:20', 0),
(70, NULL, 13, 'customer_log_in', '', '', '2014-05-19 19:05:26', 0),
(71, NULL, 13, 'new_transaction', NULL, '', '2014-05-19 19:39:33', 0),
(72, NULL, 13, 'customer_created_new_cart', '9', '', '2014-05-19 19:39:33', 0),
(73, NULL, 13, 'customer_log_out', '', '', '2014-05-19 19:05:22', 0),
(74, NULL, 13, 'customer_log_in', '', '', '2014-05-19 19:05:47', 0),
(75, NULL, 13, 'new_transaction', '4', '', '2014-05-19 19:43:53', 0),
(76, NULL, 13, 'customer_created_new_cart', '10', '', '2014-05-19 19:43:53', 0),
(77, NULL, 13, 'new_transaction', '5', '', '2014-05-19 19:52:11', 0),
(78, NULL, 13, 'customer_created_new_cart', '11', '', '2014-05-19 19:52:11', 0),
(79, NULL, 13, 'customer_log_out', '', '', '2014-05-19 20:05:56', 0),
(80, NULL, 4, 'customer_log_in', '', '', '2014-05-19 20:05:04', 0),
(81, NULL, 4, 'new_transaction', '6', '', '2014-05-19 20:10:35', 0),
(82, NULL, 4, 'customer_created_new_cart', '12', '', '2014-05-19 20:10:35', 0),
(83, NULL, 4, 'customer_log_out', '', '', '2014-05-19 20:05:44', 0),
(84, NULL, 14, 'customer_register', '', '', '2014-05-19 20:12:01', 0),
(85, NULL, 14, 'customer_created_new_cart', '13', '', '2014-05-19 20:12:01', 0),
(86, NULL, 14, 'customer_log_in', '', '', '2014-05-19 20:05:05', 0),
(87, NULL, 14, 'new_transaction', '7', '', '2014-05-19 20:12:49', 0),
(88, NULL, 14, 'customer_created_new_cart', '14', '', '2014-05-19 20:12:49', 0),
(89, NULL, 14, 'customer_log_out', '', '', '2014-05-19 20:05:57', 0),
(90, NULL, 4, 'customer_log_in', '', '', '2014-05-19 20:05:02', 0),
(91, NULL, 4, 'customer_log_out', '', '', '2014-05-19 20:05:52', 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `manufacturers`
--

CREATE TABLE IF NOT EXISTS `manufacturers` (
  `manufacturer_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8_polish_ci NOT NULL,
  `deleted` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`manufacturer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=6 ;

--
-- Zrzut danych tabeli `manufacturers`
--

INSERT INTO `manufacturers` (`manufacturer_id`, `name`, `deleted`) VALUES
(1, 'Asics', 0),
(3, 'New Balance', 0),
(4, 'Mizuno', 0),
(5, 'Saucony', 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `media`
--

CREATE TABLE IF NOT EXISTS `media` (
  `media_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `file_path` text COLLATE utf8_polish_ci NOT NULL,
  `type` text COLLATE utf8_polish_ci NOT NULL,
  `deleted` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`media_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=76 ;

--
-- Zrzut danych tabeli `media`
--

INSERT INTO `media` (`media_id`, `product_id`, `file_path`, `type`, `deleted`) VALUES
(13, 8, 'fujitrainer2.jpg', 'image', 0),
(14, 5, 'emperor.jpg', 'image', 0),
(15, 8, 'fujitrainer2_2.jpg', 'image', 0),
(16, 6, 'enduro_9_men.jpg', 'image', 0),
(17, 2, 't33uq_0130.png', 'image', 0),
(18, 2, 't33uq_0130_1.png', 'image', 0),
(19, 2, 't33uq_0130_2.png', 'image', 0),
(20, 3, 't458q3670.jpg', 'image', 0),
(21, 3, 't458q3670-.jpg', 'image', 0),
(22, 4, 't3c0n_2801.png', 'image', 0),
(23, 4, 't3c0n_2801_n.png', 'image', 0),
(24, 7, 't3h4n_2693.png', 'image', 0),
(25, 7, 't3h4n_2693_n.png', 'image', 0),
(26, 9, 't39sq_7093.png', 'image', 0),
(27, 9, 't39sq_7093_n.png', 'image', 0),
(28, 10, 'asics.oberon8.w.jpg', 'image', 0),
(29, 10, 'asics.oberon8.m.s.jpg', 'image', 0),
(30, 11, 't470n-1901.jpg', 'image', 0),
(31, 12, 'asics_gel_pulse_5_ladies_running_shoes_t3d6n_6201-500x500.jpg', 'image', 0),
(32, 13, 't3r5n_2130.png', 'image', 0),
(33, 13, 't3r5n_2130_n.png', 'image', 0),
(34, 14, 'w790pp3_2.jpg', 'image', 0),
(35, 14, 'w790pp3_3.jpg', 'image', 0),
(36, 14, 'w790pp3_6.jpg', 'image', 0),
(37, 15, 'w860pl4.jpg', 'image', 0),
(38, 15, 'w860pl4_nb_15_i.jpg', 'image', 0),
(39, 15, 'w860pl4_nb_14_i.jpg', 'image', 0),
(40, 15, 'w860pl4_nb_16_i.jpg', 'image', 0),
(41, 16, 'wt10gp2_nb_02_i.jpg', 'image', 0),
(42, 16, 'wt10gp2_nb_03_i.jpg', 'image', 0),
(43, 16, 'wt10gp2_nb_06_i.jpg', 'image', 0),
(44, 17, 'w590bw2.jpg', 'image', 0),
(45, 17, 'w590bw2_1.jpg', 'image', 0),
(46, 17, 'w590bw2_3.jpg', 'image', 0),
(47, 18, 'mr00rb2_nb_14_i_2.jpg', 'image', 0),
(48, 18, 'mr00rb2_nb_15_i_2.jpg', 'image', 0),
(49, 18, 'mr00rb2_nb_16_i_2.jpg', 'image', 0),
(50, 19, 'm870bb2.jpg', 'image', 0),
(51, 19, 'm870bb2_1.jpg', 'image', 0),
(52, 19, 'm870bb2_3.jpg', 'image', 0),
(53, 19, 'm870bb2_4.jpg', 'image', 0),
(54, 19, 'm870bb2_5.jpg', 'image', 0),
(55, 19, 'm870bb2_6.jpg', 'image', 0),
(56, 19, 'm870bb2_2.jpg', 'image', 0),
(57, 20, 'm1080go3.jpg', 'image', 0),
(58, 20, 'm1080go3_1.jpg', 'image', 0),
(59, 20, 'm1080go3_4.jpg', 'image', 0),
(60, 20, 'm1080go3_2.jpg', 'image', 0),
(61, 20, 'm1080go3_3.jpg', 'image', 0),
(62, 21, '1gc144445_0.jpg', 'image', 0),
(63, 21, '1gc144445_1.jpg', 'image', 0),
(64, 22, 'j1ge144945.jpg', 'image', 0),
(65, 23, 'mizuno_wave_nexus_7_donna.jpg', 'image', 0),
(66, 24, '59e9d5b8-4eab-4264-a880-e623dc4d3c89.png', 'image', 0),
(67, 24, '320x226_j1gf141102-1_1.jpg', 'image', 0),
(68, 25, 'w54_76223_saucony_101793_1_.jpg', 'image', 0),
(69, 25, '10179-3_1.jpg', 'image', 0),
(70, 25, '10179-3_3_1200x735.jpg', 'image', 0),
(71, 25, '10179-3_4_1200x735.jpg', 'image', 0),
(72, 26, '20072-3_1_700x700.jpg', 'image', 0),
(73, 26, '20072-3_2_700x700.jpg', 'image', 0),
(74, 26, '20072-3_3_700x700.jpg', 'image', 0),
(75, 26, '20072-3_4_700x700.jpg', 'image', 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `manufacturer_id` int(11) NOT NULL,
  `product_no` text COLLATE utf8_polish_ci,
  `name` text COLLATE utf8_polish_ci NOT NULL,
  `description` text COLLATE utf8_polish_ci,
  `status` text COLLATE utf8_polish_ci,
  `deleted` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=27 ;

--
-- Zrzut danych tabeli `products`
--

INSERT INTO `products` (`product_id`, `manufacturer_id`, `product_no`, `name`, `description`, `status`, `deleted`) VALUES
(2, 1, '65', 'Asics GEL-Nimbus 15 Lite-Show', '<p>GEL-NIMBUS 15 to flagowy model buta amortyzującego w kolekcji ASICS. But ten dostarcza&nbsp;<strong>wyjątkowy komfort i amortyzację dla biegaczy neutralnych o</strong>raz z niewielką skłonnością do pronacji. &nbsp;</p>\r\n<p>Piętnasta edycja tego buta może być spokojnie nazywana&nbsp;<strong>najbardziej komfortową wersją w historii</strong>. Wprowadzono bowiem nowe cholewki wykonane w technologii ASICS FluidFit oznaczającej siateczkę, kt&oacute;ra rozciąga się w wielu kierunkach, aby stworzyć najlepsze dopasowanie do stopy. Ta innowacja wsp&oacute;lnie z technologiami Heel Clutching System oraz Discrete Eyestay Construction zapewnia niezwykle precyzyjne dopasowanie buta do stopy biegacza.</p>\r\n<p>Wyjątkowy komfort biegu w tym modelu GEL-NIMBUS dostarcza podeszwa środkowa spEVA wykonana z bardzo lekkiego i trwałego materiału. Wpływ na wygodę użytkowania tego buta posiada r&oacute;wnież inna technologia podeszwy środkowej &ndash; FluidRide, zapewniająca biegaczom&nbsp;<strong>najlepszą charakterystykę odbicia oraz amortyzację</strong>&nbsp;przy zachowaniu lekkości.</p>\r\n<p>Model GEL-NIMBUS 15 dla mężczyzn zawiera także technologię Trusstic System, kt&oacute;ra oferuje nieco większą sztywność skrętną dla dodatkowego wsparcia podczas biegu.</p>\r\n<p>Technologia Full Length Guidance Line widoczna jako rowek wzdłuż podeszwy, prowadzi stopę przez cały cykl ruchu idealnie kopiując tor ruchu ludzkiej stopy. Dzięki temu biegacz porusza się sprawniej, nawet wtedy, gdy podczas treningu pojawia się zmęczenie.</p>\r\n<p>Dzięki zaawansowanym technologicznie innowacjom zapewniającym amortyzację model GEL-NIMBUS 15 to&nbsp;<strong>idealny partner na długie wybiegania.</strong></p>\r\n<p>&nbsp;</p>\r\n<p><strong>Systemy i technologie:</strong></p>\r\n<p><strong>Rearfoot and Forefooot GEL Cushioning Systems</strong>&nbsp;- tłumi uderzenia o podłoże podczas biegu, pozwala na ruch w wielu płaszczyznach podczas całego cyklu biegu.</p>\r\n<p><strong>FluidRide</strong>&nbsp;- innowacja w technologii podeszwy środkowej ASICS. FluidRide zapewnia najlepszą charakterystykę odbicia oraz amortyzację przy zachowaniu lekkości.</p>\r\n<p><strong>Full Length Guidance Line</strong>&nbsp;- system pionowych rowk&oacute;w przecinających podeszwę wzdłuż linii progresji dla spotęgowania efektywności przetaczania stopy w całym cyklu biegu.</p>\r\n<p><strong>Guidance Trusstic</strong>&nbsp;- Trusstic System integruje konstrukcję Guidance Line dla spotęgowania efektywności biegu przy jednoczesnym zachowaniu integralnej struktury podeszwy środkowej.</p>\r\n<p><strong>AHAR+</strong>&nbsp;- guma stosowana w zewnętrznej podeszwie, kt&oacute;rą cechuje wysoka odporność na ścieranie.</p>\r\n<p><strong>Discrete Eyelet&nbsp;</strong>- ulepsza dopasowanie cholewki przy jednoczesnej redukcji możliwych podrażnień.</p>\r\n<p><strong>Clutch counter</strong>&nbsp;- zewnętrzny zapiętek zapewniający lepsze wsparcie i dopasowanie pięty.</p>\r\n<p><strong>Ortholite Sockliner&nbsp;</strong>- zapewnia amortyzację i antybakteryjne właściwości dla zdrowszego, suchego i chłodnego środowiska.</p>\r\n<p><strong>Clutch counter</strong>&nbsp;- zewnętrzny zapiętek zapewniający zwiększone wsparcie stopy oraz stwarzający doskonałe dopasowanie buta do pięty.</p>\r\n<p><strong>IGS (Impact Guidance System)</strong>&nbsp;- czyli technologiczne rozwiązanie konstrukcji buta, kt&oacute;re pozwala stopie sportowca na naturalne ruchy w trakcie poszczeg&oacute;lnych faz kroku oraz stanowi wsparcie dla podbicia stopy.</p>\r\n<p><strong>FluitFit&nbsp;</strong>- technologia ASICS FluidFit zawiera technologiczną siateczkę, kt&oacute;ra rozciąga się w wielu kierunkach, aby stworzyć najlepsze dopasowanie do stopy.</p>\r\n<p>Waga: 330g</p>\r\n<p>Drop: 10 mm</p>', 'new', 0),
(3, 1, '', 'Asics Gel-Noosa Tri 9', '<p>Nazwany na cześć australijskiego triathlonu, GEL-NOOSA TRI jest&nbsp;<strong>popularny ze względu na swoje triathlonowe właściwości</strong>&nbsp;oraz kolorowe wzornictwo.</p>\r\n<p>GEL-NOOSA TRI 9 zawiera dodatkowe elastyczne sznur&oacute;wki, kt&oacute;re wystarczy zaciągnąć w czasie biegu. Dzięki temu możesz&nbsp;<strong>zaoszczędzić czas w strefie zmian</strong>. Miękka, antypoślizgowa wyści&oacute;łka pozwala na noszenie obuwia r&oacute;wnież bez skarpet.</p>\r\n<p>Odważny&nbsp;<strong>nowy projekt cholewki</strong>&nbsp;zawiera inspirowane australijskim triathlonem odblaskowe wzornictwo, zapewniające widoczność.</p>\r\n<p><strong>Buty startowe, zapewniające wsparcie</strong>, wychodzące na przeciw potrzebom triathlonist&oacute;w w dniu startu.</p>\r\n<p>&nbsp;</p>\r\n<p><strong>Wybrane systemy i technologie:</strong></p>\r\n<p><strong>Impact Guidance System I.G.S.</strong>&nbsp;- filozofia wzornicza Asics. Konstrukcja podnosząca efektywność naturalnego chodu w całym procesie przetaczania stopy.</p>\r\n<p><strong>Rearfoot and Forefoot GEL Cushioning System</strong>&nbsp;- neutralizuje wstrząsy podczas fazy lądowania i wybicia oraz wspiera proces biegu.</p>\r\n<p><strong>Full Length Guidance Line</strong>&nbsp;- system pionowych rowk&oacute;w przecinających podeszwę wzdłuż linii progresji dla spotęgowania efektywności przetaczania stopy w całym cyklu biegu.</p>\r\n<p><strong>Dynamic DuoMax Support System</strong>&nbsp;- system podeszwy środkowej o podw&oacute;jnej gęstości dla zwiększonego wsparcia i stabilizacji stopy.</p>\r\n<p><strong>Solyte Midsole Material&nbsp;</strong>- materiał lżejszy niż standardowy Asics EVA i SpEVA. Charakteryzuje się ulepszonymi właściwościami amortyzującymi i wyjątkową trwałością.</p>\r\n<p><strong>WetGrip RubberSponge</strong>&nbsp;- materiał wykonany ze spaecjalnej mieszanki organicznych i nieorganicznych komponent&oacute;w, zaprojektowany by zwiększyć przyczepność nawet na mokrych nawierzchniach.</p>\r\n<p><strong>Clutch counter</strong>&nbsp;- zewnętrzny zapiętek zapewniający zwiększone wsparcie stopy oraz stwarzający doskonałe dopasowanie buta do pięty.</p>\r\n<p>Waga: 238g</p>', 'recommended', 0),
(4, 1, '', 'Asics GEL-Cumulus 15', '<p>GEL-CUMULUS 15 to kolejna edycja buta treningowego, kt&oacute;ry zapewnia&nbsp;<strong>wyjątkowy komfort użytkowania.</strong></p>\r\n<p>Nowością w tym wydaniu jest podeszwa środkowa SpEVA na pełnej długości dostarczająca dodatkową amortyzację. &nbsp;Wsp&oacute;lnie z widocznymi w podeszwie wkładkami żelowymi zlokalizowanymi w przedniej i tylnej części buta absorbuje wstrząsy wywoływane uderzeniem stopy o podłoże zapewniając&nbsp;<strong>doskonały komfort podczas biegu.</strong></p>\r\n<p>Model GEL-CUMULUS 15 dla kobiet zawiera r&oacute;wnież technologię Gender Specific Cushioning, charakteryzującą się tym, że warstwa podeszwy środkowej Solyte ulokowana w przedniej części buta ma gęstość dobraną&nbsp;<strong>specjalnie dla kobiet</strong>. Pozwala to na znaczne obniżenie wagi buta oraz poprawienie komfortu i amortyzacji.</p>\r\n<p>Technologia Full Length Guidance Line widoczna jako rowek wzdłuż podeszwy, prowadzi stopę przez cały cykl ruchu idealnie kopiując tor ruchu ludzkiej stopy. Dzięki temu biegaczka&nbsp;<strong>porusza się sprawniej</strong>, nawet wtedy, gdy podczas treningu pojawia się zmęczenie.</p>\r\n<p>Technologia Discrete Eyestay Construction w cholewce&nbsp;<strong>poprawia og&oacute;lne dopasowanie buta</strong>&nbsp;do stopy.</p>\r\n<p>&nbsp;</p>\r\n<p><strong>Systemy i technologie:</strong></p>\r\n<p><strong>Full Length Guidance Line</strong>&nbsp;- system pionowych rowk&oacute;w przecinających podeszwę wzdłuż linii progresji dla spotęgowania efektywności przetaczania stopy w całym cyklu biegu.</p>\r\n<p><strong>Solyte Midsole Material</strong>&nbsp;- materiał amortyzujący zapewniający niebywale niską wagę przy r&oacute;wnoczesnym zwiększeniu sprężystości i trwałości.</p>\r\n<p><strong>Forefoot GEL, Rearfoot GEL</strong>&nbsp;- system ASICS GEL bazuje na specjalnej wkładce wykonanej z silikonu, kt&oacute;ra zapewnia optymalną amortyzację. Wkładki żelowe są rozmieszczone w newralgicznych miejscach podeszwy środkowej i tak wkomponowane, aby zwiększyć funkcjonalność.</p>\r\n<p><strong>AHAR+</strong>&nbsp;- wysoce odporna na uszkodzenia i trwała guma używana jako gruba warstwa w miejscach narażonych na szczeg&oacute;lne uszkodzenia. Zwiększa trwałość obuwia.</p>\r\n<p><strong>ComfortDry Sockliner</strong>&nbsp;&ndash; trzywarstwowa wkładka wewnętrzna, gwarantująca lepsze dopasowanie do stopy, optymalną cyrkulację powietrza; posiada funkcje antybakteryjne.</p>\r\n<p><strong>I.G.S.</strong>&nbsp;- opracowany przez ASICS Impact Guidance. System jest rozwiązaniem technicznym zastosowanym w budowie buta, dzięki kt&oacute;remu zachowana jest możliwość naturalnych ruch&oacute;w stopy. System I.G.S. ułatwia zachowanie naturalnego chodu.</p>\r\n<p><strong>Discrete Eyelet&nbsp;</strong>- poprawia dopasowanie buta w g&oacute;rnej warstwie, zmniejsza możliwość podrażnień.</p>\r\n<p><strong>Guidance Trusstic</strong>&nbsp;- Trusstic System integruje konstrukcję Guidance Line dla spotęgowania efektywności biegu przy jednoczesnym zachowaniu integralnej struktury podeszwy środkowej.</p>\r\n<p>Waga: 323 g</p>\r\n<p>Drop: 10 mm</p>', 'sale', 0),
(5, 1, '', 'Asics Gel-Emperor', '<p>Asics Gel-Emperor oferuje&nbsp;<strong>doskonałą amortyzację dla neutralnych biegaczy</strong>&nbsp;i jest idealny na luźne, relaksujące wybiegania.</p>\r\n<p>Amortyzujący system GEL absorbuje wstrząsy podczas kontaktu pięty z podłożem, a w połączeniu z pianką EVA w podeszwie środkowej&nbsp;<strong>zapewnia komfortowy bieg.</strong></p>\r\n<p>System Trusstic redukuję masę buta oraz zapewnia odpowiednią sztywność dla&nbsp;<strong>lepszej stabilizacji śr&oacute;dstopia</strong>.</p>\r\n<p>Podeszwa zewnętrza została wzmocniona poprzez ASICS AHAR, gumie zapewniającej<strong>wysoką odporność na ścieranie</strong>.</p>\r\n<p>&nbsp;</p>\r\n<p><strong>Systemy i technologie</strong>:</p>\r\n<p><strong>Rearfoot GEL Cushioning System</strong>&nbsp;- pochłania wstrząsy podczas fazy uderzenia i pozwala nałagodne przejście do fazy środkowej.</p>\r\n<p><strong>Trusstic System</strong>&nbsp;- redukuje masę podeszwy przy jednoczesnym zachowaniu integralnej struktury buta.</p>\r\n<p>Waga: 275g</p>', '', 0),
(6, 1, '', 'Asics GEL-Enduro 9', '<p>GEL-ENDURO 8 jest doskonały, jako&nbsp;<strong>model dla początkujących biegaczy.</strong>&nbsp;Oferuje komfort i ochronę na r&oacute;żnych typach terenu.</p>\r\n<p>Rearfoot GEL Cushioning System absorbuje wstrząsy, kiedy stopa ląduje i zapewnia<strong>komfortowy, doskonale zamortyzowany bieg.</strong></p>\r\n<p>Trusstic System redukuje masę obuwia stwarzając r&oacute;wnież&nbsp;<strong>lepszą stabilizację śr&oacute;dstopia.</strong></p>\r\n<p>Podeszwa zewnętrzna Trail Specific Outsole&nbsp;<strong>zapewnia optymalną trakcję na g&oacute;rzystym i kamienistym terenie</strong>. Aby sprawić, żeby podeszwa była jeszcze bardziej wytrzymała wzmocniona została technologią ASICS High Abrasion Rubber.</p>\r\n<p>Waga: 315 g</p>', 'promotion', 0),
(7, 1, '', 'Asics Gel-Fuji Trabuco 2', '<p>Od wielu lat GEL-FUJI TRABUCO należy do ulubionych but&oacute;w biegaczy trailowych ponieważ zapewnia im&nbsp;<strong>komfort i ochronę</strong>&nbsp;nawet w najbardziej wymagających warunkach.</p>\r\n<p>Tegoroczna edycja odznacza się nową cholewką, kt&oacute;ra jest bardziej&nbsp;<strong>przejrzysta i komfortowa.</strong></p>\r\n<p>To uniwersalne obuwie oferuje intensywny kontakt z podłożem poprzez podeszwę środkową oraz DuoMax Support System, kt&oacute;ry zapewnia bardzo&nbsp;<strong>stabilny ruch</strong>. Podeszwa zewnętrzna o charakterystycznym, agresywnym kształcie dostarcza biegaczom wielu wrażeń z pokonywania kilometr&oacute;w w terenie trailowym przy jednocześnie&nbsp;<strong>doskonałej przyczepności</strong>. GEL-FUJI TRABUCO 2 odznacza się 90 stopniowymi wcięciami w podeszwie zewnętrznej, aby udostępnić biegaczom<strong>optymalną trakcję</strong>&nbsp;na trudnych, stromych ścieżkach.</p>\r\n<p>System amortyzujące zlokalizowane w przedniej i tylnej części buta - Forefoot oraz Rearfoot GEL Cushioning zapewniają&nbsp;<strong>wyjątkowy komfort i ochronę</strong>, podczas gdy technologia Rock Protection Plate zabezpiecza stopy biegacza przed urazami, kt&oacute;re mogłyby spowodować wystające na ścieżce kamienie lub skały. &nbsp;</p>\r\n<p>Cholewka buta jest zbudowana w taki spos&oacute;b, aby odprowadzać brud i zanieczyszczenia poza obuwie. Zewnętrzny zapiętek natomiast uzupełnia niezwykłe możliwości tego modelu o ścisłe,&nbsp;<strong>idealne dopasowanie</strong>&nbsp;do stopy biegacza.</p>\r\n<p>Waga: 360g</p>', 'promotion', 0),
(8, 1, '', 'Asics Gel-FujiTrainer 2', '<p>GEL-FUJI TRAINER 2 to&nbsp;<strong>lekki terenowy but</strong>. Doświadczeni biegacze mogą pomyśleć o starcie w tym modelu nawet w ultra wyścigach.</p>\r\n<p>Specyficzna dla but&oacute;w trailowych podeszwa zapewnia&nbsp;<strong>doskonałą przyczepność</strong>, niezależnie od rodzaju terenu przy podbiegach oraz zbiegach.</p>\r\n<p>Waga: 285g</p>', '', 0),
(9, 1, '', 'Asics GEL-Kayano 20 Lite Show', '<p>Stworzony specjalnie dla łagodnych i umiarkowanych nadpronator&oacute;w jubileuszowy model GEL-KAYANO 20 został uzupełniony o nowe technologie ASICS FluidRide oraz FluidFit.</p>\r\n<p>FluidRide to efekt ewolucji firmy ASICS w obszarze technologii podeszwy środkowej, zapewniającej wyjątkową lekkość i amortyzację. Dzięki tej technologii biegacze mogą pokonywać dłuższe dystanse w szybszym tempie. Zmiany dokonane w podeszwie środkowej pozwoliły zastosować nową, wyższą gęstość wkładki SpEVA 55, kt&oacute;ra wsp&oacute;lnie ze wzmocnionym zapiętkiem zapewnia najlepszą charakterystykę odbicia oraz amortyzację przy zachowaniu lekkości.</p>\r\n<p>Wprowadzono r&oacute;wnież nowe cholewki wykonane w technologii ASICS FluidFit oznaczającej siateczkę, kt&oacute;ra rozciąga się w wielu kierunkach, aby stworzyć najlepsze dopasowanie do stopy. Dzięki temu obuwie dopasowuje się do stopy, jak rękawiczka do dłoni.</p>\r\n<p>Obok nowinek technologicznych w modelu GEL-KAYANO najnowsza edycja zawiera r&oacute;wnież wszystkie sp&oacute;jne zmiany wprowadzone od momentu wprowadzenia w 1993 roku. Innowacyjne technologie ASICS, takie jak żel zlokalizowany w okolicy pięty oraz przedniej części stopy, (GEL Cushioning System) technologie Impact Guidance System (IGS) w celu zwiększenia efektywności biegu, czy technologia DYNAMIC DUOMAX. Świadczy to o ewolucyjnej naturze zmian dokonywanych w butach z serii GEL-KAYANO.</p>\r\n<p>Nowy GEL-KAYANO 20 jest dostępny w specjalnych wariantach zar&oacute;wno dla mężczyzn jak i dla kobiet. Kobiecy GEL-KAYANO 20 został wzbogacony r&oacute;wnież o technologię Plus3, czyli dodatkowe 3 mm warstwy w podeszwie środkowej modeli, co pozwala zmniejszyć napięcie ścięgna Achillesa. Dzięki temu nowy model GEL-KAYANO 20 oferuje wyjątkowe wrażenia z biegu i zapewnia bezpieczeństwo wszystkim biegaczkom, niezależnie od stopnia wytrenowania.</p>\r\n<p><strong>Wybrane systemy i technologie:</strong></p>\r\n<p><strong>Impact Guidance System I.G.S.</strong>&nbsp;- filozofia wzornicza Asics. Konstrukcja podnosząca efektywność naturalnego chodu w całym procesie przetaczania stopy.</p>\r\n<p><strong>Rearfoot and Forefoot GEL Cushioning System</strong>&nbsp;- neutralizuje wstrząsy podczas fazy lądowania i wybicia oraz wspiera proces biegu.</p>\r\n<p><strong>FluidRide</strong>&nbsp;- innowacja w technologii podeszwy środkowej ASICS. FluidRide zapewnia najlepszą charakterystykę odbicia oraz amortyzację przy zachowaniu lekkości.</p>\r\n<p><strong>Dynamic DuoMax Support System</strong>&nbsp;- system podeszwy środkowej o podw&oacute;jnej gęstości dla zwiększonego wsparcia i stabilizacji stopy.</p>\r\n<p><strong>Guidance Trusstic</strong>&nbsp;- Trusstic System integruje konstrukcję Guidance Line dla spotęgowania efektywności biegu przy jednoczesnym zachowaniu integralnej struktury podeszwy środkowej.</p>\r\n<p><strong>FluitFit</strong>&nbsp;- technologia ASICS FluidFit zawiera technologiczną siateczkę, kt&oacute;ra rozciąga się w wielu kierunkach, aby stworzyć najlepsze dopasowanie do stopy.</p>\r\n<p><strong>Clutch counter</strong>&nbsp;- zewnętrzny zapiętek zapewniający zwiększone wsparcie stopy oraz stawarzający doskonałe dopasowanie buta do pięty.</p>\r\n<p><strong>Discrete Eyelet</strong>&nbsp;- przelotki ulepszające dopasowanie cholewki, redukując jednocześnie możliwość podrażnień.</p>\r\n<p>Drop: 12 mm</p>', 'promotion', 0),
(10, 1, '', 'Asics GEL-Oberon 8', '<p>GEL-OBERON 8 oferuje&nbsp;<strong>doskonałą amortyzację dla neutralnych biegaczy</strong>&nbsp;i jest idealny na luźne, relaksujące wybiegania.</p>\r\n<p>Amortyzujący system GEL absorbuje wstrząsy podczas kontaktu pięty z podłożem, a w połączeniu z pianką EVA w podeszwie środkowej&nbsp;<strong>zapewnia komfortowy bieg.</strong></p>\r\n<p>System Trusstic redukuję masę buta oraz zapewnia odpowiednią sztywność dla&nbsp;<strong>lepszej stabilizacji śr&oacute;dstopia</strong>.</p>\r\n<p>Podeszwa zewnętrza została wzmocniona poprzez ASICS AHAR, gumie zapewniającej<strong>wysoką odporność na ścieranie</strong>.</p>\r\n<p>&nbsp;</p>\r\n<p><strong>Systemy i technologie</strong>:</p>\r\n<p><strong>Rearfoot GEL</strong>&nbsp;- pochłania wstrząsy podczas uderzenia i fazy odbicia oraz pozwala na ruch stopy w wielu płaszczyznach.</p>\r\n<p><strong>Trusstic System</strong>&nbsp;- redukuje masę podeszwy przy jednoczesnym zachowaniu integralnej struktury buta.</p>\r\n<p><strong>Removable EVA Sockliner</strong>&nbsp;- wkładka, kt&oacute;ra można wyjąć w celu umieszczenia wkładki ortopedycznej.</p>\r\n<p>Waga: 250 g</p>', '', 0),
(11, 1, '', 'Asics Gel-Phoenix 6', '<p>Dzięki połączeniu amortyzacji i stabilizacji, nowy GEL-PHOENIX zapewnia&nbsp;<strong>wysokiej jakości buty dla pronator&oacute;w.</strong></p>\r\n<p>Ten model oferuje amortyzujący GEL w przedniej i tylnej części buta, aby zapewnić<strong>doskonałą amortyzację</strong>. Jest to but wzbogacony o wkładki SpEVA w pięcie tworzące dodatkową amortyzację absorbującą uderzenia o podłoże.</p>\r\n<p>DuoMax Support System w podeszwie środkowej&nbsp;<strong>zapewnia dostateczną stabilizację</strong>pronatorom.</p>\r\n<p>Aby zapewnić&nbsp;<strong>większą trwałość</strong>, podeszwa wzbogacona jest o AHAR, gumę wysoce odporną na ścieranie.</p>\r\n<p>&nbsp;</p>\r\n<p><strong>Wybrane systemy i technologie</strong>:</p>\r\n<p><strong>Rearfoot and Forefoot GEL Cushioning System</strong>&nbsp;- pochłania wstrząsy podczas uderzenia i fazy odbicia oraz pozwala na ruch stopy w wielu płaszczyznach.</p>\r\n<p><strong>DuoMax Support System</strong>&nbsp;- system podeszwy środkowej o podw&oacute;jnej gestości dla zwiększonego wsparcia i stabilizacji stopy.</p>\r\n<p><strong>SpEVA Rearfoot Midsole Material&nbsp;</strong>&nbsp;- ulepsza charakterystykę odbicia i zmniejsza ryzyko pęknięcia podeszwy.</p>\r\n<p><strong>Trusstic System</strong>&nbsp;- redukuje masę podeszwy przy jednoczesnym zachowaniu integralnej struktury buta.</p>\r\n<p><strong>&nbsp;</strong>Waga: 245g</p>', 'promotion', 0),
(12, 1, '', 'Asics GEL-Pulse 5', '<p>System amortyzacji GEL został umieszczony w przedniej i tylnej części stopy, model posiada wyjmowaną wkladkę ComfortDry Sockliner, lekkości dodaje system Trusstic, a trwałości podeszwy pełnej długości SpEVA.</p>\r\n<p><strong>Systemy i technologie</strong>:</p>\r\n<p><strong>Full Length Guidance Line</strong>&nbsp;- system pionowych rowk&oacute;w przecinających podeszwę wzdłuż linii progresji dla spotęgowania efektywności przetaczania stopy w całym cyklu biegu.&nbsp;<strong>(nowość)</strong></p>\r\n<p><strong>Forefoot GEL, Rearfoot GEL</strong>&nbsp;- system ASICS GEL bazuje na specjalnej wkładce wykonanej z silikonu, kt&oacute;ra zapewnia optymalną amortyzację. Wkładki żelowe są rozmieszczone w newralgicznych miejscach podeszwy środkowej i tak wkomponowane, aby zwiększyć funkcjonalność.</p>\r\n<p><strong>AHAR+</strong>&nbsp;- wysoce odporna na uszkodzenia i trwała guma używana jako gruba warstwa w miejscach narażonych na szczeg&oacute;lne uszkodzenia. Zwiększa trwałość obuwia.</p>\r\n<p><strong>SpEVA Midsole Material</strong>&nbsp;- najwyższej jakości materiał podeszwy środkowej zapewniający lepszą sprężystość i zapobiegający pękaniu podeszwy.</p>\r\n<p><strong>Guidance Trusstic</strong>&nbsp;- Trusstic System integruje konstrukcję Guidance Line dla spotęgowania efektywności biegu przy jednoczesnym zachowaniu integralnej struktury podeszwy środkowej.</p>\r\n<p><strong>ComforDry Sockliner</strong>&nbsp;- trzywarstwowa wkładka podeszwy zapewniająca lepszą amortyzację, ma właściwości antybakteryjne dla zapewnienia stopie chłodnego, suchego i zdrowszego środowiska.</p>\r\n<p>Waga: 235g</p>', '', 0),
(13, 1, '', 'Asics GT-1000 2', '<p>GT-1000 2 to nowa nazwa bardzo popularnej wartościowej serii GEL-1000. Zaprojektowany dla umiarkowanych pronator&oacute;w, GT-1000&nbsp;<strong>oferują amortyzację i stabilizację jakiej Ci potrzeba</strong>.</p>\r\n<p>GT-1000 jest najlżejszym jak dotąd modelem, dysponuje obniżoną wysokością podeszwy, aby zapewnić większą&nbsp;<strong>elastyczność i szybkość reagowania.</strong></p>\r\n<p>Nowy Guidance Line na całej długości podeszwy zawiera nacięcie w podeszwie, aby<strong>prowadzić stopę bardziej efektywnie.</strong></p>\r\n<p>Poza dużą amortyzacją Gel w pięcie oraz przodostopiu, ta edycja zawiera system wsparcia Duomax,&nbsp;<strong>zapewniając większą stabilność.</strong></p>\r\n<p>&nbsp;</p>\r\n<p><strong>Wybrane systemy i technologie</strong>:</p>\r\n<p><strong>Rearfoot and Forefoot GEL Cushioning System</strong>&nbsp;- pochłania wstrząsy podczas uderzenia i fazy odbicia oraz pozwala na ruch stopy w wielu płaszczyznach.</p>\r\n<p><strong>Full lenght Guidance Line</strong>&nbsp;- system pionowych rowk&oacute;w przecinających podeszwę wzdłuż linii progresji dla spotęgowania efektywności przetaczania stopy w całym cyklu biegu.</p>\r\n<p><strong>DuoMax Support System</strong>&nbsp;- system podeszwy środkowej o podw&oacute;jnej gestości dla zwiększonego wsparcia i stabilizacji stopy.</p>\r\n<p><strong>SpEVA Midsole Material</strong>&nbsp;- poprawia charakterystykę odbicia i zapobiega pęknięciom podeszwy środkowej.</p>\r\n<p><strong>Trusstic System</strong>&nbsp;- redukuje masę podeszwy przy jednoczesnym zachowaniu integralnej struktury buta.</p>\r\n<p>Waga: 240g</p>\r\n<p>Drop: 10 mm</p>', '', 0),
(14, 3, '', 'New Balance W790PP3', '<p>Jest to już trzecia odsłona serii 790. Drop w tym modelu został zaprojektowany na 12 mm. Zastosowana podeszwa piankowa REVlite cechuje się niewielką wagą oraz zapewnia amortyzację na najwyższym poziomie, a do tego jest o 30% lżejsza w por&oacute;wnaniu do innych modeli. Obuwie od strony wewnętrznej zostało wykończone bezszwowo, dzięki czemu nie powoduje otarć podczas biegu.</p>\r\n<p>Waga: 210g</p>', 'recommended', 0),
(15, 3, '', 'New Balance W860PL4', '<p>Buty do biegania przeznaczone dla os&oacute;b ze stopą pronującą do bieg&oacute;w na twardych nawierzchniach. Jest to czwarta edycja znanego od roku 2011 modelu 860. M860SG4 jest to model treningowy przeznaczony do średnich oraz długich dystans&oacute;w, charakteryzujący się bardzo dobrą amortyzacją, przy zachowaniu niewielkiej wagi. Dzięki 12 mm r&oacute;żnicy wysokości pomiędzy położeniem pięty w stosunku do palc&oacute;w model 860 umożliwia bardziej naturalne ułożenie stopy podczas biegu.</p>\r\n<p>Waga: 252g</p>', 'new', 0),
(16, 3, '', 'New Balance Minimus WT10GP2', '<p>Buty przeznaczone dla os&oacute;b ze stopą neutralną do bieg&oacute;w terenowych.</p>\r\n<p>Dzięki podeszwie wykonanej w technologii Vibram, model MT10v2 idealnie dba o przyczepność i bezpieczeństwo podczas bieg&oacute;w po zr&oacute;żnicowanym terenie.</p>\r\n<p>R&oacute;żnica pomiędzy wysokością położenia pięty w stosunku do palc&oacute;w wynosi zaledwie 4mm dzięki czemu spokojnie możemy go zakwalifikować do kategorii &bdquo;bieganie naturalne&rdquo;.</p>\r\n<p>Dzięki oddychającej i szybkoschnącej syntetycznej siateczce obuwie zapewnia bardzo dobre odprowadzanie wilgoci.</p>\r\n<p>Waga: 139g</p>\r\n<p>Drop: 4 mm</p>', '', 0),
(17, 3, '', 'New Balance W590BW2', '<p>Buty przeznaczone dla os&oacute;b ze stopą neutralną oraz supinującą do bieg&oacute;w na twardych nawierzchniach.</p>\r\n<p>Model 590 idealnie nadaje się do trening&oacute;w kr&oacute;tko i średniodystansowych.</p>\r\n<p>Zaprojektowany dla biegaczy ceniących sobie dobrą amortyzację, przy zachowaniu odpowiedniej elastyczności, lekkości oraz komfortu.</p>\r\n<p>Obuwie przeznaczone zar&oacute;wno dla początkujących jak i zaawansowanych biegaczy.</p>\r\n<p>Waga: 190g</p>\r\n<p>Drop: 12 mm</p>', '', 0),
(18, 3, '', 'Minimus Zero v2 MR00RB2', '<p>Obuwie przeznaczone dla stopy naturalnej. Zastosowana w tym modelu podeszwa piankowa REVlite cechuje się niewielką wagą oraz zapewnia odpowiedni kontakt z podłożem. System Vibram nadaje doskonałą trakcję na nier&oacute;wnym podłożu. Obuwie od strony wewnętrznej zostało wykończone bezszwowo, dzięki czemu nie powoduje otarć podczas biegu. Odpowiednie antybakteryjne materiały użyte do produkcji tego modelu zapobiegają tworzeniu się nieprzyjemnego zapachu. Drop w modelu MR00v2 wynosi 0mm czyniąc go tym samym idealnym obuwiem do bieg&oacute;w minimalistycznych.</p>\r\n<p>Waga: 162g</p>', '', 0),
(19, 3, '', 'New Balance M870BB2', '<p>Buty przeznaczone dla os&oacute;b ze stopą neutralną oraz lekko pronującą do biegania na twardych nawierzchniach.</p>\r\n<p>Zastosowana podeszwa piankowa REVlite cechuje się niewielką wagą, a połączona z systemem ABZORB umieszczonym na całej długości, zachowuje amortyzację na najwyższym poziomie.</p>\r\n<p>Podeszwa REVlite jest 30% lżejsza w por&oacute;wnaniu do innych modeli.</p>\r\n<p>Obuwie od strony wewnętrznej zostało wykończone bezszwowo, dzięki czemu nie powoduje otarć podczas biegu.</p>\r\n<p>Waga: 278g</p>\r\n<p>Drop: 8 mm</p>', '', 0),
(20, 3, '', 'New Balance M1080GO3', '<p>Jest to już 3 generacja cieszącego się uznaniem wśr&oacute;d biegaczy modelu 1080.</p>\r\n<p>Nowa generacja została odchudzona o 9 gram&oacute;w. Technologie z poprzedniej wersji takie jak N2, czy Abzorb zapewniające bardzo dobrą amortyzację, zostały r&oacute;wnież zastosowane w obecnej.</p>\r\n<p>Dzięki 8 mm r&oacute;żnicy wysokości pomiędzy położeniem pięty w stosunku do palc&oacute;w model 1080 umożliwia nam bardziej naturalne ułożenie stopy podczas biegu.</p>\r\n<p>Obuwie od strony wewnętrznej zostało wykończone bezszwowo, dzięki czemu nie powoduje otarć podczas biegu.</p>\r\n<p>Waga: 288g</p>\r\n<p>Drop: 8 mm</p>', '', 0),
(21, 4, '', 'Mizuno Wave Inspire 10', '<p>Dla zaawansowanych lżejszych biegaczy utrzymujących wysokie tempo, kt&oacute;re potrzebują umiarkowanego wsparcia. Nowość &ndash; podeszwa wykonana z ultralekkiego U4ic i gumy tłoczonej (blown rubber). But stabilizujący z płytką Mizuno Wave. Dla pań umiarkowanie pronujących chcących odczuwać podczas biegu wysoki komfort. But amortyzujący i wspierający, ale z lekkim i dynamicznym czuciem zbliżonym do buta z serii naturalnej. Szybki i funkcjonalny dodatkowo z systemem SR Touch zapewniającym jeszcze lepszą absorpcję wstrząs&oacute;w.</p>\r\n<p>Waga: 250g</p>', '', 0),
(22, 4, '', 'Mizuno Wave Advance', '<p>Buty dla biegaczy ze stopą neutralną i pronującą.&nbsp;Super amortyzacja, kt&oacute;rą daje płytka<strong>Mizuno Wave</strong>, dodatkowo daje uczucie lekkości i szybkości.</p>', '', 0),
(23, 4, '', 'Mizuno Wave Nexus 7', '<p>But stabilizujący dla średniozaawansowanych biegaczy, kt&oacute;rzy potrzebują umiarkowanego wsparcia pronacji.</p>\r\n<p>Super amortyzacja, kt&oacute;rą daje płytka Mizuno Wave, kt&oacute;ra doadkowo daje uczucie lekkości i szybkości.</p>\r\n<p>Innowacyjny system Smooth Ride sprawia, że bieganie staje się bardziej płynne i przyjemne.</p>\r\n<p><strong>Systemy i technologie:</strong></p>\r\n<p><strong>Mizuno Wave</strong>&nbsp;- unikalna technologia, kt&oacute;ra łączy w sobie dwie niezbędne podczas biegania funkcje: amortyzację i stabilność. Zaprojektowana dla wszystkich typ&oacute;w biegaczy.</p>\r\n<p><strong>SmoothRide</strong>&nbsp;- inżynieryjne podejście mające na celu zminimalizowanie negatywnych sił działających na stopę podczas kolejnych zmian tempa biegu. Zapewnia, że bieganie staje się bardziej płynne.</p>\r\n<p><strong>ap+</strong>&nbsp;- nowe komponenty w wyści&oacute;łkach but&oacute;w Mizuno zapewniają niesamowite uczucie w trakcie biegu. Wytrzumała podeszwa zwiększa amortyzację oraz zapewnia lepszą trwałość.</p>\r\n<p><strong>X10</strong>&nbsp;- najbardziej trwała mieszanka gumy węglowej, kt&oacute;ra jest mniej podatna na ścieranie w obszarach najbardziej na to narażonych, wspiera dodatkowo pracę pięty.</p>\r\n<p><strong>Removable INSOCK</strong>&nbsp;- anatomicznie formowane wkładki dla zwiększenia komfortu i amortyzacji.</p>\r\n<p>Waga: 240g</p>', 'promotion', 0),
(24, 4, '', 'Mizuno Wave Resolute 2', '<p>But przeznaczony dla os&oacute;b o niewielkim doświadczeniu w bieganiu.&nbsp; Konstrukcja fali Mizuno Wave daje doskonałą amortyzację oraz efektywne przetoczenie. But, kt&oacute;ry dobrze się dopasowuje dając duży komfort. Przeznaczony dla biegaczy o stopie neutralnej.</p>\r\n<p>Waga: 255g</p>', '', 0),
(25, 5, '', 'Saucony Progrid Guide 6', '<p>R&oacute;żnica w wysokości pięta/śr&oacute;dstopie w tym modelu to 8mm (standard to 12 mm). Dzięki temu biegamy bardziej dynamicznie- mamy lepszy krok biegowy.</p>\r\n<p>W modelu Guide 6 zastosowano system amortyzacyjny - Full-length ProGrid, SRC Impact Zone, HRC Strobel Board oraz lżejszą piankę EVA - SSL EVA.</p>\r\n<p>Drop: 8 mm</p>', 'recommended', 0),
(26, 5, '', 'Saucony ProGrid Kinvara', '<p>Bardzo dobry but na szybki trening i starty.<strong>&nbsp;Minimalistyczna</strong>&nbsp;konstrukcja podeszwy środkowej.</p>\r\n<p>Podeszwa środkowe jest zbudowana z pianki&nbsp;EVA&nbsp;i wkładki&nbsp;ProGrid LITE&nbsp;pod piętą - co zapewnia bardzo niską wagę buta.</p>\r\n<p>Cholewka zapewnia doskonałą wentylację obuwia. Wymienna wkładka zapewniająca wygodę wnętrza buta.</p>\r\n<p><strong>Wyści&oacute;łka Hydrator</strong>&nbsp;- tkanina Saucony używana do produkcji profesjonalnej odzieży sportowej. Zapewnia komfort w kontacie ze sk&oacute;rą i maksymalizuje odprowadzanie wilgoci.</p>\r\n<p><strong>Inteligentna pianka</strong>&nbsp;w pięcie dostosowuje się do ścięgna Achillesa oraz pięty i w ten spos&oacute;b polepsza dopasowanie przez mocne trzymanie pięty i większe wsparcie podczas uderzenia piętą o podłoże.</p>\r\n<p><strong>EVA+</strong>&nbsp;- lekka mieszanka pianki EVA, kt&oacute;ra zapewnia dobrą amortyzację.</p>\r\n<p><strong>XT-900</strong>&nbsp;- guma węglowa służąca do produkcji podeszwy zewnętrznej zapewniająca wyjątkowe właściwości trakcji bez pogorszenia trwałości.</p>\r\n<p>Waga: 218g.</p>', 'new', 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `sizes`
--

CREATE TABLE IF NOT EXISTS `sizes` (
  `size_id` int(11) NOT NULL AUTO_INCREMENT,
  `manufacturer_id` int(11) NOT NULL,
  `us` text COLLATE utf8_polish_ci NOT NULL,
  `uk` text COLLATE utf8_polish_ci NOT NULL,
  `cm` text COLLATE utf8_polish_ci NOT NULL,
  `euro` text COLLATE utf8_polish_ci NOT NULL,
  `sex` text COLLATE utf8_polish_ci NOT NULL,
  `deleted` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`size_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=114 ;

--
-- Zrzut danych tabeli `sizes`
--

INSERT INTO `sizes` (`size_id`, `manufacturer_id`, `us`, `uk`, `cm`, `euro`, `sex`, `deleted`) VALUES
(4, 1, '4', '3', '22.5', '36', 'male', 0),
(5, 1, '4.5', '3.5', '23', '37', 'male', 0),
(6, 1, '5', '4', '23.5', '37.5', 'male', 0),
(7, 1, '5.5', '4.5', '24', '38', 'male', 0),
(8, 1, '6', '5', '24.5', '39', 'male', 0),
(9, 1, '6.5', '5.5', '25', '39.5', 'male', 0),
(10, 1, '7', '6', '', '40', 'male', 0),
(11, 1, '7.5', '6.5', '25.5', '40.5', 'male', 0),
(12, 1, '8', '7', '26', '41.5', 'male', 0),
(13, 1, '8.5', '7.5', '26.5', '42', 'male', 0),
(14, 1, '9', '8', '27', '42.5', 'male', 0),
(15, 1, '9.5', '8.5', '27.5', '43.5', 'male', 0),
(16, 1, '10', '9', '28', '44', 'male', 0),
(17, 1, '10.5', '9.5', '', '44.5', 'male', 0),
(18, 1, '11', '10', '28.5', '45', 'male', 0),
(19, 1, '11.5', '10.5', '29', '46', 'male', 0),
(20, 1, '12', '11', '29.5', '46.5', 'male', 0),
(21, 1, '5.5', '3.5', '22.5', '36', 'female', 0),
(22, 1, '6', '4', '23', '37', 'female', 0),
(23, 1, '6.5', '4.5', '23.5', '37.5', 'female', 0),
(24, 1, '7', '5', '24', '38', 'female', 0),
(25, 1, '7.5', '5.5', '24.5', '39', 'female', 0),
(26, 1, '8', '6', '25', '39.5', 'female', 0),
(27, 1, '8.5', '6.5', '', '40', 'female', 0),
(28, 1, '9', '7', '25.5', '40.5', 'female', 0),
(29, 1, '9.5', '7.5', '26', '41.5', 'female', 0),
(30, 1, '10', '8', '26.5', '42', 'female', 0),
(31, 1, '10.5', '8.5', '27', '42.5', 'female', 0),
(32, 1, '11', '9', '27.5', '43.5', 'female', 0),
(33, 1, '11.5', '9.5', '28', '44', 'female', 0),
(34, 1, '12', '10', '', '44.5', 'female', 0),
(35, 3, '5', '', '22', '35', 'female', 0),
(36, 3, '5.5', '', '22.5', '36', 'female', 0),
(37, 3, '6', '', '23', '36.5', 'female', 0),
(38, 3, '6.5', '', '23.5', '37', 'female', 0),
(39, 3, '7', '', '24', '37.5', 'female', 0),
(40, 3, '7.5', '', '24.5', '38', 'female', 0),
(41, 3, '8', '', '25', '39', 'female', 0),
(42, 3, '8.5', '', '25.5', '40', 'female', 0),
(43, 3, '9', '', '26', '40.5', 'female', 0),
(44, 3, '9.5', '', '26.5', '41', 'female', 0),
(45, 3, '10', '', '27', '41.5', 'female', 0),
(46, 3, '10.5', '', '27.5', '42.5', 'female', 0),
(47, 3, '7', '', '25', '40', 'male', 0),
(48, 3, '7.5', '', '25.5', '40.5', 'male', 0),
(49, 3, '8', '', '26', '41.5', 'male', 0),
(50, 3, '8.5', '', '26.5', '42', 'male', 0),
(51, 3, '9', '', '27', '42.5', 'male', 0),
(52, 3, '9.5', '', '27.5', '43', 'male', 0),
(53, 3, '10', '', '28', '44', 'male', 0),
(54, 3, '10.5', '', '28.5', '44.5', 'male', 0),
(55, 3, '11', '', '29', '45', 'male', 0),
(56, 3, '11.5', '', '29.5', '45.5', 'male', 0),
(57, 3, '12', '', '30', '46.5', 'male', 0),
(58, 3, '12.5', '', '30.5', '47', 'male', 0),
(59, 3, '13', '', '31', '47.5', 'male', 0),
(60, 3, '14', '', '32', '49', 'male', 0),
(61, 3, '15', '', '33', '50', 'male', 0),
(62, 4, '', '3.5', '22.5', '36', 'male', 0),
(63, 4, '', '4', '23', '36.5', 'male', 0),
(64, 4, '', '4.5', '23.5', '37', 'male', 0),
(65, 4, '', '5', '24', '38', 'male', 0),
(66, 4, '', '5.5', '24.5', '38.5', 'male', 0),
(67, 4, '', '6', '25', '39', 'male', 0),
(68, 4, '', '6.5', '25.5', '40', 'male', 0),
(69, 4, '', '7', '26', '40.5', 'male', 0),
(70, 4, '', '7.5', '26.5', '41', 'male', 0),
(71, 4, '', '8', '27', '42', 'male', 0),
(72, 4, '', '8.5', '27.5', '42.5', 'male', 0),
(73, 4, '', '9', '28', '43', 'male', 0),
(74, 4, '', '9.5', '28.5', '44', 'male', 0),
(75, 4, '', '10', '29', '44.5', 'male', 0),
(76, 4, '', '10.5', '29.5', '45', 'male', 0),
(77, 4, '', '11', '30', '46', 'male', 0),
(78, 4, '', '3.5', '22.5', '36', 'female', 0),
(79, 4, '', '4', '23', '36.5', 'female', 0),
(80, 4, '', '4.5', '23.5', '37', 'female', 0),
(81, 4, '', '5', '24', '38', 'female', 0),
(82, 4, '', '5.5', '24.5', '38.5', 'female', 0),
(83, 4, '', '6', '25', '39', 'female', 0),
(84, 4, '', '6.5', '25.5', '40', 'female', 0),
(85, 4, '', '7', '26', '40.5', 'female', 0),
(86, 4, '', '7.5', '26.5', '41', 'female', 0),
(87, 4, '', '8', '27', '42', 'female', 0),
(88, 4, '', '8.5', '27.5', '42.5', 'female', 0),
(89, 4, '', '9', '28', '43', 'female', 0),
(90, 4, '', '9.5', '28.5', '44', 'female', 0),
(91, 4, '', '10', '29', '44.5', 'female', 0),
(92, 4, '', '10.5', '29.5', '45', 'female', 0),
(93, 4, '', '11', '30', '46', 'female', 0),
(94, 5, '6', '7', '25', '40', 'male', 0),
(95, 5, '6.5', '7.5', '25.5', '40.5', 'male', 0),
(96, 5, '7', '8', '26', '41', 'male', 0),
(97, 5, '7.5', '8.5', '26.5', '42', 'male', 0),
(98, 5, '8', '9', '27', '42.5', 'male', 0),
(99, 5, '8.5', '9.5', '27.5', '43', 'male', 0),
(100, 5, '9', '10', '28', '44', 'male', 0),
(101, 5, '9.5', '10.5', '28.5', '44.5', 'male', 0),
(102, 5, '10', '11', '29', '45', 'male', 0),
(103, 5, '10.5', '11.5', '29.5', '46', 'male', 0),
(104, 5, '5', '3', '21.5', '35.5', 'female', 0),
(105, 5, '5.5', '3.5', '22', '36', 'female', 0),
(106, 5, '6', '4', '22.5', '37', 'female', 0),
(107, 5, '6.5', '4.5', '23', '37.5', 'female', 0),
(108, 5, '7', '5', '23.5', '38', 'female', 0),
(109, 5, '7.5', '5.5', '24', '38.5', 'female', 0),
(110, 5, '8', '6', '24.5', '9', 'female', 0),
(111, 5, '8.5', '6.5', '25', '40', 'female', 0),
(112, 5, '9', '7', '25.5', '40.5', 'female', 0),
(113, 5, '9.5', '7.5', '26', '41', 'female', 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `transactions`
--

CREATE TABLE IF NOT EXISTS `transactions` (
  `transaction_id` int(11) NOT NULL AUTO_INCREMENT,
  `cart_id` int(11) NOT NULL,
  `payment_method` text COLLATE utf8_polish_ci NOT NULL,
  `status` text COLLATE utf8_polish_ci NOT NULL,
  `address` text COLLATE utf8_polish_ci NOT NULL,
  `start_date` text COLLATE utf8_polish_ci,
  `end_date` text COLLATE utf8_polish_ci,
    `deleted` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`transaction_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=8 ;

--
-- Zrzut danych tabeli `transactions`
--

INSERT INTO `transactions` (`transaction_id`, `cart_id`, `payment_method`, `status`, `address`, `start_date`, `end_date`, `deleted`) VALUES
(4, 4, 'standard', 'finished', 'Jan Kowalski, Klonowa 49/16a,  Poznań', '2014-05-19 19:43:53', '2014-05-19 19:44:53', 0),
(5, 10, 'standard', 'in_progress', 'Jan Kowalski, Klonowa 49/16a,  Poznań', '2014-05-19 19:52:11', NULL, 0),
(6, 1, 'standard', 'finished', 'Marta Nowak, Kozia 14,  Kraków', '2014-05-19 20:10:35', '2014-05-19 20:11:35', 0),
(7, 13, 'standard', 'finished', 'Karol Wójcik, Polska 14,  Wrocław', '2014-05-19 20:12:49', '2014-05-19 20:13:49', 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `types`
--

CREATE TABLE IF NOT EXISTS `types` (
  `type_id` int(11) NOT NULL AUTO_INCREMENT,
  `type_name` text COLLATE utf8_polish_ci NOT NULL,
  `deleted` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=10 ;

--
-- Zrzut danych tabeli `types`
--

INSERT INTO `types` (`type_id`, `type_name`, `deleted`) VALUES
(3, 'foot_neutral', 0),
(4, 'foot_supination', 0),
(5, 'foot_pronation', 0),
(6, 'shoe_road', 0),
(7, 'shoe_terrain', 0),
(8, 'shoe_training', 0),
(9, 'shoe_race', 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `types_products`
--

CREATE TABLE IF NOT EXISTS `types_products` (
  `types_product_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `deleted` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`types_product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=103 ;

--
-- Zrzut danych tabeli `types_products`
--

INSERT INTO `types_products` (`types_product_id`, `product_id`, `type_id`, `deleted`) VALUES
(5, 2, 3, 0),
(6, 2, 4, 0),
(7, 2, 6, 0),
(8, 2, 8, 0),
(9, 3, 9, 0),
(10, 3, 6, 0),
(11, 3, 3, 0),
(12, 3, 5, 0),
(13, 4, 3, 0),
(14, 4, 4, 0),
(15, 4, 6, 0),
(16, 4, 8, 0),
(17, 5, 8, 0),
(18, 5, 6, 0),
(19, 5, 4, 0),
(20, 5, 3, 0),
(21, 6, 3, 0),
(22, 6, 5, 0),
(23, 6, 7, 0),
(24, 6, 8, 0),
(25, 7, 3, 0),
(26, 7, 4, 0),
(27, 7, 7, 0),
(28, 7, 8, 0),
(29, 8, 3, 0),
(30, 8, 4, 0),
(31, 8, 7, 0),
(32, 8, 8, 0),
(33, 8, 9, 0),
(34, 3, 8, 0),
(35, 10, 3, 0),
(36, 10, 4, 0),
(37, 10, 6, 0),
(38, 10, 8, 0),
(39, 9, 3, 0),
(40, 9, 5, 0),
(41, 9, 6, 0),
(42, 9, 8, 0),
(43, 11, 3, 0),
(44, 11, 5, 0),
(45, 11, 6, 0),
(46, 11, 8, 0),
(47, 12, 3, 0),
(48, 12, 4, 0),
(49, 12, 6, 0),
(50, 12, 8, 0),
(51, 13, 3, 0),
(52, 13, 5, 0),
(53, 13, 6, 0),
(54, 13, 8, 0),
(55, 14, 3, 0),
(56, 14, 4, 0),
(57, 14, 6, 0),
(58, 14, 8, 0),
(59, 15, 3, 0),
(60, 15, 5, 0),
(61, 15, 6, 0),
(62, 15, 8, 0),
(63, 16, 3, 0),
(64, 16, 7, 0),
(65, 16, 8, 0),
(66, 17, 3, 0),
(67, 17, 4, 0),
(68, 17, 6, 0),
(69, 17, 8, 0),
(70, 18, 3, 0),
(71, 18, 6, 0),
(72, 18, 8, 0),
(73, 19, 3, 0),
(74, 19, 5, 0),
(75, 19, 6, 0),
(76, 19, 8, 0),
(77, 20, 3, 0),
(78, 20, 4, 0),
(79, 20, 6, 0),
(80, 20, 8, 0),
(81, 21, 3, 0),
(82, 21, 5, 0),
(83, 21, 6, 0),
(84, 21, 8, 0),
(85, 22, 3, 0),
(86, 22, 5, 0),
(87, 22, 6, 0),
(88, 22, 8, 0),
(89, 23, 3, 0),
(90, 23, 5, 0),
(91, 23, 6, 0),
(92, 23, 8, 0),
(93, 24, 3, 0),
(94, 24, 6, 0),
(95, 24, 8, 0),
(96, 25, 3, 0),
(97, 25, 5, 0),
(98, 25, 6, 0),
(99, 25, 8, 0),
(100, 26, 3, 0),
(101, 26, 6, 0),
(102, 26, 8, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 02 Maj 2014, 11:14
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `szmitas_trzewiki`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `admins`
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
(1, 'adam', 'pswd', '', 'aaaaa@ww.ww', 'Andrzej', 'Nowak', '1', 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `carts`
--

CREATE TABLE IF NOT EXISTS `carts` (
  `cart_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`cart_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `cart_items`
--

CREATE TABLE IF NOT EXISTS `cart_items` (
  `cart_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_count` int(11) NOT NULL,
  `item_price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `contents`
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
(6, 'aaaatdfgf', 'KONTENT VALgggdfg\r\n	  ', 0),
(7, 'bbbb', 'bbbbbbgh', 1),
(8, 'key heh', 'val heh', 0),
(9, 'key heh', 'val heh', 0),
(10, 'n', 'n', 0),
(11, 'fff', 'hg', 0),
(12, 'fff', 'hg', 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
  `customer_id` int(11) NOT NULL AUTO_INCREMENT,
  `login` text COLLATE utf8_polish_ci NOT NULL,
  `password` text COLLATE utf8_polish_ci NOT NULL,
  `salt` text COLLATE utf8_polish_ci NOT NULL,
  `email` text COLLATE utf8_polish_ci NOT NULL,
  `first_name` text COLLATE utf8_polish_ci NOT NULL,
  `last_name` text COLLATE utf8_polish_ci NOT NULL,
  `street` text COLLATE utf8_polish_ci NOT NULL,
  `street_additional` text COLLATE utf8_polish_ci,
  `zip_code` text COLLATE utf8_polish_ci NOT NULL,
  `city` text COLLATE utf8_polish_ci NOT NULL,
  `status` text COLLATE utf8_polish_ci NOT NULL,
  `deleted` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=4 ;

--
-- Zrzut danych tabeli `customers`
--

INSERT INTO `customers` (`customer_id`, `login`, `password`, `salt`, `email`, `first_name`, `last_name`, `street`, `street_additional`, `zip_code`, `city`, `status`, `deleted`) VALUES
(1, 'loginasdg', 'qasdasd', 'sdfsdf', 'sdfsdf', 'adamae', 'plocienakezzz', 'ssssssssssssszzzzzzzzzzzzz', 'wwwwwwwwwzzzzzzzzzzzzzzzzzzzzz', 'aaaaaazzzzzzzzzzzzzzzzzzzzzzzz', 'dddddddddddsdfzzzzzzzzzzzzzzzzzzzz', 'wadsazzzzzzzzzzzzzz', 0),
(2, 'wwwwwwws', 'eeeeeeee', '', 'eeeeeeeeeeeeeeeeeeeeee', 'eeeeeeeeeeeeeeeeeeeeee', 'eeeeeeeeeeeeeeeeee', 'eeeeeeeeeeee', 'eeeeeeeeeeeeeeeee', 'eeeeeeeeeeeeeee', 'eeeeeeeeeeeeeeeeeeeeee', 'eeeeeeeee', 0),
(3, 'wwwwww', 'wwwwwwwwwwwwwwww', '', 'wwwwwwwwwwwwwwwww', 'wwwwwwwww', '', '', '', '', '', '', 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `size_id` int(11) NOT NULL,
  `price` float NOT NULL,
  `price2` float DEFAULT NULL,
  `status` text COLLATE utf8_polish_ci,
  `deleted` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`item_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=5 ;

--
-- Zrzut danych tabeli `items`
--

INSERT INTO `items` (`item_id`, `product_id`, `size_id`, `price`, `price2`, `status`, `deleted`) VALUES
(1, 5, 3, 20, 4, '5', 0),
(2, 5, 1, 20, 4, '5', 0),
(3, 2, 1, 444, 333, '22', 0),
(4, 2, 1, 3, 3, '2', 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `logs`
--

CREATE TABLE IF NOT EXISTS `logs` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `action` text COLLATE utf8_polish_ci NOT NULL,
  `custom1` text COLLATE utf8_polish_ci,
  `custom2` text COLLATE utf8_polish_ci,
  `custom3` text COLLATE utf8_polish_ci,
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `manufacturers`
--

CREATE TABLE IF NOT EXISTS `manufacturers` (
  `manufacturer_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8_polish_ci NOT NULL,
  `deleted` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`manufacturer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=16 ;

--
-- Zrzut danych tabeli `manufacturers`
--

INSERT INTO `manufacturers` (`manufacturer_id`, `name`, `deleted`) VALUES
(1, 'gff', 0),
(2, 'NIKErfwerfwe', 1),
(3, 'werewr', 0),
(4, 'xxxxx', 0),
(5, 'aaaaaaa', 0),
(6, 'aaaaaaa', 0),
(7, 'aaaaaaa', 0),
(8, 'aaaaaaa', 0),
(9, 'aaaaaaa', 0),
(10, 'aaaaaaa', 0),
(11, 'aaaaaaa', 0),
(12, 'aaaaaaajhk', 0),
(13, 'xasd', 0),
(14, 'Nike', 0),
(15, 'ADIDAS', 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `media`
--

CREATE TABLE IF NOT EXISTS `media` (
  `media_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `file_path` text COLLATE utf8_polish_ci NOT NULL,
  `type` text COLLATE utf8_polish_ci NOT NULL,
  `deleted` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`media_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=13 ;

--
-- Zrzut danych tabeli `media`
--

INSERT INTO `media` (`media_id`, `product_id`, `file_path`, `type`, `deleted`) VALUES
(1, 2, 'http://insidery.eu/uploads/avatars/avatar_91.jpg?dateline=1376060913', 'img', 0),
(2, 2, 'http://blogi.stylomierz.pl/obrazki/logotypy/5288eaa1bde277f/small.jpg', 'img', 1),
(3, 2, 'xcvxcv', 'fdgdfg', 1),
(4, 2, 'http://www.giercownia.pl/avatary/b/biteko.gif', 'img', 1),
(5, 2, 'http://www.giercownia.pl/avatary/b/biteko.gif', 'ssss', 1),
(6, 2, 'http://www.giercownia.pl/avatary/b/biteko.gif', 'ssss', 1),
(7, 2, 'http://www.giercownia.pl/avatary/b/biteko.gif', 'ssss', 1),
(8, 2, 'http://imgx.wizaz.pl/forum/customavatars/avatar916392_1.gif', 'dddd', 0),
(9, 7, 'http://avatarmaker.net/free-avatars/avatars/animated_214/yellow_smile_blabla_animated_avatar_100x100_62415.gif', 'image', 0),
(10, 2, 'http://blogi.stylomierz.pl/obrazki/logotypy/5288eaa1bde277f/small.jpg', 'imgxd', 0),
(11, 8, 'http://avatarmaker.net/free-avatars/avatars/animated_214/yellow_smile_blabla_animated_avatar_100x100_62415.gif', 'img', 0),
(12, 8, 'http://www.halloween-mask.com/timcor/sadistic_timcor.jpg', 'd', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `manufacturer_id` int(11) NOT NULL,
  `product_no` text COLLATE utf8_polish_ci,
  `name` text COLLATE utf8_polish_ci NOT NULL,
  `description` text COLLATE utf8_polish_ci,
  `deleted` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=9 ;

--
-- Zrzut danych tabeli `products`
--

INSERT INTO `products` (`product_id`, `manufacturer_id`, `product_no`, `name`, `description`, `deleted`) VALUES
(2, 14, 'ertretretert', 'example2ert', 'example2ert', 0),
(3, 2, NULL, 'gfhdfg', 'hfghrtut', 0),
(4, 2, NULL, 'sdfsdf', 'sdfsdf', 0),
(5, 2, NULL, 'new one xd', 'sdfsdf', 0),
(6, 8, 'dddddddddddddddddddd', 'ddddddddddddd', 'ddddddddddddddddddd', 0),
(7, 15, 'product_no', 'Speed', 'To jest przykladowy opis hehe', 0),
(8, 1, 'lllllllllllllllllll', 'llllllllll', 'llllllllllllllllll', 0);


--
-- Struktura tabeli dla tabeli `sizes`
--

CREATE TABLE IF NOT EXISTS `sizes` (
  `size_id` int(11) NOT NULL AUTO_INCREMENT,
  `manufacturer_id` int(11) NOT NULL,
  `us` text COLLATE utf8_polish_ci NOT NULL,
  `uk` text COLLATE utf8_polish_ci NOT NULL,
  `cm` text COLLATE utf8_polish_ci NOT NULL,
  `euro` text COLLATE utf8_polish_ci NOT NULL,
  `sex` varchar(2) COLLATE utf8_polish_ci NOT NULL,
  `deleted` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`size_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=4 ;

--
-- Zrzut danych tabeli `sizes`
--

INSERT INTO `sizes` (`size_id`, `manufacturer_id`, `us`, `uk`, `cm`, `euro`, `sex`, `deleted`) VALUES
(1, 4, '33', '22', '11', '55', '1', 0),
(2, 15, 'g', 'ggggggggggggggg', 'gggggggggggggg', 'gggggggggggg', '1', 0),
(3, 12, 'eeeeeeeeee', 'eeeeeeeeeeeeee', 'eeeeeeeeeeeeeeee', 'eeeeeeeeeeee', '0', 0);

-- --------------------------------------------------------
 
--
-- Struktura tabeli dla tabeli `transactions`
--

CREATE TABLE IF NOT EXISTS `transactions` (
  `transaction_id` int(11) NOT NULL AUTO_INCREMENT,
  `cart_id` int(11) NOT NULL,
  `payment_method_id` int(11) NOT NULL,
  `status` text COLLATE utf8_polish_ci NOT NULL,
  PRIMARY KEY (`transaction_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `types`
--

CREATE TABLE IF NOT EXISTS `types` (
  `type_id` int(11) NOT NULL AUTO_INCREMENT,
  `type_name` text COLLATE utf8_polish_ci NOT NULL,
  `deleted` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=3 ;

--
-- Zrzut danych tabeli `types`
--

INSERT INTO `types` (`type_id`, `type_name`, `deleted`) VALUES
(1, 'na nogerty', 0),
(2, 'ddddddd', 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `types_products`
--

CREATE TABLE IF NOT EXISTS `types_products` (
 `types_product_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `deleted` tinyint(4) DEFAULT '0',
    PRIMARY KEY (`types_product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=5 ;

--
-- Zrzut danych tabeli `types_products`
--

INSERT INTO `types_products` (`types_product_id`, `product_id`, `type_id`, `deleted`) VALUES
(1, 2, 2, 0),
(2, 2, 1, 0),
(3, 2, 1, 1),
(4, 2, 1, 1);


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

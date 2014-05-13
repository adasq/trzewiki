-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Czas wygenerowania: 13 Maj 2014, 09:57
-- Wersja serwera: 5.5.34
-- Wersja PHP: 5.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
  `deleted` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`item_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=34 ;

--
-- Zrzut danych tabeli `items`
--

INSERT INTO `items` (`item_id`, `product_id`, `size_id`, `price`, `price2`, `deleted`) VALUES
(5, 8, 8, 359, 300, 0),
(6, 8, 10, 359, 0, 0),
(7, 7, 8, 459, 0, 0),
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
(33, 6, 20, 299, 259, 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=7 ;

--
-- Zrzut danych tabeli `manufacturers`
--

INSERT INTO `manufacturers` (`manufacturer_id`, `name`, `deleted`) VALUES
(1, 'Asics', 0),
(3, 'New Balance', 0),
(4, 'Mizuno', 0),
(5, 'Saucony', 0),
(6, 'Brooks', 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=26 ;

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
(25, 7, 't3h4n_2693_n.png', 'image', 0);

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
  `status` text COLLATE utf8_polish_ci,
  `deleted` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=9 ;

--
-- Zrzut danych tabeli `products`
--

INSERT INTO `products` (`product_id`, `manufacturer_id`, `product_no`, `name`, `description`, `status`, `deleted`) VALUES
(2, 1, '65', 'Asics GEL-Nimbus 15 Lite-Show', '<p>GEL-NIMBUS 15 to flagowy model buta amortyzującego w kolekcji ASICS. But ten dostarcza&nbsp;<strong>wyjątkowy komfort i amortyzację dla biegaczy neutralnych o</strong>raz z niewielką skłonnością do pronacji. &nbsp;</p>\r\n<p>Piętnasta edycja tego buta może być spokojnie nazywana&nbsp;<strong>najbardziej komfortową wersją w historii</strong>. Wprowadzono bowiem nowe cholewki wykonane w technologii ASICS FluidFit oznaczającej siateczkę, kt&oacute;ra rozciąga się w wielu kierunkach, aby stworzyć najlepsze dopasowanie do stopy. Ta innowacja wsp&oacute;lnie z technologiami Heel Clutching System oraz Discrete Eyestay Construction zapewnia niezwykle precyzyjne dopasowanie buta do stopy biegacza.</p>\r\n<p>Wyjątkowy komfort biegu w tym modelu GEL-NIMBUS dostarcza podeszwa środkowa spEVA wykonana z bardzo lekkiego i trwałego materiału. Wpływ na wygodę użytkowania tego buta posiada r&oacute;wnież inna technologia podeszwy środkowej &ndash; FluidRide, zapewniająca biegaczom&nbsp;<strong>najlepszą charakterystykę odbicia oraz amortyzację</strong>&nbsp;przy zachowaniu lekkości.</p>\r\n<p>Model GEL-NIMBUS 15 dla mężczyzn zawiera także technologię Trusstic System, kt&oacute;ra oferuje nieco większą sztywność skrętną dla dodatkowego wsparcia podczas biegu.</p>\r\n<p>Technologia Full Length Guidance Line widoczna jako rowek wzdłuż podeszwy, prowadzi stopę przez cały cykl ruchu idealnie kopiując tor ruchu ludzkiej stopy. Dzięki temu biegacz porusza się sprawniej, nawet wtedy, gdy podczas treningu pojawia się zmęczenie.</p>\r\n<p>Dzięki zaawansowanym technologicznie innowacjom zapewniającym amortyzację model GEL-NIMBUS 15 to&nbsp;<strong>idealny partner na długie wybiegania.</strong></p>\r\n<p>&nbsp;</p>\r\n<p><strong>Systemy i technologie:</strong></p>\r\n<p><strong>Rearfoot and Forefooot GEL Cushioning Systems</strong>&nbsp;- tłumi uderzenia o podłoże podczas biegu, pozwala na ruch w wielu płaszczyznach podczas całego cyklu biegu.</p>\r\n<p><strong>FluidRide</strong>&nbsp;- innowacja w technologii podeszwy środkowej ASICS. FluidRide zapewnia najlepszą charakterystykę odbicia oraz amortyzację przy zachowaniu lekkości.</p>\r\n<p><strong>Full Length Guidance Line</strong>&nbsp;- system pionowych rowk&oacute;w przecinających podeszwę wzdłuż linii progresji dla spotęgowania efektywności przetaczania stopy w całym cyklu biegu.</p>\r\n<p><strong>Guidance Trusstic</strong>&nbsp;- Trusstic System integruje konstrukcję Guidance Line dla spotęgowania efektywności biegu przy jednoczesnym zachowaniu integralnej struktury podeszwy środkowej.</p>\r\n<p><strong>AHAR+</strong>&nbsp;- guma stosowana w zewnętrznej podeszwie, kt&oacute;rą cechuje wysoka odporność na ścieranie.</p>\r\n<p><strong>Discrete Eyelet&nbsp;</strong>- ulepsza dopasowanie cholewki przy jednoczesnej redukcji możliwych podrażnień.</p>\r\n<p><strong>Clutch counter</strong>&nbsp;- zewnętrzny zapiętek zapewniający lepsze wsparcie i dopasowanie pięty.</p>\r\n<p><strong>Ortholite Sockliner&nbsp;</strong>- zapewnia amortyzację i antybakteryjne właściwości dla zdrowszego, suchego i chłodnego środowiska.</p>\r\n<p><strong>Clutch counter</strong>&nbsp;- zewnętrzny zapiętek zapewniający zwiększone wsparcie stopy oraz stwarzający doskonałe dopasowanie buta do pięty.</p>\r\n<p><strong>IGS (Impact Guidance System)</strong>&nbsp;- czyli technologiczne rozwiązanie konstrukcji buta, kt&oacute;re pozwala stopie sportowca na naturalne ruchy w trakcie poszczeg&oacute;lnych faz kroku oraz stanowi wsparcie dla podbicia stopy.</p>\r\n<p><strong>FluitFit&nbsp;</strong>- technologia ASICS FluidFit zawiera technologiczną siateczkę, kt&oacute;ra rozciąga się w wielu kierunkach, aby stworzyć najlepsze dopasowanie do stopy.</p>\r\n<p>Waga: 330g</p>\r\n<p>Drop: 10 mm</p>', 'new', 0),
(3, 1, '', 'Asics Gel-Noosa Tri 9', '<p>Nazwany na cześć australijskiego triathlonu, GEL-NOOSA TRI jest&nbsp;<strong>popularny ze względu na swoje triathlonowe właściwości</strong>&nbsp;oraz kolorowe wzornictwo.</p>\r\n<p>GEL-NOOSA TRI 9 zawiera dodatkowe elastyczne sznur&oacute;wki, kt&oacute;re wystarczy zaciągnąć w czasie biegu. Dzięki temu możesz&nbsp;<strong>zaoszczędzić czas w strefie zmian</strong>. Miękka, antypoślizgowa wyści&oacute;łka pozwala na noszenie obuwia r&oacute;wnież bez skarpet.</p>\r\n<p>Odważny&nbsp;<strong>nowy projekt cholewki</strong>&nbsp;zawiera inspirowane australijskim triathlonem odblaskowe wzornictwo, zapewniające widoczność.</p>\r\n<p><strong>Buty startowe, zapewniające wsparcie</strong>, wychodzące na przeciw potrzebom triathlonist&oacute;w w dniu startu.</p>\r\n<p>&nbsp;</p>\r\n<p><strong>Wybrane systemy i technologie:</strong></p>\r\n<p><strong>Impact Guidance System I.G.S.</strong>&nbsp;- filozofia wzornicza Asics. Konstrukcja podnosząca efektywność naturalnego chodu w całym procesie przetaczania stopy.</p>\r\n<p><strong>Rearfoot and Forefoot GEL Cushioning System</strong>&nbsp;- neutralizuje wstrząsy podczas fazy lądowania i wybicia oraz wspiera proces biegu.</p>\r\n<p><strong>Full Length Guidance Line</strong>&nbsp;- system pionowych rowk&oacute;w przecinających podeszwę wzdłuż linii progresji dla spotęgowania efektywności przetaczania stopy w całym cyklu biegu.</p>\r\n<p><strong>Dynamic DuoMax Support System</strong>&nbsp;- system podeszwy środkowej o podw&oacute;jnej gęstości dla zwiększonego wsparcia i stabilizacji stopy.</p>\r\n<p><strong>Solyte Midsole Material&nbsp;</strong>- materiał lżejszy niż standardowy Asics EVA i SpEVA. Charakteryzuje się ulepszonymi właściwościami amortyzującymi i wyjątkową trwałością.</p>\r\n<p><strong>WetGrip RubberSponge</strong>&nbsp;- materiał wykonany ze spaecjalnej mieszanki organicznych i nieorganicznych komponent&oacute;w, zaprojektowany by zwiększyć przyczepność nawet na mokrych nawierzchniach.</p>\r\n<p><strong>Clutch counter</strong>&nbsp;- zewnętrzny zapiętek zapewniający zwiększone wsparcie stopy oraz stwarzający doskonałe dopasowanie buta do pięty.</p>\r\n<p>Waga: 238g</p>', 'recommended', 0),
(4, 1, '', 'Asics GEL-Cumulus 15', '<p>GEL-CUMULUS 15 to kolejna edycja buta treningowego, kt&oacute;ry zapewnia&nbsp;<strong>wyjątkowy komfort użytkowania.</strong></p>\r\n<p>Nowością w tym wydaniu jest podeszwa środkowa SpEVA na pełnej długości dostarczająca dodatkową amortyzację. &nbsp;Wsp&oacute;lnie z widocznymi w podeszwie wkładkami żelowymi zlokalizowanymi w przedniej i tylnej części buta absorbuje wstrząsy wywoływane uderzeniem stopy o podłoże zapewniając&nbsp;<strong>doskonały komfort podczas biegu.</strong></p>\r\n<p>Model GEL-CUMULUS 15 dla kobiet zawiera r&oacute;wnież technologię Gender Specific Cushioning, charakteryzującą się tym, że warstwa podeszwy środkowej Solyte ulokowana w przedniej części buta ma gęstość dobraną&nbsp;<strong>specjalnie dla kobiet</strong>. Pozwala to na znaczne obniżenie wagi buta oraz poprawienie komfortu i amortyzacji.</p>\r\n<p>Technologia Full Length Guidance Line widoczna jako rowek wzdłuż podeszwy, prowadzi stopę przez cały cykl ruchu idealnie kopiując tor ruchu ludzkiej stopy. Dzięki temu biegaczka&nbsp;<strong>porusza się sprawniej</strong>, nawet wtedy, gdy podczas treningu pojawia się zmęczenie.</p>\r\n<p>Technologia Discrete Eyestay Construction w cholewce&nbsp;<strong>poprawia og&oacute;lne dopasowanie buta</strong>&nbsp;do stopy.</p>\r\n<p>&nbsp;</p>\r\n<p><strong>Systemy i technologie:</strong></p>\r\n<p><strong>Full Length Guidance Line</strong>&nbsp;- system pionowych rowk&oacute;w przecinających podeszwę wzdłuż linii progresji dla spotęgowania efektywności przetaczania stopy w całym cyklu biegu.</p>\r\n<p><strong>Solyte Midsole Material</strong>&nbsp;- materiał amortyzujący zapewniający niebywale niską wagę przy r&oacute;wnoczesnym zwiększeniu sprężystości i trwałości.</p>\r\n<p><strong>Forefoot GEL, Rearfoot GEL</strong>&nbsp;- system ASICS GEL bazuje na specjalnej wkładce wykonanej z silikonu, kt&oacute;ra zapewnia optymalną amortyzację. Wkładki żelowe są rozmieszczone w newralgicznych miejscach podeszwy środkowej i tak wkomponowane, aby zwiększyć funkcjonalność.</p>\r\n<p><strong>AHAR+</strong>&nbsp;- wysoce odporna na uszkodzenia i trwała guma używana jako gruba warstwa w miejscach narażonych na szczeg&oacute;lne uszkodzenia. Zwiększa trwałość obuwia.</p>\r\n<p><strong>ComfortDry Sockliner</strong>&nbsp;&ndash; trzywarstwowa wkładka wewnętrzna, gwarantująca lepsze dopasowanie do stopy, optymalną cyrkulację powietrza; posiada funkcje antybakteryjne.</p>\r\n<p><strong>I.G.S.</strong>&nbsp;- opracowany przez ASICS Impact Guidance. System jest rozwiązaniem technicznym zastosowanym w budowie buta, dzięki kt&oacute;remu zachowana jest możliwość naturalnych ruch&oacute;w stopy. System I.G.S. ułatwia zachowanie naturalnego chodu.</p>\r\n<p><strong>Discrete Eyelet&nbsp;</strong>- poprawia dopasowanie buta w g&oacute;rnej warstwie, zmniejsza możliwość podrażnień.</p>\r\n<p><strong>Guidance Trusstic</strong>&nbsp;- Trusstic System integruje konstrukcję Guidance Line dla spotęgowania efektywności biegu przy jednoczesnym zachowaniu integralnej struktury podeszwy środkowej.</p>\r\n<p>Waga: 323 g</p>\r\n<p>Drop: 10 mm</p>', 'sale', 0),
(5, 1, '', 'Asics Gel-Emperor', '<p>Asics Gel-Emperor oferuje&nbsp;<strong>doskonałą amortyzację dla neutralnych biegaczy</strong>&nbsp;i jest idealny na luźne, relaksujące wybiegania.</p>\r\n<p>Amortyzujący system GEL absorbuje wstrząsy podczas kontaktu pięty z podłożem, a w połączeniu z pianką EVA w podeszwie środkowej&nbsp;<strong>zapewnia komfortowy bieg.</strong></p>\r\n<p>System Trusstic redukuję masę buta oraz zapewnia odpowiednią sztywność dla&nbsp;<strong>lepszej stabilizacji śr&oacute;dstopia</strong>.</p>\r\n<p>Podeszwa zewnętrza została wzmocniona poprzez ASICS AHAR, gumie zapewniającej<strong>wysoką odporność na ścieranie</strong>.</p>\r\n<p>&nbsp;</p>\r\n<p><strong>Systemy i technologie</strong>:</p>\r\n<p><strong>Rearfoot GEL Cushioning System</strong>&nbsp;- pochłania wstrząsy podczas fazy uderzenia i pozwala nałagodne przejście do fazy środkowej.</p>\r\n<p><strong>Trusstic System</strong>&nbsp;- redukuje masę podeszwy przy jednoczesnym zachowaniu integralnej struktury buta.</p>\r\n<p>Waga: 275g</p>', '', 0),
(6, 1, '', 'Asics GEL-Enduro 9', '<p>GEL-ENDURO 8 jest doskonały, jako&nbsp;<strong>model dla początkujących biegaczy.</strong>&nbsp;Oferuje komfort i ochronę na r&oacute;żnych typach terenu.</p>\r\n<p>Rearfoot GEL Cushioning System absorbuje wstrząsy, kiedy stopa ląduje i zapewnia<strong>komfortowy, doskonale zamortyzowany bieg.</strong></p>\r\n<p>Trusstic System redukuje masę obuwia stwarzając r&oacute;wnież&nbsp;<strong>lepszą stabilizację śr&oacute;dstopia.</strong></p>\r\n<p>Podeszwa zewnętrzna Trail Specific Outsole&nbsp;<strong>zapewnia optymalną trakcję na g&oacute;rzystym i kamienistym terenie</strong>. Aby sprawić, żeby podeszwa była jeszcze bardziej wytrzymała wzmocniona została technologią ASICS High Abrasion Rubber.</p>\r\n<p>Waga: 315 g</p>', 'new', 0),
(7, 1, '', 'Asics Gel-Fuji Trabuco 2', '<p>Od wielu lat GEL-FUJI TRABUCO należy do ulubionych but&oacute;w biegaczy trailowych ponieważ zapewnia im&nbsp;<strong>komfort i ochronę</strong>&nbsp;nawet w najbardziej wymagających warunkach.</p>\r\n<p>Tegoroczna edycja odznacza się nową cholewką, kt&oacute;ra jest bardziej&nbsp;<strong>przejrzysta i komfortowa.</strong></p>\r\n<p>To uniwersalne obuwie oferuje intensywny kontakt z podłożem poprzez podeszwę środkową oraz DuoMax Support System, kt&oacute;ry zapewnia bardzo&nbsp;<strong>stabilny ruch</strong>. Podeszwa zewnętrzna o charakterystycznym, agresywnym kształcie dostarcza biegaczom wielu wrażeń z pokonywania kilometr&oacute;w w terenie trailowym przy jednocześnie&nbsp;<strong>doskonałej przyczepności</strong>. GEL-FUJI TRABUCO 2 odznacza się 90 stopniowymi wcięciami w podeszwie zewnętrznej, aby udostępnić biegaczom<strong>optymalną trakcję</strong>&nbsp;na trudnych, stromych ścieżkach.</p>\r\n<p>System amortyzujące zlokalizowane w przedniej i tylnej części buta - Forefoot oraz Rearfoot GEL Cushioning zapewniają&nbsp;<strong>wyjątkowy komfort i ochronę</strong>, podczas gdy technologia Rock Protection Plate zabezpiecza stopy biegacza przed urazami, kt&oacute;re mogłyby spowodować wystające na ścieżce kamienie lub skały. &nbsp;</p>\r\n<p>Cholewka buta jest zbudowana w taki spos&oacute;b, aby odprowadzać brud i zanieczyszczenia poza obuwie. Zewnętrzny zapiętek natomiast uzupełnia niezwykłe możliwości tego modelu o ścisłe,&nbsp;<strong>idealne dopasowanie</strong>&nbsp;do stopy biegacza.</p>\r\n<p>Waga: 360g</p>', 'promotion', 0),
(8, 1, '', 'Asics Gel-FujiTrainer 2', '<p>GEL-FUJI TRAINER 2 to&nbsp;<strong>lekki terenowy but</strong>. Doświadczeni biegacze mogą pomyśleć o starcie w tym modelu nawet w ultra wyścigach.</p>\r\n<p>Specyficzna dla but&oacute;w trailowych podeszwa zapewnia&nbsp;<strong>doskonałą przyczepność</strong>, niezależnie od rodzaju terenu przy podbiegach oraz zbiegach.</p>\r\n<p>Waga: 285g</p>', '', 0);

-- --------------------------------------------------------

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
  `sex` text COLLATE utf8_polish_ci NOT NULL,
  `deleted` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`size_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=21 ;

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
(20, 1, '12', '11', '29.5', '46.5', 'male', 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=5 ;

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

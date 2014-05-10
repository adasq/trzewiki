-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Czas wygenerowania: 10 May 2014, 17:58
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
(1, 'adam', 'pswd', '', 'aaaaa@ww.ww', 'Andrzej', 'Nowak', '1', 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `carts`
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
-- Struktura tabeli dla  `cart_items`
--

CREATE TABLE IF NOT EXISTS `cart_items` (
  `cart_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_count` int(11) NOT NULL,
  `item_price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

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
(6, 'aaaatdfgf', 'KONTENT VALgggdfg\r\n	  ', 0),
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
-- Struktura tabeli dla  `items`
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=12 ;

--
-- Zrzut danych tabeli `items`
--

INSERT INTO `items` (`item_id`, `product_id`, `size_id`, `price`, `price2`, `status`, `deleted`) VALUES
(5, 8, 1, 359, 300, 'new', 0),
(6, 8, 1, 359, 0, 'new', 0),
(7, 7, 1, 459, 0, 'new', 0),
(8, 6, 1, 299, 259, 'new', 0),
(9, 2, 1, 599, NULL, 'recommended', 0),
(10, 3, 1, 499, NULL, 'recommended', 0),
(11, 4, 1, 499, NULL, 'recommended', 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `logs`
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
-- Struktura tabeli dla  `manufacturers`
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
(1, 'Asics', 0),
(3, 'New Balance', 0),
(4, 'Mizuno', 0),
(5, 'Saucony', 0),
(6, 'Brooks', 0);

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
-- Struktura tabeli dla  `products`
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
(2, 1, '', 'Asics GEL-Nimbus 15 Lite-Show', 'GEL-NIMBUS 15 to flagowy model buta amortyzującego w kolekcji ASICS. But ten dostarcza wyjątkowy komfort i amortyzację dla biegaczy neutralnych oraz z niewielką skłonnością do pronacji.  \r\n\r\n\r\nPiętnasta edycja tego buta może być spokojnie nazywana najbardziej komfortową wersją w historii. Wprowadzono bowiem nowe cholewki wykonane w technologii ASICS FluidFit oznaczającej siateczkę, która rozciąga się w wielu kierunkach, aby stworzyć najlepsze dopasowanie do stopy. Ta innowacja wspólnie z technologiami Heel Clutching System oraz Discrete Eyestay Construction zapewnia niezwykle precyzyjne dopasowanie buta do stopy biegacza.\r\n\r\n\r\nWyjątkowy komfort biegu w tym modelu GEL-NIMBUS dostarcza podeszwa środkowa spEVA wykonana z bardzo lekkiego i trwałego materiału. Wpływ na wygodę użytkowania tego buta posiada również inna technologia podeszwy środkowej – FluidRide, zapewniająca biegaczom najlepszą charakterystykę odbicia oraz amortyzację przy zachowaniu lekkości.\r\n\r\n\r\nModel GEL-NIMBUS 15 dla mężczyzn zawiera także technologię Trusstic System, która oferuje nieco większą sztywność skrętną dla dodatkowego wsparcia podczas biegu.\r\n\r\n\r\nTechnologia Full Length Guidance Line widoczna jako rowek wzdłuż podeszwy, prowadzi stopę przez cały cykl ruchu idealnie kopiując tor ruchu ludzkiej stopy. Dzięki temu biegacz porusza się sprawniej, nawet wtedy, gdy podczas treningu pojawia się zmęczenie.\r\n\r\n\r\nDzięki zaawansowanym technologicznie innowacjom zapewniającym amortyzację model GEL-NIMBUS 15 to idealny partner na długie wybiegania.\r\n\r\n\r\n \r\n\r\n\r\nSystemy i technologie:\r\n\r\n\r\nRearfoot and Forefooot GEL Cushioning Systems - tłumi uderzenia o podłoże podczas biegu, pozwala na ruch w wielu płaszczyznach podczas całego cyklu biegu.\r\n\r\n\r\nFluidRide - innowacja w technologii podeszwy środkowej ASICS. FluidRide zapewnia najlepszą charakterystykę odbicia oraz amortyzację przy zachowaniu lekkości.\r\n\r\n\r\nFull Length Guidance Line - system pionowych rowków przecinających podeszwę wzdłuż linii progresji dla spotęgowania efektywności przetaczania stopy w całym cyklu biegu.\r\n\r\n\r\nGuidance Trusstic - Trusstic System integruje konstrukcję Guidance Line dla spotęgowania efektywności biegu przy jednoczesnym zachowaniu integralnej struktury podeszwy środkowej.\r\n\r\n\r\nAHAR+ - guma stosowana w zewnętrznej podeszwie, którą cechuje wysoka odporność na ścieranie.\r\n\r\n\r\nDiscrete Eyelet - ulepsza dopasowanie cholewki przy jednoczesnej redukcji możliwych podrażnień.\r\n\r\n\r\nClutch counter - zewnętrzny zapiętek zapewniający lepsze wsparcie i dopasowanie pięty.\r\n\r\n\r\nOrtholite Sockliner - zapewnia amortyzację i antybakteryjne właściwości dla zdrowszego, suchego i chłodnego środowiska.\r\n\r\n\r\nClutch counter - zewnętrzny zapiętek zapewniający zwiększone wsparcie stopy oraz stwarzający doskonałe dopasowanie buta do pięty.\r\n\r\n\r\nIGS (Impact Guidance System) - czyli technologiczne rozwiązanie konstrukcji buta, które pozwala stopie sportowca na naturalne ruchy w trakcie poszczególnych faz kroku oraz stanowi wsparcie dla podbicia stopy.\r\n\r\n\r\nFluitFit - technologia ASICS FluidFit zawiera technologiczną siateczkę, która rozciąga się w wielu kierunkach, aby stworzyć najlepsze dopasowanie do stopy.\r\n\r\n\r\nWaga: 330g\r\n\r\n\r\nDrop: 10 mm', 0),
(3, 1, NULL, 'Asics Gel-Noosa Tri 9', 'Nazwany na cześć australijskiego triathlonu, GEL-NOOSA TRI jest popularny ze względu na swoje triathlonowe właściwości oraz kolorowe wzornictwo.\r\n\r\n\r\nGEL-NOOSA TRI 9 zawiera dodatkowe elastyczne sznurówki, które wystarczy zaciągnąć w czasie biegu. Dzięki temu możesz zaoszczędzić czas w strefie zmian. Miękka, antypoślizgowa wyściółka pozwala na noszenie obuwia również bez skarpet.\r\n\r\n\r\nOdważny nowy projekt cholewki zawiera inspirowane australijskim triathlonem odblaskowe wzornictwo, zapewniające widoczność.\r\n\r\n\r\nButy startowe, zapewniające wsparcie, wychodzące na przeciw potrzebom triathlonistów w dniu startu.\r\n\r\n\r\n \r\n\r\n\r\nWybrane systemy i technologie:\r\n\r\n\r\nImpact Guidance System I.G.S. - filozofia wzornicza Asics. Konstrukcja podnosząca efektywność naturalnego chodu w całym procesie przetaczania stopy.\r\n\r\n\r\nRearfoot and Forefoot GEL Cushioning System - neutralizuje wstrząsy podczas fazy lądowania i wybicia oraz wspiera proces biegu.\r\n\r\n\r\nFull Length Guidance Line - system pionowych rowków przecinających podeszwę wzdłuż linii progresji dla spotęgowania efektywności przetaczania stopy w całym cyklu biegu.\r\n\r\n\r\n\r\n\r\n\r\n\r\nDynamic DuoMax Support System - system podeszwy środkowej o podwójnej gęstości dla zwiększonego wsparcia i stabilizacji stopy.\r\n\r\n\r\n\r\n\r\nSolyte Midsole Material - materiał lżejszy niż standardowy Asics EVA i SpEVA. Charakteryzuje się ulepszonymi właściwościami amortyzującymi i wyjątkową trwałością.\r\n\r\n\r\nWetGrip RubberSponge - materiał wykonany ze spaecjalnej mieszanki organicznych i nieorganicznych komponentów, zaprojektowany by zwiększyć przyczepność nawet na mokrych nawierzchniach.\r\n\r\n\r\nClutch counter - zewnętrzny zapiętek zapewniający zwiększone wsparcie stopy oraz stwarzający doskonałe dopasowanie buta do pięty.\r\n\r\n\r\nWaga: 238g', 0),
(4, 1, NULL, 'Asics GEL-Cumulus 15', 'GEL-CUMULUS 15 to kolejna edycja buta treningowego, który zapewnia wyjątkowy komfort użytkowania.\r\n\r\n\r\nNowością w tym wydaniu jest podeszwa środkowa SpEVA na pełnej długości dostarczająca dodatkową amortyzację.  Wspólnie z widocznymi w podeszwie wkładkami żelowymi zlokalizowanymi w przedniej i tylnej części buta absorbuje wstrząsy wywoływane uderzeniem stopy o podłoże zapewniając doskonały komfort podczas biegu.\r\n\r\n\r\nModel GEL-CUMULUS 15 dla kobiet zawiera również technologię Gender Specific Cushioning, charakteryzującą się tym, że warstwa podeszwy środkowej Solyte ulokowana w przedniej części buta ma gęstość dobraną specjalnie dla kobiet. Pozwala to na znaczne obniżenie wagi buta oraz poprawienie komfortu i amortyzacji.\r\n\r\n\r\nTechnologia Full Length Guidance Line widoczna jako rowek wzdłuż podeszwy, prowadzi stopę przez cały cykl ruchu idealnie kopiując tor ruchu ludzkiej stopy. Dzięki temu biegaczka porusza się sprawniej, nawet wtedy, gdy podczas treningu pojawia się zmęczenie.\r\n\r\n\r\nTechnologia Discrete Eyestay Construction w cholewce poprawia ogólne dopasowanie buta do stopy.\r\n\r\n\r\nSystemy i technologie:\r\n\r\n\r\nFull Length Guidance Line - system pionowych rowków przecinających podeszwę wzdłuż linii progresji dla spotęgowania efektywności przetaczania stopy w całym cyklu biegu.\r\n\r\n\r\nSolyte Midsole Material - materiał amortyzujący zapewniający niebywale niską wagę przy równoczesnym zwiększeniu sprężystości i trwałości.\r\n\r\n\r\nForefoot GEL, Rearfoot GEL - system ASICS GEL bazuje na specjalnej wkładce wykonanej z silikonu, która zapewnia optymalną amortyzację. Wkładki żelowe są rozmieszczone w newralgicznych miejscach podeszwy środkowej i tak wkomponowane, aby zwiększyć funkcjonalność.\r\n\r\n\r\nAHAR+ - wysoce odporna na uszkodzenia i trwała guma używana jako gruba warstwa w miejscach narażonych na szczególne uszkodzenia. Zwiększa trwałość obuwia.\r\n\r\n\r\nComfortDry Sockliner – trzywarstwowa wkładka wewnętrzna, gwarantująca lepsze dopasowanie do stopy, optymalną cyrkulację powietrza; posiada funkcje antybakteryjne.\r\n\r\n\r\nI.G.S. - opracowany przez ASICS Impact Guidance. System jest rozwiązaniem technicznym zastosowanym w budowie buta, dzięki któremu zachowana jest możliwość naturalnych ruchów stopy. System I.G.S. ułatwia zachowanie naturalnego chodu.\r\n\r\n\r\nDiscrete Eyelet - poprawia dopasowanie buta w górnej warstwie, zmniejsza możliwość podrażnień.\r\n\r\n\r\nGuidance Trusstic - Trusstic System integruje konstrukcję Guidance Line dla spotęgowania efektywności biegu przy jednoczesnym zachowaniu integralnej struktury podeszwy środkowej.\r\n\r\n\r\nWaga: 323 g\r\n\r\n\r\nDrop: 10 mm', 0),
(5, 1, NULL, 'Asics Gel-Emperor', 'Asics Gel-Emperor oferuje doskonałą amortyzację dla neutralnych biegaczy i jest idealny na luźne, relaksujące wybiegania.\r\n\r\n\r\nAmortyzujący system GEL absorbuje wstrząsy podczas kontaktu pięty z podłożem, a w połączeniu z pianką EVA w podeszwie środkowej zapewnia komfortowy bieg.\r\n\r\n\r\nSystem Trusstic redukuję masę buta oraz zapewnia odpowiednią sztywność dla lepszej stabilizacji śródstopia.\r\n\r\n\r\nPodeszwa zewnętrza została wzmocniona poprzez ASICS AHAR, gumie zapewniającej wysoką odporność na ścieranie.\r\n\r\n\r\nSystemy i technologie:\r\n\r\n\r\nRearfoot GEL Cushioning System - pochłania wstrząsy podczas fazy uderzenia i pozwala nałagodne przejście do fazy środkowej.\r\n\r\n\r\nTrusstic System - redukuje masę podeszwy przy jednoczesnym zachowaniu integralnej struktury buta.\r\n\r\n\r\nWaga: 275g', 0),
(6, 1, '', 'Asics GEL-Enduro 9', 'GEL-ENDURO 8 jest doskonały, jako model dla początkujących biegaczy. Oferuje komfort i ochronę na różnych typach terenu.\r\n\r\n\r\nRearfoot GEL Cushioning System absorbuje wstrząsy, kiedy stopa ląduje i zapewnia komfortowy, doskonale zamortyzowany bieg.\r\n\r\n\r\nTrusstic System redukuje masę obuwia stwarzając również lepszą stabilizację śródstopia.\r\n\r\n\r\nPodeszwa zewnętrzna Trail Specific Outsole zapewnia optymalną trakcję na górzystym i kamienistym terenie. Aby sprawić, żeby podeszwa była jeszcze bardziej wytrzymała wzmocniona została technologią ASICS High Abrasion Rubber.\r\n\r\n\r\nWaga: 315 g', 0),
(7, 1, '', 'Asics Gel-Fuji Trabuco 2', 'Od wielu lat GEL-FUJI TRABUCO należy do ulubionych butów biegaczy trailowych ponieważ zapewnia im komfort i ochronę nawet w najbardziej wymagających warunkach.\r\n\r\n\r\nTegoroczna edycja odznacza się nową cholewką, która jest bardziej przejrzysta i komfortowa.\r\n\r\n\r\nTo uniwersalne obuwie oferuje intensywny kontakt z podłożem poprzez podeszwę środkową oraz DuoMax Support System, który zapewnia bardzo stabilny ruch. Podeszwa zewnętrzna o charakterystycznym, agresywnym kształcie dostarcza biegaczom wielu wrażeń z pokonywania kilometrów w terenie trailowym przy jednocześnie doskonałej przyczepności. GEL-FUJI TRABUCO 2 odznacza się 90 stopniowymi wcięciami w podeszwie zewnętrznej, aby udostępnić biegaczom optymalną trakcję na trudnych, stromych ścieżkach.\r\n\r\n\r\nSystem amortyzujące zlokalizowane w przedniej i tylnej części buta - Forefoot oraz Rearfoot GEL Cushioning zapewniają wyjątkowy komfort i ochronę, podczas gdy technologia Rock Protection Plate zabezpiecza stopy biegacza przed urazami, które mogłyby spowodować wystające na ścieżce kamienie lub skały.  \r\n\r\n\r\nCholewka buta jest zbudowana w taki sposób, aby odprowadzać brud i zanieczyszczenia poza obuwie. Zewnętrzny zapiętek natomiast uzupełnia niezwykłe możliwości tego modelu o ścisłe, idealne dopasowanie do stopy biegacza.\r\n\r\n\r\nWaga: 360g', 0),
(8, 1, '', 'Asics Gel-FujiTrainer 2', 'GEL-FUJI TRAINER 2 to lekki terenowy but. Doświadczeni biegacze mogą pomyśleć o starcie w tym modelu nawet w ultra wyścigach.\r\n\r\n\r\n \r\n\r\n\r\nSpecyficzna dla butów trailowych podeszwa zapewnia doskonałą przyczepność, niezależnie od rodzaju terenu przy podbiegach oraz zbiegach.\r\n\r\n\r\n \r\n\r\n\r\nWaga: 285g', 0);

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
-- Struktura tabeli dla  `transactions`
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
-- Struktura tabeli dla  `types`
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
-- Struktura tabeli dla  `types_products`
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

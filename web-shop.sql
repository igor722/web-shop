-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 16. Jan 2024 um 16:32
-- Server-Version: 10.4.28-MariaDB
-- PHP-Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `web-shop`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(250) NOT NULL,
  `admin_email` text NOT NULL,
  `admin_password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `admins`
--

INSERT INTO `admins` (`admin_id`, `admin_name`, `admin_email`, `admin_password`) VALUES
(3, 'admin', 'admin@info.de', 'e10adc3949ba59abbe56e057f20f883e');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_cost` decimal(6,2) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_status` varchar(15) DEFAULT NULL,
  `user_phone` varchar(20) DEFAULT NULL,
  `user_city` varchar(20) DEFAULT NULL,
  `user_address` varchar(50) DEFAULT NULL,
  `order_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `order_items`
--

CREATE TABLE `order_items` (
  `item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_image1` varchar(255) NOT NULL,
  `order_cost` decimal(6,2) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(150) NOT NULL,
  `product_category` varchar(100) NOT NULL,
  `product_description` varchar(255) NOT NULL,
  `product_image1` varchar(255) NOT NULL,
  `product_image2` varchar(255) NOT NULL,
  `product_image3` varchar(255) NOT NULL,
  `product_image4` varchar(255) NOT NULL,
  `product_price` decimal(6,2) NOT NULL,
  `product_color1` varchar(10) DEFAULT NULL,
  `product_color2` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_category`, `product_description`, `product_image1`, `product_image2`, `product_image3`, `product_image4`, `product_price`, `product_color1`, `product_color2`) VALUES
(1, 'Hi-Vis Broken Reflective Premium T-Shirt Alhambra', 'T-Shirt', 'Zertifiziert nach EN ISO 20471:2013 + A1:2016', '1188014.jpg', '1750585.jpg', '1188014.jpg', '1188014.jpg', 38.42, '#EDE939', '#EDE939'),
(2, 'EOS Hi-Vis Workwear Softshell Jacket With Printing Area', 'Jacke', 'Zertifiziert nach EN ISO 20471:2013 + A1:2016', '2259255.jpg', '2259258.jpg', '2259259.jpg', '2259255.jpg', 89.99, '#EDE939', '#000000'),
(4, 'High Vis Cap', 'Mütze', 'Zertifiziert nach EN ISO 20471:2013 + A1:2016', '302129.jpg', '1924055.jpg', '1924056.jpg', '302129.jpg', 14.99, '#F0FF3D', '#F0FF3D'),
(5, 'Men´s Chef Jacket Turin GreeNature', 'Jacke', 'Ärmel zum Aufkrempeln können mit Schlaufe und Druckknopf fixiert werden. Bis 95 °C waschbar.', '2161491.jpg', '2157911.jpg', '2157912.jpg', '2161491.jpg', 57.99, '#040000', '#040000'),
(6, 'Apron Vittoria Classic', 'Latzschürze', 'Bis 95 °C waschbar.', '1319738.jpg', '2107681.jpg', '1319738.jpg', '1319738.jpg', 29.99, '#97143E', '#97143E'),
(7, 'Sandstone SB Safety Trainer', 'Schuhe', 'Wasserabweisendes Obermaterial aus PU-Nubuk und Netz mit gepolstertem Knöchelschutz', '2261659.jpg', '2261636.jpg', '2261637.jpg', '2261638.jpg', 99.99, '#A11729', '#000000'),
(8, 'Mudstone SBP Safety Hiker', 'Schuhe', 'Wasserabweisendes Obermaterial aus PU-Nubuk und Netz mit gepolstertem Knöchelschutz', '2115746.jpg', '2100822.jpg', '2394322.jpg', '2394323.jpg', 119.99, '#39373B', '#AF3135'),
(9, 'Ofenhandschuh', 'Handschuhe', 'Baumwollseite hitzeresistent.', '1577957.jpg', '1625057.jpg', '1913961.jpg', '1577957.jpg', 49.99, '#4A2317', '#323635'),
(10, 'Lite Coverall', 'T-Shirt', 'Cargo-Mehrzweck-Taschensystem mit reflektierenden Klettverschlusslaschen', '759700.jpg', '1904909.jpg', '1904910.jpg', '759700.jpg', 79.99, '#36424A', '#E85100'),
(11, 'Expert Kiwi Cap', 'Mütze', 'Angerautes, recyceltes Polyester und BCI-Baumwolle mit EcoShield DWR-Oberfläche', 'Expert Kiwi Cap1.jpeg', 'Expert Kiwi Cap2.jpeg', 'Expert Kiwi Cap3.jpeg', 'Expert Kiwi Cap4.jpeg', 25.99, '#505050', '#505050'),
(12, 'Men´s T-Shirt', 'T-Shirt', 'Mischware Single Jersey Seitennähte Schlaufen in der Seitennaht innen Elasthananteil im schmalen Ripp-Bündchen', 'Men´s T-Shirt1.jpeg', 'Men´s T-Shirt2.jpeg', 'Men´s T-Shirt3.jpeg', 'Men´s T-Shirt4.jpeg', 29.99, '#1244A6', '#1244A6'),
(14, 'Unisex Sweater', 'T-Shirt', 'Unisex Sweatshirt Halbmond im Nacken Elasthanbündchen an Hals, Ärmeln und Saum Schlaufen in der Seitennaht innen', 'Unisex Sweater1.jpeg', 'Unisex Sweater2.jpeg', 'Unisex Sweater3.jpeg', 'Unisex Sweater4.jpeg', 34.90, '#C3031F', '#C3031F'),
(15, 'Lite Shorts', 'Hose', '\r\n\r\n    Reißverschluss vorne mit Knopfverschluss\r\n    Elastische Einsätze am Bund\r\n    Cargo-Mehrzweck-Taschensystem mit reflektierenden Klettverschlusslaschen\r\n    Verstärkte Nähte an beanspruchten Stellen\r\n    Gürtelschlaufen mit doppelter Lasche\r\n    W', '2173697.jpg', '1904907.jpg', '1904908.jpg', '759699.jpg', 44.99, '#161E44', '#E85100');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_password`) VALUES
(1, 'Igor', 'mymail@success.de', '101a6ec9f938885df0a44f20458d2eb4'),
(2, 'Somebodyelse', 'yourmail@success.de', '5b1b68a9abf4d2cd155c81a9225fd158'),
(3, 'Igor', 'xcute@gmail.com', 'd5fed6622af5f214f8cb087948fc9b27'),
(4, 'New User', '123456@pass.de', 'e10adc3949ba59abbe56e057f20f883e'),
(5, 'Neue Nutzer', 'nutzer@email.de', '25f9e794323b453885f5181f1b624d0b');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indizes für die Tabelle `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indizes für die Tabelle `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indizes für die Tabelle `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `UX_Constraint` (`user_email`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT für Tabelle `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `order_items`
--
ALTER TABLE `order_items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

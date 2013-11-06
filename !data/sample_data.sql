-- phpMyAdmin SQL Dump
-- version 4.0.6deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 06, 2013 at 11:04 AM
-- Server version: 5.5.34-0ubuntu0.13.10.1
-- PHP Version: 5.5.3-1ubuntu2

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `test`
--

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`) VALUES
(1, 'Spodnie męskie'),
(2, 'Koszula damska'),
(3, 'Dysk twardy'),
(4, 'Spodnie damskie'),
(5, 'Jabłko'),
(6, 'Telewizor'),
(7, 'Radio'),
(8, 'Kurtka'),
(9, 'Buty'),
(10, 'Zegarek'),
(11, 'Bluzka'),
(12, 'Spodnie'),
(13, 'Bluzka'),
(14, 'Sweter'),
(15, 'Koszulka'),
(16, 'Skarpetki'),
(17, 'Spodnie kolorowe');

--
-- Dumping data for table `product_attribute`
--

INSERT INTO `product_attribute` (`id`, `name`) VALUES
(3, 'Dla kogo'),
(5, 'Dostępny'),
(1, 'Kolor'),
(6, 'Kruszec'),
(7, 'Kruszec12'),
(4, 'Pojemność'),
(2, 'Rozmiar');

--
-- Dumping data for table `product_attribute_value`
--

INSERT INTO `product_attribute_value` (`id`, `value`, `id_attribute`) VALUES
(18, '500GB', 4),
(24, 'Czarny', 1),
(6, 'Czerwony', 1),
(15, 'Dla dzieci', 3),
(16, 'Dla kobiet', 3),
(17, 'Dla mężczyzn', 3),
(13, 'L', 2),
(12, 'M', 2),
(19, 'Niebieski', 1),
(23, 'Platyna', 6),
(11, 'S', 2),
(21, 'Srebro', 6),
(14, 'XL', 2),
(9, 'Zielony', 1),
(20, 'Złoto', 6),
(10, 'Żółty', 1);

--
-- Dumping data for table `product_product2attribute_value`
--

INSERT INTO `product_product2attribute_value` (`id`, `id_product`, `id_value`) VALUES
(28, 9, 11),
(29, 9, 12),
(30, 9, 13),
(31, 9, 15),
(32, 9, 17),
(1, 12, 12),
(2, 14, 11),
(4, 15, 11),
(5, 15, 12),
(6, 15, 13),
(3, 15, 17),
(12, 16, 12),
(13, 16, 15),
(17, 17, 6),
(18, 17, 9),
(19, 17, 10),
(20, 17, 19);
SET FOREIGN_KEY_CHECKS=1;
COMMIT;


-- phpMyAdmin SQL Dump
-- version 4.0.6deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 06, 2013 at 11:03 AM
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

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=18 ;

-- --------------------------------------------------------

--
-- Table structure for table `product_attribute`
--

CREATE TABLE IF NOT EXISTS `product_attribute` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_polish_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Table structure for table `product_attribute_value`
--

CREATE TABLE IF NOT EXISTS `product_attribute_value` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `value` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `id_attribute` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `value_id_attribute` (`value`,`id_attribute`),
  KEY `id_attribute` (`id_attribute`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=25 ;

-- --------------------------------------------------------

--
-- Table structure for table `product_product2attribute_value`
--

CREATE TABLE IF NOT EXISTS `product_product2attribute_value` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_product` int(10) unsigned NOT NULL,
  `id_value` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_product_id_attribute_id_value` (`id_product`,`id_value`),
  KEY `id_product` (`id_product`),
  KEY `id_value` (`id_value`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci ROW_FORMAT=COMPACT AUTO_INCREMENT=33 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product_attribute_value`
--
ALTER TABLE `product_attribute_value`
  ADD CONSTRAINT `product_attribute_value_ibfk_1` FOREIGN KEY (`id_attribute`) REFERENCES `product_attribute` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_product2attribute_value`
--
ALTER TABLE `product_product2attribute_value`
  ADD CONSTRAINT `FK_product_product2attribute_value_product` FOREIGN KEY (`id_product`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_product_product2attribute_value_product_attribute_value` FOREIGN KEY (`id_value`) REFERENCES `product_attribute_value` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

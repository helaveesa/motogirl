-- phpMyAdmin SQL Dump
-- version 3.2.3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 10, 2013 at 09:11 PM
-- Server version: 5.1.40
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `eshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `nazv` varchar(255) COLLATE cp1251_general_cs NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 COLLATE=cp1251_general_cs AUTO_INCREMENT=5 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `nazv`) VALUES
(1, 'Категория 1'),
(2, 'Категория 2222'),
(4, 'Категория 1');

-- --------------------------------------------------------

--
-- Table structure for table `tovary`
--

CREATE TABLE IF NOT EXISTS `tovary` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `nazv` varchar(255) COLLATE cp1251_general_cs NOT NULL,
  `cena` mediumint(9) NOT NULL,
  `opis` text COLLATE cp1251_general_cs NOT NULL,
  `photo` varchar(255) COLLATE cp1251_general_cs NOT NULL,
  `spec` tinyint(4) NOT NULL,
  `id_cat` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_cat` (`id_cat`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 COLLATE=cp1251_general_cs AUTO_INCREMENT=10 ;

--
-- Dumping data for table `tovary`
--

INSERT INTO `tovary` (`id`, `nazv`, `cena`, `opis`, `photo`, `spec`, `id_cat`) VALUES
(1, 'Товар 111', 12000, 'ntrbdflg df gdsfdf ывапыв а ыва выа', '1.jpeg', 0, 1),
(3, 'Товар 2', 1000, 'п вапвап', '3.jpeg', 1, 1),
(4, 'Товар 3', 2311, 'ыв аываыв', '4.jpeg', 1, 4),
(5, 'Длинное название товара', 1356, 'ыва ываыва', '5.jpeg', 1, 1),
(6, 'И еще товар', 2122, 'выавыа ыва ыва', '6.jpeg', 0, 2),
(7, 'Товар 555', 3322, 'ыва ыва ыва вы', 'i.jpeg', 0, 4),
(8, 'Товар без фотки', 23569, 'ыва ываывавыа', 'i.jpeg', 0, 1),
(9, 'Суперпредложение!', 222, 'фывфы вфыв фывфы', '9.jpeg', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE cp1251_general_cs NOT NULL,
  `pwd` char(40) COLLATE cp1251_general_cs NOT NULL,
  `fio` varchar(255) COLLATE cp1251_general_cs NOT NULL,
  `phone` varchar(255) COLLATE cp1251_general_cs NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 COLLATE=cp1251_general_cs AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `pwd`, `fio`, `phone`) VALUES
(1, 'Admin', '7d01886094e7b668b3e2c486156266b1', 'Admin', '111'),
(2, 'vasya@maol.ru', '7d01886094e7b668b3e2c486156266b1', 'Вася', '7895465');

-- --------------------------------------------------------

--
-- Table structure for table `zakaz`
--

CREATE TABLE IF NOT EXISTS `zakaz` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `date_add` datetime NOT NULL,
  `status` tinyint(4) NOT NULL,
  `fio` varchar(255) COLLATE cp1251_general_cs NOT NULL,
  `phone` varchar(255) COLLATE cp1251_general_cs NOT NULL,
  `adres` varchar(255) COLLATE cp1251_general_cs NOT NULL,
  `id_tovar` smallint(6) NOT NULL,
  `kol` smallint(6) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_tovar` (`id_tovar`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 COLLATE=cp1251_general_cs AUTO_INCREMENT=4 ;

--
-- Dumping data for table `zakaz`
--

INSERT INTO `zakaz` (`id`, `date_add`, `status`, `fio`, `phone`, `adres`, `id_tovar`, `kol`) VALUES
(1, '2013-10-10 20:57:34', 2, 'Вася', '7895465', 'sdfsdfsd', 3, 1),
(2, '2013-10-10 20:57:34', 2, 'Вася', '7895465', 'sdfsdfsd', 6, 1),
(3, '2013-10-10 20:57:34', 1, 'Вася', '7895465', 'sdfsdfsd', 5, 4);

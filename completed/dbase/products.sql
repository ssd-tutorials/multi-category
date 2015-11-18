-- phpMyAdmin SQL Dump
-- version 3.3.9.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 27, 2012 at 09:23 AM
-- Server version: 5.5.9
-- PHP Version: 5.3.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `products`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` VALUES(1, 'Electric');
INSERT INTO `categories` VALUES(2, 'Acoustic');
INSERT INTO `categories` VALUES(3, 'Wooden');
INSERT INTO `categories` VALUES(4, 'Strings');
INSERT INTO `categories` VALUES(5, 'Woodwind');
INSERT INTO `categories` VALUES(6, 'Brass');
INSERT INTO `categories` VALUES(7, 'Percussion');
INSERT INTO `categories` VALUES(8, 'Metal');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` VALUES(1, 'Bass Guitar');
INSERT INTO `products` VALUES(2, 'Drum Kit');
INSERT INTO `products` VALUES(3, 'Acoustic Guitar');
INSERT INTO `products` VALUES(4, 'Electric Guitar');
INSERT INTO `products` VALUES(5, 'Trumpet');
INSERT INTO `products` VALUES(6, 'Piano');

-- --------------------------------------------------------

--
-- Table structure for table `products_categories`
--

CREATE TABLE `products_categories` (
  `product` int(10) unsigned NOT NULL,
  `category` int(10) unsigned NOT NULL,
  PRIMARY KEY (`product`,`category`),
  KEY `category` (`category`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products_categories`
--

INSERT INTO `products_categories` VALUES(1, 1);
INSERT INTO `products_categories` VALUES(2, 1);
INSERT INTO `products_categories` VALUES(4, 1);
INSERT INTO `products_categories` VALUES(6, 1);
INSERT INTO `products_categories` VALUES(2, 2);
INSERT INTO `products_categories` VALUES(3, 2);
INSERT INTO `products_categories` VALUES(6, 2);
INSERT INTO `products_categories` VALUES(1, 3);
INSERT INTO `products_categories` VALUES(2, 3);
INSERT INTO `products_categories` VALUES(3, 3);
INSERT INTO `products_categories` VALUES(4, 3);
INSERT INTO `products_categories` VALUES(1, 4);
INSERT INTO `products_categories` VALUES(3, 4);
INSERT INTO `products_categories` VALUES(4, 4);
INSERT INTO `products_categories` VALUES(5, 6);
INSERT INTO `products_categories` VALUES(2, 7);
INSERT INTO `products_categories` VALUES(6, 7);
INSERT INTO `products_categories` VALUES(2, 8);
INSERT INTO `products_categories` VALUES(5, 8);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products_categories`
--
ALTER TABLE `products_categories`
  ADD CONSTRAINT `products_categories_ibfk_1` FOREIGN KEY (`product`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `products_categories_ibfk_2` FOREIGN KEY (`category`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

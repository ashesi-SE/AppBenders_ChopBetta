-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 24, 2014 at 09:33 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `canteen`
--

-- --------------------------------------------------------

--
-- Table structure for table `currentMeal`
--

CREATE TABLE IF NOT EXISTS `currentMeal` (
  `current_meal_id` int(11) NOT NULL AUTO_INCREMENT,
  `current_meal_name` varchar(255) DEFAULT NULL,
  `customer_rating` int(11) DEFAULT NULL,
  PRIMARY KEY (`current_meal_id`),
  UNIQUE KEY `current_meal_name` (`current_meal_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='This table shows the list of meals available at a given point in time' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `foodList`
--

CREATE TABLE IF NOT EXISTS `foodList` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_name` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`item_id`),
  UNIQUE KEY `item_name` (`item_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='This table provides a list of food items available at the local eateries' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `mealList`
--

CREATE TABLE IF NOT EXISTS `mealList` (
  `meal_id` int(11) NOT NULL AUTO_INCREMENT,
  `meal_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`meal_id`),
  UNIQUE KEY `meal_name` (`meal_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='This table provides a collection of meals usually served at the eateries' AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `currentMeal`
--
ALTER TABLE `currentMeal`
  ADD CONSTRAINT `currentmeal_ibfk_1` FOREIGN KEY (`current_meal_id`) REFERENCES `mealList` (`meal_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

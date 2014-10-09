-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 04, 2014 at 04:19 PM
-- Server version: 5.6.19-0ubuntu0.14.04.1
-- PHP Version: 5.5.17-2+deb.sury.org~trusty+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;


USE `canteen`;

-- --------------------------------------------------------

--
-- Table structure for table `cafeteria`

--
-- Dumping data for table `cafeteria`
--

INSERT INTO `cafeteria` (`cafeteria_id`, `cafeteria_name`) VALUES
(1, 'Akonnor'),
(4, 'Charlottes'),
(3, 'Eyram''s'),
(2, 'Mannies');



INSERT INTO `currentMeal` (`current_meal_id`, `current_meal_name`, `customer_rating`, `cid`) VALUES
(1, 'Banku,Okro stew and grilled tilapia', NULL, 1),
(2, 'Fried Rice and Beef Sauce', NULL, 2),
(3, 'Fried Plantain and beans stew', NULL, 1),
(5, 'Boiled Yam and Beans Stew', NULL, 1),
(7, 'Fried Plantain and Tomato Sauce', NULL, 1),
(8, 'Jollof and Grilled Tilapia', NULL, 2),
(9, 'fried fish with egg', NULL, NULL);



INSERT INTO `foodList` (`item_id`, `item_name`, `cid`) VALUES
(47, '', 1),
(1, 'Banku', 1),
(41, 'Beans Stew', 1),
(5, 'Beef Sauce', 2),
(39, 'Beef Stew', 1),
(42, 'Boiled Yam', 1),
(49, 'egg', 1),
(40, 'Fried Plantain', 1),
(4, 'Fried Rice', 2),
(48, 'Gari', 1),
(3, 'Grilled Tilapia', 1),
(38, 'Jollof', 1),
(2, 'Okro stew', 1),
(43, 'Palava Sauce', 1),
(36, 'Rice', 1),
(44, 'Safron Rice', 2),
(45, 'Sausages', 2),
(37, 'Tomato sauce', 1);


INSERT INTO `mealList` (`meal_id`, `meal_name`, `cid`) VALUES
(1, '\nBanku,Okro stew and grilled tilapia', 1),
(5, 'Boiled Yam and Beans Stew', 1),
(6, 'Boiled Yam and Okro stew', 2),
(9, 'fried fish with egg', 3),
(3, 'Fried Plantain and beans stew', 1),
(7, 'Fried Plantain and Tomato Sauce', 1),
(2, 'Fried Rice and Beef Sauce', 2),
(8, 'Jollof and Grilled Tilapia', 2),
(4, 'Jollof Rice Chicken', 2);



INSERT INTO `vendors` (`vendor_id`, `vendor_name`, `vendor_password`, `cid`) VALUES
(1, 'eyram', '912ec803b2ce49e4a541068d495ab570', 1);



/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

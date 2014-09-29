create schema `canteen`;
use `canteen`;

--
-- Database: `canteen`
--


-- --------------------------------------------------------

--
-- Table structure for table `cafeteria`
--

CREATE TABLE IF NOT EXISTS `cafeteria` (
  `cafeteria_id` int PRIMARY KEY AUTO_INCREMENT,
  `cafeteria_name` varchar(50) UNIQUE
) COMMENT='This table contains a list of all the different cafeterias available on campus';

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE IF NOT EXISTS `vendors` (
  `vendor_id` int PRIMARY KEY AUTO_INCREMENT,
  `vendor_name` varchar(100),
  `vendor_password`	varchar(15),
  `cid` int,	
  FOREIGN KEY (`cid`) references `cafeteria` (`cafeteria_id`),
  UNIQUE (`vendor_name`,`cid`)
) COMMENT='This table lists all the different vendors under a particular cafeteria';

-- --------------------------------------------------------

--
-- Table structure for table `foodList`
--

CREATE TABLE IF NOT EXISTS `foodList` (
  `item_id` int PRIMARY KEY AUTO_INCREMENT,
  `item_name` varchar(30),
  `cid` int,
  FOREIGN KEY (`cid`) references `cafeteria` (`cafeteria_id`),
  UNIQUE (`item_name`,`cid`)
) COMMENT='This table provides a list of food items available at the local eateries';

-- --------------------------------------------------------

--
-- Table structure for table `mealList`
--

CREATE TABLE IF NOT EXISTS `mealList` (
  `meal_id` int PRIMARY KEY AUTO_INCREMENT,
  `meal_name` varchar(255),
  `cid` int,
  FOREIGN KEY (`cid`) references `cafeteria` (`cafeteria_id`),
  UNIQUE (`meal_name`,`cid`)	
) COMMENT='This table provides a collection of meals usually served at the eateries';

-- --------------------------------------------------------

--
-- Table structure for table `currentMeal`
--

CREATE TABLE IF NOT EXISTS `currentMeal` (
  `current_meal_id` int PRIMARY KEY,
  `current_meal_name` varchar(255),
  `customer_rating` int,
  `cid` int,
  FOREIGN KEY (`cid`) references `cafeteria` (`cafeteria_id`),
  FOREIGN KEY (`current_meal_id`) references `mealList` (`meal_id`),
  UNIQUE (`current_meal_name`,`cid`)
) COMMENT='This table shows the list of meals available at a given point in time';




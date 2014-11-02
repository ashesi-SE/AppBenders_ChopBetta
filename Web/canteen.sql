USE `canteen`;

--
-- Database: `canteen`
--

-- --------------------------------------------------------

--
-- Table structure for table `cafeteria`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `admin_id`       INT PRIMARY KEY AUTO_INCREMENT,
  `admin_name`     VARCHAR(50) UNIQUE,
  `admin_password` VARCHAR(255)
)
  COMMENT ='This table stores the credentials of the super admin';

-- --------------------------------------------------------

--
-- Table structure for table `cafeteria`
--

CREATE TABLE IF NOT EXISTS `cafeteria` (
  `cafeteria_id`   INT PRIMARY KEY AUTO_INCREMENT,
  `cafeteria_name` VARCHAR(50) UNIQUE
)
  COMMENT ='This table contains a list of all the different cafeterias available on campus';

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE IF NOT EXISTS `vendors` (
  `vendor_id`       INT PRIMARY KEY AUTO_INCREMENT,
  `vendor_name`     VARCHAR(100),
  `vendor_password` VARCHAR(255),
  `cid`             INT NOT NULL,
  FOREIGN KEY (`cid`) REFERENCES `cafeteria` (`cafeteria_id`),
  UNIQUE (`vendor_name`, `cid`)
)
  COMMENT ='This table lists all the different vendors under a particular cafeteria';

-- --------------------------------------------------------

--
-- Table structure for table `foodList`
--

CREATE TABLE IF NOT EXISTS `foodList` (
  `item_id`   INT PRIMARY KEY AUTO_INCREMENT,
  `item_name` VARCHAR(30),
  `cid`       INT NOT NULL,
  FOREIGN KEY (`cid`) REFERENCES `cafeteria` (`cafeteria_id`),
  UNIQUE (`item_name`, `cid`)
)
  COMMENT ='This table provides a list of food items available at the local eateries';

-- --------------------------------------------------------

--
-- Table structure for table `mealList`
--

CREATE TABLE IF NOT EXISTS `mealList` (
  `meal_id`   INT PRIMARY KEY AUTO_INCREMENT,
  `meal_name` VARCHAR(255),
  `cid`       INT NOT NULL,
  FOREIGN KEY (`cid`) REFERENCES `cafeteria` (`cafeteria_id`),
  UNIQUE (`meal_name`, `cid`)
)
  COMMENT ='This table provides a collection of meals usually served at the eateries';

-- --------------------------------------------------------

--
-- Table structure for table `currentMeal`
--

CREATE TABLE `currentmeal` (
  `current_meal_id` int(11) NOT NULL,
  `current_meal_name` varchar(255) DEFAULT NULL,
  `customer_rating` decimal(2,1) NOT NULL DEFAULT '0.0',
  `number_of_ratings` int(11) NOT NULL DEFAULT '0',
  `cid` int(11) NOT NULL,
  PRIMARY KEY (`current_meal_id`),
  UNIQUE KEY `current_meal_name` (`current_meal_name`,`cid`),
  KEY `cid` (`cid`),
  FOREIGN KEY (`cid`) REFERENCES `cafeteria` (`cafeteria_id`),
  FOREIGN KEY (`current_meal_id`) REFERENCES `meallist` (`meal_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='This table shows the list of meals available at a given point in time';

CREATE TABLE superAdmin (
  vendor_id       INT AUTO_INCREMENT PRIMARY KEY,
  vendor_name     VARCHAR(25),
  vendor_password TEXT,
  cid             INT
);

INSERT INTO superAdmin (vendor_name, vendor_password, cid) VALUES ('superAdmin', md5(12345), 0);


-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 05, 2019 at 10:31 PM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shades_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_brands`
--

DROP TABLE IF EXISTS `tbl_brands`;
CREATE TABLE IF NOT EXISTS `tbl_brands` (
  `brand_id` int(11) NOT NULL AUTO_INCREMENT,
  `brand_name` varchar(45) NOT NULL,
  PRIMARY KEY (`brand_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_brands`
--

INSERT INTO `tbl_brands` (`brand_id`, `brand_name`) VALUES
(1, 'Armani'),
(2, 'Rayban'),
(4, 'Carrera'),
(5, 'Oaklay'),
(6, 'Burberry'),
(7, 'Raph Lauren');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart`
--

DROP TABLE IF EXISTS `tbl_cart`;
CREATE TABLE IF NOT EXISTS `tbl_cart` (
  `cart_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `cart_date` varchar(45) DEFAULT NULL,
  `cart_time` varchar(45) DEFAULT NULL,
  `cart_qty` int(11) DEFAULT NULL,
  `cart_total` decimal(10,0) DEFAULT NULL,
  PRIMARY KEY (`cart_id`),
  UNIQUE KEY `user_id_UNIQUE` (`user_id`),
  KEY `fk_tbl_cart_tbl_user1_idx` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_cart`
--

INSERT INTO `tbl_cart` (`cart_id`, `user_id`, `cart_date`, `cart_time`, `cart_qty`, `cart_total`) VALUES
(10, 8, '2018-09-02', '05:30:30', NULL, NULL),
(11, 9, '2018-09-02', '06:31:57', NULL, NULL),
(15, 13, '2018-09-13', '14:43:47', NULL, NULL),
(16, 14, '2019-09-05', '18:14:23', NULL, NULL),
(17, 15, '2019-09-05', '19:33:39', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart_item`
--

DROP TABLE IF EXISTS `tbl_cart_item`;
CREATE TABLE IF NOT EXISTS `tbl_cart_item` (
  `cart_item_id` int(11) NOT NULL AUTO_INCREMENT,
  `cart_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `cart_item_quantity` int(11) DEFAULT NULL,
  `cart_item_price` decimal(10,0) DEFAULT NULL,
  PRIMARY KEY (`cart_item_id`),
  KEY `fk_tbl_cart_item_tbl_cart1_idx` (`cart_id`),
  KEY `fk_tbl_cart_item_tbl_product1_idx` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=130 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_cart_item`
--

INSERT INTO `tbl_cart_item` (`cart_item_id`, `cart_id`, `product_id`, `cart_item_quantity`, `cart_item_price`) VALUES
(100, 11, 3, 3, '192'),
(105, 15, 2, 4, '128'),
(106, 15, 6, 2, '90'),
(123, 10, 1, 10, '6'),
(124, 10, 5, 5, '78'),
(125, 10, 8, 4, '50'),
(126, 10, 9, 4, '50'),
(127, 10, 10, 3, '34'),
(128, 10, 1, 1, '6'),
(129, 10, 1, 1, '6');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

DROP TABLE IF EXISTS `tbl_product`;
CREATE TABLE IF NOT EXISTS `tbl_product` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(100) DEFAULT NULL,
  `product_number` varchar(45) DEFAULT NULL,
  `brand_id` int(11) NOT NULL,
  `product_price` int(11) DEFAULT NULL,
  `product_qty` int(11) DEFAULT NULL,
  `product_image` varchar(100) DEFAULT 'default.jpg',
  PRIMARY KEY (`product_id`),
  KEY `fk_product_tbl_brands_idx` (`brand_id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`product_id`, `product_name`, `product_number`, `brand_id`, `product_price`, `product_qty`, `product_image`) VALUES
(1, 'Armani Emporio', 'EA4004', 1, 6, 100, 'img/sunglass/armani/1.jpg'),
(2, 'Armani Emporio', 'EA4012', 1, 32, 100, 'img/sunglass/armani/2.jpg'),
(3, 'Armani Emporio', 'EA4025', 1, 64, 100, 'img/sunglass/armani/3.jpg'),
(4, 'Armani Emporio', 'EA4029', 1, 50, 100, 'img/sunglass/armani/4.jpg'),
(5, 'Armani Emporio', 'EA4033', 1, 78, 100, 'img/sunglass/armani/5.jpg'),
(6, 'Armani Emporio', 'EA4034', 1, 45, 100, 'img/sunglass/armani/6.jpg'),
(8, 'Raph Lauren', 'RL8066526013', 7, 50, 100, 'img/sunglass/ralph_lauren/1.jpg'),
(9, 'Rayban Justin', 'RB4165', 2, 50, 100, 'img/sunglass/rayban/1.jpg'),
(10, 'Rayban New Wayfarer Classic ', 'RB2132901', 2, 34, 100, 'img/sunglass/rayban/2.jpg'),
(11, 'Rayban', 'RB4312CH601SA1', 2, 50, 100, 'img/sunglass/rayban/3.jpg'),
(12, 'Rayban', 'RB8353635282', 2, 34, 100, 'img/sunglass/rayban/4.jpg'),
(13, 'Rayban Round ', 'RB24471247P2', 2, 23, 100, 'img/sunglass/rayban/5.jpg'),
(14, 'Rayban The Colonel', 'RB356000258 ', 2, 50, 100, 'img/sunglass/rayban/6.jpg'),
(15, 'Ralph Lauren', 'RL8070501073', 0, 3, 100, 'img/sunglass/ralph_lauren/2.jpg'),
(16, 'Ralph Lauren', 'RL8087500313A', 7, 66, 100, 'img/sunglass/ralph_lauren/3.jpg'),
(17, 'Ralph Lauren', 'RL60565001', 7, 50, 100, 'img/sunglass/ralph_lauren/4.jpg'),
(18, 'Ralph Lauren', 'RL60625003', 7, 35, 100, 'img/sunglass/ralph_lauren/5.jpg'),
(19, 'Ralph Lauren', 'RL808750018GB', 7, 50, 100, 'img/sunglass/ralph_lauren/6.jpg'),
(20, 'Carrera', '143S', 4, 23, 100, 'img/sunglass/carrera/1.jpg'),
(21, 'Carrera', '150S', 4, 50, 100, 'img/sunglass/carrera/2.jpg'),
(22, 'Carrera', '165S', 4, 4, 100, 'img/sunglass/carrera/3.jpg'),
(23, 'Carrera', '1012S', 4, 50, 100, 'img/sunglass/carrera/4.jpg'),
(24, 'Carrera', '5042S', 4, 6, 100, 'img/sunglass/carrera/5.jpg'),
(25, 'Carrera', '253DF', 4, 50, 100, 'img/sunglass/carrera/6.jpg'),
(26, 'Burberry', 'BE3043', 6, 45, 100, 'img/sunglass/burberry/1.jpg'),
(27, 'beep', 'BE3080', 6, 36, 100, 'img/sunglass/burberry/2.jpg'),
(28, 'Burberry', 'BE3090Q58', 6, 65, 100, 'img/sunglass/burberry/3.jpg'),
(29, 'Burberry', 'BE3092QF60', 6, 24, 100, 'img/sunglass/burberry/4.jpg'),
(30, 'Burberry', 'BE4216', 6, 98, 100, 'img/sunglass/burberry/5.jpg'),
(31, 'Burberry', 'BE426253', 6, 34, 100, 'img/sunglass/burberry/6.jpg'),
(42, 'Oakley Flight Jacket Prizm Trail', 'OK3324', 5, 56, 100, 'img/sunglass/oakley/1.png'),
(43, 'Oakley Jawbreaker Photocromatic Sunglasses', 'OK6322', 5, 35, 100, 'img/sunglass/oakley/2.png'),
(44, 'Oakley Jawbreaker Photocromatic Sunglasses', 'OK5321', 5, 77, 100, 'img/sunglass/oakley/3.png'),
(45, 'Oakley Jawbreaker Prizm Ruby', 'OK3414', 5, 55, 100, 'img/sunglass/oakley/4.png'),
(46, 'Oakley Jawbreaker Replacement Lens Clear', 'OK5435', 5, 44, 100, 'img/sunglass/oakley/5.png'),
(47, 'Oakley Jawbreaker Replacement Photochromic Lens', 'OK5544', 5, 33, 100, 'img/sunglass/oakley/6.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_profile`
--

DROP TABLE IF EXISTS `tbl_profile`;
CREATE TABLE IF NOT EXISTS `tbl_profile` (
  `user_id` int(11) NOT NULL,
  `profile_first_name` varchar(45) DEFAULT NULL,
  `profile_last_name` varchar(45) DEFAULT NULL,
  `profile_address` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  KEY `fk_tbl_details_user1_idx` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_profile`
--

INSERT INTO `tbl_profile` (`user_id`, `profile_first_name`, `profile_last_name`, `profile_address`) VALUES
(8, 'Mohamed', 'Aiman', 'Saranankara Roads'),
(9, 'Aishath', 'Azza', 'Maldives'),
(13, 'Ahmed', 'Fauzaan', 'Maldives'),
(14, 'haaheee', 'hooo', 'heee'),
(15, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_shipping`
--

DROP TABLE IF EXISTS `tbl_shipping`;
CREATE TABLE IF NOT EXISTS `tbl_shipping` (
  `shipping_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `shipping_place` varchar(45) DEFAULT NULL,
  `shipping_street` varchar(45) DEFAULT NULL,
  `shipping_city` varchar(45) DEFAULT NULL,
  `shipping_country` varchar(45) DEFAULT NULL,
  `shipping_zip` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`shipping_id`),
  KEY `fk_tbl_shipping2_tbl_user1_idx` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_shipping`
--

INSERT INTO `tbl_shipping` (`shipping_id`, `user_id`, `shipping_place`, `shipping_street`, `shipping_city`, `shipping_country`, `shipping_zip`) VALUES
(1, 8, '230T', 'Saranankara Road', 'Wellawata', 'Sri Lanka', '4324'),
(2, 9, '34-D', 'saranankara road', 'colombo', 'Srilanka', '3435'),
(3, 13, '45-f', 'havoc street', 'Noegogoda', 'Srilanka', '3252'),
(4, 14, NULL, NULL, NULL, NULL, NULL),
(5, 15, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

DROP TABLE IF EXISTS `tbl_user`;
CREATE TABLE IF NOT EXISTS `tbl_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(45) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_password` varchar(32) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_email_UNIQUE` (`user_email`),
  UNIQUE KEY `user_name_UNIQUE` (`user_name`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `user_name`, `user_email`, `user_password`) VALUES
(8, 'aiman1717a', 'aiman1717a@gmail.com', '123'),
(9, 'azza', 'zoogo787@hotmail.com', '123'),
(13, 'Fauzaan', 'fauzaan@gmail.com', '123'),
(14, 'test', 'test@gmail.com', '123'),
(15, 'test2', 'test2@gmail.com', '123');

--
-- Triggers `tbl_user`
--
DROP TRIGGER IF EXISTS `Creation`;
DELIMITER $$
CREATE TRIGGER `Creation` AFTER INSERT ON `tbl_user` FOR EACH ROW BEGIN
    INSERT INTO tbl_profile(user_id) VALUES (NEW.user_id);
    INSERT INTO tbl_shipping(user_id) VALUES (NEW.user_id);
    INSERT INTO tbl_cart(user_id, cart_date, cart_time) VALUES (NEW.user_id, CURDATE(), CURTIME());
END
$$
DELIMITER ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD CONSTRAINT `fk_tbl_cart_tbl_user1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_cart_item`
--
ALTER TABLE `tbl_cart_item`
  ADD CONSTRAINT `fk_tbl_cart_item_tbl_cart1` FOREIGN KEY (`cart_id`) REFERENCES `tbl_cart` (`cart_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_cart_item_tbl_product1` FOREIGN KEY (`product_id`) REFERENCES `tbl_product` (`product_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD CONSTRAINT `fk_product_tbl_brands` FOREIGN KEY (`brand_id`) REFERENCES `tbl_brands` (`brand_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_profile`
--
ALTER TABLE `tbl_profile`
  ADD CONSTRAINT `fk_tbl_details_user1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_shipping`
--
ALTER TABLE `tbl_shipping`
  ADD CONSTRAINT `fk_tbl_shipping2_tbl_user1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 27, 2012 at 03:06 AM
-- Server version: 5.5.24-log
-- PHP Version: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `commerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `prj_cart_item`
--

CREATE TABLE IF NOT EXISTS `prj_cart_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

--
-- Table structure for table `prj_product`
--

CREATE TABLE IF NOT EXISTS `prj_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `description` varchar(500) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(100) NOT NULL,
  `dimensions` varchar(30) NOT NULL,
  `discount` decimal(10,2) NOT NULL,
  `inprint` varchar(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `prj_product`
--

INSERT INTO `prj_product` (`id`, `title`, `description`, `price`, `image`, `dimensions`, `discount`, `inprint`) VALUES
(1, 'Test 1', 'Test Description', '100.12', '0001', '12 x 14 in.', '0.10', 'true'),
(3, 'Test 2', 'Test 2 Description', '50.00', '0002', '14 x 12 in.', '0.00', 'true'),
(4, 'Test 3', 'Test 3 Description', '100.00', '0003', '12 x 14 in.', '0.00', 'true'),
(5, 'Test 4', 'Test 4 Description', '100.00', '0004', '12 x 14 in.', '0.00', 'true'),
(6, 'Test 5', 'Test 5 Description', '1000.00', '0005', '12 x 14 in.', '0.50', 'false');

-- --------------------------------------------------------

--
-- Table structure for table `prj_user`
--

CREATE TABLE IF NOT EXISTS `prj_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `newsletter` varchar(5) NOT NULL,
  `referral` varchar(30) NOT NULL,
  `account_type` varchar(10) NOT NULL,
  `address` varchar(100) NOT NULL,
  `city` varchar(30) NOT NULL,
  `state` varchar(30) NOT NULL,
  `zip` int(10) NOT NULL,
  `phone` varchar(16) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `prj_user`
--

INSERT INTO `prj_user` (`id`, `username`, `firstname`, `lastname`, `password`, `email`, `newsletter`, `referral`, `account_type`, `address`, `city`, `state`, `zip`, `phone`) VALUES
(3, 'test', 'John', 'Smith', '5d9c65a31bda1b876f12e5621b111f83', 'test@test.com', 'no', 'Advertisement', 'user', '', '', '', 0, '');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `prj_cart_item`
--
ALTER TABLE `prj_cart_item`
  ADD CONSTRAINT `prj_cart_item_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `prj_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `prj_cart_item_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `prj_product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

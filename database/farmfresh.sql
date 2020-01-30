-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 30, 2020 at 01:42 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `farmfresh`
--
CREATE DATABASE IF NOT EXISTS `farmfresh` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `farmfresh`;

-- --------------------------------------------------------

--
-- Table structure for table `administrator`
--

DROP TABLE IF EXISTS `administrator`;
CREATE TABLE IF NOT EXISTS `administrator` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `phone` text DEFAULT NULL,
  `name` text DEFAULT NULL,
  `password` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `administrator`
--

INSERT INTO `administrator` (`id`, `phone`, `name`, `password`) VALUES
(1, '+91123456789', 'Administrator', 'admin'),
(2, '+918369612860', 'Karthik Pillai', '123');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
CREATE TABLE IF NOT EXISTS `customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `phone` text DEFAULT NULL,
  `name` text DEFAULT NULL,
  `password` text DEFAULT NULL,
  `location` text DEFAULT NULL,
  `gender` text DEFAULT NULL,
  `verified` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `phone`, `name`, `password`, `location`, `gender`, `verified`) VALUES
(12, '+919574926587', 'Satyam Yadav', '123', 'Unavailable', 'Male', 0),
(13, '+919865285684', 'Mohit Saini', '123', 'Unavailable', 'Male', 0),
(14, '+917836448567', 'Siddhant Mohite', '123', 'Unavailable', 'Male', 0),
(15, '+917845578474', 'Drushti Parab', '123', 'Unavailable', 'Male', 0),
(16, '+916548637687', 'Shubham Pal', '123', 'Unavailable', 'Male', 0),
(17, '+919736584657', 'Naveen Polishetty', '123', 'Unavailable', 'Male', 0),
(18, '+917657483564', 'Karan Johar', '123', 'Unavailable', 'Male', 0),
(19, '+91123456789', 'Karthik Pillai', '123', 'Unavailable', 'Male', 0);

-- --------------------------------------------------------

--
-- Table structure for table `farmers`
--

DROP TABLE IF EXISTS `farmers`;
CREATE TABLE IF NOT EXISTS `farmers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `phone` text NOT NULL,
  `password` text NOT NULL,
  `name` text DEFAULT NULL,
  `location` text DEFAULT NULL,
  `verified` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `farmers`
--

INSERT INTO `farmers` (`id`, `phone`, `password`, `name`, `location`, `verified`) VALUES
(55, '+919029192655', '98169', 'Karthik Pillai ', 'Unavailable', 0),
(58, '+918369612860', '93111', 'Dharini Saravanan ', 'Unavailable', 0),
(59, '+919969850698', '25301', 'Saravanan ', 'Unavailable', 0),
(62, '+919372949986', '68194', 'Mohnish Singh ', 'Unavailable', 0),
(66, '+918104140845', '38166', 'Karan Sinha ', 'Unavailable', 0),
(67, '+918234234456', '26127', 'Meenamma ', 'Unavailable', 0),
(68, '+918234234234', '61276', 'Sharukh Khan ', 'Unavailable', 0),
(72, '+919599587014', '45728', 'Parth ', '', 0),
(75, '+917045662119', '66419', 'Vijayadharini ', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `farmerid` int(11) NOT NULL,
  `productname` text NOT NULL,
  `quantityinkg` text NOT NULL,
  `priceperkg` text NOT NULL,
  `grade` text DEFAULT NULL,
  `verified` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `farmerid`, `productname`, `quantityinkg`, `priceperkg`, `grade`, `verified`) VALUES
(35, 55, 'Onion', '35', '300', 'A', 1),
(36, 58, 'Cabbage', '2', '30', NULL, 0),
(37, 55, 'Apple', '12', '180', NULL, 0),
(38, 58, 'Rice', '23', '56', NULL, 0),
(39, 55, 'Carrot', '8', '24', 'D', 1),
(40, 62, 'Orange', '14', '80', NULL, 0),
(41, 66, 'Tomato', '18', '24', NULL, 0),
(42, 66, 'Wheat', '8', '42', NULL, 0),
(43, 67, 'Corn', '18', '30', NULL, 0),
(44, 67, 'Ladyfinger', '5', '37', 'B', 1),
(46, 68, 'Broccoli', '5', '23', 'C', 1),
(56, 75, 'Apple', '5', '180', 'A', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

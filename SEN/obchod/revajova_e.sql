-- CREATE DATABASE `revajova.e`;
USE `revajova.e`;

-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 18, 2022 at 06:11 PM
-- Server version: 8.0.27-0ubuntu0.20.04.1
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `revajova.e`
--

-- --------------------------------------------------------

--
-- Table structure for table `middle_man`
--

CREATE TABLE `middle_man` (
  `mid_id` int NOT NULL AUTO_INCREMENT,
  `pro_id` int NOT NULL,
  `ord_id` int NOT NULL,
  `amount` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `middle_man`
--

INSERT INTO `middle_man` (`mid_id`, `pro_id`, `ord_id`, `amount`) VALUES
(1, 1, 1, 45);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `ord_id` int NOT NULL,
  `use_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`ord_id`, `use_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `pro_id` int NOT NULL,
  `pro_name` text NOT NULL,
  `pro_price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`pro_id`, `pro_name`, `pro_price`) VALUES
(1, 'ice cream sandwich', 2.99);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `use_id` int NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`use_id`, `username`, `password`) VALUES
(1, 'alfred', '12345');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `middle_man`
--
ALTER TABLE `middle_man`
  ADD PRIMARY KEY (`mid_id`),
  ADD KEY `FK_mid_ord` (`ord_id`),
  ADD KEY `FK_mid_pro` (`pro_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`ord_id`),
  ADD KEY `FK_ord_use` (`use_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`pro_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`use_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `middle_man`
--
ALTER TABLE `middle_man`
  ADD CONSTRAINT `FK_mid_ord` FOREIGN KEY (`ord_id`) REFERENCES `orders` (`ord_id`),
  ADD CONSTRAINT `FK_mid_pro` FOREIGN KEY (`pro_id`) REFERENCES `products` (`pro_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `FK_ord_use` FOREIGN KEY (`use_id`) REFERENCES `users` (`use_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

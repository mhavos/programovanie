-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 03, 2021 at 03:01 PM
-- Server version: 8.0.27-0ubuntu0.20.04.1
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `haverlik.m`
--

-- --------------------------------------------------------

--
-- Table structure for table `preukazy`
--

CREATE TABLE `preukazy` (
  `COP` int NOT NULL,
  `RC` int NOT NULL,
  `UID` int NOT NULL,
  `Datum_vydania` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Platnost` date NOT NULL DEFAULT '2030-08-08'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `preukazy`
--

INSERT INTO `preukazy` (`COP`, `RC`, `UID`, `Datum_vydania`, `Platnost`) VALUES
(1022, 333444, 1000, '2021-11-03 13:56:24', '2030-08-08'),
(1123, 343654, 1001, '2021-11-03 13:57:00', '2030-08-08');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UID` int NOT NULL,
  `Name` varchar(300) NOT NULL DEFAULT 'Jožko Mrkvička',
  `Password` varchar(200) NOT NULL,
  `Email` varchar(200) NOT NULL,
  `Privilege` tinyint UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UID`, `Name`, `Password`, `Email`, `Privilege`) VALUES
(1000, 'Janko Hraško', 'hrasko', 'hrasko@gjh.sk', 1),
(1001, 'Jožko Mrkvička', '1234', 'mrkvicka@gjh.sk', 2),
(1002, 'Geralt', 'ciri', 'geralt@rivia.sk', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `preukazy`
--
ALTER TABLE `preukazy`
  ADD PRIMARY KEY (`COP`),
  ADD UNIQUE KEY `RC` (`RC`),
  ADD UNIQUE KEY `UID` (`UID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UID`),
  ADD UNIQUE KEY `email` (`Email`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `preukazy`
--
ALTER TABLE `preukazy`
  ADD CONSTRAINT `UserOP` FOREIGN KEY (`UID`) REFERENCES `users` (`UID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

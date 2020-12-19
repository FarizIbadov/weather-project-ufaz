-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: Dec 19, 2020 at 09:08 AM
-- Server version: 8.0.22
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test_tb`
--

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `cityId` int NOT NULL,
  `city` varchar(50) NOT NULL,
  `isValid` tinyint NOT NULL DEFAULT '1'
) ENGINE=InnoDB;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`cityId`, `city`, `isValid`) VALUES
(1, 'Baku', 1),
(2, 'Moscow', 1),
(3, 'Vashington', 1),
(4, 'Paris', 1);

-- --------------------------------------------------------

--
-- Table structure for table `overall`
--

CREATE TABLE `overall` (
  `overallId` int NOT NULL,
  `overall` varchar(50) NOT NULL,
  `isValid` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB;

--
-- Dumping data for table `overall`
--

INSERT INTO `overall` (`overallId`, `overall`, `isValid`) VALUES
(1, 'Sunny', 1),
(2, 'Partial Clouds', 1),
(3, 'Cloudy', 1),
(4, 'Rainy', 1);

-- --------------------------------------------------------

--
-- Table structure for table `weather`
--

CREATE TABLE `weather` (
  `weather_id` int NOT NULL,
  `temperature` int NOT NULL,
  `wind_speed` int NOT NULL,
  `pressure` float NOT NULL,
  `humidity` int NOT NULL,
  `visibility` float NOT NULL,
  `dates` date NOT NULL,
  `cityId` int NOT NULL,
  `overallId` int NOT NULL,
  `isValid` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB;

--
-- Dumping data for table `weather`
--

INSERT INTO `weather` (`weather_id`, `temperature`, `wind_speed`, `pressure`, `humidity`, `visibility`, `dates`, `cityId`, `overallId`, `isValid`) VALUES
(16, 12, 15, 1.45, 15, 1.2, '2020-12-13', 1, 1, 1),
(17, 12, 15, 1.2, 80, 10, '2020-12-15', 1, 2, 1),
(18, 10, 15, 1.2, 15, 1.2, '2020-12-10', 2, 2, 1),
(19, 20, 15, 1.2, 15, 1.2, '2020-12-11', 3, 2, 1),
(21, 12, 15, 1.2, 15, 1.2, '2020-12-11', 2, 2, 1),
(22, 12, 15, 1.2, 15, 1.2, '2020-12-10', 3, 2, 1),
(24, 12, 15, 1.2, 15, 1.2, '2020-12-10', 1, 2, 1),
(25, 5, 15, 1.2, 15, 15, '2020-12-12', 1, 4, 1),
(26, 7, 15, 1.2, 15, 1.2, '2020-12-12', 2, 2, 1),
(27, 20, 15, 1.2, 15, 1.2, '2020-12-18', 1, 2, 1),
(28, 10, 15, 1.2, 15, 1.2, '2020-12-16', 1, 2, 1),
(29, 15, 15, 1.2, 15, 20, '2020-12-14', 1, 4, 1),
(30, 14, 10, 766, 80, 10, '2020-12-17', 1, 1, 1),
(31, 10, 12, 12, 60, 23, '2020-12-15', 4, 2, 1),
(32, 12, 12, 12, 12, 12, '2020-12-19', 1, 2, 1),
(33, 12, 12, 21, 12, 12, '2020-12-20', 1, 1, 1),
(34, 12, 12, 12, 12, 12, '2020-12-21', 1, 1, 1),
(35, 12, 12, 12, 12, 12, '2020-12-25', 1, 1, 1),
(36, 21, 21, 21, 12, 12, '2020-12-26', 1, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`cityId`);

--
-- Indexes for table `overall`
--
ALTER TABLE `overall`
  ADD PRIMARY KEY (`overallId`);

--
-- Indexes for table `weather`
--
ALTER TABLE `weather`
  ADD PRIMARY KEY (`weather_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `cityId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `overall`
--
ALTER TABLE `overall`
  MODIFY `overallId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `weather`
--
ALTER TABLE `weather`
  MODIFY `weather_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 05, 2024 at 01:46 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_garden`
--

-- --------------------------------------------------------

--
-- Table structure for table `pl_bag_cost`
--

CREATE TABLE `pl_bag_cost` (
  `bag_id` int(11) NOT NULL,
  `bag_cost` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pl_bag_cost`
--

INSERT INTO `pl_bag_cost` (`bag_id`, `bag_cost`) VALUES
(1, 72);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_basket`
--

CREATE TABLE `tbl_basket` (
  `basket_id` int(11) NOT NULL,
  `total` int(11) DEFAULT NULL,
  `cost` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_basket`
--

INSERT INTO `tbl_basket` (`basket_id`, `total`, `cost`) VALUES
(17, 32, 2304.00);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_calculations`
--

CREATE TABLE `tbl_calculations` (
  `calculation_id` int(11) NOT NULL,
  `area_units` varchar(5) DEFAULT NULL,
  `depth_units` varchar(5) DEFAULT NULL,
  `area` decimal(10,2) DEFAULT NULL,
  `depth` decimal(10,2) DEFAULT NULL,
  `total_area` decimal(10,2) DEFAULT NULL,
  `total_bags` int(11) DEFAULT NULL,
  `total_cost` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_calculations`
--

INSERT INTO `tbl_calculations` (`calculation_id`, `area_units`, `depth_units`, `area`, `depth`, `total_area`, `total_bags`, `total_cost`) VALUES
(26, 'ft', 'in', 110.00, 0.67, 22.46, 32, 2304.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pl_bag_cost`
--
ALTER TABLE `pl_bag_cost`
  ADD PRIMARY KEY (`bag_id`);

--
-- Indexes for table `tbl_basket`
--
ALTER TABLE `tbl_basket`
  ADD PRIMARY KEY (`basket_id`);

--
-- Indexes for table `tbl_calculations`
--
ALTER TABLE `tbl_calculations`
  ADD PRIMARY KEY (`calculation_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pl_bag_cost`
--
ALTER TABLE `pl_bag_cost`
  MODIFY `bag_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_basket`
--
ALTER TABLE `tbl_basket`
  MODIFY `basket_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tbl_calculations`
--
ALTER TABLE `tbl_calculations`
  MODIFY `calculation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

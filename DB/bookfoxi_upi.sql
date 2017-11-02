-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 02, 2017 at 12:53 PM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `upi`
--

-- --------------------------------------------------------

--
-- Table structure for table `business_admin`
--

CREATE TABLE `business_admin` (
  `id` int(10) NOT NULL,
  `admin_name` text NOT NULL,
  `phone_no` bigint(12) NOT NULL,
  `admin_email` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `items_all`
--

CREATE TABLE `items_all` (
  `id` int(5) NOT NULL,
  `name` text NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `machines`
--

CREATE TABLE `machines` (
  `address` text NOT NULL,
  `local_admin_name` text NOT NULL,
  `local_admin_phone` int(11) NOT NULL,
  `upi_vpa` text NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `wifi_id` text NOT NULL,
  `wifi_pass` text NOT NULL,
  `location` text,
  `area_city` text,
  `city` text,
  `pincode` int(7) DEFAULT NULL,
  `tot_units` int(5) NOT NULL,
  `left_units` int(5) NOT NULL,
  `id` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `machines`
--

INSERT INTO `machines` (`address`, `local_admin_name`, `local_admin_phone`, `upi_vpa`, `latitude`, `longitude`, `wifi_id`, `wifi_pass`, `location`, `area_city`, `city`, `pincode`, `tot_units`, `left_units`, `id`) VALUES
('sfwf', 'Anirudh', 33, 'ad', 3, 3, 'r3', '3r33', 'r3', 'wr', 'wdw', 11, 11, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `machine_items`
--

CREATE TABLE `machine_items` (
  `id` int(11) NOT NULL,
  `pos` varchar(255) NOT NULL,
  `mc_id` varchar(8) NOT NULL,
  `name` text NOT NULL,
  `price` int(11) NOT NULL,
  `tot_units` int(2) NOT NULL,
  `left_units` int(2) NOT NULL,
  `row_tag` varchar(255) NOT NULL,
  `row_total_columns` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `machine_items`
--

INSERT INTO `machine_items` (`id`, `pos`, `mc_id`, `name`, `price`, `tot_units`, `left_units`, `row_tag`, `row_total_columns`) VALUES
(1, 'A1', '112', 'Lays-Blue', 20, 8, 3, 'A1', 5);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` varchar(12) NOT NULL,
  `mc_id` varchar(8) NOT NULL,
  `price` int(5) NOT NULL,
  `items` int(3) NOT NULL,
  `trupay_txn_id` varchar(255) NOT NULL,
  `bank_txn_id` text NOT NULL,
  `user_vpa` text NOT NULL,
  `user_name` text NOT NULL,
  `user_phone` int(14) NOT NULL,
  `t_msg` text NOT NULL,
  `reciever_vpa` text NOT NULL,
  `details` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `mc_id`, `price`, `items`, `trupay_txn_id`, `bank_txn_id`, `user_vpa`, `user_name`, `user_phone`, `t_msg`, `reciever_vpa`, `details`) VALUES
('1', '112', 100, 1, 'haskudh', 'hdsahdkash', 'njksdnfjds', 'abcd', 88888, 'dsalkdhild', 'dkjfklsdnfl', 'njlbndsflnsdf');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(255) NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `name` text NOT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `quantity` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `name`, `price`, `quantity`) VALUES
(1, '1', 'snf', '122.22', 11);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `business_admin`
--
ALTER TABLE `business_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items_all`
--
ALTER TABLE `items_all`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `machines`
--
ALTER TABLE `machines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `machine_items`
--
ALTER TABLE `machine_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `business_admin`
--
ALTER TABLE `business_admin`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `items_all`
--
ALTER TABLE `items_all`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `machines`
--
ALTER TABLE `machines`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `machine_items`
--
ALTER TABLE `machine_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

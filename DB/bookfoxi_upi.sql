-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 31, 2017 at 09:52 PM
-- Server version: 10.0.31-MariaDB-cll-lve
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookfoxi_upi`
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
  `id` varchar(8) NOT NULL,
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
  `pincode` int(7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

-- --------------------------------------------------------

--
-- Table structure for table `machine_orders`
--

CREATE TABLE `machine_orders` (
  `t_id` varchar(12) NOT NULL,
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

-- --------------------------------------------------------

--
-- Table structure for table `machine_order_items`
--

CREATE TABLE `machine_order_items` (
  `id` int(255) NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `name` text NOT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `quantity` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
-- Indexes for table `machine_orders`
--
ALTER TABLE `machine_orders`
  ADD PRIMARY KEY (`t_id`);

--
-- Indexes for table `machine_order_items`
--
ALTER TABLE `machine_order_items`
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
-- AUTO_INCREMENT for table `machine_items`
--
ALTER TABLE `machine_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `machine_order_items`
--
ALTER TABLE `machine_order_items`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

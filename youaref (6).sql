-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 13, 2017 at 11:06 AM
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
-- Database: `youaref`
--

-- --------------------------------------------------------

--
-- Table structure for table `bank_details`
--

CREATE TABLE `bank_details` (
  `bank_id` int(10) NOT NULL,
  `user_id` int(10) DEFAULT NULL,
  `holder_name` varchar(50) DEFAULT NULL,
  `bank_name` varchar(20) DEFAULT NULL,
  `ifsc` varchar(20) DEFAULT NULL,
  `account_number` varchar(20) DEFAULT NULL,
  `pan_number` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bank_details`
--

INSERT INTO `bank_details` (`bank_id`, `user_id`, `holder_name`, `bank_name`, `ifsc`, `account_number`, `pan_number`) VALUES
(39, 72, 'fhji', 'ghjj', 'gjjj', 'ghh', 'ghj');

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `company_id` int(10) NOT NULL,
  `logo` text NOT NULL,
  `about` text NOT NULL,
  `rating` decimal(10,0) NOT NULL,
  `type` varchar(25) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` int(12) NOT NULL,
  `enrolled` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `password` varchar(20) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`company_id`, `logo`, `about`, `rating`, `type`, `name`, `email`, `phone`, `enrolled`, `timestamp`, `password`, `status`) VALUES
(1, 'http://media.corporate-ir.net/media_files/IROL/17/176060/img/logos/amazon_logo_RGB.jpg', 'It is a giant whole seller', '2', 'Retail', 'Amazon', 'anierdb@gmail.com', 2147483647, 23, '2017-10-12 23:54:59', '', 0),
(2, 'http://media.corporate-ir.net/media_files/IROL/17/176060/img/logos/amazon_logo_RGB.jpg', 'Online retailer', '2', 'Retail', 'Flipkart', 'flipkart@gmail.com', 978119335, 12, '2017-10-13 05:14:18', '22', 1),
(3, 'http://media.corporate-ir.net/media_files/IROL/17/176060/img/logos/amazon_logo_RGB.jpg', 'It is automobile company', '5', 'Automobile', 'Tesla', 'tesla.com', 4232, 11, '2017-10-12 22:56:27', '', 1),
(4, 'http://media.corporate-ir.net/media_files/IROL/17/176060/img/logos/amazon_logo_RGB.jpg', 'space oriented company', '3', 'Space', 'Spacex', 'spacex', 333, 3, '2017-10-12 23:00:30', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `companynotifications`
--

CREATE TABLE `companynotifications` (
  `cn_id` int(10) NOT NULL,
  `cn_notification` text NOT NULL,
  `company_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `company_rating`
--

CREATE TABLE `company_rating` (
  `rating_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `company_id` int(10) NOT NULL,
  `rating` decimal(10,0) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `discussion_answers`
--

CREATE TABLE `discussion_answers` (
  `answer_id` int(10) NOT NULL,
  `question_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `answer` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `discussion_answers`
--

INSERT INTO `discussion_answers` (`answer_id`, `question_id`, `user_id`, `timestamp`, `answer`) VALUES
(27, 15, 2, '2017-10-09 14:47:51', 'Through Tez'),
(28, 15, 2, '2017-10-09 14:47:51', 'Through Tez'),
(29, 15, 1, '2017-10-09 14:47:51', 'Through Tez'),
(30, 15, 1, '2017-10-09 14:47:51', 'Through Tez'),
(32, 22, 75, '2017-10-12 22:35:33', 'adadcsc');

-- --------------------------------------------------------

--
-- Table structure for table `discussion_questions`
--

CREATE TABLE `discussion_questions` (
  `question_id` int(10) NOT NULL,
  `plan_id` int(10) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `question` text NOT NULL,
  `user_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `discussion_questions`
--

INSERT INTO `discussion_questions` (`question_id`, `plan_id`, `timestamp`, `question`, `user_id`) VALUES
(15, 2, '2017-10-12 17:03:11', 'How will I get my money?', 2),
(16, 2, '2017-10-12 17:03:14', 'How will I get my money?', 2),
(17, 2, '2017-10-12 17:03:16', 'dada', 2),
(18, 2, '2017-10-12 17:03:16', 'dada', 2),
(19, 2, '2017-10-12 17:03:16', 'dada', 1),
(22, 1, '2017-10-12 22:35:06', 'adad', 75);

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `like_id` int(10) NOT NULL,
  `plan_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `my_plans`
--

CREATE TABLE `my_plans` (
  `plan_reg_id` int(10) NOT NULL,
  `plan_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `status` varchar(20) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `amount` int(10) DEFAULT NULL,
  `company_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `my_plans`
--

INSERT INTO `my_plans` (`plan_reg_id`, `plan_id`, `user_id`, `status`, `timestamp`, `amount`, `company_id`) VALUES
(1, 4, 2, 'Waiting', '2017-10-11 19:13:39', NULL, 0),
(11, 2, 37, 'accepted', '2017-10-12 11:06:19', NULL, 2),
(12, 3, 37, 'accepted', '2017-10-12 11:06:26', NULL, 1),
(15, 1, 37, 'accepted', '2017-10-12 22:41:47', 0, 1),
(19, 1, 56, 'Waiting', '2017-10-12 20:56:40', 0, 1),
(20, 3, 56, 'Waiting', '2017-10-12 20:56:45', 0, 1),
(23, 1, 75, 'accepted', '2017-10-13 07:23:00', 500, 1),
(24, 3, 75, 'Waiting', '2017-10-12 22:34:10', 0, 1),
(31, 1, 57, 'accepted', '2017-10-13 08:28:22', 500, 1),
(32, 3, 57, 'waiting', '2017-10-13 08:28:22', 500, 1);

-- --------------------------------------------------------

--
-- Table structure for table `plans`
--

CREATE TABLE `plans` (
  `plan_id` int(10) NOT NULL,
  `company_id` int(10) NOT NULL,
  `conversion` text NOT NULL,
  `earn_per_conversion` text NOT NULL,
  `price_of_product` int(6) NOT NULL,
  `difficulty` varchar(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `training_kit` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `expiry_date` date NOT NULL,
  `about` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `plans`
--

INSERT INTO `plans` (`plan_id`, `company_id`, `conversion`, `earn_per_conversion`, `price_of_product`, `difficulty`, `name`, `training_kit`, `timestamp`, `expiry_date`, `about`) VALUES
(1, 1, 'Rs to dollar', 'Rs 500 ', 499, 'Hard', 'Amazon Plan A', 'KJBKHBKH', '2017-10-12 16:06:39', '2017-10-25', 'This is Amazon Plan A'),
(2, 2, 'Rs to dollar', 'Rs 300 ', 999, 'Easy', 'Flipkart-A', 'LKML', '2017-10-12 16:07:06', '2017-10-30', 'This is Flipkart Plan A'),
(3, 1, 'Rs to dollar', 'Rs 400 ', 499, 'Hard', 'Amazon Plan B', 'DAD', '2017-10-12 16:06:47', '2017-10-30', 'This is Amazon Plan A'),
(4, 3, 'Rs to dollar', 'Rs 1000 ', 999, 'Medium', 'Plan A', 'dd', '2017-10-12 16:07:29', '2017-10-31', 'This is Plan A');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `review_id` int(10) NOT NULL,
  `plan_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `message` text NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`review_id`, `plan_id`, `user_id`, `timestamp`, `message`, `name`) VALUES
(68, 1, 57, '2017-10-12 16:10:25', 'Good', 'It\'s a good plan'),
(73, 1, 75, '2017-10-12 22:34:44', 'sfsfs', 'adad');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(10) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `college` text NOT NULL,
  `gender` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` bigint(12) NOT NULL,
  `address` varchar(255) NOT NULL,
  `degree` varchar(50) NOT NULL,
  `cv` text NOT NULL,
  `status` varchar(50) DEFAULT 'rejected',
  `google_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `college`, `gender`, `email`, `phone`, `address`, `degree`, `cv`, `status`, `google_id`) VALUES
(1, 'ani', 'thapar', 'male', 'anirudhkhandelwal04@gmail.com', 2147483647, 'kota', 'b.tech', '', '', ''),
(2, 'Ayush Pahwa', 'Thapar University', 'male', 'ayushpahwa96@gmail.com', 964626162, 'Hostel M, Thapar University, Patiala - 147004', 'Software Engineering', 'lun.com', '', ''),
(3, 'Anshul', 'Thapar', 'Male', 'anshul@gmail.com', 12323, 'hoste-j', 'be', '', '', ''),
(4, 'Alok', 'Thapar', 'Male', 'alok@gmail.com', 43424, 'J hostel', 'be', '', '', ''),
(5, 'Lakshit', 'Thapar', 'male', 'lakshit@gmail.com', 9892113, 'delhi', 'be', 'link', '', ''),
(57, 'Alok Singh', 'ghjk', 'gh', 'singhalok641@gmail.com', 566, 'hhh', 'ghh', 'qwe', 'accepted', '110322049520609074950'),
(71, 'Anshul Mehta', 'hxhs', 'bsbz', 'anshul.mk97@gmail.com', 8373, 'bzbz', 'bxbx', 'bzbz', 'accepted', '103871410449701682831'),
(72, 'ANSHUL MEHTA', 'g kk', 'ff', 'amehta_be15@thapar.edu', 55, 'jt', 'hkk', 'dgh', 'accepted', '117109295943667630406'),
(74, 'dadad', 'sg', 'dgdgd', 'aadqa232322131', 3322121, 'xvxvx', 'svsvs', 'svsvs', NULL, 'adad21242'),
(75, 'dadad', 'sg', 'dgdgd', 'aadqa23232322131', 332212123, 'xvxvx', 'svsvs', 'svsvs', 'accepted', 'adad2124232'),
(77, 'Vaibhav Chobisa', 'hshzh', 'jsjz', 'vaibhav.chobisa@gmail.com', 8282, 'bzbz', 'bzbz', 'jsjsj', 'accepted', '117485766734094763814');

-- --------------------------------------------------------

--
-- Table structure for table `usernotifications`
--

CREATE TABLE `usernotifications` (
  `un_id` int(10) NOT NULL,
  `un_notification` text NOT NULL,
  `plan_reg_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `company_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usernotifications`
--

INSERT INTO `usernotifications` (`un_id`, `un_notification`, `plan_reg_id`, `user_id`, `company_id`) VALUES
(32, 'User with user id  has registered in plan with plan id 1', 1, 75, 1),
(33, 'User with user id  has registered in plan with plan id 1', 1, 75, 1),
(34, 'User with user id 75 has registered in plan with plan id 3', 3, 75, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_companies`
--

CREATE TABLE `user_companies` (
  `user_companies_id` int(10) NOT NULL,
  `company_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_companies`
--

INSERT INTO `user_companies` (`user_companies_id`, `company_id`, `user_id`, `timestamp`) VALUES
(5, 1, 1, '2017-10-07 03:41:13'),
(6, 2, 1, '2017-10-07 03:41:49'),
(7, 1, 3, '2017-10-07 08:43:31'),
(8, 4, 4, '2017-10-09 13:12:15'),
(9, 3, 2, '2017-10-09 14:14:33'),
(23, 1, 57, '2017-10-12 15:49:44'),
(24, 3, 57, '2017-10-12 15:49:44'),
(32, 1, 71, '2017-10-12 21:53:02'),
(33, 1, 72, '2017-10-12 21:55:45'),
(34, 1, 75, '2017-10-12 22:27:25'),
(35, 3, 75, '2017-10-12 22:51:01'),
(36, 1, 77, '2017-10-13 05:58:16'),
(37, 1, 72, '2017-10-13 09:02:46');

-- --------------------------------------------------------

--
-- Table structure for table `user_registrationnotification`
--

CREATE TABLE `user_registrationnotification` (
  `ur_id` int(10) NOT NULL,
  `user_reg_notification` text NOT NULL,
  `user_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_registrationnotification`
--

INSERT INTO `user_registrationnotification` (`ur_id`, `user_reg_notification`, `user_id`) VALUES
(3, ' A new user has registered', 74),
(4, ' A new user has registered', 75),
(5, ' A new user has registered', 77);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bank_details`
--
ALTER TABLE `bank_details`
  ADD PRIMARY KEY (`bank_id`),
  ADD KEY `f_2` (`user_id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`company_id`),
  ADD UNIQUE KEY `company_name` (`name`,`email`,`phone`);

--
-- Indexes for table `companynotifications`
--
ALTER TABLE `companynotifications`
  ADD PRIMARY KEY (`cn_id`),
  ADD KEY `f_k3` (`company_id`);

--
-- Indexes for table `company_rating`
--
ALTER TABLE `company_rating`
  ADD PRIMARY KEY (`rating_id`),
  ADD KEY `f_3` (`company_id`),
  ADD KEY `f_4` (`user_id`);

--
-- Indexes for table `discussion_answers`
--
ALTER TABLE `discussion_answers`
  ADD PRIMARY KEY (`answer_id`),
  ADD KEY `f_5` (`question_id`),
  ADD KEY `f_6` (`user_id`);

--
-- Indexes for table `discussion_questions`
--
ALTER TABLE `discussion_questions`
  ADD PRIMARY KEY (`question_id`),
  ADD KEY `f_7` (`plan_id`),
  ADD KEY `f_8` (`user_id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`like_id`),
  ADD KEY `f_9` (`plan_id`),
  ADD KEY `f_10` (`user_id`);

--
-- Indexes for table `my_plans`
--
ALTER TABLE `my_plans`
  ADD PRIMARY KEY (`plan_reg_id`),
  ADD KEY `f_13` (`plan_id`),
  ADD KEY `f_14` (`user_id`);

--
-- Indexes for table `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`plan_id`),
  ADD KEY `f_1` (`company_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `f_15` (`plan_id`),
  ADD KEY `f_16` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`,`phone`),
  ADD UNIQUE KEY `email_2` (`email`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- Indexes for table `usernotifications`
--
ALTER TABLE `usernotifications`
  ADD PRIMARY KEY (`un_id`),
  ADD KEY `fk_myplan_notif` (`plan_reg_id`),
  ADD KEY `fk_91` (`user_id`);

--
-- Indexes for table `user_companies`
--
ALTER TABLE `user_companies`
  ADD PRIMARY KEY (`user_companies_id`),
  ADD KEY `f_21` (`company_id`),
  ADD KEY `fk_90` (`user_id`);

--
-- Indexes for table `user_registrationnotification`
--
ALTER TABLE `user_registrationnotification`
  ADD PRIMARY KEY (`ur_id`),
  ADD KEY `f_k_1` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bank_details`
--
ALTER TABLE `bank_details`
  MODIFY `bank_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `company_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `companynotifications`
--
ALTER TABLE `companynotifications`
  MODIFY `cn_id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `company_rating`
--
ALTER TABLE `company_rating`
  MODIFY `rating_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;
--
-- AUTO_INCREMENT for table `discussion_answers`
--
ALTER TABLE `discussion_answers`
  MODIFY `answer_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `discussion_questions`
--
ALTER TABLE `discussion_questions`
  MODIFY `question_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `like_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `my_plans`
--
ALTER TABLE `my_plans`
  MODIFY `plan_reg_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `plans`
--
ALTER TABLE `plans`
  MODIFY `plan_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;
--
-- AUTO_INCREMENT for table `usernotifications`
--
ALTER TABLE `usernotifications`
  MODIFY `un_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `user_companies`
--
ALTER TABLE `user_companies`
  MODIFY `user_companies_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `user_registrationnotification`
--
ALTER TABLE `user_registrationnotification`
  MODIFY `ur_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `companynotifications`
--
ALTER TABLE `companynotifications`
  ADD CONSTRAINT `f_k3` FOREIGN KEY (`company_id`) REFERENCES `companies` (`company_id`);

--
-- Constraints for table `company_rating`
--
ALTER TABLE `company_rating`
  ADD CONSTRAINT `f_3` FOREIGN KEY (`company_id`) REFERENCES `companies` (`company_id`);

--
-- Constraints for table `discussion_answers`
--
ALTER TABLE `discussion_answers`
  ADD CONSTRAINT `f_5` FOREIGN KEY (`question_id`) REFERENCES `discussion_questions` (`question_id`),
  ADD CONSTRAINT `f_6` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `discussion_questions`
--
ALTER TABLE `discussion_questions`
  ADD CONSTRAINT `f_7` FOREIGN KEY (`plan_id`) REFERENCES `plans` (`plan_id`),
  ADD CONSTRAINT `f_8` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `f_10` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `f_9` FOREIGN KEY (`plan_id`) REFERENCES `plans` (`plan_id`);

--
-- Constraints for table `my_plans`
--
ALTER TABLE `my_plans`
  ADD CONSTRAINT `f_13` FOREIGN KEY (`plan_id`) REFERENCES `plans` (`plan_id`);

--
-- Constraints for table `plans`
--
ALTER TABLE `plans`
  ADD CONSTRAINT `f_1` FOREIGN KEY (`company_id`) REFERENCES `companies` (`company_id`);

--
-- Constraints for table `user_companies`
--
ALTER TABLE `user_companies`
  ADD CONSTRAINT `f_21` FOREIGN KEY (`company_id`) REFERENCES `companies` (`company_id`),
  ADD CONSTRAINT `fk_90` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

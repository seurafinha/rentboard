-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Oct 06, 2022 at 10:23 AM
-- Server version: 5.7.34
-- PHP Version: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `game_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Card Game'),
(2, 'Board Game'),
(3, 'Others');

-- --------------------------------------------------------

--
-- Table structure for table `chat_message`
--

CREATE TABLE `chat_message` (
  `chat_message_id` int(11) NOT NULL,
  `to_user_id` int(11) NOT NULL,
  `from_user_id` int(11) NOT NULL,
  `chat_message` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chat_message`
--

INSERT INTO `chat_message` (`chat_message_id`, `to_user_id`, `from_user_id`, `chat_message`, `timestamp`, `status`) VALUES
(1, 1, 4, 'Hi', '2022-09-19 18:56:15', 2),
(2, 1, 4, 'How are you', '2022-09-19 18:56:34', 2),
(3, 2, 4, 'hello', '2022-09-19 19:03:05', 1),
(4, 3, 4, 'hi', '2022-09-19 19:03:11', 1),
(5, 3, 4, 'how are you', '2022-09-19 19:03:29', 1),
(6, 4, 5, 'Hi', '2022-09-20 08:07:02', 0),
(7, 4, 5, 'fffddfdf', '2022-09-20 08:26:05', 0),
(8, 5, 4, 'Hi', '2022-09-20 10:20:00', 0),
(9, 5, 4, 'How are you', '2022-09-20 10:20:16', 0),
(12, 6, 5, 'Hi', '2022-10-06 10:04:03', 0),
(13, 6, 5, 'how are you?', '2022-10-06 10:04:28', 0),
(14, 5, 6, 'hELLO', '2022-10-06 10:05:25', 0),
(15, 6, 5, 'Whats Up', '2022-10-06 10:08:41', 0),
(16, 6, 5, 'I am fine', '2022-10-06 10:09:03', 0),
(17, 5, 6, 'Okay..', '2022-10-06 10:09:31', 0),
(18, 5, 6, 'hwqiq', '2022-10-06 10:18:52', 0),
(19, 5, 6, 'sdcsdcsdc', '2022-10-06 10:18:57', 0),
(20, 6, 5, 'oksdcsd', '2022-10-06 10:19:13', 1);

-- --------------------------------------------------------

--
-- Table structure for table `deals`
--

CREATE TABLE `deals` (
  `id` int(11) NOT NULL,
  `pro_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `borower_id` int(11) NOT NULL,
  `pro_price` varchar(255) NOT NULL,
  `installments` varchar(255) NOT NULL,
  `per_month` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `paid_instmts` int(11) NOT NULL DEFAULT '0',
  `last_Installment_date` timestamp NULL DEFAULT NULL,
  `delay_status` int(11) NOT NULL DEFAULT '0',
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `deals`
--

INSERT INTO `deals` (`id`, `pro_id`, `user_id`, `borower_id`, `pro_price`, `installments`, `per_month`, `status`, `paid_instmts`, `last_Installment_date`, `delay_status`, `created_at`) VALUES
(1, 2, 5, 4, '2000', '2', '83.333333333333', 1, 4, '2022-09-20 16:23:40', 0, '2022-09-20 15:48:41'),
(3, 3, 5, 4, '200', '1', '16.666666666667', 0, 0, NULL, 0, '2022-09-20 18:43:12'),
(4, 5, 5, 4, '200', '1', '16.666666666667', 1, 1, '2022-09-20 15:36:01', 0, '2022-09-20 19:20:12'),
(5, 6, 5, 4, '324', '1', '27', 0, 0, NULL, 0, '2022-09-20 20:39:57'),
(6, 6, 5, 6, '2333', '2', '97.208333333333', 1, 1, '2022-07-20 16:12:39', 1, '2022-09-20 21:33:58');

-- --------------------------------------------------------

--
-- Table structure for table `installments`
--

CREATE TABLE `installments` (
  `id` int(11) NOT NULL,
  `deals_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `price_paid` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `installRecords`
--

CREATE TABLE `installRecords` (
  `id` int(11) NOT NULL,
  `deals_id` int(11) NOT NULL,
  `borrower_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `installRecords`
--

INSERT INTO `installRecords` (`id`, `deals_id`, `borrower_id`, `created_at`) VALUES
(1, 1, 4, '2022-09-20 11:55:04'),
(3, 3, 4, '2022-09-20 13:43:55'),
(8, 4, 4, '2022-09-20 14:20:45');

-- --------------------------------------------------------

--
-- Table structure for table `lateinstall`
--

CREATE TABLE `lateinstall` (
  `id` int(11) NOT NULL,
  `deals_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `borower_id` int(11) NOT NULL,
  `messagae` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`user_id`, `username`, `password`, `status`) VALUES
(4, 'Zulqarnain Haider', '$2y$10$7j2pLVa7OVHIZolBPK4wQeovSI91Pm1H6Smta28ZlvVMAeGHEXoyO', 1),
(5, 'Hammad', '$2y$10$4etCuvrLEGrm/FgJJ/MQBe8w3v4tdrcKXsZi.VyZLiOJySV2q10mi', 0),
(6, 'Alihassan', '$2y$10$76Nj2ezC5/sBVGIdFV42Ye9UI9Af5W3ll7W5wyGw3Y9cC9VOhOuHq', 0);

-- --------------------------------------------------------

--
-- Table structure for table `login_details`
--

CREATE TABLE `login_details` (
  `login_details_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `last_activity` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_type` enum('no','yes') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login_details`
--

INSERT INTO `login_details` (`login_details_id`, `user_id`, `last_activity`, `is_type`) VALUES
(1, 4, '2022-09-19 20:21:33', 'no'),
(2, 4, '2022-09-19 20:54:49', 'no'),
(3, 4, '2022-09-19 21:15:01', 'no'),
(4, 4, '2022-09-20 07:51:34', 'no'),
(5, 4, '2022-09-20 08:03:58', 'no'),
(6, 5, '2022-09-20 10:27:20', 'no'),
(7, 4, '2022-09-20 15:55:21', 'no'),
(8, 5, '2022-09-20 16:10:49', 'no'),
(9, 6, '2022-10-06 09:30:55', 'no'),
(10, 5, '2022-10-06 10:14:21', 'no'),
(11, 6, '2022-10-06 09:39:46', 'no'),
(12, 5, '2022-10-06 10:03:28', 'no'),
(13, 6, '2022-10-06 10:14:39', 'no'),
(14, 6, '2022-10-06 10:23:47', 'no'),
(15, 5, '2022-10-06 10:23:48', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `pro_name` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `pro_price` varchar(255) NOT NULL,
  `pro_image` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `cat_id`, `pro_name`, `user_id`, `pro_price`, `pro_image`, `status`, `created_at`) VALUES
(1, 1, 'Plastic High Quality Card Game 2022', 4, '809', 'A_Game_of_Rummy.jpeg', 0, '2022-09-20 10:44:03'),
(2, 1, 'Latest Plactic High Quality Card Game', 5, '200', 'cards_new.jpeg', 1, '2022-09-20 12:05:56'),
(3, 2, 'Board Games 2022', 5, '324', '104151701-GettyImages-143949731.jpeg', 1, '2022-09-20 13:13:55'),
(5, 3, '2022 Full Game Other', 5, '200', '960x0.jpeg', 1, '2022-09-20 13:50:45'),
(6, 3, 'DCDSC', 5, '324', '960x0.jpeg', 1, '2022-09-20 16:04:14'),
(7, 3, 'New Game 2025', 6, '2000', '960x0.jpeg', 0, '2022-09-20 16:32:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat_message`
--
ALTER TABLE `chat_message`
  ADD PRIMARY KEY (`chat_message_id`);

--
-- Indexes for table `deals`
--
ALTER TABLE `deals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `installments`
--
ALTER TABLE `installments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `installRecords`
--
ALTER TABLE `installRecords`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lateinstall`
--
ALTER TABLE `lateinstall`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `login_details`
--
ALTER TABLE `login_details`
  ADD PRIMARY KEY (`login_details_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `chat_message`
--
ALTER TABLE `chat_message`
  MODIFY `chat_message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `deals`
--
ALTER TABLE `deals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `installments`
--
ALTER TABLE `installments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `installRecords`
--
ALTER TABLE `installRecords`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `lateinstall`
--
ALTER TABLE `lateinstall`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `login_details`
--
ALTER TABLE `login_details`
  MODIFY `login_details_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

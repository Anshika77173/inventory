-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3308
-- Generation Time: Sep 17, 2024 at 04:53 PM
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
-- Database: `inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `assets`
--

CREATE TABLE `assets` (
  `id` int(11) NOT NULL,
  `location` varchar(255) NOT NULL,
  `asset_type` varchar(255) NOT NULL,
  `asset_id` varchar(255) NOT NULL,
  `Model_no` varchar(255) DEFAULT NULL,
  `configuration` text DEFAULT NULL,
  `brand` varchar(255) DEFAULT NULL,
  `IMEI` varchar(255) DEFAULT NULL,
  `Serial_no` varchar(255) DEFAULT NULL,
  `processor` varchar(255) DEFAULT NULL,
  `ram` varchar(255) DEFAULT NULL,
  `storage` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `accessory` text DEFAULT NULL,
  `date_of_joining` date DEFAULT NULL,
  `asset_purchase` date DEFAULT NULL,
  `assetissue_date` date DEFAULT NULL,
  `asset_issue` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assets`
--

INSERT INTO `assets` (`id`, `location`, `asset_type`, `asset_id`, `Model_no`, `configuration`, `brand`, `IMEI`, `Serial_no`, `processor`, `ram`, `storage`, `username`, `password`, `ip`, `accessory`, `date_of_joining`, `asset_purchase`, `assetissue_date`, `asset_issue`) VALUES
(60, '', 'desktop', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(61, '', 'laptop', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `devices`
--

CREATE TABLE `devices` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `devices`
--

INSERT INTO `devices` (`id`, `name`, `deleted_at`) VALUES
(54, 'Laptop', NULL),
(55, 'Desktop', NULL),
(56, 'Printer', NULL),
(57, 'wire', '2024-09-16 04:01:42'),
(58, 'modem', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `employees_id` varchar(255) NOT NULL,
  `employees_name` varchar(255) NOT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `department` varchar(255) DEFAULT NULL,
  `contact` varchar(20) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `employees_id`, `employees_name`, `designation`, `department`, `contact`, `location`, `date`) VALUES
(1, '2', 'Kayan Sharma', '', '', '', '', '0000-00-00'),
(2, '2', 'Kayan Sharma', '', '', '', '', '0000-00-00'),
(3, '2', 'Kayan Sharma', '', '', '', '', '0000-00-00'),
(4, '2', 'Kayan Sharma', '', '', '', '', '0000-00-00'),
(5, '21', '', '', '', '', '', '0000-00-00'),
(7, '21', '', '', '', '', '', '0000-00-00'),
(9, '2', '', '', '', '', '', '0000-00-00'),
(10, '21', '', '', '', '', '', '0000-00-00'),
(11, '21', '', '', '', '', '', '0000-00-00'),
(12, '213', 'rtet', '', '', '', '', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `id` int(11) NOT NULL,
  `locationname` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `district` varchar(255) NOT NULL,
  `pincode` varchar(10) DEFAULT NULL,
  `contact` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`id`, `locationname`, `state`, `district`, `pincode`, `contact`) VALUES
(81, 'kjpl', 'chandigarh', 'punjab', '224325', 'xcxzczx');

-- --------------------------------------------------------

--
-- Table structure for table `purchaseregister`
--

CREATE TABLE `purchaseregister` (
  `id` int(11) NOT NULL,
  `Device` varchar(255) NOT NULL,
  `Serial_no` varchar(255) DEFAULT NULL,
  `purchase_vendor` varchar(255) DEFAULT NULL,
  `purchase_date` date DEFAULT NULL,
  `recieving_date` date DEFAULT NULL,
  `asset_id` varchar(255) DEFAULT NULL,
  `po` varchar(255) DEFAULT NULL,
  `approved` varchar(255) DEFAULT NULL,
  `asset` varchar(255) DEFAULT NULL,
  `year` varchar(4) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchaseregister`
--

INSERT INTO `purchaseregister` (`id`, `Device`, `Serial_no`, `purchase_vendor`, `purchase_date`, `recieving_date`, `asset_id`, `po`, `approved`, `asset`, `year`, `price`) VALUES
(16, 'Desktop', '', '', '0000-00-00', '0000-00-00', '', '', '', '', '', 0.00),
(17, 'Desktop', '', '', '0000-00-00', '0000-00-00', '', '', '', '', '', 0.00),
(18, 'wire', '', '', '0000-00-00', '0000-00-00', '', '', '', '', '', 0.00),
(19, 'Desktop', '', '', '0000-00-00', '0000-00-00', '', '', '', '', '', 0.00),
(20, 'Printer', '', '', '0000-00-00', '0000-00-00', '', '', '', '', '', 0.00),
(21, 'Printer', '', '', '0000-00-00', '0000-00-00', '', '', '', '', '', 0.00),
(22, 'Desktop', '', '', '0000-00-00', '0000-00-00', '', '', '', '', '', 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `returnasset`
--

CREATE TABLE `returnasset` (
  `id` int(11) NOT NULL,
  `issue_date` date NOT NULL,
  `left_date` date NOT NULL,
  `asset_id` varchar(255) NOT NULL,
  `employee_name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `transaction_id` int(11) NOT NULL,
  `employees_id` int(11) NOT NULL,
  `employees_name` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `asset_id` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`transaction_id`, `employees_id`, `employees_name`, `date`, `asset_id`, `location`) VALUES
(11, 3, 'balakrishan', '2024-08-17', 'kBPl/kATHU-01', 'KBPL-Kathua'),
(12, 21, 'Kayan Sharma', '2024-08-17', 'kBPl/kATHU-08', 'KBPL-Kathua'),
(20, 0, '', '0000-00-00', '', ''),
(21, 2, '', '0000-00-00', '', ''),
(22, 23322, 'Kayan Sharma', '0000-00-00', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `password`, `created_at`) VALUES
(45, 'vishal', 'vishal@gmail.com', '$2y$10$UMsuKwo8lEmDLGB7CsLIteC1Xyt1WPCdOK074TNV01MER1LaG0qZm', '2024-08-16 05:59:04'),
(49, '', 'vishal1@gmail.com', '$2y$10$YZkISwMUkyAfoAaZFsHRfer.qLH1yCaHtKWWsZXkbiKVqHhDWmEvu', '2024-08-17 03:56:06'),
(51, '', 'anm@gmail.com', '$2y$10$dNAfy4zt4xeFVC4l11jopesHB2hBamj4uhYCTpxeq6v6Uvtcxrbr.', '2024-08-19 06:08:53'),
(52, '', 'sunny@gmail.com', '$2y$10$W/rInh8ipAv/Re3LgorcL.oO00PaH8ZP5JrTs8P1RexiZw.w3mFB.', '2024-08-19 06:41:42'),
(53, '', 'vanshika@gmail.com', '$2y$10$jEoWUODCowQPfUjcHjJL1OSYSyZkPIee/SRKpSLitk7WflalqFNqm', '2024-09-15 09:10:07'),
(54, '', 'jaggoyal78@gmail.com', '$2y$10$rbs.74jN6WFkMP6Uqofk1O3APvznmzJvzY15t7ZmAT3Jz09083OOC', '2024-09-15 09:10:24');

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `vendor_id` varchar(50) NOT NULL,
  `vendor_name` varchar(100) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`vendor_id`, `vendor_name`, `date`) VALUES
('01', 'mnet', '2024-08-13'),
('32323', '', '0000-00-00'),
('323232', '', '0000-00-00'),
('5534', 'rwwr', '0000-00-00'),
('55343', '', '0000-00-00'),
('67', '', '0000-00-00'),
('675', '', '0000-00-00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assets`
--
ALTER TABLE `assets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `devices`
--
ALTER TABLE `devices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchaseregister`
--
ALTER TABLE `purchaseregister`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `returnasset`
--
ALTER TABLE `returnasset`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`transaction_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`vendor_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assets`
--
ALTER TABLE `assets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `devices`
--
ALTER TABLE `devices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `purchaseregister`
--
ALTER TABLE `purchaseregister`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `returnasset`
--
ALTER TABLE `returnasset`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

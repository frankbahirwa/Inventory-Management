-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 17, 2024 at 03:08 PM
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
-- Database: `stock_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `supplier` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL DEFAULT 'o',
  `product_image_path` varchar(255) NOT NULL DEFAULT 'none',
  `added_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `description`, `price`, `quantity`, `supplier`, `category`, `product_image_path`, `added_by`, `created_at`, `updated_at`) VALUES
(24, 'ibijumba', '', 40000.00, 55, '0', 'food', 'none', 24, '2024-11-17 13:22:47', '2024-11-17 13:25:44');

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `profile_id` int(4) UNSIGNED ZEROFILL NOT NULL,
  `added_by` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`profile_id`, `added_by`, `image`, `created_at`) VALUES
(0002, 22, 'assets/profiles/profile_6739e11becc161.72038082_DALL·E 2024-10-19 18.58.06 - A visual representation of an attendance system for a school using card tap data. The image shows a dashboard interface with different sections_ a lis.webp', '2024-11-17 13:27:07'),
(0003, 23, 'assets/profiles/profile_6739e1c6775e87.78284914_frank.jpg', '2024-11-17 13:29:58'),
(0004, 23, 'assets/profiles/profile_6739e24ca7c6d5.46612539_frankk.jpg', '2024-11-17 13:32:12'),
(0005, 24, 'assets/profiles/profile_6739efa6a2e097.78741264_frankk.jpg', '2024-11-17 14:29:10');

-- --------------------------------------------------------

--
-- Table structure for table `stockin`
--

CREATE TABLE `stockin` (
  `id` int(3) UNSIGNED ZEROFILL NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `supplier` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL DEFAULT 'o',
  `product_image_path` varchar(255) NOT NULL DEFAULT 'none',
  `added_by` int(11) NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stockin`
--

INSERT INTO `stockin` (`id`, `product_name`, `description`, `price`, `product_id`, `quantity`, `supplier`, `category`, `product_image_path`, `added_by`, `created_at`, `updated_at`) VALUES
(018, 'ibijumba', 'nksdnslda', 40000.00, 24, 655, '0', 'food', 'none', 24, '2024-11-17 13:23:32', '2024-11-17 13:23:32');

-- --------------------------------------------------------

--
-- Table structure for table `stockout`
--

CREATE TABLE `stockout` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `added_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stockout`
--

INSERT INTO `stockout` (`id`, `product_name`, `product_id`, `quantity`, `added_by`, `created_at`) VALUES
(11, 'ibijumba', 24, 500, 24, '2024-11-17 13:24:56'),
(12, 'ibijumba', 24, 100, 24, '2024-11-17 13:25:43');

-- --------------------------------------------------------

--
-- Table structure for table `stock_details`
--

CREATE TABLE `stock_details` (
  `product_id` int(3) UNSIGNED ZEROFILL NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `supplier` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL DEFAULT 'o',
  `product_image_path` varchar(255) NOT NULL DEFAULT 'none',
  `added_by` int(11) NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stock_details`
--

INSERT INTO `stock_details` (`product_id`, `product_name`, `description`, `price`, `quantity`, `supplier`, `category`, `product_image_path`, `added_by`, `created_at`, `updated_at`) VALUES
(001, 'orange', 'hello there', 1000.00, 20, '0', 'shoes', 'none', 2147483647, '2024-09-01 15:36:33', '2024-09-01 15:36:33'),
(002, 'banana', 'thats the newest banana', 500.00, 20, '0', 'clothes', 'none', 2147483647, '2024-09-03 08:47:46', '2024-09-03 08:47:46'),
(003, '', '', 0.00, 0, '0', '', 'none', 2147483647, '2024-11-08 18:42:29', '2024-11-08 18:42:29'),
(004, 'Bahirwa frank', 'dfsadsadf', 500.00, 20, '0', 'clothes', 'none', 2147483647, '2024-11-10 12:59:37', '2024-11-10 12:59:37'),
(005, 'umuceri', 'umuceri', 1000.00, 20, '0', 'food', 'none', 2147483647, '2024-11-11 06:00:25', '2024-11-11 06:00:25'),
(006, 'eddy', '', 1000.00, 20, '0', 'other', 'none', 2147483647, '2024-11-11 06:06:34', '2024-11-11 06:06:34'),
(007, 'beans', 'caguwa', 1000.00, 655, '0', 'clothes', 'none', 2147483647, '2024-11-11 06:41:47', '2024-11-11 06:41:47'),
(008, 'beanss', '3434fss', 1000.00, 655, '0', 'clothes', 'none', 2147483647, '2024-11-11 07:21:34', '2024-11-11 07:21:34'),
(009, 'Bahirwa Frank Frank', 'ds;vms;lv', 1000.00, 655, '0', 'clothes', 'none', 2147483647, '2024-11-11 07:30:33', '2024-11-11 07:30:33'),
(010, 'chlomi', 'ds;vms;lv', 1000.00, 655, '0', 'clothes', 'none', 2147483647, '2024-11-11 07:31:52', '2024-11-11 07:31:52'),
(011, 'arsene', 'ds;vms;lv', 1000.00, 655, '0', 'clothes', 'none', 2147483647, '2024-11-11 07:32:43', '2024-11-11 07:32:43'),
(012, 'machine learning basics', '3434fss', 1000.00, 655, '0', 'clothes', 'none', 2147483647, '2024-11-11 08:20:29', '2024-11-11 08:20:29'),
(013, 'machine learning basics', '3434fss', 1000.00, 655, '0', 'shoes', 'none', 2147483647, '2024-11-11 08:46:50', '2024-11-11 08:46:50'),
(014, 'ibijumba', '3434fss', 1000.00, 655, '0', 'food', 'none', 2147483647, '2024-11-11 11:14:07', '2024-11-11 11:14:07'),
(015, 'ibijumba', '3434fss', 1000.00, 1000, '0', 'food', 'none', 2147483647, '2024-11-11 11:15:20', '2024-11-11 11:15:20'),
(016, 'ibijumba', '3434fss', 1000.00, 1000, '0', 'shoes', 'none', 2147483647, '2024-11-11 11:31:43', '2024-11-11 11:31:43'),
(017, 'orange', 'ibijumb', 600.00, 1, '0', 'food', 'none', 2147483647, '2024-11-11 12:20:58', '2024-11-11 12:20:58'),
(018, 'orange', 'ibijumb', 0.00, 0, '0', 'food', 'none', 2147483647, '2024-11-11 12:21:42', '2024-11-11 12:21:42'),
(019, 'orange', '', 500.00, 20, '0', 'food', 'none', 2147483647, '2024-11-11 12:22:59', '2024-11-11 12:22:59'),
(020, 'ibijumba', '3434fss', 1000.00, 0, '0', 'shoes', 'none', 2147483647, '2024-11-11 16:43:30', '2024-11-11 16:43:30'),
(021, 'ibijumba', '3434fss', 1000.00, 0, '0', 'shoes', 'none', 2147483647, '2024-11-11 16:44:05', '2024-11-11 16:44:05'),
(022, 'beanss', '3434fss', 1000.00, 0, '0', '', 'none', 2147483647, '2024-11-11 16:44:19', '2024-11-11 16:44:19'),
(023, 'beanss', '', 1000.00, 655, '0', 'shoes', 'none', 2147483647, '2024-11-11 16:46:12', '2024-11-11 16:46:12'),
(024, 'beanss', '3434fss', 1000.00, -655, '0', 'shoes', 'none', 2147483647, '2024-11-11 16:46:45', '2024-11-11 16:46:45'),
(025, 'beanss', '3434fss', 1000.00, -655, '0', 'shoes', 'none', 2147483647, '2024-11-11 16:48:17', '2024-11-11 16:48:17'),
(026, 'beanss', '3434fss', 1000.00, -655, '0', 'shoes', 'none', 2147483647, '2024-11-11 16:48:51', '2024-11-11 16:48:51'),
(027, 'beanss', '3434fss', 1000.00, -655, '0', 'shoes', 'none', 2147483647, '2024-11-11 16:49:19', '2024-11-11 16:49:19'),
(028, 'beanss', '3434fss', 1000.00, -655, '0', 'clothes', 'none', 2147483647, '2024-11-11 16:50:46', '2024-11-11 16:50:46'),
(029, 'beanss', '3434fss', 1000.00, -655, '0', 'clothes', 'none', 2147483647, '2024-11-11 16:52:25', '2024-11-11 16:52:25'),
(030, 'beanss', '3434fss', 1000.00, 655, '0', 'shoes', 'none', 2147483647, '2024-11-11 18:01:38', '2024-11-11 18:01:38'),
(031, 'beanss', '3434fss', 1000.00, 655, '0', 'shoes', 'none', 2147483647, '2024-11-11 18:36:46', '2024-11-11 18:36:46');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password_hash`, `created_at`, `updated_at`) VALUES
(22, 'bahirwa frank', '$2y$10$A1augQQDxqrR.Gv6Z6Jf8.aDDU8wCWuAlPuVwsRLenlOVPk.6TGsa', '2024-11-17 11:24:57', '2024-11-17 11:24:57'),
(23, 'mom', '$2y$10$/YvMJcqEdxcxiQ04/xKL.OUsk0DqKcci4tSpKG0RhK5WHKHg.5ehK', '2024-11-17 12:29:14', '2024-11-17 12:29:14'),
(24, 'isai', '$2y$10$1WnTWKw9n2fFe7tAutVTguqd8NiTAJ3j27Lxe9S7IGBixol2dsOvu', '2024-11-17 12:37:23', '2024-11-17 12:37:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `added_by` (`added_by`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`profile_id`),
  ADD KEY `profiles_ibfk_1` (`added_by`);

--
-- Indexes for table `stockin`
--
ALTER TABLE `stockin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `added_by` (`added_by`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `stockout`
--
ALTER TABLE `stockout`
  ADD PRIMARY KEY (`id`),
  ADD KEY `added_by` (`added_by`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `stock_details`
--
ALTER TABLE `stock_details`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `profile_id` int(4) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `stockin`
--
ALTER TABLE `stockin`
  MODIFY `id` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `stockout`
--
ALTER TABLE `stockout`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `stock_details`
--
ALTER TABLE `stock_details`
  MODIFY `product_id` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`added_by`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `profiles`
--
ALTER TABLE `profiles`
  ADD CONSTRAINT `profiles_ibfk_1` FOREIGN KEY (`added_by`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `stockin`
--
ALTER TABLE `stockin`
  ADD CONSTRAINT `stockin_ibfk_1` FOREIGN KEY (`added_by`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `stockin_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `stockout`
--
ALTER TABLE `stockout`
  ADD CONSTRAINT `stockout_ibfk_1` FOREIGN KEY (`added_by`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `stockout_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 11, 2024 at 11:47 AM
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
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `description`, `price`, `quantity`, `supplier`, `category`, `product_image_path`, `added_by`, `created_at`, `updated_at`) VALUES
(001, 'machine learning basics', '3434fss', 1000.00, 655, '0', 'shoes', 'none', 2147483647, '2024-11-11 08:46:50', '2024-11-11 08:46:50');

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
(013, 'machine learning basics', '3434fss', 1000.00, 655, '0', 'shoes', 'none', 2147483647, '2024-11-11 08:46:50', '2024-11-11 08:46:50');

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
(1, 'mom', '$2y$10$cMpSUCNcqKRADQCSSS13w.ZRJV9A6iHzPoZnxh682o4TRNCmf3GTu', '2024-11-11 08:01:22', '2024-11-11 08:01:22');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` enum('Admin','Manager','User') NOT NULL DEFAULT 'User',
  `profile_image_path` varchar(255) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password_hash`, `email`, `role`, `profile_image_path`, `created_at`, `updated_at`) VALUES
(1, 'eddy', '123we', 'frank@gmail.com', 'User', '../assets/profiles/image2.jpg', '2024-08-10 15:37:23', '2024-08-20 10:51:13'),
(3, 'frank', '4444444gjghjkghkjgkjhg', 'frankbahirwa@gmail.com', 'Admin', '../assets/profiles/image2.jpg', '2024-08-10 15:50:37', '2024-08-20 10:51:13'),
(5, 'mandela', '12333', 'frankbahirwaa@gmail.com', 'User', '../assets/profiles/image2.jpg', '2024-08-10 16:12:39', '2024-08-20 10:51:13'),
(6, 'irafasha', '$2y$10$3A3f0DanjGHEsbS3GfIVC.8KteAo0qOawEEM0zOVnyFUKT3jAAdAO', 'frankbaffhirwa@gmail.com', 'User', '0', '2024-08-20 16:19:50', '2024-08-20 16:19:50'),
(8, 'kamoso', '$2y$10$bna/UYDx/.XBQo0WtVyxbuKaEkuCKW3p9SR/OJjM1jHD7bBGrQ3xi', 'frankbfffahirwa@gmail.com', 'User', '0', '2024-08-22 06:07:42', '2024-08-22 06:07:42'),
(9, 'papa', '$2y$10$I1mlLZaSzfYCcu4CV.OgQelc5o6cRsMuFjKTMXVD/iAjil1XKB02e', '123@gmail.com', 'User', '0', '2024-09-01 10:31:13', '2024-09-01 10:31:13'),
(12, 'kaka', '$2y$10$CQhq0fRv1k8m3stxejqFgeemyMyY0Eg4JzTGKAdPIwh9qAPAg.iIy', '1234@gmail.com', 'User', '0', '2024-09-01 10:47:01', '2024-09-01 10:47:01'),
(15, 'kkamoso', '$2y$10$4ihh1OeK.TocZmQJGR7TI.1ts.IsmCqjiyz/S7tJPjtBjSahjuUkm', '', 'User', '0', '2024-11-10 14:21:39', '2024-11-10 14:21:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `stock_details`
--
ALTER TABLE `stock_details`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `stock_details`
--
ALTER TABLE `stock_details`
  MODIFY `product_id` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

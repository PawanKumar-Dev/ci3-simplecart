-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 25, 2022 at 08:23 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ci3cart`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `created` varchar(255) NOT NULL,
  `modified` varchar(255) NOT NULL,
  `status` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `email`, `phone`, `address`, `created`, `modified`, `status`) VALUES
(20, 'Pawan Kumar', 'pk687376@gmail.com', '08882608794', 'Shahbad dairy Delhi 110042, F-4, Shahbad Dairy', '24-03-2022 07:54:12', '24-03-2022 07:54:12', '1'),
(21, 'Pawan Kumar', 'pk687376@gmail.com', '08882608794', 'Shahbad dairy Delhi 110042, F-4, Shahbad Dairy', '24-03-2022 07:56:04', '24-03-2022 07:56:04', '1'),
(22, 'Pawan Kumar', 'pk687376@gmail.com', '08882608794', 'Shahbad dairy Delhi 110042, F-4, Shahbad Dairy', '24-03-2022 08:11:41', '24-03-2022 08:11:41', '1');

-- --------------------------------------------------------

--
-- Table structure for table `instamojo`
--

CREATE TABLE `instamojo` (
  `id` int(10) UNSIGNED NOT NULL,
  `phone` varchar(25) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `buyer_name` varchar(255) DEFAULT NULL,
  `amount` decimal(16,2) NOT NULL,
  `purpose` text DEFAULT NULL,
  `expires_at` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `send_sms` varchar(5) NOT NULL DEFAULT 'false',
  `send_email` varchar(5) NOT NULL DEFAULT 'false',
  `sms_status` varchar(255) DEFAULT NULL,
  `email_status` varchar(255) DEFAULT NULL,
  `shorturl` mediumtext DEFAULT NULL,
  `longurl` mediumtext DEFAULT NULL,
  `redirect_url` mediumtext DEFAULT NULL,
  `webhook` mediumtext DEFAULT NULL,
  `allow_repeated_payments` varchar(5) NOT NULL DEFAULT 'false',
  `customer_id` varchar(255) DEFAULT NULL,
  `created_at` varchar(255) DEFAULT NULL,
  `modified_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `grand_total` float NOT NULL,
  `created` varchar(255) NOT NULL,
  `modified` varchar(255) NOT NULL,
  `status` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `grand_total`, `created`, `modified`, `status`) VALUES
(17, 20, 70, '24-03-2022 07:54:12', '24-03-2022 07:54:12', '1'),
(18, 21, 70, '24-03-2022 07:56:04', '24-03-2022 07:56:04', '1'),
(19, 22, 210, '24-03-2022 08:11:41', '24-03-2022 08:11:41', '1');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(5) NOT NULL,
  `sub_total` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `sub_total`) VALUES
(10, 17, 6, 1, 70),
(11, 18, 6, 1, 70),
(12, 19, 6, 3, 210);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` float NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `status` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `image`, `name`, `description`, `price`, `created`, `modified`, `status`) VALUES
(4, 'product1.jpg', 'product 1', 'Curabitur pharetra convallis urna, et varius ligula euismod sed. Aenean diam ipsum, blandit at fringilla ut, commodo nec lorem. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae', 123.45, '2022-03-20 07:52:11', '2022-03-20 07:52:11', '1'),
(5, 'product2.jpg', 'product 2', 'Integer eget varius mi, commodo tincidunt purus. Cras dolor ligula, molestie quis facilisis vitae, porttitor in est. Morbi tincidunt arcu tempor venenatis pharetra. Phasellus euismod varius massa, sit amet sagittis lacus', 92.56, '2022-03-20 07:52:11', '2022-03-20 07:52:11', '1'),
(6, 'product3.jpg', 'product 3', 'Fusce commodo, nisl non suscipit laoreet, augue diam molestie diam, in convallis massa sem ac sem. Quisque cursus, nibh sed fringilla iaculis, justo tellus auctor quam, eu congue tortor lectus eget massa.', 70, '2022-03-20 07:53:36', '2022-03-20 07:53:36', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `instamojo`
--
ALTER TABLE `instamojo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `instamojo`
--
ALTER TABLE `instamojo`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 29, 2025 at 02:17 AM
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
-- Database: `db_pointofsale20251`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `created_at`, `updated_at`) VALUES
(1, 'The Main Food', '2025-10-22 04:08:36', '2025-10-22 04:09:50'),
(2, 'Snack', '2025-10-22 04:08:36', '2025-10-22 04:10:05'),
(3, 'Drink', '2025-10-22 04:08:36', '2025-10-22 04:10:17');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `order_code` varchar(255) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `total_amount` decimal(10,2) DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `payment_amount` decimal(10,2) DEFAULT NULL,
  `payment_change` decimal(10,2) DEFAULT NULL,
  `order_status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `price_at_sale` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `product_description` text DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL,
  `deleted_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `product_name`, `photo`, `price`, `product_description`, `is_active`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'Bibimbap', '1761182257_bibimbap.jpg', 55000.00, 'Nasi campur khas Korea...', 1, '2025-10-23 01:17:37', '2025-10-22 04:08:36', '2025-10-23 01:17:37'),
(2, 1, 'Bulgogi', '1761182250_bulgogi.jpg', 75000.00, 'Irisan daging sapi premium...', 1, '2025-10-23 01:17:30', '2025-10-22 04:08:36', '2025-10-23 01:17:30'),
(3, 1, 'Jajangmyeon', '1761182240_jajangmyeon.webp', 60000.00, 'Mi tebal dengan saus...', 1, '2025-10-23 01:17:20', '2025-10-22 04:08:36', '2025-10-23 01:17:20'),
(4, 2, 'Tteokbokki', '1761182228_tteokbokki.jpg', 45000.00, 'Kue beras kenyal...', 1, '2025-10-23 01:17:08', '2025-10-22 04:08:36', '2025-10-23 01:17:08'),
(5, 2, 'Kimbap', '1761182215_kimbap.jpg', 40000.00, 'Nasi yang digulung...', 1, '2025-10-23 01:16:55', '2025-10-22 04:08:36', '2025-10-23 01:16:55'),
(6, 2, 'Mandu', '1761182199_mandu.jpg', 35000.00, 'Pangsit khas Korea...', 1, '2025-10-23 01:16:39', '2025-10-22 04:08:36', '2025-10-23 01:16:39'),
(7, 3, 'Iced Tea', '1761182186_iced_tea.jpg', 15000.00, 'Teh manis dingin...', 1, '2025-10-23 01:16:26', '2025-10-22 04:08:36', '2025-10-23 01:16:26'),
(8, 3, 'Soju', '1761182173_soju.jpg', 80000.00, 'Minuman beralkohol...', 1, '2025-10-23 01:16:13', '2025-10-22 04:08:36', '2025-10-23 01:16:13');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Superadmin', '2025-10-18 01:25:24', '2025-10-18 02:05:51'),
(2, 'Operator', '2025-10-18 01:25:24', '2025-10-18 02:06:06'),
(3, 'Administrator', '2025-10-18 01:25:24', '2025-10-18 02:06:06'),
(4, 'User', '2025-10-18 01:25:24', '2025-10-18 02:06:06');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `delete_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role_id`, `delete_at`, `created_at`, `updated_at`) VALUES
(1, 'Andi Bramawijaya', 'admin@gmail.com', '$2y$10$ng2d38NhGAP/oLWqP4qktOks7fM5Aae/IheSp2npWEYa89u8arziS', 1, NULL, '2025-10-18 01:22:44', '2025-10-20 10:57:21'),
(2, 'Budi Pengguna', 'budi@gmail.com', '$2y$10$ng2d38NhGAP/oLWqP4qktOks7fM5Aae/IheSp2npWEYa89u8arziS', 2, NULL, '2025-10-18 01:22:44', '2025-10-18 14:00:06'),
(3, 'Citra Lestari', 'citra@gmail.com', '$2y$10$ng2d38NhGAP/oLWqP4qktOks7fM5Aae/IheSp2npWEYa89u8arziS', 2, NULL, '2025-10-18 01:22:44', '2025-10-20 10:57:49'),
(4, 'Bambang Abraham', 'bambang123@gmail.com', '$2y$10$ng2d38NhGAP/oLWqP4qktOks7fM5Aae/IheSp2npWEYa89u8arziS', 2, NULL, '2025-10-18 01:31:31', '2025-10-18 02:41:56'),
(5, 'Muhammad Ghalib', 'magh180698@gmail.com', '$2y$10$IU6dSp0gT1qzF3qiV28VAe50DU1GFQJXbo6SB1VPSZwuqjQurT8VG', 1, NULL, '2025-10-18 12:36:31', '2025-10-18 12:36:31'),
(7, 'Ahmad Darmawan', 'ahmad123@gmail.com', '$2y$10$p5l6suTsccvGrXfe/Qc8ue/BY24p0D4fXSafGE4RKI9yBppNpjZiG', 4, NULL, '2025-10-18 14:06:57', '2025-10-18 14:09:13'),
(9, 'Ghalib', 'ghalib123@gmail.com', '$2y$10$aYIDhyEF.nuPcqhXClumIORqCG4iV79fPKjJ2rb4avIbTAkorg0V2', 3, NULL, '2025-10-20 10:59:14', '2025-10-20 10:59:14'),
(10, 'Riyo Ferdinan', 'riyoferdinan77@gmail.com', '$2y$10$1yqaGAM.JVL86GsuIFk2u.768dYaf.TyZZPu5LnUxrpuqYnP.Moym', 4, NULL, '2025-10-20 11:00:31', '2025-10-20 11:00:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `order_code` (`order_code`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

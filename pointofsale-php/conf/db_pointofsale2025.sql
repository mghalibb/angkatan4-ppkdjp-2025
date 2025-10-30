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
-- Database: `db_pointofsale2025`
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
(1, 'Main Courses', '2025-10-18 01:24:49', '2025-10-22 12:35:16'),
(2, 'Drinks', '2025-10-18 01:24:49', '2025-10-22 12:36:28'),
(4, 'Side Dishes', '2025-10-18 01:24:49', '2025-10-22 12:35:53'),
(5, 'Desserts', '2025-10-18 14:55:13', '2025-10-22 12:36:09'),
(6, 'Snack', '2025-10-18 15:21:17', '2025-10-22 11:02:22'),
(7, 'Appetizers', '2025-10-18 15:21:38', '2025-10-22 12:35:34');

-- --------------------------------------------------------

--
-- Table structure for table `discounts`
--

CREATE TABLE `discounts` (
  `id` int(11) NOT NULL,
  `code` varchar(50) DEFAULT NULL,
  `type` enum('fixed','percent') DEFAULT NULL,
  `value` decimal(10,2) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `discounts`
--

INSERT INTO `discounts` (`id`, `code`, `type`, `value`, `is_active`, `expires_at`) VALUES
(1, 'DISKONRAMADAN12', 'percent', 0.15, 1, '2025-10-31 13:15:00');

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
  `discount_code` varchar(50) DEFAULT NULL,
  `discount_amount` decimal(10,2) DEFAULT NULL,
  `order_status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_code`, `order_date`, `total_amount`, `payment_method`, `payment_amount`, `payment_change`, `discount_code`, `discount_amount`, `order_status`) VALUES
(1, 'ORD-20251022042331-B6E5', '2025-10-22 02:23:31', 6900000.00, NULL, NULL, NULL, NULL, NULL, 1),
(2, 'ORD-20251022042342-593F', '2025-10-22 02:23:42', 250000.00, NULL, NULL, NULL, NULL, NULL, 1),
(3, 'ORD-20251022042608-F7CE', '2025-10-22 02:26:08', 250000.00, NULL, NULL, NULL, NULL, NULL, 1),
(4, 'ORD-20251027085933-CC74', '2025-10-27 07:59:33', 69300.00, 'QRIS', NULL, NULL, '', 0.00, 1),
(5, 'ORD-20251027144650-B250', '2025-10-27 13:46:50', 17325.00, 'QRIS', NULL, NULL, '', 0.00, 1),
(6, 'ORD-20251027144832-F7AB', '2025-10-27 13:48:32', 194512.50, 'Cash', NULL, NULL, '', 0.00, 0),
(7, 'ORD-20251027150619-92D6', '2025-10-27 14:06:19', 344137.50, 'Cash', NULL, NULL, 'DISKONRAMADAN12', 54337.50, 0),
(8, 'ORD-20251027151855-99FF', '2025-10-27 14:18:55', 369075.00, 'Cash', NULL, NULL, 'DISKONRAMADAN12', 58275.00, 0),
(9, 'ORD-20251028090247-501C', '2025-10-28 08:02:47', 234412.50, 'Cash', NULL, NULL, 'DISKONRAMADAN12', 37012.50, 1),
(10, 'ORD-20251028090952-ABDF', '2025-10-28 08:09:52', 294262.50, 'Cash', NULL, NULL, 'DISKONRAMADAN12', 46462.50, 1);

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

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `qty`, `price_at_sale`, `subtotal`) VALUES
(1, 1, 5, 1, 6900000.00, 6900000.00),
(2, 2, 4, 1, 250000.00, 250000.00),
(3, 3, 4, 1, 250000.00, 250000.00),
(4, 4, 2, 1, 60000.00, 60000.00),
(5, 5, 11, 1, 15000.00, 15000.00),
(6, 6, 9, 1, 55000.00, 55000.00),
(7, 6, 5, 1, 75000.00, 75000.00),
(8, 6, 11, 2, 15000.00, 30000.00),
(9, 6, 10, 1, 35000.00, 35000.00),
(10, 7, 2, 2, 60000.00, 120000.00),
(11, 7, 11, 1, 15000.00, 15000.00),
(12, 7, 5, 1, 75000.00, 75000.00),
(13, 7, 9, 1, 55000.00, 55000.00),
(14, 7, 8, 1, 80000.00, 80000.00),
(15, 8, 2, 1, 60000.00, 60000.00),
(16, 8, 5, 2, 75000.00, 150000.00),
(17, 8, 9, 1, 55000.00, 55000.00),
(18, 8, 11, 2, 15000.00, 30000.00),
(19, 8, 10, 1, 35000.00, 35000.00),
(20, 8, 4, 1, 40000.00, 40000.00),
(21, 9, 9, 1, 55000.00, 55000.00),
(22, 9, 5, 1, 75000.00, 75000.00),
(23, 9, 11, 2, 15000.00, 30000.00),
(24, 9, 10, 1, 35000.00, 35000.00),
(25, 9, 4, 1, 40000.00, 40000.00),
(26, 10, 9, 1, 55000.00, 55000.00),
(27, 10, 5, 1, 75000.00, 75000.00),
(28, 10, 2, 1, 60000.00, 60000.00),
(29, 10, 11, 2, 15000.00, 30000.00),
(30, 10, 10, 1, 35000.00, 35000.00),
(31, 10, 4, 1, 40000.00, 40000.00);

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
(1, 6, 'Tteokbokki', '1761135063_tteokbokki.jpg', 45000.00, 'Kue beras kenyal...', 0, '2025-10-22 12:11:03', '2025-10-18 01:25:09', '2025-10-22 12:11:03'),
(2, 1, 'Jajangmyeon', '1761134906_jajangmyeon.webp', 60000.00, 'Mi tebal dengan saus...', 0, '2025-10-22 12:08:26', '2025-10-18 01:25:09', '2025-10-22 12:08:26'),
(4, 6, 'Kimbap', '1761135126_kimbap.jpg', 40000.00, 'Nasi yang digulung...', 0, '2025-10-22 12:12:06', '2025-10-18 01:25:09', '2025-10-22 12:12:06'),
(5, 1, 'Bulgogi', '1761134768_bulgogi.jpg', 75000.00, 'Irisan daging sapi premium...', 0, '2025-10-22 12:06:08', '2025-10-18 01:25:09', '2025-10-22 12:06:08'),
(8, 2, 'Soju', '1761133372_soju.jpg', 80000.00, 'Minuman beralkohol...', 0, '2025-10-22 11:42:52', '2025-10-22 11:42:52', '2025-10-22 11:42:52'),
(9, 1, 'Bibimbap', '1761134660_bibimbap.jpg', 55000.00, 'Nasi campur khas Korea...', 0, '2025-10-22 12:04:20', '2025-10-22 11:47:28', '2025-10-22 12:04:20'),
(10, 6, 'Mandu', '1761135172_mandu.jpg', 35000.00, 'Pangsit khas Korea...', 0, '2025-10-22 12:12:52', '2025-10-22 12:12:43', '2025-10-22 12:12:52'),
(11, 2, 'Iced Tea', '1761135211_iced_tea.jpg', 15000.00, 'Teh manis dingin...', 0, '2025-10-22 12:13:31', '2025-10-22 12:13:31', '2025-10-22 12:13:31'),
(12, 4, 'Kimchi', '1761139471_kimchi.jpg', 65500.00, 'Kimchi adalah hidangan tradisional Korea yang terbuat dari sayuran asin dan fermentasi, umumnya kubis, yang dibumbui dengan bahan-bahan seperti bawang putih, bubuk cabai, dan jahe. Kimchi memiliki rasa pedas, asam, dan gurih yang khas, dan merupakan lauk pokok dalam masakan Korea yang dapat dimakan begitu saja atau dicampur dengan hidangan lain seperti semur, nasi, dan mi.', 0, '2025-10-22 13:24:31', '2025-10-22 13:24:31', '2025-10-22 13:24:31');

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
(4, 'Bambang Abraham', 'bambang123@gmail.com', '$2y$10$ng2d38NhGAP/oLWqP4qktOks7fM5Aae/IheSp2npWEYa89u8arziS', 2, NULL, '2025-10-18 01:31:31', '2025-10-22 14:25:01'),
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
-- Indexes for table `discounts`
--
ALTER TABLE `discounts`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `discounts`
--
ALTER TABLE `discounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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

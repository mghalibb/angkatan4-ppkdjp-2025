-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 22, 2025 at 06:02 AM
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
(1, 'Elektronik', '2025-10-18 01:24:49', '2025-10-18 01:24:49'),
(2, 'Fashion', '2025-10-18 01:24:49', '2025-10-18 14:54:17'),
(4, 'Minuman', '2025-10-18 01:24:49', '2025-10-18 01:24:49'),
(5, 'Perlengkapan Rumah', '2025-10-18 14:55:13', '2025-10-18 14:55:13'),
(6, 'Hobi & Koleksi', '2025-10-18 15:21:17', '2025-10-18 15:21:17'),
(7, 'Voucher & Tagihan', '2025-10-18 15:21:38', '2025-10-18 15:21:38');

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

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_code`, `order_date`, `total_amount`, `payment_method`, `payment_amount`, `payment_change`, `order_status`) VALUES
(1, 'ORD-20251022042331-B6E5', '2025-10-22 02:23:31', 6900000.00, NULL, NULL, NULL, 1),
(2, 'ORD-20251022042342-593F', '2025-10-22 02:23:42', 250000.00, NULL, NULL, NULL, 1),
(3, 'ORD-20251022042608-F7CE', '2025-10-22 02:26:08', 250000.00, NULL, NULL, NULL, 1);

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
(3, 3, 4, 1, 250000.00, 250000.00);

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
(1, 1, 'Laptop Asus Vivobook', '1761028231_asus_vivobook.png', 8500000.00, '', 0, '2025-10-21 06:30:31', '2025-10-18 01:25:09', '2025-10-21 06:30:31'),
(2, 2, 'Kaos Polos Hitam', '1761028208_black_tshirt.png', 75000.00, '', 0, '2025-10-21 06:30:08', '2025-10-18 01:25:09', '2025-10-21 06:30:08'),
(4, 1, 'Wireless Mouse Logitech', '1761028199_wireless_carbon.png', 250000.00, '', 0, '2025-10-21 06:29:59', '2025-10-18 01:25:09', '2025-10-21 06:29:59'),
(5, 1, 'Lenovo IdeaPad Slim 3', '1761028193_lenovo_IdeaPad.jpg', 6900000.00, '0', 0, '2025-10-21 08:09:57', '2025-10-18 01:25:09', '2025-10-21 08:09:57'),
(7, 2, 'Celana Cargo', '1761028172_cargo.jpg', 120000.00, '', 0, '2025-10-21 06:29:32', '2025-10-18 15:19:55', '2025-10-21 06:29:32');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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

CREATE TABLE `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Data contoh untuk `roles`
--
INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'Admin'),
(2, 'User');

-- --------------------------------------------------------

--
-- Struktur tabel untuk `users`
--
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `delete_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `role_id` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Data contoh untuk `users`
-- Catatan: Password di bawah ini adalah 'password123' yang sudah di-hash
--
INSERT INTO `users` (`id`, `name`, `email`, `password`, `role_id`, `delete_at`) VALUES
(1, 'Andi Administrator', 'admin@example.com', '$2y$10$E.aAvJdDBRHPEvsAM59pL.x.3kKVw5SDE8PGuq7yAib8yILpPTBvG', 1, NULL),
(2, 'Budi Pengguna', 'budi@example.com', '$2y$10$E.aAvJdDBRHPEvsAM59pL.x.3kKVw5SDE8PGuq7yAib8yILpPTBvG', 2, NULL),
(3, 'Citra Dihapus', 'citra@example.com', '$2y$10$E.aAvJdDBRHPEvsAM59pL.x.3kKVw5SDE8PGuq7yAib8yILpPTBvG', 2, '2025-10-17 12:00:00');

INSERT INTO `roles` (`id`, `username`, `email`, `password`, `role_id`, `delete_at`) VALUES
(1, 'Andi Administrator', 'admin@example.com', '$2y$10$E.aAvJdDBRHPEvsAM59pL.x.3kKVw5SDE8PGuq7yAib8yILpPTBvG', 1, NULL),
(2, 'Budi Pengguna', 'budi@example.com', '$2y$10$E.aAvJdDBRHPEvsAM59pL.x.3kKVw5SDE8PGuq7yAib8yILpPTBvG', 2, NULL),
(3, 'Citra Dihapus', 'citra@example.com', '$2y$10$E.aAvJdDBRHPEvsAM59pL.x.3kKVw5SDE8PGuq7yAib8yILpPTBvG', 2, '2025-10-17 12:00:00');

INSERT INTO roles (name) VALUES ('Superadmin'), ('Operator'), ('Administrator');
Teks penuh
id
name
Superadmin
Operator
Administrator

--
-- Menambahkan Foreign Key constraint
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
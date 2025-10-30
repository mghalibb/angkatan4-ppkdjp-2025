-- SQL : Struktur Query Language
-- - Mengolah
-- - Mengelola sebuah database
-- Database MariaDB, MySql, PostgreSQL, SQL Server

-- DDL, DML 
-- DDL : Data Definition Language
-- -Cerate Database

-- Sintaks
cd C:\xampp\mysql\bin
mysql -u root -p
exit;
quit;

SHOW DATABASES;
CREATE DATABASE db_point_of_sale_2025;
USE db_point_of_sale_2025;
DROP DATABASE db_point_of_sale_2025;
---------------------------------------------------------------------------------------------
SHOW TABLES;
CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    delete_at timestamp NULL DEFAULT NULL
);
INSERT INTO users (username, password, email) VALUES ('andri', '12345', 'andri@example.com'), ('ardian', '12345', 'ardian@example.com'), ('gungu', '12345', 'gungu@example.com');

CREATE TABLE roles (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
INSERT INTO roles (name) VALUES ('Superadmin'), ('Operator'), ('Administrator'), ('User');

CREATE TABLE user_roles (
    user_id INT NOT NULL,
    role_id INT NOT NULL,
    PRIMARY KEY (user_id, role_id),
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (role_id) REFERENCES roles(id) ON DELETE CASCADE
);
INSERT INTO user_roles (user_id, role_id) VALUES (1, 1);

DESCRIBE users;
DESC users;
ALTER TABLE users ADD COLUMN role_id INT(11);
ALTER TABLE users ADD COLUMN email VARCHAR(100) NOT NULL UNIQUE;
ALTER TABLE users ADD COLUMN updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP;
DROP TABLE users;
---------------------------------------------------------------------------------------------
SELECT * FROM users;
SELECT kolom1, kolom2 FROM users;
SELECT * FROM users WHERE id = 4;
SELECT * FROM users ORDER BY id DESC;
---------------------------------------------------------------------------------------------
UPDATE users SET kolom_yang_diubah = 'nilai_baru' WHERE kondisi;
UPDATE produk SET harga = 5500 WHERE id = 1;
UPDATE users SET username='Bambang Nugraha' WHERE id=1;
UPDATE users SET role_id = 1 WHERE id = 1;
---------------------------------------------------------------------------------------------
DELETE FROM users WHERE kondisi;
DELETE FROM produk WHERE id = 1;
---------------------------------------------------------------------------------------------
SELECT
    nama_tabel1.nama_kolom,
    nama_tabel2.nama_kolom
FROM
    nama_tabel1
INNER JOIN
    nama_tabel2 ON nama_tabel1.kolom_penghubung = nama_tabel2.kolom_penghubung;

-- INNER JOIN : Hanya menampilkan data yang memiliki pasangan di kedua sisi.
SELECT
    users.username,
    users.email,
    roles.name AS role_name
FROM
    users
INNER JOIN
    user_roles ON users.id = user_roles.user_id
INNER JOIN
    roles ON user_roles.role_id = roles.id;

SELECT
    u.*,
    roles.name AS role_name
FROM
    users u
JOIN
roles ON roles.id = u.role_id;

-- LEFT JOIN : Menampilkan semua data dari tabel kiri, dan data dari tabel kanan jika ada pasangan. Jika tidak, hasilnya NULL.
SELECT
    users.username,
    roles.name AS role_name
FROM
    users
LEFT JOIN
    user_roles ON users.id = user_roles.user_id
LEFT JOIN
    roles ON user_roles.role_id = roles.id;
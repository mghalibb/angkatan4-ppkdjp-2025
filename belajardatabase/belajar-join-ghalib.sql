-- 1. Membuat database
CREATE DATABASE belajar_join_ghalib;

-- 2. Menggunakan database tersebut
USE belajar_join_ghalib;

-- 3. (Opsional) Hapus tabel jika sudah ada sebelumnya
DROP TABLE IF EXISTS orders;
DROP TABLE IF EXISTS users;

-- 4. Membuat tabel users
CREATE TABLE users (
    id INT PRIMARY KEY,
    name VARCHAR(50)
);

-- 5. Membuat tabel orders
CREATE TABLE orders (
    id INT PRIMARY KEY,
    user_id INT,
    product_name VARCHAR(50)
);

-- 6. Menambahkan data ke tabel users
INSERT INTO users (id, name) VALUES
(1, 'Andi'),
(2, 'Budi'),
(3, 'Citra'),
(4, 'Dewi');

-- 7. Menambahkan data ke tabel orders
INSERT INTO orders (id, user_id, product_name) VALUES
(1, 1, 'Laptop'),
(2, 1, 'Mouse'),
(3, 2, 'Keyboard'),
(4, 5, 'Monitor'); -- user_id = 5 tidak ada di tabel users

-- ============================
-- 8. QUERY JOIN
-- ============================

-- a. Menampilkan semua pengguna dan pesanan mereka (INNER JOIN)
SELECT users.id, users.name, orders.product_name
FROM users
INNER JOIN orders ON users.id = orders.user_id;

-- b. Menampilkan pengguna yang tidak memiliki pesanan (LEFT JOIN)
SELECT users.id, users.name, orders.product_name
FROM users
LEFT JOIN orders ON users.id = orders.user_id
WHERE orders.user_id IS NULL;

-- c. Menampilkan pesanan yang tidak memiliki pengguna terdaftar (RIGHT JOIN)
SELECT users.id AS user_id, users.name, orders.product_name
FROM users
RIGHT JOIN orders ON users.id = orders.user_id
WHERE users.id IS NULL;

-- ==================================================================================

-- Membuat tabel users
CREATE TABLE users (
    id INT PRIMARY KEY,
    name VARCHAR(50)
);

-- Membuat tabel orders
CREATE TABLE orders (
    id INT PRIMARY KEY,
    user_id INT,
    product_name VARCHAR(50)
);

-- Menambahkan data ke tabel users
INSERT INTO users (id, name) VALUES
(1, 'Andi'),
(2, 'Budi'),
(3, 'Citra'),
(4, 'Dewi');

-- Menambahkan data ke tabel orders
INSERT INTO orders (id, user_id, product_name) VALUES
(1, 1, 'Laptop'),
(2, 1, 'Mouse'),
(3, 2, 'Keyboard'),
(4, 5, 'Monitor'); -- user_id = 5 tidak ada di tabel users


SELECT users.id, users.name, orders.product_name
FROM users
INNER JOIN orders ON users.id = orders.user_id;

SELECT users.id, users.name, orders.product_name
FROM users
LEFT JOIN orders ON users.id = orders.user_id
WHERE orders.user_id IS NULL;

SELECT users.id AS user_id, users.name, orders.product_name
FROM users
RIGHT JOIN orders ON users.id = orders.user_id
WHERE users.id IS NULL;

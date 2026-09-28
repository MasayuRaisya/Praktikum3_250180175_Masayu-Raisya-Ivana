-- Membuat database store_db jika belum ada
CREATE DATABASE IF NOT EXISTS store_db;

-- Menggunakan database store_db
USE store_db;

-- Membuat tabel products jika belum ada
CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    category VARCHAR(100) NOT NULL,
    price INT NOT NULL,
    stock INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Mengosongkan data lama agar tidak terjadi duplikasi
TRUNCATE TABLE products;

-- Memasukkan data awal menu makanan
INSERT INTO products (name, category, price, stock) VALUES
('Nasi Goreng Spesial', 'Makanan Utama', 25000, 20),
('Ayam Geprek Sambal Matah', 'Makanan Utama', 22000, 15),
('Mie Goreng Jawa', 'Makanan Utama', 20000, 18),
('Soto Ayam Kampung', 'Kuah & Sup', 23000, 12),
('Sate Ayam Madura', 'Olahan Daging', 30000, 10),
('Roti Bakar Cokelat Keju', 'Camilan', 18000, 25);
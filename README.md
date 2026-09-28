# Product Manager - Resto Nusantara

Aplikasi CRUD Manajemen Menu Makanan berbasis PHP Native, PDO MySQL, dan CSS Flexbox.

## Fitur Aplikasi
- **Create**: Menambah menu makanan baru (dengan validasi nama min 3 karakter, harga > 0, dan stok >= 0)
- **Read**: Menampilkan daftar menu dalam bentuk card grid Flexbox yang responsif
- **Update**: Memperbarui data menu berdasarkan ID
- **Delete**: Menghapus menu menggunakan method POST & proteksi CSRF Token
- **Search**: Mencari menu berdasarkan nama atau kategori
- **Security**: Menggunakan PDO Prepared Statement (anti SQL Injection) dan htmlspecialchars (anti XSS)

## Cara Jalankan Aplikasi
1. Buka XAMPP dan jalankan modul **Apache** dan **MySQL**.
2. Salin folder proyek ini ke dalam direktori `htdocs` XAMPP (`C:/xampp/htdocs/product-manager`).
3. Buka phpMyAdmin di browser (`http://localhost/phpmyadmin`).
4. Buat database baru atau impor berkas `database/store_db.sql`.
5. Akses aplikasi melalui URL: `http://localhost/product-manager/public/index.php`.
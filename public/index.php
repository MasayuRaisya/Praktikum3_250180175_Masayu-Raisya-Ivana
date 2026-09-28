<?php
// Memanggil koneksi database
require_once __DIR__ . '/../config/db.php';

// Memeriksa variabel koneksi
if (!isset($conn) || $conn === null) {
    die("Koneksi database gagal: Variabel \$conn tidak ditemukan. Pastikan file config/db.php sudah benar.");
}

// Fitur Pencarian Menu / Kategori
$search = $_GET['search'] ?? '';

if (!empty($search)) {
    $stmt = $conn->prepare("SELECT * FROM products WHERE name LIKE ? OR category LIKE ? ORDER BY id DESC");
    $searchTerm = "%" . $search . "%";
    $stmt->bind_param("ss", $searchTerm, $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $sql = "SELECT * FROM products ORDER BY id DESC";
    $result = $conn->query($sql);
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resto Nusantara - Catalog Menu Makanan</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

    <div class="header">
        <h1>Resto Nusantara</h1>
        <p>Manajemen Stok & Catalog Menu Makanan</p>
    </div>

    <div class="top-bar">
        <form method="GET" action="" class="search-form">
            <input type="text" name="search" placeholder="Cari menu atau kategori..." value="<?= htmlspecialchars($search); ?>">
            <button type="submit" class="btn btn-search">Cari</button>
        </form>
        <a href="create.php" class="btn btn-add">+ Tambah Menu</a>
    </div>

    <div class="card-grid">
        <?php if ($result && $result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <div class="card">
                    <span class="badge"><?= htmlspecialchars($row['category']); ?></span>
                    <h3><?= htmlspecialchars($row['name']); ?></h3>
                    <p class="price">Rp <?= number_format($row['price'], 0, ',', '.'); ?></p>
                    <p class="stock">Stok Tersedia: <?= $row['stock']; ?> pcs</p>
                    <div class="card-actions">
                        <a href="edit.php?id=<?= $row['id']; ?>" class="btn btn-edit">Edit</a>
                        <a href="delete.php?id=<?= $row['id']; ?>" class="btn btn-delete" onclick="return confirm('Hapus menu ini?');">Hapus</a>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p style="grid-column: 1 / -1; text-align: center; color: #777;">Menu makanan tidak ditemukan.</p>
        <?php endif; ?>
    </div>

</body>
</html>
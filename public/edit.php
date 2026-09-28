<?php
require_once '../config/db.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: index.php");
    exit();
}

$stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();

if (!$product) {
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name     = $_POST['name'];
    $category = $_POST['category'];
    $price    = (int) $_POST['price'];
    $stock    = (int) $_POST['stock'];

    $update_stmt = $conn->prepare("UPDATE products SET name = ?, category = ?, price = ?, stock = ? WHERE id = ?");
    $update_stmt->bind_param("ssiii", $name, $category, $price, $stock, $id);

    if ($update_stmt->execute()) {
        header("Location: index.php");
        exit();
    } else {
        $error = "Gagal memperbarui data: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Produk</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <div class="container">
        <h2>Edit Produk</h2>
        <?php if (isset($error)): ?>
            <p style="color: red; margin-bottom: 10px;"><?= $error; ?></p>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="form-group">
                <label>Nama Produk:</label>
                <input type="text" name="name" value="<?= htmlspecialchars($product['name']); ?>" required>
            </div>
            <div class="form-group">
                <label>Kategori:</label>
                <input type="text" name="category" value="<?= htmlspecialchars($product['category']); ?>" required>
            </div>
            <div class="form-group">
                <label>Harga (Rp):</label>
                <input type="number" name="price" value="<?= $product['price']; ?>" required>
            </div>
            <div class="form-group">
                <label>Stok:</label>
                <input type="number" name="stock" value="<?= $product['stock']; ?>" required>
            </div>
            <button type="submit" class="btn">Update Produk</button>
            <a href="index.php" class="btn btn-warning">Batal</a>
        </form>
    </div>
</body>
</html>
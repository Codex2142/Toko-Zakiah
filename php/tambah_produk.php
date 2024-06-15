<?php
include("koneksi.php");
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../style/style.css">
</head>
<body>

<div class="container mt-5">
    <h1 class="h1">Tambah <span>Produk</span></h1>
    
    <form action="proses_tambah_produk.php" method="post">
        <div class="mb-3">
            <label for="namaProduk" class="form-label">Nama Produk</label>
            <input type="text" class="form-control" id="namaProduk" name="namaProduk" required>
        </div>
        <div class="mb-3">
            <label for="ukuranProduk" class="form-label">Ukuran</label>
            <input type="text" class="form-control" id="ukuranProduk" name="ukuranProduk" required>
        </div>
        <div class="mb-3">
            <label for="hargaBeli" class="form-label">Harga Beli</label>
            <input type="number" class="form-control" id="hargaBeli" name="hargaBeli" required>
        </div>
        <div class="mb-3">
            <label for="hargaGrosir" class="form-label">Harga Grosir</label>
            <input type="number" class="form-control" id="hargaGrosir" name="hargaGrosir" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="admin.php" class="btn btn-secondary">Batal</a>
    </form>


</div>

<!-- Bootstrap JavaScript (optional) -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>

</body>
</html>

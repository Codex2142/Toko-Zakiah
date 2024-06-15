<?php
include("koneksi.php");

// Periksa apakah parameter ID produk tersedia dan valid
if(isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk menghapus produk berdasarkan ID (diasumsikan kolom no adalah yang benar)
    $query = "DELETE FROM produk WHERE no = $id";
    $delete_result = mysqli_query($connection, $query);

    // Periksa apakah query berhasil dijalankan
    if($delete_result) {
        // Jika berhasil, tampilkan pesan sukses
        echo '<div class="alert alert-success" role="alert">
                Produk berhasil dihapus.
            </div>';
    } else {
        // Jika gagal, tampilkan pesan error
        echo '<div class="alert alert-danger" role="alert">
                Gagal menghapus produk. Silakan coba lagi.
            </div>';
    }
} else {
    // Jika parameter ID tidak tersedia atau tidak valid, tampilkan pesan error
    echo '<div class="alert alert-danger" role="alert">
            Terjadi kesalahan. Produk tidak ditemukan.
        </div>';
}

// Setelah menampilkan pesan, arahkan kembali ke halaman admin atau halaman terkait
header("refresh:2;url=admin.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hapus Produk</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="../style/style.css" />
</head>
<body>
    
</body>
</html>
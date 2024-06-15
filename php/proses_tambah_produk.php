<?php
include("koneksi.php");

// Validasi bahwa $_POST['namaProduk'], $_POST['ukuranProduk'], $_POST['hargaBeli'], dan $_POST['hargaGrosir'] ada
if (isset($_POST['namaProduk'], $_POST['ukuranProduk'], $_POST['hargaBeli'], $_POST['hargaGrosir'])) {
    // Ambil nilai dari $_POST
    $namaProduk = $_POST['namaProduk'];
    $ukuranProduk = $_POST['ukuranProduk'];
    $hargaBeli = $_POST['hargaBeli'];
    $hargaGrosir = $_POST['hargaGrosir'];

    // Query untuk menyimpan data ke dalam database
    $query = "INSERT INTO produk (nama, ukuran, harga_beli, harga_grosir) VALUES ('$namaProduk', '$ukuranProduk', $hargaBeli, $hargaGrosir)";

    // Eksekusi query
    $result = mysqli_query($connection, $query);

    if($result) {
        // Jika penyisipan berhasil, redirect kembali ke halaman admin.php atau halaman lainnya
        header("Location: admin.php");
        exit(); // Penting: pastikan untuk keluar dari skrip setelah redirect
    } else {
        // Jika terjadi kesalahan saat eksekusi query
        die("Query Error: ".mysqli_errno($connection)." - ".mysqli_error($connection));
    }
} else {
    // Jika $_POST tidak mengandung kunci yang diharapkan
    die("Error: Data tidak lengkap");
}

// Tutup koneksi database (opsional, tergantung kebutuhan)
mysqli_close($connection);
?>

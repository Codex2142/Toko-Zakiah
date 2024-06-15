<?php
include("koneksi.php");

if (isset($_POST['namaProduk'], $_POST['ukuranProduk'], $_POST['hargaBeli'], $_POST['hargaGrosir'])) {
    $namaProduk = $_POST['namaProduk'];
    $ukuranProduk = $_POST['ukuranProduk'];
    $hargaBeli = $_POST['hargaBeli'];
    $hargaGrosir = $_POST['hargaGrosir'];

    $query = "INSERT INTO produk (nama, ukuran, harga_beli, harga_grosir) VALUES ('$namaProduk', '$ukuranProduk', $hargaBeli, $hargaGrosir)";

    $result = mysqli_query($connection, $query);

    if($result) {
        header("Location: admin.php");
        exit();
    } else {
        die("Query Error: ".mysqli_errno($connection)." - ".mysqli_error($connection));
    }
} else {
    die("Error: Data tidak lengkap");
}

mysqli_close($connection);
?>

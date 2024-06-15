<?php
    include("koneksi.php");

    // Inisialisasi variabel pencarian
    $keyword = "";
    if(isset($_GET['keyword'])) {
        $keyword = $_GET['keyword'];
    }

    // Handle reset pencarian
    if(isset($_GET['reset'])) {
        $keyword = ""; // Reset nilai keyword menjadi kosong
    }

    // Ambil ID produk dari parameter URL
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        
        // Query untuk mengambil data produk berdasarkan ID
        $query = "SELECT * FROM produk WHERE no = $id";
        $result = mysqli_query($connection, $query);
        
        // Memeriksa apakah data ditemukan
        if(mysqli_num_rows($result) == 1) {
            $data = mysqli_fetch_assoc($result);
        } else {
            echo "Produk tidak ditemukan.";
            exit;
        }
    } else {
        echo "ID produk tidak ditemukan.";
        exit;
    }

    // Memproses form jika ada POST data
    if(isset($_POST['submit'])) {
        // Ambil data yang di-post
        $nama = $_POST['nama'];
        $ukuran = $_POST['ukuran'];
        $harga_beli = $_POST['harga_beli'];
        $harga_grosir = $_POST['harga_grosir'];

        // Query untuk update data produk berdasarkan ID
        $update_query = "UPDATE produk SET 
                        nama = '$nama', 
                        ukuran = '$ukuran', 
                        harga_beli = '$harga_beli', 
                        harga_grosir = '$harga_grosir' 
                        WHERE no = $id";

        $update_result = mysqli_query($connection, $update_query);

        if($update_result) {
            echo '<div class="alert alert-success" role="alert">
                    Data produk berhasil diperbarui.
                  </div>';
            header("location: admin.php");
            exit; // Pastikan untuk keluar dari script setelah header() redirect
        } else {
            echo '<div class="alert alert-danger" role="alert">
                    Gagal memperbarui data produk: '.mysqli_error($connection).'
                  </div>';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <div class="container mt-5">
        <h1 class="h1">Edit Produk</h1>
        
        <form action="" method="post">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Produk</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $data['nama']; ?>">
            </div>
            <div class="mb-3">
                <label for="ukuran" class="form-label">Ukuran</label>
                <input type="text" class="form-control" id="ukuran" name="ukuran" value="<?php echo $data['ukuran']; ?>">
            </div>
            <div class="mb-3">
                <label for="harga_beli" class="form-label">Harga Beli</label>
                <input type="number" class="form-control" id="harga_beli" name="harga_beli" value="<?php echo $data['harga_beli']; ?>">
            </div>
            <div class="mb-3">
                <label for="harga_grosir" class="form-label">Harga Grosir</label>
                <input type="number" class="form-control" id="harga_grosir" name="harga_grosir" value="<?php echo $data['harga_grosir']; ?>">
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Simpan Perubahan</button>
            <a href="admin.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

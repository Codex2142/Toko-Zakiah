<?php
    include("koneksi.php");
    session_start();

    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
        header('Location: login.php');
        exit();
    }

    // Check if session has expired
    if (time() > $_SESSION['expire_time']) {
        session_unset();
        session_destroy();
        header('Location: login.php');
        exit();
    }

    // Inisialisasi variabel pencarian
    $keyword = "";
    if(isset($_GET['keyword'])) {
        $keyword = $_GET['keyword'];
    }

    // Handle reset pencarian
    if(isset($_GET['reset'])) {
        $keyword = ""; // Reset nilai keyword menjadi kosong
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk Kami</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="../style/style.css" />
</head>
<body>

    <div class="container mt-5">
        <h1 class="h1">Daftar <span>Produk</span></h1>
        <a href="tambah_produk.php" class="btn btn-primary mb-3">Tambah Produk</a>
        
        <!-- Form pencarian -->
        <form action="" method="get" class="mb-3">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Cari produk..." name="keyword" value="<?php echo $keyword; ?>">
                <button type="submit" class="btn btn-primary">Cari</button>
                <?php if(!empty($keyword)): ?>
                    <a href="?reset" class="btn btn-secondary">Reset</a>
                <?php endif; ?>
            </div>
        </form>
        <!-- End Form pencarian -->

        <!-- Tabel produk -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Produk</th>
                    <th scope="col">Ukuran</th>
                    <th scope="col">Harga Beli</th>
                    <th scope="col">Harga Grosir</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Hapus</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                if(empty($keyword)) {
                    $query = "SELECT * FROM produk";
                } else {
                    $query = "SELECT * FROM produk WHERE nama LIKE '%$keyword%' OR ukuran LIKE '%$keyword%'";
                }
                $result = mysqli_query($connection, $query);
                if(!$result) {
                    die ("Query Error: ".mysqli_errno($connection)." - ".mysqli_error($connection));
                }
                while($data = mysqli_fetch_assoc($result)){ 
                    echo "<tr>
                            <th scope='row'>$no</th>
                            <td>$data[nama]</td>
                            <td>$data[ukuran]</td>
                            <td>$data[harga_beli]</td>
                            <td>$data[harga_grosir]</td>
                            <td><a href='edit_produk.php?id=$data[no]' class='btn btn-primary btn-sm'>Edit</a></td>
                            <td><a href='hapus_produk.php?id=$data[no]' class='btn btn-danger btn-sm' onclick='return confirmDelete(\"$data[nama]\",\"$data[ukuran]\",\"$data[harga_beli]\",\"$data[harga_grosir]\", $data[no])'>Hapus</a></td>
                        </tr>";
                    $no++;
                }
                ?>
            </tbody>
        </table>
        <!-- End Tabel produk -->
    </div>

    <!-- Modal Konfirmasi Hapus -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Konfirmasi Hapus Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th scope="row">Nama Produk</th>
                                <td><span id="productNameToDelete"></span></td>
                            </tr>
                            <tr>
                                <th scope="row">Ukuran</th>
                                <td><span id="productSizeToDelete"></span></td>
                            </tr>
                            <tr>
                                <th scope="row">Harga Beli</th>
                                <td><span id="productPurchasePriceToDelete"></span></td>
                            </tr>
                            <tr>
                                <th scope="row">Harga Grosir</th>
                                <td><span id="productWholesalePriceToDelete"></span></td>
                            </tr>
                        </tbody>
                    </table>
                    <p class="text-danger">Apakah Anda yakin ingin menghapus produk ini?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <a id="deleteProductLink" href="#" class="btn btn-danger">Hapus</a>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal Konfirmasi Hapus -->

    <!-- Bootstrap JavaScript (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
    <!-- Script JavaScript untuk konfirmasi hapus -->
    <!-- Script JavaScript untuk modal konfirmasi hapus -->
    <script>
        function confirmDelete(namaProduk, ukuranProduk, beliProduk, grosirProduk ,idProduk) {
            // Set nama produk yang akan dihapus di modal
            document.getElementById('productNameToDelete').innerText = namaProduk;
            document.getElementById('productSizeToDelete').innerText = ukuranProduk;
            document.getElementById('productPurchasePriceToDelete').innerText = beliProduk;
            document.getElementById('productWholesalePriceToDelete').innerText = grosirProduk;

            // Set link untuk menghapus produk di modal
            document.getElementById('deleteProductLink').setAttribute('href', `hapus_produk.php?id=${idProduk}`);

            // Show the modal
            var myModal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'));
            myModal.show();

            return false; // Prevent the default action
        }
    </script>
    <!-- End Script JavaScript untuk modal konfirmasi hapus -->

</body>
</html>

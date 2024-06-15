<?php
    include("koneksi.php"); // Include file koneksi.php untuk menghubungkan ke database

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
    <!-- start navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">TOKO ZAKIAH</a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarNav"
          aria-controls="navbarNav"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="../index.html">Beranda</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../html/tim.html">Tim Kami</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="#">Produk Kami</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../html/lokasi.html">Lokasi Kami</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- end navbar -->
     
    <div class="container mt-5">
        <h1 class="h1">Daftar <span>Produk</span></h1>
        
        <!-- Form pencarian -->
        <form action="" method="get" class="mb-3">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Cari produk..." name="keyword" value="<?php echo htmlspecialchars($keyword); ?>">
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
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                // Query berdasarkan keyword pencarian
                if(empty($keyword)) {
                    $query = "SELECT * FROM produk";
                } else {
                    $query = "SELECT * FROM produk WHERE nama LIKE '%$keyword%' OR ukuran LIKE '%$keyword%'";
                }
                $result = mysqli_query($connection, $query);
                if(!$result) {
                    die ("Query Error: ".mysqli_errno($connection)." - ".mysqli_error($connection));
                }
                // Menampilkan data hasil pencarian dalam tabel
                while($data = mysqli_fetch_assoc($result)){ 
                    echo "<tr>
                            <th scope='row'>$no</th>
                            <td>$data[nama]</td>
                            <td>$data[ukuran]</td>
                            <td>$data[harga_beli]</td>
                            <td>$data[harga_grosir]</td>
                        </tr>";
                    $no++;
                }
                ?>
            </tbody>
        </table>
        <!-- End Tabel produk -->
    </div>

    <!-- Bootstrap JavaScript (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
</body>
</html>

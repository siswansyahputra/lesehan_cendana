<?php
session_start();
include('koneksi.php');
$sql_identitas = "SELECT * FROM identitas";
$query_identitas = mysqli_query($koneksi, $sql_identitas);
$data_identitas = mysqli_fetch_array($query_identitas);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="icons/icon-192x192.png">
    <title>App</title>
    <link rel="stylesheet" href="bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <link rel="manifest" href="manifest.json">
</head>

<body class="bg-light">
    <nav class="navbar navbar-expand-lg shadow-sm" style="background-color: #e3f2fd;">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php?module=home">
                <img src="icons/icon-192x192.png" alt="Logo" width="30" height="24"
                    class="d-inline-block align-text-top">
                <?php echo $data_identitas['nama']; ?>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php?module=home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?module=identitas">
                            Identitas
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?module=penjualan">Penjualan</a>
                    </li>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?module=menu">Menu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?module=meja">Nomor Meja</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?module=kasir">Kasir</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container-fluid">
        <?php
        require_once('media.php');
        ?>
    </div>
    <div class="container-fluid mt-3">
        <div class="row py-2">
            <div class="col-12 text-center">
                <span class="text-muted">&copy; Copyright <?php echo date('Y'); ?> - <?php echo $data_identitas['nama']; ?></span>
            </div>
        </div>
    </div>
    <script src="script.js"></script>
    <script src="bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
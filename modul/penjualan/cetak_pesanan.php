<?php
include "../../koneksi.php";
$identitas = $koneksi->query("SELECT * FROM identitas")->fetch_assoc();

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Ambil data penjualan
    $penjualan = $koneksi->query("SELECT a.*, b.nama_meja FROM penjualan a INNER JOIN meja b ON a.id_meja = b.id WHERE a.id = '$id'")->fetch_assoc();

    // Ambil detail makanan
    $statusMakanan = 0;
    $detailMakanan = $koneksi->query("SELECT b.nama_menu, a.harga, a.diskon, a.jumlah, (a.harga - a.diskon) * a.jumlah AS total FROM detail_penjualan a INNER JOIN menu b ON a.id_menu = b.id WHERE a.id_penjualan = '$id' AND b.kategori != 'Minuman'");
    // cek num rows
    if ($detailMakanan->num_rows > 0) {
        $statusMakanan = 1;
    }

    // Ambil detail minuman
    $statusMinuman = 0;
    $detailMinuman = $koneksi->query("SELECT b.nama_menu, a.harga, a.diskon, a.jumlah, (a.harga - a.diskon) * a.jumlah AS total FROM detail_penjualan a INNER JOIN menu b ON a.id_menu = b.id WHERE a.id_penjualan = '$id' AND b.kategori = 'Minuman'");
    // cek num rows
    if ($detailMinuman->num_rows > 0) {
        $statusMinuman = 1;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Struk</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        .container {
            width: 80mm;
            margin: auto;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            text-align: left;
            padding: 5px;
        }

        hr {
            border: none;
            border-top: 1px dashed #000;
        }
    </style>
</head>

<body onload="window.print()">
    <div class="container">
        <?php
        if($statusMakanan == 1){
        ?>
        <p>Detail Makanan</p>
        <hr>
        <p>No. Transaksi: <?= $penjualan['id']; ?></p>
        <p>Tanggal: <?= $penjualan['tanggal']; ?></p>
        <p>Meja: <?= $penjualan['nama_meja']; ?></p>
        <hr>
        <table>
            <thead>
                <tr>
                    <th>Menu</th>
                    <th class="text-right">Qty</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $detailMakanan->fetch_assoc()) { ?>
                    <tr>
                        <td><?= $row['nama_menu']; ?></td>
                        <td class="text-right"><?= $row['jumlah']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <hr>
        <?php
        }
        if($statusMinuman == 1){
        ?>
        <p>Detail Minuman</p>
        <hr>
        <p>No. Transaksi: <?= $penjualan['id']; ?></p>
        <p>Tanggal: <?= $penjualan['tanggal']; ?></p>
        <p>Meja: <?= $penjualan['nama_meja']; ?></p>
        <hr>
        <table>
            <thead>
                <tr>
                    <th>Menu</th>
                    <th class="text-right">Qty</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $detailMinuman->fetch_assoc()) { ?>
                    <tr>
                        <td><?= $row['nama_menu']; ?></td>
                        <td class="text-right"><?= $row['jumlah']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <hr>
        <?php
        }
        ?>
    </div>
</body>

</html>
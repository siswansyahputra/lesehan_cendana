<?php
include "../../koneksi.php";
$identitas = $koneksi->query("SELECT * FROM identitas")->fetch_assoc();

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Ambil data penjualan
    $penjualan = $koneksi->query("SELECT a.*, b.nama_meja FROM penjualan a INNER JOIN meja b ON a.id_meja = b.id WHERE a.id = '$id'")->fetch_assoc();

    // Ambil detail penjualan
    $detail = $koneksi->query("SELECT b.nama_menu, a.harga, a.diskon, a.jumlah, (a.harga - a.diskon) * a.jumlah AS total FROM detail_penjualan a INNER JOIN menu b ON a.id_menu = b.id WHERE a.id_penjualan = '$id'");
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
        <div class="text-center">
            <h2><?= $identitas['nama']; ?></h2>
            <p><?= $identitas['alamat']; ?></p>
            <p>No. Telp: <?= $identitas['telepon']; ?></p>
        </div>
        <hr>
        <p>No. Transaksi: <?= $penjualan['id']; ?></p>
        <p>Tanggal: <?= $penjualan['tanggal']; ?></p>
        <p>Meja: <?= $penjualan['nama_meja']; ?></p>
        <hr>
        <table>
            <thead>
                <tr>
                    <th>Menu</th>
                    <th class="text-right">Harga</th>
                    <th class="text-right">Qty</th>
                    <th class="text-right">Total</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $detail->fetch_assoc()) { ?>
                    <tr>
                        <td><?= $row['nama_menu']; ?></td>
                        <td class="text-right"><?= number_format($row['harga'], 0); ?></td>
                        <td class="text-right"><?= $row['jumlah']; ?></td>
                        <td class="text-right"><?= number_format($row['total'], 0); ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <hr>
        <table>
            <tr>
                <td>Total Diskon</td>
                <td class="text-right">Rp. <?= number_format($penjualan['total_diskon'], 0); ?></td>
            </tr>
            <tr>
                <td>Total Pembayaran</td>
                <td class="text-right">Rp. <?= number_format($penjualan['total_pembayaran'], 0); ?></td>
            </tr>
        </table>
        <hr>
        <p class="text-center">Terima kasih atas kunjungan Anda!</p>
    </div>
</body>

</html>
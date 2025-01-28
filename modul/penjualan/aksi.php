<?php
require_once('../../koneksi.php');

if (isset($_GET['aksi'])) {
    $aksi = $_GET['aksi'];
    if($aksi == 'hapus'){
        $id = $_GET['id'];
        $koneksi->query("delete from penjualan where id = '$id'");
        $koneksi->query("delete from detail_penjualan where id_penjualan = '$id'");
    }elseif($aksi == 'bayar'){
        $id = $_GET['id'];
        $tunai = $_POST['tunai'];
        $kembalian = $_POST['kembalian'];
        $catatan = $_POST['catatan'];
        $koneksi->query("update penjualan set tanggal=NOW(), tunai = '$tunai', kembalian = '$kembalian', catatan = '$catatan', status = 'Selesai' where id = '$id'");
    }
}
header("location:../../index.php?module=penjualan");
?>
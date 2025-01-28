<?php
require_once('../../koneksi.php');
if($_GET['aksi'] == 'tambah') {
    $nama_menu = $_POST['nama_menu'];
    $harga = $_POST['harga'];
    $diskon = $_POST['diskon'];
    $kategori = $_POST['kategori'];
    $sql_tambah = "INSERT INTO menu (nama_menu, harga, diskon, kategori, created_at, updated_at) VALUES ('$nama_menu', '$harga', '$diskon', '$kategori', NOW(), NOW())";
    $query_tambah = mysqli_query($koneksi, $sql_tambah);
    if ($query_tambah) {
        header('location:../../index.php?module=menu');
    }
}elseif($_GET['aksi'] == 'update') {
    $id = $_GET['id'];
    $nama_menu = $_POST['nama_menu'];
    $harga = $_POST['harga'];
    $diskon = $_POST['diskon'];
    $kategori = $_POST['kategori'];
    $status = $_POST['status'];
    $sql_update = "UPDATE menu SET nama_menu = '$nama_menu', harga = '$harga', diskon = '$diskon', kategori = '$kategori', status = '$status', updated_at = NOW() WHERE id = '$id'";
    $query_update = mysqli_query($koneksi, $sql_update);
    if ($query_update) {
        header('location:../../index.php?module=menu');
    }
}elseif($_GET['aksi'] == 'hapus') {
    $id = $_GET['id'];
    $sql_hapus = "DELETE FROM menu WHERE id = '$id'";
    $query_hapus = mysqli_query($koneksi, $sql_hapus);
    if ($query_hapus) {
        header('location:../../index.php?module=menu');
    }
}
?>
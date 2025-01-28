<?php
require_once('../../koneksi.php');

if (isset($_GET['aksi'])) {
    $aksi = $_GET['aksi'];
    if ($aksi == 'tambah') {
        $nama_meja = $_POST['nama_meja'];
        $sql = "INSERT INTO meja (nama_meja, created_at, updated_at) VALUES ('$nama_meja', NOW(), NOW())";
        $query = mysqli_query($koneksi, $sql);
        if ($query) {
            header('location:../../index.php?module=meja');
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($koneksi);
        }
    } elseif ($aksi == 'edit') {
        $id_meja = $_GET['id'];
        $nama_meja = $_POST['nama_meja'];
        $sql = "UPDATE meja SET nama_meja='$nama_meja', updated_at=NOW() WHERE id='$id_meja'";
        $query = mysqli_query($koneksi, $sql);
        if ($query) {
            header('location:../../index.php?module=meja');
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($koneksi);
        }
    } elseif ($aksi == 'hapus') {
        $id_meja = $_GET['id'];
        $sql = "DELETE FROM meja WHERE id='$id_meja'";
        $query = mysqli_query($koneksi, $sql);
        if ($query) {
            header('location:../../index.php?module=meja');
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($koneksi);
        }
    }
}
?>
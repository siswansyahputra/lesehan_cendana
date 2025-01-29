<?php
session_start();
require_once('../../koneksi.php');
$id = $_GET['id'];
$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$telepon = $_POST['telepon'];

if(isset($_GET['aksi'])){
    if($_GET['aksi'] == 'update'){
        $query = $koneksi->query("UPDATE identitas SET nama = '$nama', alamat = '$alamat', telepon = '$telepon' WHERE id = '$id'");
        if($query){
            // kirim pesan sukses dari session
            $_SESSION['pesan'] = 'Data identitas berhasil diubah';
            header('location:../../main.php?module=identitas');
        }
    }
}
?>
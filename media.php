<?php
if (isset($_GET['module'])) {
    $module = $_GET['module'];
    if ($module == 'home') {
        include('modul/home/index.php');
    } elseif ($module == 'penjualan') {
        include('modul/penjualan/index.php');
    } elseif ($module == 'menu') {
        include('modul/menu/index.php');
    } elseif ($module == 'kasir') {
        include('modul/kasir/index.php');
    } elseif ($module == 'meja') {
        include('modul/meja/index.php');  
    } elseif ($module == 'identitas') {
        include('modul/identitas/index.php');
    } 
    else {
        include('modul/home/index.php');
    }
}else{
    include('modul/home/index.php');
}

?>
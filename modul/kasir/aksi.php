<?php
require_once '../../koneksi.php';

// buat response untuk json
header('Content-Type: application/json');
$method = $_SERVER['REQUEST_METHOD'];
if ($method === 'POST') {
    try {
        $data = json_decode(file_get_contents('php://input'), true);
        $id_meja = $data['id_meja'];
        $total_diskon = $data['total_diskon'];
        $total_pembayaran = $data['total_pembayaran'];
        $status = "Proses";

        $query = "INSERT INTO penjualan (tanggal,id_meja, total_diskon, total_pembayaran, status, created_at, updated_at) VALUES (NOW(),'$id_meja', '$total_diskon', '$total_pembayaran', '$status', NOW(), NOW())";
        $koneksi->query($query);

        // Ambil ID penjualan terakhir
        $id_penjualan = $koneksi->insert_id;

        $pesanan = $data['pesanan'];
        foreach ($pesanan as $item) {
            $id_menu = $item['id'];
            $jumlah = $item['jumlah'];
            $harga = $item['harga'];
            $diskon = $item['diskon'];
            $total = $item['total'];

            $query = "INSERT INTO detail_penjualan (id_penjualan, id_menu, jumlah, harga, diskon, total) VALUES ('$id_penjualan', '$id_menu', '$jumlah', '$harga', '$diskon', '$total')";
            $koneksi->query($query);
        }
        echo json_encode(['status' => 'success', 'message' => 'Pesanan berhasil disimpan']);
        
    } catch (\Throwable $th) {
        echo json_encode(['status' => 'error', 'message' => $th->getMessage()]);
    }
}
?>
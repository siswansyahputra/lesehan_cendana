<?php
header("Content-Type: application/json");

require_once('../../koneksi.php');

if ($koneksi->connect_error) {
    die(json_encode(["error" => "Connection failed: " . $koneksi->connect_error]));
}

$sql = "SELECT * FROM meja";
$result = $koneksi->query($sql);

$meja_items = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $meja_items[] = $row;
    }
    echo json_encode(["success" => true, "data" => $meja_items]);
} else {
    echo json_encode(["success" => false, "message" => "No meja found"]);
}

$koneksi->close();

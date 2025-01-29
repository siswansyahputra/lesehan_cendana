<?php
header("Content-Type: application/json");

require_once('../../koneksi.php');

if ($koneksi->connect_error) {
    die(json_encode(["error" => "Connection failed: " . $koneksi->connect_error]));
}

$sql = "SELECT * FROM menu";
$result = $koneksi->query($sql);

$menu_items = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $menu_items[] = $row;
    }
    echo json_encode(["success" => true, "data" => $menu_items]);
} else {
    echo json_encode(["success" => false, "message" => "No menu found"]);
}

$koneksi->close();

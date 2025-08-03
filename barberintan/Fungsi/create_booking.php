<?php
header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'koneksi.php';

// Ambil input JSON
$data = json_decode(file_get_contents("php://input"), true);

// Validasi minimal
if (!$data) {
    echo json_encode(["success" => false, "message" => "Data tidak valid."]);
    exit;
}

// Ambil data booking
$id_pelanggan = $data['id_pelanggan'];
$id_layanan = $data['id_layanan'];
$waktu_booking = $data['waktu_booking'];
$harga_total = $data['harga_total'];
$catatan = $data['catatan'] ?? '';

// SQL Simpan booking
$sql = "INSERT INTO booking (id_pelanggan, id_layanan, waktu_booking, harga_total, catatan)
        VALUES (?, ?, ?, ?, ?)";

$stmt = $koneksi->prepare($sql);
if (!$stmt) {
    echo json_encode(["success" => false, "message" => "Gagal menyiapkan query."]);
    exit;
}

$stmt->bind_param("iisds", $id_pelanggan, $id_layanan, $waktu_booking, $harga_total, $catatan);

if ($stmt->execute()) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "message" => "Gagal menyimpan booking."]);
}
?>

<?php
header('Content-Type: application/json');
require 'koneksi.php';

$sql = "SELECT id_layanan, nama_layanan, deskripsi, harga, durasi_menit, aktif FROM layanan WHERE aktif = 1";
$result = $koneksi->query($sql);

$layanan = [];
while ($row = $result->fetch_assoc()) {
    $layanan[] = $row;
}

echo json_encode($layanan);
?>

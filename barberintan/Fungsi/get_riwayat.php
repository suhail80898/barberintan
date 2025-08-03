<?php
header('Content-Type: application/json');
require 'koneksi.php';

if (!isset($_GET['id_pelanggan'])) {
    echo json_encode(['success' => false, 'message' => 'ID pelanggan dibutuhkan']);
    exit;
}

$id = intval($_GET['id_pelanggan']);

$query = $koneksi->prepare("SELECT b.*, l.nama_layanan FROM booking b 
    LEFT JOIN layanan l ON b.id_layanan = l.id_layanan 
    WHERE b.id_pelanggan = ? ORDER BY b.waktu_booking DESC");
$query->bind_param("i", $id);
$query->execute();

$result = $query->get_result()->fetch_all(MYSQLI_ASSOC);

echo json_encode([
    'success' => true,
    'riwayat' => $result
]);

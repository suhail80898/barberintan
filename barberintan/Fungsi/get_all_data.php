<?php
header('Content-Type: application/json');
require 'koneksi.php';

$response = [];

try {
    // Ambil data pelanggan
    $pelanggan = $koneksi->query("SELECT * FROM pelanggan")->fetch_all(MYSQLI_ASSOC);
    $response['pelanggan'] = $pelanggan;

    // Ambil data layanan
    $layananRaw = $koneksi->query("SELECT * FROM layanan")->fetch_all(MYSQLI_ASSOC);
    $layanan = [];
    foreach ($layananRaw as $l) {
        $l['aktif'] = (bool) $l['aktif'];
        $l['harga'] = (float) $l['harga'];
        $layanan[] = $l;
    }
    $response['layanan'] = $layanan;

    // Ambil data booking
    $bookingRaw = $koneksi->query("SELECT * FROM booking")->fetch_all(MYSQLI_ASSOC);
    $booking = [];
    foreach ($bookingRaw as $b) {
        $b['harga_total'] = isset($b['harga_total']) ? (float) $b['harga_total'] : 0;
        $b['waktu_booking'] = $b['waktu_booking'] ?? ''; // hindari null
        $b['status'] = $b['status'] ?? 'Pending';
        $booking[] = $b;
    }
    $response['booking'] = $booking;

    echo json_encode([
        'success' => true,
        'data' => $response
    ]);
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
?>

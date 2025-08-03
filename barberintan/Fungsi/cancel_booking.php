<?php
header('Content-Type: application/json');
require 'koneksi.php';

$data = json_decode(file_get_contents("php://input"), true);
$id_booking = $data['id_booking'] ?? null;
$by_admin = $data['by_admin'] ?? false;

if (!$id_booking) {
    echo json_encode(["success" => false, "message" => "ID booking tidak ditemukan"]);
    exit;
}

// Ambil data booking
$query = $koneksi->prepare("SELECT waktu_booking, status FROM booking WHERE id_booking = ?");
$query->bind_param("i", $id_booking);
$query->execute();
$result = $query->get_result();

if ($result->num_rows === 0) {
    echo json_encode(["success" => false, "message" => "Booking tidak ditemukan"]);
    exit;
}

$booking = $result->fetch_assoc();
$waktu_booking = strtotime($booking['waktu_booking']);
$sekarang = time();

// Validasi waktu (hanya untuk pelanggan)
if (!$by_admin && ($waktu_booking - $sekarang < 3600)) {
    echo json_encode(["success" => false, "message" => "Tidak bisa membatalkan booking kurang dari 1 jam sebelum waktu booking."]);
    exit;
}

// Cek status hanya boleh jika Pending atau Confirmed
if (!in_array($booking['status'], ['Pending', 'Confirmed'])) {
    echo json_encode(["success" => false, "message" => "Booking tidak bisa dibatalkan karena sudah diproses."]);
    exit;
}

// Update status ke Cancelled
$update = $koneksi->prepare("UPDATE booking SET status = 'Cancelled' WHERE id_booking = ?");
$update->bind_param("i", $id_booking);
$success = $update->execute();

if ($success) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "message" => "Gagal membatalkan booking."]);
}

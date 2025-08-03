<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

include 'koneksi.php';
header('Content-Type: application/json');

$tanggal = $_GET['tanggal'] ?? '';

if (!$tanggal) {
    echo json_encode(["success" => false, "message" => "Tanggal tidak valid"]);
    exit;
}

$booked_times = [];

// Bandingkan dengan tanggal hari ini
$today = date('Y-m-d');

if ($tanggal < $today) {
    // Lewat dari hari ini = abaikan (tidak tampilkan)
    echo json_encode(["success" => true, "booked_times" => []]);
    exit;
} elseif ($tanggal === $today) {
    // Hari ini → ambil hanya jam yang belum lewat
    $sql = "SELECT waktu_booking FROM booking 
            WHERE DATE(waktu_booking) = ?
            AND TIME(waktu_booking) >= TIME(NOW())
            AND status != 'Cancelled'";
} else {
    // Besok atau seterusnya → ambil semua booking di tanggal itu
    $sql = "SELECT waktu_booking FROM booking 
            WHERE DATE(waktu_booking) = ?
            AND status != 'Cancelled'";
}

$stmt = $koneksi->prepare($sql);
if (!$stmt) {
    echo json_encode(["success" => false, "message" => "Prepare failed", "error" => $koneksi->error]);
    exit;
}

$stmt->bind_param("s", $tanggal);

if (!$stmt->execute()) {
    echo json_encode(["success" => false, "message" => "Execute failed", "error" => $stmt->error]);
    exit;
}

$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    $time = date('H:i', strtotime($row['waktu_booking']));
    $booked_times[] = $time;
}

echo json_encode(["success" => true, "booked_times" => $booked_times]);
?>

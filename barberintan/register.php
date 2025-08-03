<?php
header('Content-Type: application/json');
require 'koneksi.php';

$data = json_decode(file_get_contents('php://input'), true);

$nama     = $data['nama_lengkap'];
$email    = $data['email'];
$telepon  = $data['nomor_telepon'];
$password = $data['password'];


$cek = $koneksi->prepare("SELECT id_pelanggan FROM pelanggan WHERE email = ?");
$cek->bind_param("s", $email);
$cek->execute();
$cekResult = $cek->get_result();

if ($cekResult->num_rows > 0) {
    echo json_encode(["success" => false, "message" => "Email sudah terdaftar"]);
    exit;
}

$hash = password_hash($password, PASSWORD_DEFAULT);

$stmt = $koneksi->prepare("INSERT INTO pelanggan (nama_lengkap, email, nomor_telepon, password_hash) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $nama, $email, $telepon, $hash);
$stmt->execute();

echo json_encode([
    "success" => true,
    "message" => "Registrasi berhasil",
    "id_pelanggan" => $stmt->insert_id
]);
?>

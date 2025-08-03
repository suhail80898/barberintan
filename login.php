<?php
header('Content-Type: application/json');
require 'koneksi.php';

$data = json_decode(file_get_contents("php://input"), true);
$email = $data['email'] ?? '';
$password = $data['password'] ?? '';

$response = ['success' => false];

// Cek ke tabel admin dulu
$stmt = $koneksi->prepare("SELECT * FROM admin WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();   
$resultAdmin = $stmt->get_result();

if ($resultAdmin->num_rows > 0) {
    $admin = $resultAdmin->fetch_assoc();
    if ($admin['password'] === $password) {
        $response['success'] = true;
        $response['role'] = 'admin';
        $response['user'] = $admin;
    } else {
        $response['message'] = 'Password salah.';
    }
} else {
    $stmt = $koneksi->prepare("SELECT * FROM pelanggan WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultUser = $stmt->get_result();

    if ($resultUser->num_rows > 0) {
        $user = $resultUser->fetch_assoc();
        if (password_verify($password, $user['password_hash'])) {
            $response['success'] = true;
            $response['role'] = 'pelanggan';
            $response['user'] = $user;
        } else {
            $response['message'] = 'Password salah.';
        }
    } else {
        $response['message'] = 'Email tidak ditemukan.';
    }
}

echo json_encode($response);
?>

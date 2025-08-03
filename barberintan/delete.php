<?php
header('Content-Type: application/json');
require 'koneksi.php';

$table = $_GET['table'] ?? '';
$id = $_GET['id'] ?? '';
$response = ['success' => false];

try {
    if (!in_array($table, ['pelanggan', 'staf', 'layanan', 'booking'])) {
        throw new Exception("Tabel tidak valid.");
    }

    $id_field = "id_$table";

    $stmt = $koneksi->prepare("DELETE FROM $table WHERE $id_field = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    $response['success'] = true;
} catch (Exception $e) {
    $response['message'] = $e->getMessage();
}

echo json_encode($response);
?>

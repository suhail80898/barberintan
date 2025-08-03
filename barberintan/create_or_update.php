<?php
header('Content-Type: application/json');
require 'koneksi.php';

$data = json_decode(file_get_contents("php://input"), true);
$table = $_GET['table'] ?? '';
$response = ['success' => false];

try {
    if (!in_array($table, ['pelanggan', 'staf', 'layanan', 'booking'])) {
        throw new Exception("Tabel tidak valid.");
    }

    $id_field = "id_$table";
    $id = $data[$id_field] ?? null;
    unset($data[$id_field]);

    $columns = array_keys($data);
    $values = array_values($data);

    $types = '';
    foreach ($values as $v) {
        if (is_int($v)) $types .= 'i';
        elseif (is_float($v)) $types .= 'd';
        else $types .= 's';
    }

    if ($id) {
        // UPDATE
        $set_clause = implode(', ', array_map(fn($col) => "$col = ?", $columns));
        $sql = "UPDATE $table SET $set_clause WHERE $id_field = ?";
        $types .= 'i';
        $values[] = $id;
    } else {
        // INSERT
        $cols = implode(', ', $columns);
        $placeholders = implode(', ', array_fill(0, count($columns), '?'));
        $sql = "INSERT INTO $table ($cols) VALUES ($placeholders)";
    }

    $stmt = $koneksi->prepare($sql);
    if (!$stmt) {
        throw new Exception("Gagal prepare statement: " . $koneksi->error);
    }

    $stmt->bind_param($types, ...$values);
    $stmt->execute();

    if ($stmt->affected_rows >= 0) {
        $response['success'] = true;
        $response['id'] = $id ?: $stmt->insert_id;
    } else {
        throw new Exception("Query tidak berhasil dieksekusi.");
    }

} catch (Exception $e) {
    $response['message'] = $e->getMessage();
}

echo json_encode($response);
?>

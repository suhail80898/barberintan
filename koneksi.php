<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'pangkas_rambut_berintan';

$koneksi = new mysqli($host, $user, $pass, $db);
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}
?>

<?php
// Koneksi ke database
include('../koneksi.php');

// Cek apakah ID tersedia di URL
if (!isset($_GET['id'])) {
    header('Location: managementTheater.php?message=error');
    exit();
}

$id = $_GET['id'];

// Query untuk menghapus data berdasarkan ID
$query = "DELETE FROM theatres WHERE id = '$id'";

if ($db->query($query)) {
    // Redirect kembali ke halaman utama dengan pesan sukses
    header("Location: managementTheater.php?message=deleted");
    exit();
} else {
    // Jika query gagal
    header("Location: managementTheater.php?message=error");
    exit();
}
?>

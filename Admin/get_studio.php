<?php
include '../koneksi.php';

if (isset($_GET['id_theatres'])) {
    $id_theatres = $_GET['id_theatres'];

    // Ambil data studio berdasarkan theatres_id
    $query = "SELECT id_studio, nama_studio FROM studio WHERE id_theatres = '$id_theatres'";
    $result = $db->query($query);

    $studio = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $studio[] = $row;
        }
    }

    // Kembalikan data sebagai JSON
    echo json_encode($studio);
}

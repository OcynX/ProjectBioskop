<?php
include 'koneksi.php';

// Contoh jadwal_id, ganti sesuai data Anda
$jadwal_id = 1; 

// Tentukan jumlah baris dan kolom kursi
$rows = ['A', 'B', 'C']; // Baris kursi
$cols = 5; // Kolom kursi

// Mulai pengisian
$query = "INSERT INTO seats (jadwal_id, seat_number, status) VALUES (?, ?, ?)";
$stmt = $db->prepare($query);

foreach ($rows as $row) {
    for ($col = 1; $col <= $cols; $col++) {
        $seat_number = $row . $col; // Kombinasi baris dan kolom (e.g., A1, B3)
        $status = 'available'; // Status awal
        $stmt->bind_param("iss", $jadwal_id, $seat_number, $status);
        $stmt->execute();
    }
}

echo "Data kursi untuk jadwal_id $jadwal_id berhasil ditambahkan!";
?>

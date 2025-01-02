<?php
session_start();
include 'koneksi.php';

// Ambil ID penjualan dari parameter URL
if (!isset($_GET['penjualan_id'])) {
    die("ID penjualan tidak ditemukan!");
}
$penjualan_id = $_GET['penjualan_id'];

// Query untuk mengambil data tiket terbaru berdasarkan ID penjualan
$query = "SELECT t.customer_name, t.customer_email, t.seat_number, t.price, 
                 j.show_time, m.title AS film, s.nama_studio, th.name AS theatre
          FROM tickets t
          JOIN penjualan p ON t.jadwal_id = p.jadwal_id
          JOIN jadwal j ON t.jadwal_id = j.id
          JOIN movies m ON t.movie_id = m.id
          JOIN studio s ON j.studio_id = s.id_studio
          JOIN theatres th ON j.theatre_id = th.id
          WHERE p.id_penjualan = ?
          ORDER BY t.idtiket DESC"; // Urutkan data tiket berdasarkan ID terbaru

$stmt = $db->prepare($query);
$stmt->bind_param("i", $penjualan_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $ticket = $result->fetch_assoc(); // Ambil hanya tiket terbaru
} else {
    die("Data tiket tidak ditemukan.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Tiket</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="user.css">
    <style>
        .container{
            margin-top:180px;
        }
    </style>
</head>
<body>
    <?php include "Layout/header.php"; ?>

    <div class="container container-fluid" >
        <h2>Detail Tiket Pemesanan</h2>
        <table class="table table-bordered mt-4">
            <tr>
                <th>Nama</th>
                <td><?php echo htmlspecialchars($ticket['customer_name']); ?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><?php echo htmlspecialchars($ticket['customer_email']); ?></td>
            </tr>
            <tr>
                <th>Film</th>
                <td><?php echo htmlspecialchars($ticket['film']); ?></td>
            </tr>
            <tr>
                <th>Theatre</th>
                <td><?php echo htmlspecialchars($ticket['theatre']); ?></td>
            </tr>
            <tr>
                <th>Studio</th>
                <td><?php echo htmlspecialchars($ticket['nama_studio']); ?></td>
            </tr>
            <tr>
                <th>Kursi</th>
                <td><?php echo htmlspecialchars($ticket['seat_number']); ?></td>
            </tr>
            <tr>
                <th>Waktu Tayang</th>
                <td><?php echo htmlspecialchars($ticket['show_time']); ?></td>
            </tr>
            <tr>
                <th>Harga</th>
                <td><?php echo "Rp " . number_format($ticket['price'], 0, ',', '.'); ?></td>
            </tr>
        </table>
    </div>

</body>
</html>

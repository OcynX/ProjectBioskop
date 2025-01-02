<?php
include '../koneksi.php';

$query = "
SELECT 
    movies.title AS judul_film,
    jadwal.show_time AS waktu_tayang,
    tickets.idtiket AS idtiket,
    tickets.customer_name AS nama_customer,
    tickets.customer_email AS email_customer,
    tickets.seat_number AS nomor_kursi,
    tickets.price AS harga_tiket,
    tickets.created_at AS waktu_order,
    tickets.refund_status AS refund_status

    FROM tickets
    INNER JOIN movies ON tickets.movie_id = movies.id
    INNER JOIN jadwal ON  tickets.jadwal_id = jadwal.id
";
$result = $db->query($query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>management ticket</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="admin.css">
    <style>
        .table th, .table td {
            vertical-align: middle;
            text-align: center;
        }
        .table th {
            background-color: #242424;
        }
        
        .btn {
            padding: 5px 10px;
            width:7vw;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            margin: 3px;
        }
        .content {
            margin-left: 250px;
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="d-flex">
    <div class="sidebar">
            <h3 class="p-3">CINEMA21</h3>
            <a href="halamanAdmin.php">Dashboard</a>
            <a href="management_ticket.php">Management Tiket</a>
            <a href="managementTheater.php">Management Bioskop</a>
            <a href="gudangdatafilm.php">Manajemen Film</a>
            <a href="LaporanPenjualan.php">Laporan Penjualan</a>
            <a href="logout.php">Logout</a>
        </div>

        <div class="content">
            <h1>Manajemen tickets</h1>
            <p>Total number of theatres: <?= $result->num_rows; ?></p>
            <div class="table-responsive w-100">
                <table class="table table-dark table-bordered w-100">
                    <thead>
                        <tr>
                            <th>movie</th>
                            <th>jadwal</th>
                            <th>nama customer</th>
                            <th>email</th>
                            <th>kursi</th>
                            <th>order at</th>
                            <td>refund status</td>
                            <th>aksi</th>
                        </tr>
                    </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['judul_film']) ?></td>
                    <td><?= htmlspecialchars($row['waktu_tayang']) ?></td>
                    <td><?= htmlspecialchars($row['nama_customer']) ?></td>
                    <td><?= htmlspecialchars($row['email_customer']) ?></td>
                    <td><?= htmlspecialchars($row['nomor_kursi']) ?></td>
                    <td><?=htmlspecialchars($row['waktu_order'])?> </td>
                    <td><?=htmlspecialchars($row['refund_status'])?> </td>
                    <td>
                        <button class="btn btn-warning btn-sm" onclick="window.location.href='editticket.php?id=<?= $row['idtiket'] ?>'">Edit</button>
                        <button class="btn btn-danger btn-sm" onclick="confirmDelete(<?= $row['idtiket'] ?>)">Hapus</button>   
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>

                </table>
        </div>
    </div>
</body>
</html>
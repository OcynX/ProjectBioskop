<?php
include "../koneksi.php";

// Query untuk mengambil data yang sesuai
$query = "SELECT 
            studio.id_studio, 
            theatres.name AS theatre_name, 
            studio.nama_studio, 
            theatres.contact, 
            studio.kapasitas 
          FROM studio
          INNER JOIN theatres ON studio.id_theatres = theatres.id;";
$result = $db->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="admin.css">
    <style>
        .content {
            width: 100vw;
            margin-left: 250px;
            padding: 20px;
        }
        .table th, .table td {
            vertical-align: middle;
            text-align: center;
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
        .table th {
            background-color: #242424;
        }

        .btn-tambah{
            display: flex;
            width: 100%;
            align-items: end;
            justify-content: end;
        }

        .btn-tambah btn{
            padding: 5px 10px;
            width:7vw;
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar">
            <h3 class="p-3">CINEMA21</h3>
            <a href="halamanAdmin.php">Dashboard</a>
            <a href="management_ticket.php">Management Tiket</a>
            <a href="managementTheater.php">Management Bioskop</a>
            <ul>
                <li><a href="#">Management Studio</a></li>
                <li><a href="#">Jadwal Tayang</a></li>
            </ul>
            <a href="gudangdatafilm.php">Manajemen Film</a>
            <a href="LaporanPenjualan.php">Laporan Penjualan</a>
            <a href="logout.php">Logout</a>
        </div>

        <!-- Content -->
        <div class="content">
            <div class="table-responsive w-100">
                <table class="table table-dark table-bordered w-100">
                    <h1>Manajemen Studio</h1>
                    <div class="btn-tambah">
                        <button class="btn btn-info btn-sm" onclick="window.location.href='tambahstudio.php'">Tambah</button>
                    </div>
                    <p>Total number of theatres: <?= $result->num_rows; ?></p>
                    <thead>
                        <tr>
                            <th>ID Studio</th>
                            <th>Nama Theater</th>
                            <th>Nama Studio</th>
                            <th>Kontak Theater</th>
                            <th>Kapasitas</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?= htmlspecialchars($row['id_studio']) ?></td>
                                <td><?= htmlspecialchars($row['theatre_name']) ?></td>
                                <td><?= htmlspecialchars($row['nama_studio']) ?></td>
                                <td><?= htmlspecialchars($row['contact']) ?></td>
                                <td><?= htmlspecialchars($row['kapasitas']) ?></td>
                                <td>
                                <button class="btn btn-warning btn-sm" onclick="window.location.href='editstudio.php?id=<?= $row['id_studio'] ?>'">Edit</button>
                                    <button class="btn btn-danger btn-sm" onclick="deleteTheatre(<?= $row['id_studio'] ?>)">Hapus</button>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>

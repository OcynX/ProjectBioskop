<?php 
include '../koneksi.php';

// Perbaiki nama variabel dari $query ke $sql
$sql = "
    SELECT
        jadwal.id AS id,
        movies.title AS judul_film,
        jadwal.show_time AS jadwal_tayang,
        jadwal.show_time2 AS jadwal_tayang2,
        jadwal.show_time3 AS jadwal_tayang3,
        jadwal.show_time4 AS jadwal_tayang4,
        theatres.name AS nama_theatre,
        studio.nama_studio AS nama_studio
    FROM jadwal
    INNER JOIN movies ON jadwal.movie_id = movies.id
    INNER JOIN studio ON jadwal.studio_id = studio.id_studio
    INNER JOIN theatres ON studio.id_theatres = theatres.id
";

// Eksekusi query dengan variabel $sql yang sudah benar
$result = $db->query($sql);

// Periksa jika query gagal
if (!$result) {
    die("Query Error: " . $db->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>jadwal</title>
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
<body class="body">
<div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar">
            <h3 class="p-3">CINEMA21</h3>
            <a href="halamanAdmin.php">Dashboard</a>
            <a href="ManagementTicket.php">Management Tiket</a>
            <a href="managementTheater.php">Management Bioskop</a>
            <ul>
                <li><a href="#">Management Studio</a></li>
                <li><a href="jadwal.php">Jadwal Tayang studio</a></li>
            </ul>
            <a href="gudangdatafilm.php">Manajemen Film</a>
            <a href="LaporanPenjualan.php">Laporan Penjualan</a>
            <a href="logout.php">Logout</a>
        </div>

        <!-- Content -->
        <div class="content">
            <div class="table-responsive w-100">
                <table class="table table-dark table-bordered w-100">
                    <h1>Management Jadwal Tayang studio</h1>
                    <div class="btn-tambah">
                        <button class="btn btn-info btn-sm" onclick="window.location.href='tambahstudio.php'">Tambah</button>
                    </div>
                    <p>Total number of theatres: <?= $result->num_rows; ?></p>
                    <thead>
                        <tr>
                            <th>film</th>
                            <th>jadwal tayang 1</th>
                            <th>jadwal tayang 2</th>
                            <th>jadwal tayang 3</th>
                            <th>jadwal tayang 4</th>
                            <th>theatre</th>
                            <th>studio</th>
                            <th>aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?= htmlspecialchars($row['judul_film']) ?></td>
                                <td><?= htmlspecialchars($row['jadwal_tayang']) ?></td>
                                <td><?= htmlspecialchars($row['jadwal_tayang2']) ?></td>
                                <td><?= htmlspecialchars($row['jadwal_tayang3']) ?></td>
                                <td><?= htmlspecialchars($row['jadwal_tayang4']) ?></td>
                                <td><?= htmlspecialchars($row['nama_theatre']) ?></td>
                                <td><?= htmlspecialchars($row['nama_studio']) ?></td>
                                <td>
                                    <button class="btn btn-warning btn-sm" onclick="editTheatre(<?= $row['id'] ?>)">Edit</button>
                                    <button class="btn btn-danger btn-sm" onclick="deleteTheatre(<?= $row['id'] ?>)">Hapus</button>
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


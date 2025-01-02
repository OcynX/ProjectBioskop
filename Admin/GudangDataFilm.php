<?php

include"../koneksi.php";

// Ambil data dari database
$query = "SELECT * FROM movies";
$result = $db->query($query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Theatre</title>
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
                <a href="ManagementTicket.php">Management Tiket</a>
                <a href="managementTheater.php">Management Bioskop</a>
                <a href="gudangdatafilm.php">Manajemen Film</a>
                <a href="LaporanPenjualan.php">Laporan Penjualan</a>
                <a href="logout.php">Logout</a>
        </div>

        <!-- Content -->
        <div class="content">
            <h1>Manajemen Film</h1>
            <div class="btn-tambah">
                <button class="btn btn-info btn-sm" onclick="window.location.href='tambahfilm.php'">Tambah</button>
            </div>
            <p>Total number of theatres: <?= $result->num_rows; ?></p>
            <div class="table-responsive w-100">
                <table class="table table-dark table-bordered w-100">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>poster</th>
                            <th>judul</th>
                            <th>sinopsis</th>
                            <th>genre</th>
                            <th>durasi</th>
                            <th>Tahun Rilis</th>
                            <th>aksi</th>
                        </tr>
                    </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['id']) ?></td>
                    <td>
                        <img src="uploads/<?php echo $row['poster_url']; ?>" alt="Poster" style="width: 100px; height: auto; border-radius: 5px;">
                    </td>

                    <td><?= htmlspecialchars($row['title']) ?></td>
                    <td class="text-start"><?= htmlspecialchars($row['synopsis']) ?></td>
                    <td><?= htmlspecialchars($row['genre']) ?></td>
                    <td><?= htmlspecialchars($row['duration']) ?></td>
                    <td><?=htmlspecialchars($row['Tahun_Rilis'])?> </td>
                    <td>
                        <button class="btn btn-warning btn-sm" onclick="window.location.href='editfilm.php?id=<?= $row['id'] ?>'">Edit</button>
                        <button class="btn btn-danger btn-sm" onclick="confirmDelete(<?= $row['id'] ?>)">Hapus</button>   
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>

                </table>
        </div>
    </div>

    <script>
        function confirmDelete(id) {
            if (confirm('Apakah Anda yakin ingin menghapus film ini?')) {
                window.location.href = `deletefilm.php?id=${id}`;
            }
        }
    </script>

</body>
</html>

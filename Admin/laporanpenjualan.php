<?php
include '../koneksi.php';

// Ambil tanggal dari input (default: semua data)
$tanggal = isset($_GET['tanggal']) ? $_GET['tanggal'] : '';

// Query untuk menghitung total tiket terjual berdasarkan tanggal
$queryTotalTiket = "
    SELECT COUNT(*) AS total_tiket
    FROM penjualan
";
if ($tanggal) {
    // Menambahkan filter berdasarkan tanggal pada kolom 'order_at' di tabel penjualan
    $queryTotalTiket .= " WHERE DATE(order_at) = '$tanggal'";
}

$resultTotalTiket = $db->query($queryTotalTiket);
$totalTiket = 0;
if ($resultTotalTiket) {
    $row = $resultTotalTiket->fetch_assoc();
    $totalTiket = $row['total_tiket'];
}

// Query untuk menghitung total penjualan berdasarkan tanggal
$queryTotalPenjualan = "
    SELECT SUM(total) AS total_penjualan
    FROM penjualan
";
if ($tanggal) {
    // Menambahkan filter berdasarkan tanggal pada kolom 'order_at' di tabel penjualan
    $queryTotalPenjualan .= " WHERE DATE(order_at) = '$tanggal'";
}

$resultTotalPenjualan = $db->query($queryTotalPenjualan);
$totalPenjualan = 0;
if ($resultTotalPenjualan) {
    $row = $resultTotalPenjualan->fetch_assoc();
    $totalPenjualan = $row['total_penjualan'];
}

// Query untuk mengambil data penjualan lainnya (dengan filter tanggal)
$query = "
SELECT
        penjualan.id_penjualan AS id_penjualan,
        movies.title AS judul_film,
        penjualan.theatres_id AS theares_name,
        penjualan.studio_id AS studio_name,
        penjualan.jadwal_id AS jadwal,
        penjualan.total AS total_harga,
        penjualan.order_at AS order_at,
        theatres.name AS theatres_name,
        studio.nama_studio AS studio_name,
        jadwal.show_time AS show_time,
        jadwal.show_time2 AS show_time2,
        jadwal.show_time3 AS show_time3,
        jadwal.show_time4 AS show_time4
    FROM penjualan
    INNER JOIN movies ON penjualan.movies_id = movies.id
    INNER JOIN studio ON penjualan.studio_id = studio.id_studio
    INNER JOIN theatres ON studio.id_theatres = theatres.id
    INNER JOIN jadwal ON penjualan.jadwal_id = jadwal.id
";
if ($tanggal) {
    $query .= " WHERE DATE(penjualan.order_at) = '$tanggal'";
}

$result = $db->query($query);

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
    <title>Laporan Penjualan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="admin.css">

    <style>
        .content {
            width: 80vw;
            margin-left: 250px;
            padding: 20px;
        }
        .table th, .table td {
            vertical-align: middle;
            text-align: center;
        }

        .fitur-filter{
            display: flex;
            gap: 8px;
            align-items: center;
            justify-content: end;
        }

        .fitur-filter .form-control{
            width: 12vw;
            height: 4vh;
        }

        .btn-fitur{
            display: flex;
            align-items: center;
            justify-content: end;
        }
       .btn-fitur .btn{
            width: 78px;
            height: 4vh;

        }

        .btn {
            padding: 5px 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 3px;
        }
        .table th {
            background-color: #242424;
        }
    </style>
</head>
<body>
    <div class="wrapper">
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
            <h1>Laporan Penjualan</h1>

            <!-- Form untuk filter by day -->
            <form method="GET" action="LaporanPenjualan.php" class="mb-4">
                <div class="fitur-filter">
                    <label for="tanggal" class="form-label">Filter by Date:  </label>
                    <input type="date" id="tanggal" name="tanggal" value="<?= htmlspecialchars($tanggal) ?>" class="form-control d-inline">
                </div>
                <div class="btn-fitur">
                        <button type="submit" class="btn btn-primary">Filter</button>
                        <a href="LaporanPenjualan.php" class="btn btn-secondary">Reset</a>
                    </div>
            </form>

            <!-- Card Total Tiket -->
            <div class="row g-4">
                <!-- Card Total Tiket Terjual -->
                <div class=" col-lg-6 col-md-6">
                    <div class="card-body bg-info rounded-3 p-4">
                        <h5 class="card-title">Total Tiket Terjual</h5>
                        <p class="card-text"><?= number_format($totalTiket) ?> tiket</p>
                    </div>
                </div>
                <!-- Card Total Penjualan -->
                <div class="col-lg-6 col-md-6 ">
                    <div class="card-body bg-warning rounded-3 p-4">
                        <h5 class="card-title">Total Penjualan</h5>
                        <p class="card-text">Rp <?= number_format($totalPenjualan, 0, ',', '.') ?></p>
                    </div>
                </div>
            </div>

            <p>Total number of records: <?= $result->num_rows; ?></p>
            <div class="table-responsive w-100">
                <table class="table table-dark table-bordered w-100">
                    <thead>
                        <tr>
                            <th>Movie</th>
                            <th>Theater</th>
                            <th>Studio</th>
                            <th>Order At</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['judul_film']) ?></td>
                            <td><?= htmlspecialchars($row['theatres_name']) ?></td>
                            <td><?= htmlspecialchars($row['studio_name']) ?></td>
                            <td><?= htmlspecialchars($row['order_at']) ?></td>
                            <td><?= htmlspecialchars($row['total_harga']) ?></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>

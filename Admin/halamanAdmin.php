<?php
// Koneksi ke database
include('../koneksi.php');

// Ambil data dari database
$jumlahPenjualan = $db->query("SELECT COUNT(*) as total FROM penjualan")->fetch_assoc()['total'];
$jumlahFilm = $db->query("SELECT COUNT(*) as total FROM movies")->fetch_assoc()['total'];
$jumlahTheatre = $db->query("SELECT COUNT(*) as total FROM theatres")->fetch_assoc()['total'];
$jumlahUsers = $db->query("SELECT COUNT(*) as total FROM users")->fetch_assoc()['total'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="Admin.css">
    <style>
       
        #page-content-wrapper {
            margin-left: 250px;
            width: calc(100% - 250px);
        }

        /* Responsivitas untuk layar kecil */
        @media (max-width: 768px) {
            #sidebar-wrapper {
                width: 100%;
                position: relative;
                min-height: auto;
            }

            #page-content-wrapper {
                margin-left: 0;
                width: 100%;
            }

            .toggled #sidebar-wrapper {
                display: none;
            }
        }
    </style>
</head>
<body class="Bodyadmin bg-dark">
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="sidebar">
            <h3 class="p-3">CINEMA21</h3>
                <a href="halamanAdmin.php">Dashboard</a>
                <a href="Management_ticket.php">Management Tiket</a>
                <a href="managementTheater.php">Management Bioskop</a>
                <a href="gudangdatafilm.php">Manajemen Film</a>
                <a href="LaporanPenjualan.php">Laporan Penjualan</a>
                <a href="logout.php">Logout</a>
        </div>

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark border-bottom">
                <div class="container-fluid">
                    <button class="btn btn-primary" id="menu-toggle">Toggle Menu</button>
                </div>
            </nav>

            <!-- Main Content -->
            <div class="container-fluid mt-4 ">
                <h1 class="text-dark">Admin Dashboard</h1>
                <div class="row g-3">
                    <!-- Card 1: Penjualan Tiket -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card text-white bg-primary text-white">
                            <div class="card-header"> Tiket</div>
                            <div class="card-body">
                                <h5 class="card-title"><?= $jumlahPenjualan; ?> Transaksi</h5>
                            </div>
                        </div>
                    </div>
                    <!-- Card 2: Artikel Film -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card text-white bg-success text-white">
                            <div class="card-header">Film</div>
                            <div class="card-body">
                                <h5 class="card-title"><?= $jumlahFilm; ?> film</h5>
                            </div>
                        </div>
                    </div>
                    <!-- Card 3: Manajemen Theatre -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card text-white bg-warning text-white">
                            <div class="card-header">Manajemen Bioskop</div>
                            <div class="card-body">
                                <h5 class="card-title"><?= $jumlahTheatre; ?> Theatre</h5>
                            </div>
                        </div>
                    </div>
                    <!-- Card 4: Pengguna -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card text-white bg-info text-white">
                            <div class="card-header">Pengguna</div>
                            <div class="card-body">
                                <h5 class="card-title"><?= $jumlahUsers; ?> Users</h5>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Table Section -->
                <div class="row mt-4">
                    <div class="col-12">
                        <h3>Data Terbaru</h3>
                        <table class="table table-dark table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Judul</th>
                                    <th>Genre</th>
                                    <th>Durasi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $result = $db->query("SELECT id, title, genre, duration FROM movies LIMIT 100");
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>
                                        <td>{$row['id']}</td>
                                        <td>{$row['title']}</td>
                                        <td>{$row['genre']}</td>
                                        <td>{$row['duration']} menit</td>
                                    </tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle Sidebar
        document.getElementById("menu-toggle").addEventListener("click", function () {
            document.getElementById("wrapper").classList.toggle("toggled");
        });
    </script>
</body>
</html>

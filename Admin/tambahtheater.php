<?php 
include '../koneksi.php'; 

// Proses form ketika tombol submit ditekan
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $location = $_POST['location'];
    $contact = $_POST['contact'];
    $kapasitas = $_POST['kapasitas'];

    // Query untuk menambahkan data ke tabel theatres
    $query = "INSERT INTO theatres (name, location, contact, kapasitas, created_at) VALUES (?, ?, ?, ?, NOW())";
    $stmt = $db->prepare($query);
    $stmt->bind_param('sssi', $name, $location, $contact, $kapasitas);

    if ($stmt->execute()) {
        echo "<script>alert('Theater berhasil ditambahkan!'); window.location.href='managementTheater.php';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan theater: {$db->error}');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Theatre</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            overflow: hidden;
            background-color: black;
        }
        .sidebar {
            width: 250px;
            background: #242424;
            padding: 20px;
            color: white;
            height: 100vh;
            position: fixed;
        }
        .sidebar h3 {
            text-align: center;
            margin-bottom: 20px;
        }
        .sidebar a {
            display: block;
            color: white;
            text-decoration: none;
            margin-bottom: 10px;
            padding: 10px;
            border-radius: 5px;
        }
        .sidebar a:hover {
            background: gray;
        }
        .content {
            margin-left: 250px;
            padding: 20px;
            width: calc(100% - 250px);
            color: white;
        }
        .form-container {
            background: #1c1c1c;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.5);
            width: 100%;
            max-width: 600px;
        }
        .form-container label {
            color: white;
        }
        .form-container .form-control::-webkit-input-placeholder {
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: black;
        }
        .form-container .form-control:focus {
            box-shadow: none;
            border: 1px solid white;
        }
        .form-container .btn {
            background: white;
            color: black;
            border: none;
            width: 100%;
        }
        .form-container .btn:hover {
            background: gray;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h3>CINEMA21</h3>
        <a href="halamanAdmin.php">Dashboard</a>
        <a href="management_ticket.php">Management Tiket</a>
        <a href="managementTheater.php">Management Bioskop</a>
            <ul>
                <li><a href="studio.php">Management Studio</a></li>
                <li><a href="#">Jadwal Tayang</a></li>
            </ul>
        <a href="gudangdatafilm.php">Manajemen Film</a>
        <a href="LaporanPenjualan.php">Laporan Penjualan</a>
        <a href="logout.php">Logout</a>
    </div>

    <!-- Content -->
    <div class="content">
        <h1>Tambah Theatre</h1>
        <div class="form-container">
            <form action="" method="POST">
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Theatre</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan nama theatre" required>
                </div>
                <div class="mb-3">
                    <label for="location" class="form-label">Lokasi</label>
                    <input type="text" class="form-control" id="location" name="location" placeholder="Masukkan lokasi theatre" required>
                </div>
                <div class="mb-3">
                    <label for="contact" class="form-label">Kontak</label>
                    <input type="text" class="form-control" id="contact" name="contact" placeholder="Masukkan kontak theatre" required>
                </div>
                <div class="mb-3">
                    <label for="kapasitas" class="form-label">Kapasitas</label>
                    <input type="number" class="form-control" id="kapasitas" name="kapasitas" placeholder="Masukkan kapasitas theatre" required>
                </div>
                <button type="submit" class="btn btn-primary">Tambah Theatre</button>
            </form>
        </div>
    </div>
</body>
</html>

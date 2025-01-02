<?php 
include '../koneksi.php';

// Ambil data theatres untuk dropdown
$queryTheatres = "SELECT id, name FROM theatres";
$resultTheatres = $db->query($queryTheatres);

// Proses data saat form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_theatres = $_POST['id_theatres'];
    $nama_studio = $_POST['nama_studio'];
    $kapasitas = $_POST['kapasitas'];

    // Query untuk insert data ke tabel studio
    $queryInsert = "INSERT INTO studio (id_theatres, nama_studio, kapasitas) VALUES (?, ?, ?)";
    $stmt = $db->prepare($queryInsert);
    $stmt->bind_param('isi', $id_theatres, $nama_studio, $kapasitas);

    if ($stmt->execute()) {
        echo "<script>alert('Studio berhasil ditambahkan!'); window.location.href='studio.php';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan studio: {$db->error}');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Studio</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="admin.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            background-color: black;
            display: flex;
            overflow: hidden;
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
        }
        .form-container label {
            color: white;
        }
        .form-container .form-control{
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: white;
        }
        .form-container .form-control::-webkit-input-placeholder{
            color: white;
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
            color: white;
        }
    </style>
</head>
<body>
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
        <h1>Tambah Studio</h1>
        <div class="form-container">
            <form action="" method="POST">
                <div class="mb-3">
                    <label for="id_theatres" class="form-label">Theater</label>
                    <select class="form-select" name="id_theatres" id="id_theatres" required>
                        <option value="" disabled selected>Pilih Theater</option>
                        <?php while ($row = $resultTheatres->fetch_assoc()): ?>
                            <option value="<?= $row['id'] ?>"><?= htmlspecialchars($row['name']) ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="nama_studio" class="form-label">Nama Studio</label>
                    <input type="text" class="form-control" id="nama_studio" name="nama_studio" placeholder="Masukkan nama studio" required>
                </div>
                <div class="mb-3">
                    <label for="kapasitas" class="form-label">Kapasitas</label>
                    <input type="number" class="form-control" id="kapasitas" name="kapasitas" placeholder="Masukkan kapasitas" required>
                </div>
                <button type="submit" class="btn btn-primary">Tambah Studio</button>
            </form>
        </div>
    </div>
</body>
</html>

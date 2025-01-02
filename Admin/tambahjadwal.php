<?php
include '../koneksi.php';

// Fetch data untuk dropdown
$movies = $db->query("SELECT id, title FROM movies");
$theatres = $db->query("SELECT id, name FROM theatres");
$studios = $db->query("SELECT id_studio, nama_studio FROM studio");

// Handle form submission (backend tetap sama)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $movie_id = $_POST['movie_id'];
    $theatre_id = $_POST['theatre_id'];
    $show_time = $_POST['show_time'];
    $show_time2 = $_POST['show_time2'];
    $show_time3 = $_POST['show_time3'];
    $show_time4 = $_POST['show_time4'];
    $studio_id = $_POST['studio_id'];

    $stmt = $db->prepare("INSERT INTO jadwal (movie_id, theatre_id, show_time, show_time2, show_time3, show_time4,studio_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("iiissss", $movie_id, $theatre_id, $show_time, $show_time2, $show_time3, $show_time4, $studio_id);

    if ($stmt->execute()) {
        echo "<script>alert('Jadwal berhasil ditambahkan'); window.location.href='jadwal.php';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan jadwal');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Jadwal</title>
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
    overflow-y: auto; /* Tambahkan scroll vertikal */
    max-height: 100vh; 
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
        .form-container .form-control, .form-container {
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: white;
        }

        .form-container .form-select{
            color: black;
        }
        .form-container .form-control::-webkit-input-placeholder {
            color: dark;
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
        <h1>Tambah Jadwal</h1>
        <div class="form-container">
            <form action="" method="POST">
                <!-- Dropdown Judul Film -->
                <div class="mb-3">
                    <label for="movie_id" class="form-label">Judul Film</label>
                    <select name="movie_id" id="movie_id" class="form-select" required>
                        <option value="" disabled selected>Pilih Judul Film</option>
                        <?php while ($row = $movies->fetch_assoc()): ?>
                            <option value="<?= $row['id'] ?>"><?= htmlspecialchars($row['title']) ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <!-- Dropdown Theatre -->
                <div class="mb-3">
                    <label for="theatre_id" class="form-label">Theatre</label>
                    <select name="theatre_id" id="theatre_id" class="form-select" required>
                        <option value="" disabled selected>Pilih Theatre</option>
                        <?php while ($row = $theatres->fetch_assoc()): ?>
                            <option value="<?= $row['id'] ?>"><?= htmlspecialchars($row['name']) ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <!-- Dropdown Studio -->
                <div class="mb-3">
                    <label for="studio_id" class="form-label">Studio</label>
                    <select name="studio_id" id="studio_id" class="form-select" required>
                        <option value="" disabled selected>Pilih Studio</option>
                        <?php while ($row = $studios->fetch_assoc()): ?>
                            <option value="<?= $row['id_studio'] ?>"><?= htmlspecialchars($row['nama_studio']) ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <!-- Input Show Time -->
                <?php for ($i = 1; $i <= 4; $i++): ?>
                    <div class="mb-3">
                        <label for="show_time<?= $i ?>" class="form-label">Jadwal Tayang <?= $i ?></label>
                        <input type="datetime-local" class="form-control" id="show_time<?= $i ?>" name="show_time<?= $i ?>">
                    </div>
                <?php endfor; ?>

                <!-- Tombol Submit -->
                <button type="submit" class="btn btn-primary">Tambah Jadwal</button>
            </form>
        </div>
    </div>
</body>
</html>

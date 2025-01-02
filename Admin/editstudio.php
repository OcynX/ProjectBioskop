<?php 
include '../koneksi.php';

// Cek apakah parameter id_studio ada
if (!isset($_GET['id_studio'])) {
    header('Location: managementTheater.php'); // Redirect jika tidak ada parameter id_studio
    exit();
}

$id_studio = $_GET['id_studio'];

// Ambil data studio berdasarkan id_studio
$query = "SELECT * FROM studios WHERE id_studio = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id_studio);
$stmt->execute();
$result = $stmt->get_result();

// Cek apakah data studio ditemukan
if ($result->num_rows > 0) {
    $studio = $result->fetch_assoc();
} else {
    // Redirect jika studio tidak ditemukan
    echo "<script>alert('Studio tidak ditemukan!'); window.location='managementTheater.php';</script>";
    exit();
}

// Proses update data jika form disubmit
if (isset($_POST['editstudio'])) {
    $id_theatres = $_POST['id_theatres'];
    $nama_studio = $_POST['nama_studio'];
    $kapasitas = $_POST['kapasitas'];

    // Update data studio
    $updateQuery = "UPDATE studios SET id_theatres = ?, nama_studio = ?, kapasitas = ? WHERE id_studio = ?";
    $updateStmt = $conn->prepare($updateQuery);
    $updateStmt->bind_param("ssii", $id_theatres, $nama_studio, $kapasitas, $id_studio);

    if ($updateStmt->execute()) {
        echo "<script>alert('Studio berhasil diupdate!'); window.location='managementTheater.php';</script>";
    } else {
        echo "<script>alert('Gagal mengupdate studio!');</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Studio</title>
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
        .form-container .form-control {
            background: rgba(255, 255, 255, 0.2);
            border: none;
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
    <h3>CINEMA21</h3>
    <a href="halamanAdmin.php">Dashboard</a>
    <a href="ManagementTicket.php">Management Tiket</a>
    <a href="managementTheater.php">Management Bioskop</a>
    <a href="gudangdatafilm.php">Manajemen Film</a>
    <a href="LaporanPenjualan.php">Laporan Penjualan</a>
    <a href="logout.php">Logout</a>
</div>

<div class="content">
    <h1>Edit Studio</h1>
    <div class="form-container">
        <form action="" method="POST">
            <!-- Dropdown Theatre -->
            <div class="mb-3">
                <label for="id_theatres" class="form-label">Theatre</label>
                <input type="text" class="form-control" id="id_theatres" name="id_theatres" value="<?= htmlspecialchars($studio['id_theatres']) ?>" required>
            </div>

            <!-- Input Nama Studio -->
            <div class="mb-3">
                <label for="nama_studio" class="form-label">Nama Studio</label>
                <input type="text" class="form-control" id="nama_studio" name="nama_studio" value="<?= htmlspecialchars($studio['nama_studio']) ?>" required>
            </div>

            <!-- Input Kapasitas -->
            <div class="mb-3">
                <label for="kapasitas" class="form-label">Kapasitas</label>
                <input type="number" class="form-control" id="kapasitas" name="kapasitas" value="<?= htmlspecialchars($studio['kapasitas']) ?>" required>
            </div>

            <!-- Tombol Submit -->
            <button type="submit" name="editstudio" class="btn btn-primary">Update</button>
            <a href="managementTheater.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
</body>
</html>

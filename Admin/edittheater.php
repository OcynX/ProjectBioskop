<?php
// Koneksi ke database
include('../koneksi.php');

// Cek apakah ID tersedia di URL
if (!isset($_GET['id'])) {
    header('Location: managementTheater.php');
    exit();
}

$id = $_GET['id'];

// Ambil data theatre berdasarkan ID
$query = "SELECT * FROM theatres WHERE id = '$id'";
$result = $db->query($query);

// Jika data tidak ditemukan
if ($result->num_rows == 0) {
    die("Theatre dengan ID $id tidak ditemukan.");
}

$theatre = $result->fetch_assoc();

// Proses update data
if (isset($_POST['edit_theatre'])) {
    $name = $_POST['name'];
    $location = $_POST['location'];
    $contact = $_POST['contact'];
    $kapasitas = $_POST['kapasitas'];

    $updateQuery = "UPDATE theatres 
                    SET name='$name', location='$location', contact='$contact', kapasitas='$kapasitas', updated_at=NOW() 
                    WHERE id='$id'";

    if ($db->query($updateQuery)) {
        header("Location: managementTheater.php?message=updated");
        exit();
    } else {
        echo "Gagal memperbarui data: " . $db->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Theatre</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="admin.css">
    <style>
        .container {
            background-color: #242424;
            padding: 20px;
            border-radius: 8px;
            color: white;
            margin-top: 50px;
        }
        h2 {
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Theatre</h2>
        <form action="" method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Nama Theatre</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($theatre['name']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="location" class="form-label">Lokasi</label>
                <input type="text" class="form-control" id="location" name="location" value="<?= htmlspecialchars($theatre['location']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="contact" class="form-label">Kontak</label>
                <input type="text" class="form-control" id="contact" name="contact" value="<?= htmlspecialchars($theatre['contact']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="kapasitas" class="form-label">Kapasitas</label>
                <input type="number" class="form-control" id="kapasitas" name="kapasitas" value="<?= htmlspecialchars($theatre['kapasitas']) ?>" required>
            </div>
            <button type="submit" name="edit_theatre" class="btn btn-warning">Update</button>
            <a href="managementTheater.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

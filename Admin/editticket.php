<?php
include '../koneksi.php';

// Ambil ID Tiket dari URL
$id = $_GET['id'] ?? null;
if (!$id) {
    die('ID tidak ditemukan!');
}

// Ambil data tiket berdasarkan ID
$query = "SELECT * FROM tickets WHERE idtiket = ?";
$stmt = $db->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$tiket = $result->fetch_assoc();

// Pastikan tiket ditemukan
if (!$tiket) {
    die('Tiket tidak ditemukan!');
}

// Update data jika form dikirim
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $jadwal = $_POST['jadwal'];
    $kursi = $_POST['kursi'];
    $refund = $_POST['refund'];

    // Cek apakah semua data yang diperlukan ada
    if (empty($jadwal) || empty($kursi) || !isset($refund)) {
        die('Semua kolom harus diisi!');
    }

    // Update refund status di tabel tickets
    $updateQuery = "UPDATE tickets SET jadwal_id = ?, seat_number = ?, refund_status = ? WHERE idtiket = ?";
    $updateStmt = $db->prepare($updateQuery);
    $updateStmt->bind_param("isii", $jadwal, $kursi, $refund, $id);
    $updateStmt->execute();

    // Jika refund status = 1 (Ya), ubah status kursi menjadi 'available' di tabel seats
    if ($refund == 1) {
        $updateSeatQuery = "UPDATE seats SET status = 'available' WHERE seat_number = ?";
        $updateSeatStmt = $db->prepare($updateSeatQuery);
        $updateSeatStmt->bind_param("s", $kursi);
        $updateSeatStmt->execute();
    } else {
        // Jika refund status = 0 (Tidak), ubah status kursi menjadi 'booked'
        $updateSeatQuery = "UPDATE seats SET status = 'booked' WHERE seat_number = ?";
        $updateSeatStmt = $db->prepare($updateSeatQuery);
        $updateSeatStmt->bind_param("s", $kursi);
        $updateSeatStmt->execute();
    }

    // Redirect ke halaman Management Tiket setelah berhasil
    header("Location: management_ticket.php?success=edit");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Tiket</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Edit Tiket</h1>
        <form method="POST">
            <div class="mb-3">
                <label for="jadwal" class="form-label">Jadwal</label>
                <select name="jadwal" id="jadwal" class="form-select" required>
                    <!-- Ambil opsi jadwal dari database -->
                    <?php
                    $jadwalQuery = "SELECT * FROM jadwal";
                    $jadwalResult = $db->query($jadwalQuery);
                    while ($jadwal = $jadwalResult->fetch_assoc()) {
                        echo "<option value='{$jadwal['id']}' " . ($jadwal['id'] == $tiket['jadwal_id'] ? 'selected' : '') . ">{$jadwal['show_time']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="kursi" class="form-label">Nomor Kursi</label>
                <input type="text" name="kursi" id="kursi" class="form-control" value="<?= htmlspecialchars($tiket['seat_number']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="refund" class="form-label">Refund Status</label>
                <select name="refund" id="refund" class="form-select" required>
                    <option value="0" <?= $tiket['refund_status'] == 0 ? 'selected' : '' ?>>Tidak</option>
                    <option value="1" <?= $tiket['refund_status'] == 1 ? 'selected' : '' ?>>Ya</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="management_ticket.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</body>
</html>

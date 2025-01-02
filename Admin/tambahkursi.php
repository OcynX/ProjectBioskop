<?php
session_start();
include '../koneksi.php';

// Ambil data theatres
$theatres = $db->query("SELECT id, name FROM theatres");

// Cek jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $theatres_id = $_POST['theatres_id'];
    $studio_id = $_POST['studio_id'];
    $jumlah_kursi = $_POST['jumlah_kursi'];

    // Masukkan kursi ke tabel seats
    $status = 'available'; // Status default
    for ($i = 1; $i <= $jumlah_kursi; $i++) {
        $seat_number = "Kursi " . $i; // Nomor kursi
        $db->query("INSERT INTO seats (theatres_id, studio_id, seat_number, status) 
                    VALUES ('$theatres_id', '$studio_id', '$seat_number', '$status')");
    }

    echo "<script>alert('Kursi berhasil ditambahkan!');</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kursi</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h1>Tambah Kursi</h1>
        <form method="POST">

            <!-- Pilih Theatre -->
            <div class="mb-3">
                <label for="theatres_id" class="form-label">Theatre</label>
                <select name="theatres_id" id="theatres_id" class="form-select" required>
                    <option value="" disabled selected>Pilih Theatre</option>
                    <?php while ($row = $theatres->fetch_assoc()): ?>
                        <option value="<?= $row['id'] ?>"><?= htmlspecialchars($row['name']) ?></option>
                    <?php endwhile; ?>
                </select>
            </div>

            <!-- Pilih Studio -->
            <div class="mb-3">
                <label for="studio_id" class="form-label">Studio</label>
                <select name="studio_id" id="studio_id" class="form-select" required>
                    <option value="" disabled selected>Pilih Studio</option>
                </select>
            </div>

            <!-- Input Jumlah Kursi -->
            <div class="mb-3">
                <label for="jumlah_kursi" class="form-label">Jumlah Kursi</label>
                <input type="number" name="jumlah_kursi" id="jumlah_kursi" class="form-control" placeholder="Masukkan jumlah kursi" required>
            </div>

            <!-- Tombol Submit -->
            <button type="submit" class="btn btn-primary">Tambah Kursi</button>
        </form>
    </div>

    <script>
        $('#theatres_id').change(function() {
    const id_theatres = $(this).val(); // ID elemen benar adalah theatres_id

    // Kosongkan dropdown Studio
    $('#studio_id').html('<option value="" disabled selected>Pilih Studio</option>');

    if (id_theatres) { // Pastikan id_theatres memiliki nilai
        $.ajax({
            url: 'get_studio.php',
            method: 'GET',
            data: { id_theatres: id_theatres },
            dataType: 'json',
            success: function(data) {
                data.forEach(function(studio) {
                    $('#studio_id').append(
                        `<option value="${studio.id_studio}">${studio.nama_studio}</option>`
                    );
                });
            },
            error: function() {
                alert('Gagal mengambil data studio.');
            }
        });
    }
});

    </script>
</body>
</html>

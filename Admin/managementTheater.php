<?php
// Koneksi ke database
include('../koneksi.php');

// Tambah data theatre
if (isset($_POST['add_theatre'])) {
    $name = $_POST['name'];
    $location = $_POST['location'];
    $contact = $_POST['contact'];
    $kapasitas = $_POST['kapasitas'];

    $query = "INSERT INTO theatres (name, location, contact, kapasitas, created_at) 
              VALUES ('$name', '$location', '$contact', '$kapasitas', NOW())";
    if ($db->query($query)) {
        header("Location: managementTheater.php?message=added");
        exit();
    }
}



// Edit data theatre
if (isset($_POST['edit_theatre'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $location = $_POST['location'];
    $contact = $_POST['contact'];
    $kapasitas = $_POST['kapasitas'];

    $query = "UPDATE theatres 
              SET name='$name', location='$location', contact='$contact', kapasitas='$kapasitas', updated_at=NOW() 
              WHERE id='$id'";
    if ($db->query($query)) {
        header("Location: managementTheater.php?message=updated");
        exit();
    }
}

// Hapus data theatre
if (isset($_POST['delete_theatre'])) {
    $id = $_POST['id'];

    $query = "DELETE FROM theatres WHERE id='$id'";
    if ($db->query($query)) {
        header("Location: managementTheater.php?message=deleted");
        exit();
    }
}

// Ambil data theatres
$query = "SELECT * FROM theatres";
$result = $db->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Theatre</title>
    <?php if (isset($_GET['message'])): ?>
        <div class="alert alert-<?php 
            echo ($_GET['message'] == 'deleted') ? 'success' : 'danger'; 
        ?>" role="alert">
            <?php 
            if ($_GET['message'] == 'deleted') {
                echo "Theatre berhasil dihapus.";
            } elseif ($_GET['message'] == 'error') {
                echo "Terjadi kesalahan saat menghapus theatre.";
            }
            ?>
        </div>
    <?php endif; ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="admin.css">
    <style>
        .content{
            width: 100vw;
        }
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
    
        .content {
            margin-left: 250px;
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar">
            <h3 class="p-3">CINEMA21</h3>
            <a href="halamanAdmin.php">Dashboard</a>
            <a href="management_ticket.php">Management Tiket</a>
            <a href="managementTheater.php">Management Bioskop</a>
                <ul>
                    <li><a href="studio.php">Management Studio</a></li>
                    <li><a href="jadwal.php">Jadwal Tayang</a></li>
                </ul>
            <a href="gudangdatafilm.php">Manajemen Film</a>
            <a href="LaporanPenjualan.php">Laporan Penjualan</a>
            <a href="logout.php">Logout</a>
        </div>

        <!-- Content -->
        <div class="content">
             <div class="table-responsive w-100">
                <table class="table table-dark table-bordered w-100">
                <h1>Manajemen Theater</h1>
                <div class="btn-tambah">
                    <button class="btn btn-info btn-sm" onclick="window.location.href='tambahTheater.php'">Tambah</button>
                </div>
                <p>Total number of theatres: <?= $result->num_rows; ?></p>
                    <thead>
                        <tr>
                            <th>Nama Theatre</th>
                            <th>Lokasi</th>
                            <th>Kontak</th>
                            <th>Kapasitas</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?= htmlspecialchars($row['name']) ?></td>
                                <td><?= htmlspecialchars($row['location']) ?></td>
                                <td><?= htmlspecialchars($row['contact']) ?></td>
                                <td><?= htmlspecialchars($row['kapasitas']) ?></td>
                                <td>
                                <button class="btn btn-warning btn-sm" onclick="window.location.href='edittheater.php?id=<?= $row['id'] ?>'">Edit</button>
                                <button class="btn btn-danger btn-sm" onclick="if(confirm('Yakin ingin menghapus theatre ini?')) {window.location.href='hapustheater.php?id=<?= $row['id'] ?>';}">Hapus</button>

                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <script>
        function showAddForm() {
            document.getElementById('theatre-form').reset();
            document.getElementById('form-id').value = '';
            document.getElementById('form-submit-btn').name = 'add_theatre';
            var modal = new bootstrap.Modal(document.getElementById('modal-form'));
            modal.show();
        }

        function editTheatre(id) {
            // Isi data ke form edit sesuai id
        }

        function deleteTheatre(id) {
            if (confirm('Yakin ingin menghapus theatre ini?')) {
                document.getElementById('theatre-form').action = 'managementTheater.php';
                document.getElementById('form-id').value = id;
                document.getElementById('form-submit-btn').name = 'delete_theatre';
                document.getElementById('theatre-form').submit();
            }
        }
    </script>
</body>
</html>

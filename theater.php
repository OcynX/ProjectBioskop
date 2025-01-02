<?php 
session_start();
include 'koneksi.php';

// Ambil data lokasi dari database
$query = "SELECT DISTINCT location FROM theatres";
$resultCity = $db->query($query);
$locations = [];
if ($resultCity->num_rows > 0) {
    while ($row = $resultCity->fetch_assoc()) {
        $locations[] = $row['location'];
    }
}

// Menangani filter yang dipilih
$locationFilter = isset($_GET['location']) ? $_GET['location'] : '';

// Query untuk mengambil data dari tabel 'theatres' dan menghitung kapasitas berdasarkan kursi tersedia
$query = "
    SELECT 
        theatres.id,
        theatres.name,
        theatres.location,
        theatres.contact,
        (SELECT COUNT(*) FROM seats WHERE seats.theatres_id = theatres.id AND seats.status = 'available') AS kapasitas
    FROM theatres
";

if ($locationFilter) {

    $query .= " WHERE location = '$locationFilter'";
}

$result = $db->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Theatre Data</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="user.css"> <!-- File CSS utama untuk proyek -->
    <style>
        a {
            color: inherit;
            text-decoration: none;
        }
        a:hover {
            color: red;
        }

        .theater-body{
            background-color: #191A19;
        }
        
        .container-teater{
            background-color: transparent;
        }
        
        .table{
            background-color: transparent;
            color: white;
        }
        
        .table th {
            background-color: red; /* Latar belakang merah */
            color: black; /* Teks hitam */
            padding: 10px; /* Jarak dalam sel */
            border-bottom: 1px solid black; /* Border bawah hitam */
        }


        .table td {
            background-color: transparent; /* Transparansi untuk header dan isi tabel */
            color: white; /* Warna teks putih */
            border-bottom: 1px solid red; /* Border bawah dengan warna transparan */
            padding: 10px; /* Jarak dalam sel */
        }


.table tbody tr:hover {
    background-color: rgba(255, 0, 0, 0.1); /* Efek hover merah transparan */
    transition: background-color 0.3s; /* Animasi hover */
}


    </style>
</head>
<body class="theater-body">
    <?php include "Layout/header.php"; ?>

    <div class="container-teater">
        <!-- Filter Dropdown -->
        <form method="GET" class="mb-3">
            <div class="row">
                <div class="col-md-4">
                    <label for="location" class="form-label">Filter by Location</label>
                    <select name="location" id="location" class="form-select" onchange="this.form.submit()">
                        <option value="">-- Select Location --</option>
                        <?php foreach ($locations as $location): ?>
                            <option value="<?php echo $location; ?>" <?php echo ($location == $locationFilter) ? 'selected' : ''; ?>><?php echo $location; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </form>

        <!-- Tabel Data Theatre -->
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Location</th>
                    <th>Capacity</th>
                    <th>Contact</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td>
                                <a href="detailtheater.php?id=<?php echo $row['id']; ?>">
                                    <?php echo $row['name']; ?>
                                </a>
                            </td>
                            <td><?php echo $row['location']; ?></td>
                            <td><?php echo $row['kapasitas']; ?></td>
                            <td><?php echo $row['contact']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center">No theatres found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

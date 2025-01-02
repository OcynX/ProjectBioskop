<?php
// Koneksi ke database
include 'koneksi.php';

// Ambil parameter jadwal_id dari URL atau form sebelumnya
$jadwal_id = isset($_GET['id']) ? $_GET['id'] : null;
$show_time = isset($_GET['show_time']) ? $_GET['show_time'] : null;

// Validasi parameter
if (!$jadwal_id || !$show_time) {
    die("Jadwal atau waktu tayang tidak ditemukan. Silakan kembali ke halaman sebelumnya.");
}

// Query untuk mendapatkan data film dan jadwal beserta ID theatre
$query = "SELECT jadwal.*, movies.id AS movie_id, movies.title AS film, studio.nama_studio, jadwal.theatre_id, jadwal.studio_id
          FROM jadwal 
          JOIN movies ON jadwal.movie_id = movies.id 
          JOIN studio ON jadwal.studio_id = studio.id_studio
          WHERE jadwal.id = ?";

$stmt = $db->prepare($query);
$stmt->bind_param("i", $jadwal_id);
$stmt->execute();
$result = $stmt->get_result();
$jadwal = $result->fetch_assoc();

if (!$jadwal) {
    die("Data jadwal tidak ditemukan.");
}

// Query untuk mendapatkan status kursi berdasarkan jadwal
$querySeats = "SELECT * FROM seats WHERE jadwal_id = ? ORDER BY CAST(SUBSTRING(seat_number, 2) AS UNSIGNED)";
$stmtSeats = $db->prepare($querySeats);
$stmtSeats->bind_param("i", $jadwal_id);
$stmtSeats->execute();
$resultSeats = $stmtSeats->get_result();
$seats = $resultSeats->fetch_all(MYSQLI_ASSOC);

$queryTheater = "SELECT name FROM theatres WHERE id = ?";
$stmtTheater = $db->prepare($queryTheater);
$stmtTheater->bind_param("i", $jadwal['theatre_id']);
$stmtTheater->execute();
$resultTheater = $stmtTheater->get_result();
$theaterData = $resultTheater->fetch_assoc();
$theaterName = $theaterData ? $theaterData['name'] : 'Studio tidak ditemukan';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemesanan Tiket</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="user.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
        }
        .container {
            margin-top:8%;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            padding: 20px;
            gap: 20px;
        }
        .seat-selection {
            flex: 2;
            height: auto;
            padding: 20px;
            background: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow-y: auto;
            max-height: 80vh;
        }
        .seat-selection h2 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }
        .seat-grid {
            display: grid;
            grid-template-columns: repeat(10, 40px);
            gap: 10px;
            justify-content: center;
        }
        .seat {
            width: 40px;
            height: 40px;
            background-color: #fff;
            border: 2px solid #ccc;
            border-radius: 5px;
            text-align: center;
            line-height: 40px;
            font-size: 14px;
            cursor: pointer;
        }
        .seat.selected {
            background-color: #4caf50;
            color: white;
        }
        .seat.booked {
            background-color: #f44336;
            cursor: not-allowed;
        }
        .form-container {
            flex: 1;
            height: 800px;
            padding: 20px;
            background: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        .form-container h2 {
            margin-bottom: 10px;
            font-size: 17px;
            color: #333;
        }
        .form-container form {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .form-container label {
            font-size: 13px;
            color: #555;
        }
        .form-container input, 
        .form-container select, 
        .form-container button {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            outline: none;
            height: 40px;
            width: 100%;
        }
        .form-container button {
            background-color: #4caf50;
            color: white;
            cursor: pointer;
        }
        .form-container p{
            font-size: 15px;
            font-weight: bold;
        }
        .form-container button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <?php include "Layout/header.php" ?>

    <div class="container">
        <div class="seat-selection">
            <h2>Pilih Kursi</h2>
            <div class="seat-grid">
                <?php foreach ($seats as $seat): ?>
                    <?php
                    $seat_class = 'available'; 
                    if ($seat['status'] === 'booked') {
                        $seat_class = 'booked';
                    }
                    ?>
                    <div class="seat <?php echo $seat_class; ?>" data-seat="<?php echo htmlspecialchars($seat['seat_number']); ?>">
                        <?php echo htmlspecialchars($seat['seat_number']); ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="form-container">
            <p class="text-center"><?php echo htmlspecialchars($theaterName); ?></p>
            <h2>Formulir Pemesanan</h2>
            <form action="proses_pesan_ticket.php" method="POST">
                <input type="hidden" name="jadwal_id" value="<?php echo htmlspecialchars($jadwal_id); ?>">
                <input type="hidden" name="theatre_id" value="<?php echo htmlspecialchars($jadwal['theatre_id']); ?>">
                <input type="hidden" name="studio_id" value="<?php echo htmlspecialchars($jadwal['studio_id']); ?>"> <!-- Pastikan studio_id dikirim -->
                <input type="hidden" name="movie_id" value="<?php echo htmlspecialchars($jadwal['movie_id']); ?>"> 

                <label for="seat">Kursi Terpilih:</label>
                <input type="text" id="seat" name="seat" readonly required>

                <label for="nama">Nama:</label>
                <input type="text" id="nama" name="nama" required placeholder="Masukkan nama">

                <label for="email">Email:</label>
                <input type="text" id="customer_email" name="customer_email" placeholder="Masukkan email" required>
                
                <label for="film">Film yang Dipilih:</label>
                <input type="text" id="film" name="film" value="<?php echo htmlspecialchars($jadwal['film']); ?>" readonly required>

                <label for="studio">Studio:</label>
                <input type="text" id="studio" name="studio" value="<?php echo htmlspecialchars($jadwal['nama_studio']); ?>" readonly required>

                <label for="total_ticket">Total Ticket:</label>
                <input type="number" id="total_ticket" name="total_ticket" readonly required>

                <label for="total_harga">Total Harga:</label>
                <input type="number" id="total_harga" name="total_harga" readonly required>

                <button type="submit">Pesan Tiket</button>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const seatList = document.querySelectorAll('.seat');
            const seatInput = document.getElementById('seat');
            const totalTicketInput = document.getElementById('total_ticket');
            const totalHargaInput = document.getElementById('total_harga');
            const studioInput = document.getElementById('studio');
            const theaterInput = document.getElementById('theater');

            const ticketPrice = <?php echo $jadwal['price']; ?>;

            seatList.forEach(seat => {
                seat.addEventListener('click', () => {
                    if (!seat.classList.contains('booked')) {
                        seat.classList.toggle('selected');
                        const selectedSeats = document.querySelectorAll('.seat.selected');

                        seatInput.value = selectedSeats.length ? Array.from(selectedSeats).map(seat => seat.innerText).join(", ") : "";
                        totalTicketInput.value = selectedSeats.length;
                        totalHargaInput.value = selectedSeats.length * ticketPrice;
                    }
                });
            });
        });
    </script>
</body>
</html>

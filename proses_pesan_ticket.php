<?php
include 'koneksi.php';

// Ambil data dari form
$jadwal_id = $_POST['jadwal_id'];
$theatre_id = $_POST['theatre_id'];
$studio_id = $_POST['studio_id'];
$movie_id = $_POST['movie_id'];
$seat = $_POST['seat'];
$nama = $_POST['nama'];
$email = $_POST['customer_email'];
$total_ticket = $_POST['total_ticket'];
$total_harga = $_POST['total_harga'];  // Total harga keseluruhan (ini tidak akan digunakan langsung untuk tiap tiket)

// Validasi data
if (empty($studio_id) || empty($movie_id) || empty($total_ticket) || empty($nama) || empty($email)) {
    die("Error: Semua field harus diisi.");
}

$seats = explode(", ", $seat);
$ticketPrice = $total_harga / $total_ticket; // Harga tiket per kursi

// Proses penyimpanan data ke dalam tabel penjualan
$queryPenjualan = "INSERT INTO penjualan (movies_id, theatres_id, studio_id, jadwal_id, total)
                   VALUES (?, ?, ?, ?, ?)";
$stmtPenjualan = $db->prepare($queryPenjualan);
$stmtPenjualan->bind_param("iiiii", $movie_id, $theatre_id, $studio_id, $jadwal_id, $ticketPrice);
$stmtPenjualan->execute();
$penjualan_id = $stmtPenjualan->insert_id;

// Proses penyimpanan data tiket yang dipilih
// Harga tiket per kursi

foreach ($seats as $selectedSeat) {
    // Insert tiket per kursi dengan harga tiket individual
    $queryTicket = "INSERT INTO tickets (movie_id, jadwal_id, customer_name, customer_email, price, seat_number) 
                    VALUES (?, ?, ?, ?, ?, ?)";
    $stmtTicket = $db->prepare($queryTicket);
    $stmtTicket->bind_param("iissis", $movie_id, $jadwal_id, $nama, $email, $ticketPrice, $selectedSeat);
    $stmtTicket->execute();
}

// Update status kursi
foreach ($seats as $selectedSeat) {
    $queryUpdateSeat = "UPDATE seats SET status = 'booked' WHERE jadwal_id = ? AND seat_number = ?";
    $stmtUpdateSeat = $db->prepare($queryUpdateSeat);
    $stmtUpdateSeat->bind_param("is", $jadwal_id, $selectedSeat);
    $stmtUpdateSeat->execute();
}

echo "Tiket berhasil dipesan!";

// Pesan sukses
echo "Tiket berhasil dipesan!";

echo "<script>
        setTimeout(function() {
            window.location.href = 'tiket_berhasil.php?penjualan_id=$penjualan_id';
        }, 1000); // Mengalihkan setelah 3 detik
      </script>";

?>


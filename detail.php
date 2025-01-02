<?php
session_start();
include 'koneksi.php'; // File koneksi database

// Periksa apakah id film tersedia di URL
if (isset($_GET['id'])) {
    $movie_id = $_GET['id'];

    // Query untuk mendapatkan detail film berdasarkan id
    $query = "SELECT * FROM movies WHERE id = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("i", $movie_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Periksa apakah data ditemukan
    if ($result->num_rows > 0) {
        $movie = $result->fetch_assoc();
    } else {
        echo "<p>Movie not found.</p>";
        exit;
    }
} else {
    echo "<p>Invalid request.</p>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($movie['title']); ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="user.css">
    <style>
    /* Menambahkan flexbox ke body agar konten bisa mengisi ruang dan footer tetap di bawah */

.footer{
    margin-top: auto;
}


   /* Mengubah layout .detail-container untuk desktop */
.detail-body {
    background-color: #191A19;
    color: white;
    display: flex;
    flex-direction: column;
    min-height: 100vh; /* Agar body mengisi seluruh tinggi layar */
    margin: 0;
    padding: 0;
}

.detail-container {
    width: 100%; /* Kontainer mengisi lebar layar */
    padding: 0 10%; /* Memberi padding kiri dan kanan agar tidak terlalu rapat ke tepi */
    margin: 80px auto; /* Memberi jarak dari atas dan mengatur konten tengah */
    align-items: center;
    
}

.detail-container .row {
    display: flex;
    justify-content: flex-start; /* Mengatur agar kolom mulai dari kiri */
    gap: 20px; /* Mengurangi jarak antar kolom */
    flex-wrap: wrap; /* Pastikan kolom tetap responsif */
}

.detail-container .col-md-4 {
    flex: 1;
    max-width: 400px; /* Ukuran gambar lebih terkendali */
}

.detail-container .col-md-8 {
    flex: 2;
    max-width: 1000px;
}

/* Mengurangi margin bottom dan padding pada gambar agar lebih dekat dengan kolom detail */
.detail-container img {
    width: 100%;
    height: auto;
    object-fit: cover;
    border-radius: 10px;
    margin-bottom: 10px; /* Memberikan sedikit jarak ke bawah gambar */
}

.detail-container h1, .detail-container p {
    margin-bottom: 10px; /* Mengurangi margin bawah untuk teks */
}

.detail-container .btn-primary {
    font-size: 1.1rem;
    padding: 12px 25px;
    border-radius: 5px;
    margin-top: 10px; /* Menambahkan sedikit jarak atas pada tombol */
}
    </style>
</head>
<body class="detail-body">
    <?php include "Layout/header.php"; ?>
	
    <div class=" detail-container container-fluid">
        <div class="row mt-5">
            <!-- Poster Film -->
            <div class="col-md-4">
            <img src="Admin/uploads/<?php echo $movie['poster_url']; ?>" class="img-fluid" alt="<?php echo htmlspecialchars($movie['title']); ?>">
            </div>

            <!-- Detail Film -->
            <div class="col-md-8 ">
                <h1><?php echo htmlspecialchars($movie['title']); ?></h1>
                <p><strong>Release Year:</strong> <?php echo htmlspecialchars($movie['Tahun_Rilis']); ?></p>
                <p><strong>Genre:</strong> <?php echo htmlspecialchars($movie['genre']); ?></p>
                <p><strong>Duration:</strong> <?php echo htmlspecialchars($movie['duration']); ?> mins</p>
                <p><strong>Synopsis:</strong> <?php echo htmlspecialchars($movie['synopsis']); ?></p>
                <a href="<?php echo htmlspecialchars($movie['trailer_url']); ?>" class="btn btn-primary" target="_blank">Watch Trailer</a>
            </div>
        </div>
    </div>
</br>
    <?php include "Layout/footer.php"; ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>

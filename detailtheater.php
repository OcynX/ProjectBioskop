<?php
session_start();
include 'koneksi.php';

// Ambil ID theatre dari URL
$idTheatre = isset($_GET['id']) ? $_GET['id'] : null;

// Validasi jika ID tidak ada
if (!$idTheatre) {
    die("Invalid theatre ID.");
}

// Query untuk mendapatkan detail theatre
$queryTheatre = "SELECT * FROM theatres WHERE id = '$idTheatre'";
$resultTheatre = $db->query($queryTheatre);
$theatre = $resultTheatre->fetch_assoc();

// Query untuk mendapatkan daftar film yang sedang tayang di bioskop ini
$queryMovies = "
    SELECT 
        movies.title, 
        movies.genre, 
        movies.duration, 
        movies.synopsis, 
        movies.poster_url, 
        jadwal.id,show_time,show_time2,show_time3,show_time4, 
        jadwal.price
    FROM jadwal
    INNER JOIN movies ON jadwal.movie_id = movies.id
    WHERE jadwal.theatre_id = '$idTheatre'
";
$resultMovies = $db->query($queryMovies);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Theatre</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="user.css">
    <style>

        .detail-body{
            background-color: #191A19;
            color: white;
        }
        .container {
            margin-top: 5%;
        }
        .container p{
            opacity: 0.9;
        }
        .bioskop{
            margin-bottom: 20px;
            margin-top: 7%;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100vw;
            height: 15vh;
            background-color: #B8001F;
        }
        .bioskop h1 {
            display: flex;
            font-weight: 600;
            font-size: 2rem;
            
            color: white;
            padding: 10px;
            align-items: center;
            justify-content: center;
        }
        .movie-card {
        display: flex;
        align-items: start;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.6);
        border-radius: 5px;
        overflow: hidden;
        margin-bottom: 20px;
        transition: transform 0.3s ease-in-out;
    }
    .movie-card:hover {
        transform: scale(1.05);
    }
    .movie-poster img {
        width: 150px; /* Atur ukuran gambar */
        height: auto;
    }
    .movie-details {
        margin-left: 30px;
        padding: 10px;
        flex: 1; /* Membuat detail teks memenuhi ruang */
    }
    .movie-title {
        font-size: 1.25rem;
        font-weight: bold;
        margin-bottom: 5px;
    }
    .movie-info {
        font-size: 0.9rem;
        margin-bottom: 5px;
    }
    .movie-synopsis {
        font-size: 0.85rem;
        color: #666;
        margin-bottom: 10px;
    }
    .harga{
        font-size: 1rem;
        opacity: 0.9;
        margin-top:10px;
    }
    .btn-showtime {
        background-color: #B8001F;
        color: white;
        font-size: 0.85rem;
        padding: 5px 10px;
        border: none;
        border-radius: 3px;
    }
    .btn-showtime:hover {
        background-color: #A0001A;
    }
    </style>
</head>
<body class="detail-body">
    <?php include "Layout/header.php"; ?>

    <div class="bioskop">
        <h1><?php echo $theatre['name']; ?></h1>
    </div>

    <div class="container">
        <p><strong>Location:</strong> <?php echo $theatre['location']; ?></p>
        <p><strong>Capacity:</strong> <?php echo $theatre['kapasitas']; ?></p>
        <p><strong>Contact:</strong> <?php echo $theatre['contact']; ?></p>

        <h2>Now Showing</h2>
        <div class="row">
            <?php if ($resultMovies->num_rows > 0): ?>
                <?php while ($movie = $resultMovies->fetch_assoc()): ?>
                    <div class="col-md-12">
                        <div class="movie-card">
                            <div class="movie-poster">
                                <img src="Admin/uploads/<?php echo $movie['poster_url']; ?>" alt="Poster of <?php echo $movie['title']; ?>">
                            </div>
                            <div class="movie-details">
                                <div class="movie-title"><?php echo $movie['title']; ?></div>
                                <div class="movie-info">
                                    <strong>Genre:</strong> <?php echo $movie['genre']; ?><br>
                                    <strong>Duration:</strong> <?php echo $movie['duration']; ?> mins<br>
                    
                                </div>
                        
                                <a href="pesanticket.php?id=<?php echo $movie['id']; ?>&theatre_id=<?php echo $idTheatre; ?>&show_time=<?php echo urlencode($movie['show_time']); ?>" class="btn-showtime">
    <?php 
    $time = date('H:i', strtotime($movie['show_time']));
    echo $time; 
    ?>
</a>

<a href="pesanticket.php?id=<?php echo $movie['id']; ?>&theatre_id=<?php echo $idTheatre; ?>&show_time=<?php echo urlencode($movie['show_time2']); ?>" class="btn-showtime">
    <?php 
    $time = date('H:i', strtotime($movie['show_time2']));
    echo $time; 
    ?>
</a>

<a href="pesanticket.php?id=<?php echo $movie['id']; ?>&theatre_id=<?php echo $idTheatre; ?>&show_time=<?php echo urlencode($movie['show_time3']); ?>" class="btn-showtime">
    <?php 
    $time = date('H:i', strtotime($movie['show_time3']));
    echo $time; 
    ?>
</a>

<a href="pesanticket.php?id=<?php echo $movie['id']; ?>&theatre_id=<?php echo $idTheatre; ?>&show_time=<?php echo urlencode($movie['show_time4']); ?>" class="btn-showtime">
    <?php 
    $time = date('H:i', strtotime($movie['show_time4']));
    echo $time; 
    ?>
</a>
                                <div class="harga">
                                    <strong>Price:</strong> Rp <?php echo number_format($movie['price'], 0, ',', '.'); ?>
                                </div>
                                

                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p class="text-center">No movies showing</p>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
include 'koneksi.php';

$location = isset($_GET['location']) ? $_GET['location'] : '';

$query = "SELECT movies.id, movies.poster_url, movies.title, theatres.location, theatres.kapasitas 
          FROM movies
          JOIN jadwal ON movies.id = jadwal.movie_id
          JOIN theatres ON jadwal.theatre_id = theatres.id";

if ($location != '') {
    $query .= " WHERE theatres.location = '$location'";
}

$query .= " LIMIT 12";
$result = $db->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman User</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <style>

.user-page {
    background-color: #191A19; /* Pastikan latar belakang halaman tetap gelap */
    color: white;
}

.user-card {
    border: 1px solid transparent;
    transition: transform 0.3s, border-color 0.3s;
    background-color: transparent;
}

.user-card-body {
    background-color: rgba(0, 0, 0, 0); /* Tembus pandang sepenuhnya */
    color: white;
    padding: 10px;
    text-align: center;
    transition: background-color 0.3s;
}

.user-card img {
    width: 100%;
    height: 60vh;
    object-fit: cover;
}

.user-card-title {
    font-size: 1.2rem;
    font-weight: bold;
    margin: 10px 0;
    color: white;
}

.user-movie-info {
    font-size: 0.9rem;
    color: white;
}

/* Hover Effects */
.user-card:hover .user-card-body {
    background-color: rgba(255, 0, 0, 0.8); /* Merah transparan saat hover */
    color: white; /* Tetap putih agar kontras */
}

.user-card:hover .user-card-title,
.user-card:hover .user-movie-info {
    color: white; /* Tetap putih saat hover */
}


</style>

</head>
<body class="user-page">
    <div class="container">
        <div class="row g-3">
            <?php if ($result && $result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <?php
                        $id = isset($row['id']) ? $row['id'] : 0;
                        $title = isset($row['title']) ? $row['title'] : 'Unknown Title';
                        $location = isset($row['location']) ? $row['location'] : 'Unknown Location';
                        $kapasitas = isset($row['kapasitas']) ? $row['kapasitas'] : 'Unknown Capacity';
                        $poster_url = isset($row['poster_url']) ? $row['poster_url'] : 'default-poster.jpg';
                    ?>
                    <div class="col-12 col-md-6 col-lg-3">
                        <a href="detail.php?id=<?php echo $id; ?>">
                            <div class="user-card">
                                <img src="Admin/uploads/<?php echo $row['poster_url']; ?>" class="card-img-top" alt="Movie Poster">
                                <div class="user-card-body">
                                    <h3 class="user-card-title"><?php echo $title; ?></h3>
                                    <div class="user-movie-info">
                                        <span>Lokasi: <?php echo $location; ?></span><br>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p class="text-center">No theatres found</p>
            <?php endif; ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

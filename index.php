<?php
session_start();
include 'koneksi.php';

// Mendapatkan lokasi dari filter yang dipilih
$location = isset($_GET['location']) ? $_GET['location'] : ''; // Default: kosong untuk menampilkan semua lokasi
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman User</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="user.css"> <!-- File CSS yang digabungkan -->
</head>
<body class="user-page">

    <!-- Header -->
    <?php include "Layout/header.php"; ?>

    <!-- Filter Lokasi Section -->
   

    <!-- Carousel Section -->
    <section class="user-carousel-section">
        <div id="movieCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <!-- Carousel Item 1 -->
                <div class="carousel-item active">
                    <img src="Asset/home1.jpg" class="d-block w-100" alt="Movie 1">
                    <div class="carousel-caption user-carousel-caption">
                        <a href="movie1.html" class="stretched-link">
                            <h5>Movie 1</h5>
                            <p>Action | Adventure</p>
                        </a>
                    </div>
                </div>
                <!-- Carousel Item 2 -->
                <div class="carousel-item">
                    <img src="Asset/home1.jpg" class="d-block w-100" alt="Movie 2">
                    <div class="carousel-caption user-carousel-caption">
                        <a href="movie2.html" class="stretched-link">
                            <h5>Movie 2</h5>
                            <p>Drama | Romance</p>
                        </a>
                    </div>
                </div>
                <!-- Carousel Item 3 -->
                <div class="carousel-item">
                    <img src="Asset/home1.jpg" class="d-block w-100" alt="Movie 3">
                    <div class="carousel-caption user-carousel-caption">
                        <a href="movie3.html" class="stretched-link">
                            <h5>Movie 3</h5>
                            <p>Comedy | Family</p>
                        </a>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#movieCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#movieCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>
    <section class="user-filter-section">
        <div class="container mt-4">
            <form method="GET" action="HalamanUser.php" id="filter-form">
                <div class="row">
                    <div class="col-md-6">
                        <select name="location" class="form-select" onchange="filterMovies()">
                            <option value="">-- Pilih Lokasi --</option>
                            <option value="Ungaran" <?php if ($location == "Ungaran") echo "selected"; ?>>Ungaran</option>
                            <option value="Ambarawa" <?php if ($location == "Ambarawa") echo "selected"; ?>>Ambarawa</option>
                            <option value="Salatiga" <?php if ($location == "Salatiga") echo "selected"; ?>>Salatiga</option>
                            <!-- Tambahkan lokasi lain jika ada -->
                        </select>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <!-- Card Catalog Section -->
    <section class="user-card-catalog" id="movie-list">
        <div class="container">
            <div class="row g-4" id="movies-container">
                <!-- Film akan dimuat di sini dengan AJAX -->
            </div>
        </div>
    </section>

    <?php include "Layout/footer.php"; ?>

    <!-- Bootstrap JS -->
     
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- AJAX untuk filter lokasi dan menampilkan hasil tanpa reload -->
    <script>
        function filterMovies() {
            var location = document.querySelector('select[name="location"]').value;
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'filtermovies.php?location=' + location, true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    document.getElementById('movies-container').innerHTML = xhr.responseText;
                }
            };
            xhr.send();
        }

        // Memuat film saat halaman pertama kali dimuat
        window.onload = filterMovies;
    </script>
    <script>
    const menuToggle = document.getElementById('menu-toggle');
    const navbar = document.getElementById('navbar');

    menuToggle.addEventListener('click', () => {
        navbar.classList.toggle('active');
    });
</script>

</body>
</html>

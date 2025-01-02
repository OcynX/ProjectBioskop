<?php
include "../koneksi.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="admin.css">
    <style>
        .container {
    background-color: #242424;
    padding: 30px;
    border-radius: 8px;
    margin-left: 20%;
}

h2 {
    color: white;
    margin-bottom: 20px;
}

.form-group label {
    color: #ccc;
}

.upload-box {
    background-color: #333;
    padding: 10px;
    border-radius: 8px;
    text-align: center;
    color: #bbb;
    height: 90vh;
    align-items: center;
    justify-content: center;
    display: flex;
}
    </style>
</head>
<body>
    <div class="d-flex">
    <div class="sidebar">
            <h3 class="p-3">CINEMA21</h3>
            <a href="halamanAdmin.php">Dashboard</a>
            <a href="management_ticket.php">Management Tiket</a>
            <a href="managementTheater.php">Management Bioskop</a>
            <a href="gudangdatafilm.php">Manajemen Film</a>
            <a href="LaporanPenjualan.php">Laporan Penjualan</a>
            <a href="logout.php">Logout</a>
        </div>
        <div class="container mt-2">
        <h2>Add new item</h2>
        <form action="submit_movie.php" method="POST" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-4">
            <div class="upload-box">
                <p>Upload cover (270 x 400)</p>
                <input type="file" class="form-control mb-3" name="poster" required>
            </div>
        </div>
        <div class="col-md-8">
            <div class="form-group mb-3">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="form-group mb-3">
                <label for="synopsis">Synopsis</label>
                <textarea class="form-control" id="synopsis" name="synopsis" rows="3" required></textarea>
            </div>
            <div class="form-group mb-3">
                <label for="duration">Duration</label>
                <input type="text" class="form-control" id="duration" name="duration" required>
            </div>
            <div class="form-group mb-3">
                <label for="genre">Genre</label>
                <select class="form-control" id="genre" name="genre" required>
                    <option value="action">Action</option>
                    <option value="adventure">Adventure</option>
                    <option value="comedy">Comedy</option>
                    <option value="drama">Drama</option>
                    <option value="fantasy">Fantasy</option>
                    <option value="horror">Horror</option>
                    <option value="romance">Romance</option>
                    <option value="science fiction">Science Fiction</option>
                    <option value="thriller">Thriller</option>
                </select>
            </div>
            <div class="form-group mb-3">
                <label for="release-year">Release Year</label>
                <input type="number" class="form-control" id="release-year" name="release_year" required>
            </div>
            <div class="form-group mb-3">
                <label for="trailer_url">Trailer URL</label>
                <input type="text" class="form-control" id="trailer_url" name="trailer_url" required>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary mt-3">Submit</button>
</form>

    </div>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
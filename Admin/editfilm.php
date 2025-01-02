<?php
include "../koneksi.php";

if (!isset($_GET['id'])) {
    header('Location: GudangDataFilm.php');
    exit(); // Stop further execution
}

$id = $_GET['id'];

$sql = "SELECT * FROM movies WHERE id = '$id'";
$query = mysqli_query($db, $sql);

if (!$query) {
    die("ERROR: QUERY FAILED");
}

$movie = mysqli_fetch_assoc($query);

if (!$movie) {
    die("Error: Data tidak ditemukan untuk ID: $id");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Film</title>
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

        .btnsubmit {
            width: 100%;
            height: auto;
            align-items: end;
            display: flex;
            justify-content: end;
        }

        .btnsubmit submit {
            margin: 4px;
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <div class="sidebar">
            <h3 class="judul p-3">CINEMA21</h3>
            <a href="halamanAdmin.php">Dashboard</a>
                <a href="ManagementTicket.php">Management Tiket</a>
                <a href="managementTheater.php">Management Bioskop</a>
                <a href="gudangdatafilm.php">Manajemen Film</a>
                <a href="LaporanPenjualan.php">Laporan Penjualan</a>
                <a href="logout.php">Logout</a>
        </div>
        <div class="container mt-2">
            <h2>Edit Film</h2>
            <form action="proseseditmovie.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= htmlspecialchars($movie['id']); ?>">
                <div class="row">
                    <div class="col-md-4">
                        <div class="upload-box">
                            <p>Upload cover (270 x 400)</p>
                            <input type="file" class="form-control mb-3" name="poster">
                            <small class="text-muted">Biarkan kosong jika tidak ingin mengganti poster.</small>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group mb-3">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title" value="<?= htmlspecialchars($movie['title']); ?>" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="synopsis">Synopsis</label>
                            <textarea class="form-control" id="synopsis" name="synopsis" rows="3" required><?= htmlspecialchars($movie['synopsis']); ?></textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label for="duration">Duration</label>
                            <input type="text" class="form-control" id="duration" name="duration" value="<?= htmlspecialchars($movie['duration']); ?>" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="genre">Genre</label>
                            <select class="form-control" id="genre" name="genre" required>
                                <option value="action" <?= $movie['genre'] === 'action' ? 'selected' : ''; ?>>Action</option>
                                <option value="adventure" <?= $movie['genre'] === 'adventure' ? 'selected' : ''; ?>>Adventure</option>
                                <option value="comedy" <?= $movie['genre'] === 'comedy' ? 'selected' : ''; ?>>Comedy</option>
                                <option value="drama" <?= $movie['genre'] === 'drama' ? 'selected' : ''; ?>>Drama</option>
                                <option value="fantasy" <?= $movie['genre'] === 'fantasy' ? 'selected' : ''; ?>>Fantasy</option>
                                <option value="horror" <?= $movie['genre'] === 'horror' ? 'selected' : ''; ?>>Horror</option>
                                <option value="romance" <?= $movie['genre'] === 'romance' ? 'selected' : ''; ?>>Romance</option>
                                <option value="science fiction" <?= $movie['genre'] === 'science fiction' ? 'selected' : ''; ?>>Science Fiction</option>
                                <option value="thriller" <?= $movie['genre'] === 'thriller' ? 'selected' : ''; ?>>Thriller</option>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="release-year">Release Year</label>
                            <input type="number" class="form-control" id="release-year" name="release_year" value="<?= htmlspecialchars($movie['Tahun_Rilis']); ?>" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="trailer_url">Trailer URL</label>
                            <input type="text" class="form-control" id="trailer_url" name="trailer_url" value="<?= htmlspecialchars($movie['trailer_url']); ?>" required>
                        </div>
                    </div>
                </div>
                <div class="btnsubmit">
                    <button type="submit" class="btn btn-primary mt-3">Submit</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

<?php
include "../koneksi.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $title = mysqli_real_escape_string($db, $_POST['title']);
    $synopsis = mysqli_real_escape_string($db, $_POST['synopsis']);
    $duration = intval($_POST['duration']);
    $genre = mysqli_real_escape_string($db, $_POST['genre']);
    $release_year = intval($_POST['release_year']);
    $trailer_url = mysqli_real_escape_string($db, $_POST['trailer_url']);

    // File upload handling
    $poster = $_FILES['poster'];
    $poster_name = null;

    // Jika ada file yang diunggah
    if ($poster['error'] === UPLOAD_ERR_OK) {
        $upload_dir = "uploads/"; // Folder untuk menyimpan file poster
        $poster_name = uniqid() . "_" . basename($poster['name']); // Nama file dengan ID unik
        $poster_path = $upload_dir . $poster_name; // Path untuk file gambar

        // Cek dan buat folder jika belum ada
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true); // Membuat folder jika belum ada
        }

        // Pindahkan file gambar ke folder uploads
        if (!move_uploaded_file($poster['tmp_name'], $poster_path)) {
            die("Error: Gagal mengunggah poster.");
        }
    }

    // Update query
    if ($poster_name) {
        // Jika ada file yang diunggah, update poster_url dengan nama file
        $sql = "UPDATE movies SET 
                title = '$title',
                synopsis = '$synopsis',
                duration = '$duration',
                genre = '$genre',
                Tahun_Rilis = '$release_year',
                poster_url = '$poster_name',  -- Menyimpan hanya nama file
                trailer_url = '$trailer_url'
                WHERE id = '$id'";
    } else {
        // Jika tidak ada file yang diunggah, hanya update data lainnya
        $sql = "UPDATE movies SET 
                title = '$title',
                synopsis = '$synopsis',
                duration = '$duration',
                genre = '$genre',
                Tahun_Rilis = '$release_year',
                trailer_url = '$trailer_url'
                WHERE id = '$id'";
    }

    // Eksekusi query
    $query = mysqli_query($db, $sql);

    if ($query) {
        // Redirect ke halaman manajemen film setelah update berhasil
        header('Location: GudangDataFilm.php');
        exit();
    } else {
        die("Error: Gagal mengupdate data");
    }
}
?>

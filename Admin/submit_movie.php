<?php
// Include file koneksi
include '../koneksi.php';

// Memproses form ketika tombol submit diklik
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $synopsis = $_POST['synopsis'];
    $duration = $_POST['duration'];
    $genre = $_POST['genre'];
    $Tahun_Rilis = $_POST['Tahun_Rilis'];
    $trailer_url = $_POST['trailer_url'];

    // Proses upload file
    $poster_url = ''; // Menginisialisasi variabel poster_url
    if (isset($_FILES['poster']) && $_FILES['poster']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = 'uploads/'; // Folder untuk menyimpan file
        $file_name = basename($_FILES['poster']['name']);
        $target_file = $upload_dir . $file_name;

        // Validasi ekstensi file
        $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
        $file_extension = strtolower(pathinfo($_FILES['poster']['name'], PATHINFO_EXTENSION));
        
        if (!in_array($file_extension, $allowed_extensions)) {
            echo "Ekstensi file tidak valid!";
            exit;
        }

        // Cek dan buat folder jika belum ada
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        // Pindahkan file yang diunggah
        if (move_uploaded_file($_FILES['poster']['tmp_name'], $target_file)) {
            $poster_url = $file_name;  // Menyimpan nama file saja, bukan path lengkap
        } else {
            echo "Gagal mengunggah file. Pastikan folder 'uploads/' dapat diakses.";
            exit;
        }
    } else {
        echo "Tidak ada file yang diunggah atau terjadi kesalahan.";
        exit;
    }

    // Debugging: Tampilkan nama file yang akan disimpan
    echo "Nama file yang akan disimpan: " . $poster_url;

    // Masukkan data ke database
    $sql = "INSERT INTO movies (title, synopsis, duration, genre, Tahun_Rilis, trailer_url, poster_url) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = $db->prepare($sql);
    $stmt->bind_param("sssssss", $title, $synopsis, $duration, $genre, $Tahun_Rilis, $trailer_url, $poster_url);

    if ($stmt->execute()) {
        echo "Data berhasil ditambahkan!";
    } else {
        echo "Error: " . $db->error;
    }

    $stmt->close();
}

$db->close();
?>

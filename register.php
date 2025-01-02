<?php
include "koneksi.php";

if (isset($_POST['register'])) {
    $username = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validasi apakah email sudah digunakan
    $check_email = "SELECT * FROM users WHERE email = '$email'";
    $result = $db->query($check_email);

    if ($result->num_rows > 0) {
        // Jika email sudah terdaftar
        echo "<script>alert('email sudah terdaftar');window.location = 'register.php';</script>";
    } else {
        // Menyimpan data baru ke database
        $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Menggunakan hashing untuk keamanan
        $sql = "INSERT INTO users (name, email, password) VALUES ('$username', '$email', '$hashed_password')";

        if ($db->query($sql)) {
            echo "<script>alert('Registrasi berhasil. Silakan login.');window.location = 'login.php';</script>";
        } else {
            echo "<script>alert('terjadi kesalahanm coba lagi.');window.location = 'login.php';</script>" . $db->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Register</title>
    <link rel="stylesheet" href="loginregister.css">
</head>
<body>

    <div class="login-page">
        <div class="wrapper">
            <form action="register.php" method="POST">
                <h3>Register</h3>
                <div class="input-box">
                    <input type="text" name="email" placeholder="Email" required>
                    <i class='bx bx-envelope'></i>
                </div>
                <div class="input-box">
                    <input type="text" name="name" placeholder="Username" required>
                    <i class='bx bxs-user'></i>
                </div>
                <div class="input-box">
                    <input type="password" name="password" placeholder="Password" required>
                    <i class='bx bxs-lock'></i>
                </div>
                <button type="submit" class="btn" name="register">DAFTAR SEKARANG</button>
                <div class="register-link">
                    <p>Sudah punya akun? <a href="login.php">Login</a></p>
                </div>
            </form>
        </div>
    </div>

    <?php include "Layout/footer.html"; ?>
</body>
</html>

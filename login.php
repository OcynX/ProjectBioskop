<?php
session_start();
include 'koneksi.php';

// Proses login
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Cek apakah email ada di database
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $db->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            // Set session setelah login sukses
            $_SESSION['user_id'] = $user['id'];  // Simpan user_id dalam session
            $_SESSION['user_name'] = $user['name'];  // Simpan nama user dalam session

            // Redirect ke halaman user setelah login
            header("Location: index.php");
            exit();
        } else {
            echo "Password salah. Silakan coba lagi.";
        }
    } else {
        echo "Email tidak terdaftar. Silakan daftar akun.";
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
    <title>Login</title>
    <link rel="stylesheet" href="loginregister.css">
</head>
<body>

    <div class="login-page">
        <div class="wrapper">
            <form action="login.php" method="POST">
                <h3>Login</h3>
                <div class="input-box">
                    <input type="email" placeholder="email" name="email" required>
                    <i class='bx bx-envelope'></i>
                </div>
                <div class="input-box">
                    <input type="password" placeholder="password" name="password" required>
                    <i class='bx bxs-lock'></i>
                </div>
                <button type="submit" class="btn" name="login">Login</button>
                <div class="register-link">
                    <p>Belum punya akun? <a href="register.php">Daftar</a></p>
                </div>
            </form>
        </div>
    </div>

    <?php include "Layout/footer.html"; ?>

</body>
</html>

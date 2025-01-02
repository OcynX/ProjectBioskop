<?php
include 'koneksi.php';
$isLoggedIn =isset($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="../user.css">
    <style>
        header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 50px;
    background-color: var(--bg-color);
    color: var(--text-color);
    position: fixed;
    top: 0;
    width: 100%;
    z-index: 1000;
    box-shadow: 0 4px 8px rgba(300, 0, 0, 0.5); /* Bayangan merah */
}

    </style>
</head>
<body>
    
</body>
</html>
<header>
    <a href="HalamanUser.php" class="logo"><i class='bx bx-movie-play'></i>Cinema12</a>

    <!-- Hamburger Menu -->
    <div class="menu-toggle" id="menu-toggle">
        <i class='bx bx-menu'></i>
    </div>

    <!-- Menu Navbar -->
    <ul class="navbar" id="navbar">
        <li><a href="HalamanUser.php" class="home-active">Home</a></li>
        <li><a href="theater.php">Theatre</a></li>
        <?php if ($isLoggedIn): ?>
            <li><a href="logout.php">Logout</a></li>
        <?php else: ?>
            <li><a href="login.php">Login</a></li>
            <li><a href="register.php">Register</a></li>
        <?php endif; ?>
    </ul>
</header>
<script>
    const menuToggle = document.getElementById('menu-toggle');
    const navbar = document.getElementById('navbar');

    menuToggle.addEventListener('click', () => {
        navbar.classList.toggle('active');
    });
</script>



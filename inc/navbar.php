<?php
	require_once("inc/header.php");
  $conn = new mysqli("localhost", "root", "", "laundry1");
  
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-lg fixed-top">
  <div class="container">
    <a class="navbar-brand" href="index.php">Rancabana<span class="text-danger">Laundry</span></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse text-right" id="navbarNav">
    <?php if (isset($_SESSION["pelanggan"])): ?>
    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
        <a class="nav-link" href="index.php"><i class="fa fa-home icon-small"></i> Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="keranjang.php"><i class="fa fa-shopping-cart icon-small"></i> Keranjang</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="paket.php"><i class="fa fa-archive icon-small"></i> Layanan</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="akun.php" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-user icon-small"></i> Akun
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="akun.php">Data Akun</a></li>
            <li><a class="dropdown-item" href="riwayat.php">Riwayat Belanja</a></li>
          </ul>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="logout.php"><i class="fa fa-sign-out icon-small"></i> logout</a>
        </li>
      </ul>
      <?php else : ?>
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
        <a class="nav-link" href="index.php"><i class="fa fa-home icon-small"></i> Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="paket.php"><i class="fa fa-archive icon-small"></i> Layanan</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="about.php"><i class="fa fa-book icon-small"></i> Tentang</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="login/login.php"><i class="fa fa-sign-in icon-small"></i> Login</a>
        </li>
      </ul>
      <?php endif ?>
    </div>
  </div>
</nav>
</header>




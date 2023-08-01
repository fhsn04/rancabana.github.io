<?php
session_start();

require_once("inc/navbar.php");
require_once("koneksi.php");

$satuan = array();
$ambil = $conn->query("select * from kategori WHERE kategori.proses = 'satuan'");
while ($tiap = $ambil->fetch_assoc())
{
  $satuan[] = $tiap;
}
$kiloan = array();
$ambil2 = $conn->query("select * from kategori WHERE kategori.proses = 'kiloan'");
while ($tiap2 = $ambil2->fetch_assoc())
{
  $kiloan[] = $tiap2;
}
?>

<!-- banner -->
<section class="content">
<div class="container-fluid banner">
    <div class="container text-center">
        <h2 class="fw-bold">Selamat Datang Di Website Rancabana <span class="text-danger fw-bold">Laundry</span></h2>
        <h4>Nikmati laundry dengan pelayanan cepat dan berkualitas</h4>
        <a href="paket.php" class="btn btn-danger">Pesan Sekarang</a>
    </div>
</div>
<!-- banner end -->

<!-- Kategori -->

<div class="container-fluid p-5 mt-5">
<h1 class="text-bs-primary text-center">Kategori Layanan Satuan</h1><br><br>
<div class="row text-center">
<?php foreach ($satuan as $key => $value): ?>
        <div class="col-lg-3">
            <img class="img-circle" src="img/<?= $value['foto_kategori']; ?>" alt="Generic placeholder image" width="140" height="140"><br><br>
            <h2><?= $value['nama_kategori']; ?></h2>
          <p><?= $value['des_kategori']; ?></p>
          <p><a class="btn btn-danger" href="paket.php?id=<?= $value['id_kategori']; ?>" role="button">View details &raquo;</a></p>
        </div><!-- /.col-lg-4 -->
<?php endforeach ?>
</div><!-- /.row -->
<h1 class="text-bs-primary text-center p-5">Kategori Layanan Kiloan</h1>
<div class="row text-center">
<?php foreach ($kiloan as $key => $value): ?>
        <div class="col-lg-4 ">
            <img class="img-circle" src="img/<?= $value['foto_kategori']; ?>" alt="Generic placeholder image" width="140" height="140"><br><br>
            <h2><?= $value['nama_kategori']; ?></h2>
          <p><?= $value['des_kategori']; ?></p>
          <p><a class="btn btn-danger" href="paket.php?id=<?= $value['id_kategori']; ?>" role="button">View details &raquo;</a></p>
        </div><!-- /.col-lg-4 -->
<?php endforeach ?>
      </div><!-- /.row -->
</div>

<!-- kategori end -->

<!-- carousel -->

<div class="container-fluid mt-2 p-5">
  <div class="container shadow-lg">
  <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="img/carousel1.png" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="img/carousel2.png" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="img/carousel3.png" class="d-block w-100" alt="...">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
  </div>
  </div>
</div>

<!-- carausel end -->

<!-- tentang -->
<div class="container">
<h1 class="text-bs-primary text-center text-upper mt-5">Tentang Kami</h1><br><br>
<div class="row">
    <div class="col-6">
      <img class="img-thumbnail" src="img/bg2.jpg" alt="...">
    </div>

  <div class="col-6">
  <div class="thumbnail p-2">
    <h3>Rancabana Laundry</h3>
    <p>Berdiri pada tahun 2017 beralamat Jl. Kavling-Komplek DKI No.67, RT.006/RW.003 Jakarta Selatan. Di dalam menjalankan usahanya tidak berbeda dengan usaha jasa laundry pada umumnya yang mempertahankan kepuasan pelanggan. Rancabana Laundry menawarkan jasa pencucian sampai penyetrikaan yang berkualitas dengan harga terjangkau. Rancabana Laundry juga menawarkan layanan pengambilan dan pengantaran yang efisien untuk pelanggan yang masih terjangkau dari lokasi toko. Rancabana Laundry juga menjual beberapa produk parfum laundry yang bisa didapatkan di toko ofline dan juga toko-toko online ternama seperti shopee dan tokopedia.</p>
  </div>
  <h2><a href="paket.php" class="link-opacity-25-hover text-danger"><i class="fa fa-shopping-cart"></i> Pesan Sekarang</a></h2>
  </div>
</div>  
</div>

<!-- tentang end -->

<!-- pilih rancabana laundry -->
<div class="bg-dark dark-gradient bg-gradient">
<div class="container-fluid text-light p-2 mt-5">
            <h2 class="text text-center text-upper mt-3">Mengapa Pilih Rancabana Laundry</h2><br><br>
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="single-cat text-center">
                            <div class="cat-icon">
                                <img src="img/icon/services-icon1.svg" alt="">
                            </div>
                            <div class="cat-cap">
                                <h3><a href="paket.php">Merima Banyak Jenis</a></h3>
                                <p>The automated process starts as soon as your clothes go into the machine. The outcome is gleaming clothes!</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="single-cat text-center">
                            <div class="cat-icon">
                                <img src="img/icon/services-icon2.svg" alt="">
                            </div>
                            <div class="cat-cap">
                                <h3><a href="paket.php">Proses Pencucian Berkualitas</a></h3>
                                <p>The automated process starts as soon as your clothes go into the machine. The outcome is gleaming clothes!</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="single-cat text-center">
                            <div class="cat-icon">
                                <img src="img/icon/services-icon3.svg" alt="">
                            </div>
                            <div class="cat-cap">
                                <h3><a href="paket.php">Kami Antar/Jemput</a></h3>
                                <p>The automated process starts as soon as your clothes go into the machine. The outcome is gleaming clothes!</p>
                            </div>
                        </div>
                    </div>
            </div>
            </div>
            </div>

<!-- pilih rancabana laundry end -->

<!-- testimoni -->
<?php
$testi = array();
$ambil = $conn->query("SELECT * FROM testimoni JOIN pelanggan ON pelanggan.id_pelanggan = testimoni.id_pelanggan");
while ($tiap = $ambil->fetch_assoc())
{
  $testi[] = $tiap;
}
?>
<div id="carouselExampleAutoplaying" class="carousel slide text-center p-2 mt-2" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">    
      <img src="img/testimoni.jpg" class="center img-circle height-10" alt="...">
      <h2>Testimoni.</h2>
      <p></p>
    </div><?php foreach ($testi as $key => $value): ?>  
    <div class="carousel-item">    
      <img src="img/testimoni.jpg" class="center img-circle height-10" alt="...">
      <h2>Testimoni, <?php echo $value['nama_pelanggan']; ?>.</h2>
      <p><?php echo $value['testimoni']; ?></p>
    </div><?php endforeach ?>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
<!-- testimoni end -->

<!-- map -->
<div class="Map-area p-5">
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.2995293719596!2d106.80574731476986!3d-6.355258995401091!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69ee9a3f1d37b5%3A0x49edaedc61b16e58!2sRancabana%20Laundry!5e0!3m2!1sid!2sid!4v1687456532969!5m2!1sid!2sid" class="w-100" height="450" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</div>
<div class="alert alert-secondary" role="alert">
    <p class="text-center"><i class="fa fa-location-arrow"></i> Kunjungi toko offline kami di Alamat Jl. Kavling-Komplek DKI No.67, RT.006/RW.003 Jakarta Selatan.<br>
Anda dapat melihat proses pelayanan toko kami secara langsung dan anda juga dapat menerima layanan service kiloan jika anda melakukan proses transaksi di toko offline kami.</p>
<p class="text-center">Kami sangat menghargai pendapat Anda! Berikan testimonial tentang pengalaman Anda dengan layanan kami.</p>
<form method="POST">
    <div class="text-center">
        <textarea class="text-center" name="testimoni" placeholder="masukan pendapat anda.." cols="100" rows="3"></textarea><br>
        <button class="btn btn-danger w-25" name="post">Kirim</button>        
    </div>
</form>
<?php
$id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];
if (isset($_POST['post'])) {
$testi = $_POST['testimoni'];

if (!isset($id_pelanggan) OR empty($id_pelanggan)){
    echo "<script>alert('Untuk mengirim testimoni anda harus login terlebih dahulu')</script>";
    echo "<script>location='index.php'</script>";
}else{
$query = "INSERT INTO testimoni (id_pelanggan, testimoni) Values ('$id_pelanggan', '$testi') ON DUPLICATE KEY UPDATE testimoni = '$testi'";
$insert = mysqli_query($conn, $query);
    if ($insert == 1) {
        echo "<script>alert('Data berhasil di kirim')</script>";
        echo "<script>location='index.php'</script>";
    } else{
        echo "<script>alert('Untuk mengirim testimoni anda harus login terlebih dahulu')</script>";
        echo "<script>location='index.php'</script>";
    }
}
}

?>
</div>

<!-- map end -->

<!-- footer -->
<?php require_once("inc/footer-nav.php"); ?>
<?php require_once("inc/footer.php"); ?>
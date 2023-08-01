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

<br><br>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-2">
		<div class="list-group bg-dark text-light">		
		<h4 class="list-group-item list-group-item-action active" aria-current="true">kategori Satuan</h4>
		<?php foreach ($satuan as $key => $value): ?>	
			<a href="paket.php?id=<?php echo $value["id_kategori"] ?>" class="text-danger p-2 fw-bold">
			<?php echo $value["nama_kategori"] ?></a>
			<?php endforeach ?>
		</div>

		<div class="list-group bg-dark text-light mt-5">		
		<h4 class="list-group-item list-group-item-action active" aria-current="true">kategori Kiloan</h4>
		<?php foreach ($kiloan as $key => $value): ?>	
			<a href="paket.php?id=<?php echo $value["id_kategori"] ?>" class="text-danger p-2 fw-bold">
			<?php echo $value["nama_kategori"] ?></a>
			<?php endforeach ?>
		</div>
	</div>
		
<?php 
$kategori = isset($_GET['id']) ? $_GET['id'] : '';
$title=$conn->query("SELECT * FROM kategori WHERE id_kategori = '$kategori'");
$datatitle=$title->fetch_assoc();
$query = "SELECT * FROM paket_cuci";
if (!empty($kategori)) {
    $query .= " WHERE id_kategori = '$kategori'";
}
?>
<div class="col-md-10 p-2">
<h1 class='text-left text-upper text-bs-primary'><?php echo $datatitle["nama_kategori"] ?></h1><br>
<div class="row g-4">
<?php

$result = mysqli_query($conn, $query);
                if (mysqli_num_rows($result) > 0) {
                    while ($paket = mysqli_fetch_assoc($result)) {
?>

					<div class="col-md-2">
					<form method="POST">
						<div class="card" style="width: 14rem; height: 25rem;">		
							<div class="form-group">
                                <input type="hidden" name="id_paket" class="form-control form-control" value="<?php echo $paket['id_paket']; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="id_kategori" class="form-control form-control" value="<?php echo $paket['id_kategori']; ?>" readonly>
                            </div>				
							<img class="img-thumbnail shadow-lg h-50 w-100" src="img/<?= $paket['p_foto']; ?>">
							<h4 class="text-bs-primary text-center"><?php echo $paket['nama_paket']; ?></h4>
                            <h4 class="text-bold text-center"><?= 'Rp ' . number_format($paket['harga']); ?></h4>
							<div class="form-group">
                            	<div class="input-group">
                            		<input type="hidden" name="qty" value="1">
                            	</div>
                            </div>
							<div align="center">
							<button name="order" class="btn btn-danger p-2 m-2"> Pesan<button>
                            <a href="detail_paket.php?id=<?php echo $paket['id_paket']; ?>" class="btn btn-sucses">Detail</a>
							</div>
						</div>
						</form> 
					</div>
					               
                    <?php }
     				}?>
			</div>

		</div>
	</div>	
</div>


<?php
if(isset($_POST["order"])){
$id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];
$id_paket = $_POST["id_paket"];
$id_kategori = $_POST["id_kategori"];
$qty = $_POST["qty"];

if (!isset($id_pelanggan) OR empty($id_pelanggan)){
	echo "<script>alert('Untuk Order Paket Anda Harus Login Terlebih Dahulu')</script>";
	echo "<script>location='paket.php'</script>";
}else{
$conn->query("INSERT INTO keranjang (id_pelanggan, id_paket, id_kategori, qty) VALUES ('$id_pelanggan', '$id_paket', '$id_kategori', '$qty')");
echo "<script>alert('Berhasil Ditambahkan Ke Keranjang')</script>";
      echo "<script>location='keranjang.php'</script>";
}
}

?>


<?php require_once("inc/footer-nav.php"); ?>
</div>
<?php require_once("inc/footer.php"); ?>



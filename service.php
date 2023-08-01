<?php
session_start();
	require_once("inc/navbar.php");
  require_once("koneksi.php");
  $query = "SELECT * FROM kategori";
  $data = mysqli_query($conn, $query);
?>
<br><br>
<div class="container">
	<h1 class="text-bs-primary text-center text-upper">KATEGORI</h1>
	<div class="row p-5">
	<?php
    if (mysqli_num_rows($data) > 0) {
    while ($kategori = mysqli_fetch_assoc($data)) {
    ?>
				<div class="col-md-2">
					<a href="paket.php?id=<?= $kategori['id_kategori']; ?>" class="card bg-dark text-center shadow-lg" style="width: 12rem; height: 20rem;">
						<img class="img-thumbnail shadow-lg h-75 w-100" src="img/<?= $kategori['foto_kategori']; ?>">
						<p class="text-center fw-bold text-danger"><?= $kategori['nama_kategori']; ?></p>
					</a>
				</div>
                <?php }
     }?>
	</div>
	</div>
	
	<?php require_once("inc/footer-nav.php"); ?>

</div>
<?php require_once("inc/footer.php"); ?>
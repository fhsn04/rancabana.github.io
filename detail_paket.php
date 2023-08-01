<?php
session_start();
require_once("inc/navbar.php");
require_once("koneksi.php");

$id = $_GET['id'];
$query = $conn->query("select *FROM paket_cuci LEFT JOIN kategori ON paket_cuci.id_kategori = kategori.id_kategori WHERE id_paket = '$id' ");
            $data = $query->fetch_assoc();
?>

<br><br>
<div class="content">           
<div class="container">

	<div class="row">
		<div class="col-sm-4 p-2">
			<div class="product-img-area card shadow-lg">
				<img src="img/<?php echo $data['p_foto']; ?>">
			</div>
		</div>
		<div class="col-sm-7 p-2 m-2 card shadow-lg">
			<div class="product-desc-container">
                <form method="POST" class="p-2 m-2">
                <div class="form-group">
                    <input type="hidden" name="id_paket" class="form-control form-control" value="<?php echo $data['id_paket']; ?>" readonly>
                </div>
                <div class="form-group">
                    <input type="hidden" name="id_kategori" class="form-control form-control" value="<?php echo $data['id_kategori']; ?>" readonly>
                </div>
				<h1 class="text-danger fw-bold text-center p-3 m-2 shadow-lg"><?php echo $data['nama_paket']; ?></h1>
                <h2 class="p-2">Paket = <?php echo $data['nama_kategori']; ?></h2>
                <h2 class="p-2">Jenis Proses = <?php echo $data['proses']; ?></h2>
                <h2 class="p-2">Harga = Rp. <?php echo number_format($data['harga']); ?></h2>
                <h2 class="p-2">Deskripsi : </h2>
                <p><?php echo $data['deskripsi']; ?></p>

                    <div class="form-group">
                            	<div class="input-group">
                            		<input type="number" name="qty" min="1" placeholder="Jumlah - min 1" style="margin-right : 20px" requaired></input><button class="btn btn-danger tex" name="order">Order</botton>
                                </div><br><br><br>
                                    
                            </div>                   	
                    </div>
                </form>
                <div class="alert alert-dark"><span class="text-danger"> WARNING !!</span> : Mohon diperhatikan jenis proses yang anda pilih.<br> Jika jenis proses yang anda pilih adalah kiloan maka jumlah adalah perkiraan berat /kg.
                </div>
            </div>
            
        </div>
    </div>

</div>
</div>



<?php require_once("inc/footer.php"); ?>

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
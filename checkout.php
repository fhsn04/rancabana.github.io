<?php
session_start();
require_once("inc/navbar.php");
require_once("koneksi.php");

if (!isset($_SESSION["pelanggan"]))
{
	echo "<script>alert('silahkan login terlebih dahulu')</script>";
    echo "<script>location='login/login.php'</script>";
}
$id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];
$ambil = $conn->query("select * from keranjang WHERE keranjang.id_pelanggan = '$id_pelanggan'");
$data = $ambil->fetch_assoc();
if (empty($data['id_keranjang']) OR !isset($data['id_keranjang']))
{
    echo "<script>alert('keranjang tidak ada, silahkan pilih paket')</script>";
    echo "<script>location='paket.php'</script>";
}

?>

<?php 
$tgl = date('Y-m-d h:i:s');
$seminggu = mktime(0, 0, 0, date("n"), date("j") + 7, date("Y"));
$batas_waktu = date("Y-m-d h:i:s", $seminggu);
$kode = "CLN" . date('Ymdsi');
$id_pelanggan=$_SESSION['pelanggan']['id_pelanggan'];

$sql=$conn->query("select * from pelanggan WHERE id_pelanggan='$id_pelanggan'");
$data = $sql->fetch_assoc();
?>

<br><br><br>

<div class="container">
	<div class="row">

		<div class="col-sm-6 col-md-6 padding-8">
			<div class="card p-3 shadow-lg">
				<h1 class="text-bs-primary text-center text-upper">Alamat Penjemputan</h1>
				<form method="POST">
                            <div class="form-group">
                                <label for="largeInput">Kode Invoice</label>
                                <input type="text" name="kode_invoice" class="form-control form-control" value="<?= $kode; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="largeInput">Nama</label>
                                <input type="text" name="nama" class="form-control form-control" value="<?= $data['nama_pelanggan']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="largeInput">Email</label>
                                <input type="text" name="email" class="form-control form-control" value="<?= $data['email_pelanggan']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="largeInput">Alamat</label>
                                <input type="text" name="alamat" class="form-control form-control" value="<?= $data['alamat_pelanggan']; ?>" required>
                            </div>                                                   
                            <div class="form-group">
                                <label for="largeInput">No Telpon</label>
                                <input type="text" name="telp" class="form-control form-control" value="+62 <?= $data['telp_pelanggan']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="largeInput">Keterangan</label>
                                <textarea type="text" name="keterangan" class="form-control form-control"></textarea>
                            </div>
                        
                            
                            
                    
			</div>
		</div>

		<div class="col-sm-6 col-md-6 padding-8" style="min-height:550px;">
			<div class="card p-3 shadow-lg">
			<h1 class="text-bs-primary text-center text-upper">Item yang dipilih</h1>
            <div class="row">
            <table class="table">
            <th>No</th>
		    <th>Kategori</th>
            <th>Layanan</th>
            <th>Item</th>
            <th>Harga</th>		
            <th>Jumlah</th>
            <th>Total</th>
            <tr>        

<?php $nomor = 1;
$main_subtotal = 0;
$alert_shown = false;
?>           
<?php

$sql = "select keranjang.*, paket_cuci.nama_paket, paket_cuci.harga, kategori.nama_kategori, kategori.proses FROM keranjang INNER JOIN paket_cuci ON paket_cuci.id_paket = keranjang.id_paket INNER JOIN kategori ON kategori.id_kategori = keranjang.id_kategori INNER JOIN pelanggan ON pelanggan.id_pelanggan = keranjang.id_pelanggan WHERE keranjang.id_pelanggan = '$id_pelanggan'";
$result = mysqli_query($conn, $sql);

// Array untuk menyimpan item dengan ID yang sama
$mergedItems = array();

// Memproses hasil query
while ($row = mysqli_fetch_assoc($result)) {   
    $id = $row['id_paket'];
    $id_keranjang = $row['id_keranjang'];
    $nama_paket = $row['nama_paket'];
    $harga = $row['harga'];
    $jumlah = $row['qty'];
    $nama_kategori = $row['nama_kategori'];
    $proses = $row['proses'];
    
    // Jika ID sudah ada dalam array $mergedItems, tambahkan jumlahnya
    if (isset($mergedItems[$id])) {
        $mergedItems[$id]['qty'] += $jumlah;
    } else {
        // Jika ID belum ada, tambahkan item baru ke array $mergedItems
        $mergedItems[$id] = array(
            'nama_paket' => $nama_paket,
            'harga' => $harga,
            'qty' => $jumlah,
            'proses' => $proses,
            'nama_kategori' => $nama_kategori          
        );
    }
}
    foreach ($mergedItems as $id => $item) {
        $nama_paket = $item['nama_paket'];
        $harga = $item['harga'];
        $jumlah = $item['qty'];
        $proses = $item['proses'];
        $nama_kategori = $item['nama_kategori'];
        $ongkir = 5000;
        $dp = 5000;
        $subharga = $harga * $jumlah;
		    
        echo "	
            <td>$nomor</td>
			<td>$nama_kategori</td>
            <td>$proses</td>
            <td>$nama_paket</td>
			<td>Rp.".number_format($harga)."</td>
            <td>$jumlah</td>
			<td>Rp.".number_format($subharga)."</td>
			<tr>";

            if($proses == 'kiloan' && !$alert_shown){
                $main_subtotal = $main_subtotal + $dp;
                echo " <p  class='alert alert-danger'>perhatian !! anda memilih jenis layanan kiloan maka total harganya digantikan dengan uang muka yaitu sebesar Rp. 5,000.</p> ";
                $alert_shown = true;
            }elseif($proses == 'satuan'){
                $main_subtotal = $main_subtotal + $subharga;          
             }
            $nomor ++;
    }           
            
    ?>  
     
        
    </table>
    <div style="width:400px;" class="center">
			<div class="row">
				<div class="col-sm-6 text-left text-muted">Total Harga</div>
				<div class="col-sm-6 text-right">Rp. <?php echo number_format($main_subtotal); ?></div>
				<div class="col-sm-6 text-left text-muted">Antar Jemput</div>
				<div class="col-sm-6 text-right">Rp. <?php echo number_format($ongkir) ?></div>
				<div class="col-sm-6 text-left text-20 text-muted">Biaya Keseluruhan</div>
				<div class="col-sm-6 text-20 text-right">Rp. <?php echo number_format($ongkir + $main_subtotal) ?></div><br><br>
                <button type="submit" name="simpan" class="btn btn-danger">Checkout</button>
				<div class="col-sm-12 text-25">
                
				</div>
			</div>
		    </div>
            </form>
			</div>
		</div>
        
	</div>
	
</div>
 
<?php
 if (isset($_POST["simpan"])) {
    $kode_invoice = $_POST["kode_invoice"];
    $nama = $_POST["nama"];
    $email = $_POST["email"];
    $alamat = $_POST["alamat"];
    $telp = $_POST["telp"];
    $keterangan = $_POST["keterangan"];
    $total_keseluruhan = $main_subtotal + $ongkir;


            if ($proses=='kiloan'){
            $conn->query("INSERT INTO transaksi (kode_invoice, id_pelanggan, tgl, batas_waktu, biaya_tambahan, uang_muka, keterangan, nama, email, no_telp, alamat, status, status_bayar) VALUES ('$kode_invoice', '$id_pelanggan', '$tgl', '$batas_waktu', '$ongkir', '$total_keseluruhan', '$keterangan', '$nama', '$email', '$telp', '$alamat', 'baru', 'belum')");
            }elseif ($proses=='satuan'){
            $conn->query("INSERT INTO transaksi (kode_invoice, id_pelanggan, tgl, batas_waktu, biaya_tambahan, total_harga, pelunasan, keterangan, nama, email, no_telp,alamat, status, status_bayar) VALUES ('$kode_invoice', '$id_pelanggan', '$tgl', '$batas_waktu', '$ongkir', '$total_keseluruhan', '$total_keseluruhan', '$keterangan','$nama', '$email', '$telp', '$alamat', 'baru', 'belum')");
            }

            $id_transaksi_new = $conn->insert_id;
                
            foreach ($mergedItems as $id => $item) {
                $id_paket = $item['id_paket'];
                $nama_paket = $item['nama_paket'];
                $harga = $item['harga'];
                $jumlah = $item['qty'];
                $proses = $item['proses'];
                $nama_kategori = $item['nama_kategori'];
                $ongkir = 5000;

        $conn->query("INSERT INTO detail_transaksi (id_transaksi, id_paket, nama_paket, nama_kategori, proses, harga, qty) VALUES ('$id_transaksi_new', '$id', '$nama_paket', '$nama_kategori', '$proses', '$harga', '$jumlah')");
    }

    $conn->query("DELETE FROM keranjang WHERE keranjang.id_pelanggan = '$id_pelanggan'");
    unset($_SESSION["keranjang"][$id]);
    
    echo "<script>alert('Data Berhasil Ditambahkan')</script>";
    echo "<script>location='sukses.php?id=$id_transaksi_new';</script>";
}


?>

</div>
</div>
<div class="">
    <?php require_once("inc/footer-nav.php"); ?>
<?php require_once("inc/footer.php"); ?>
    
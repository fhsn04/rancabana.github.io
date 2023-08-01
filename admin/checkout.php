<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Laundry</title>

    <meta name="description" content="">
    <meta name="author" content="">
	
	<link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/dataTables/datatables.min.css" rel="stylesheet">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<!-- 
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    
</head>
<?php
require 'koneksi.php';
require 'navigasi.php';

$id_user = $_SESSION['user_id'];
$ambil = $conn->query("select * from keranjang WHERE keranjang.id_user = '$id_user'");
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
$pelanggan=$_SESSION['pelanggan'];

?>

<br><br><br>

<div class="container">
	<div class="row">

		<div class="col-sm-6 col-md-6 padding-8">
			<div class="thumbnail padding-13 box-sizing">
				<h1 class="text-bs-primary text-center text-upper">Input Data Pelanggan</h1>
				<form method="POST">
                            <div class="form-group">
                                <label for="largeInput">Kode Invoice</label>
                                <input type="text" name="kode_invoice" class="form-control form-control" value="<?= $kode; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="largeInput">Nama</label>
                                <input type="text" name="nama" class="form-control form-control" placeholder="Nama" requered>
                            </div>
                            <div class="form-group">
                                <label for="largeInput">Email</label>
                                <input type="text" name="email" class="form-control form-control" placeholder="Email" requered>
                            </div>
                            <div class="form-group">
                                <label for="largeInput">Alamat</label>
                                <textarea type="text" name="alamat" class="form-control form-control" placeholder="Alamat" requered></textarea>
                            </div>                                                   
                            <div class="form-group">
                                <label for="largeInput">No Telpon</label>
                                <input type="text" name="telp" class="form-control form-control" placeholder="No Telpon" requered>
                            </div>
                            <div class="form-group">
                                <label for="largeInput">Keterangan</label>
                                <textarea type="text" name="keterangan" class="form-control form-control" placeholder="Keterangan" requered></textarea>
                            </div>
                        
                            
                            
                    
			</div>
		</div>
        <div class="row">
		<div class="col-sm-6 col-md-6 padding-8" style="min-height:550px;">
			<div class="thumbnail padding-10 box-sizing">
			<h1 class="text-bs-primary text-center text-upper">Item yang dipilih</h1>
            
            <table class="table">
            <th>No</th>
		    <th>Kategori</th>
            <th>Item</th>
            <th>Harga</th>		
            <th>Jumlah</th>
            <th>Total</th>
            <tr>        

<?php $nomor = 1;
$main_subtotal = 0;
?>           
<?php

$sql = "select keranjang.*, paket_cuci.nama_paket, paket_cuci.harga, kategori.nama_kategori FROM keranjang INNER JOIN paket_cuci ON paket_cuci.id_paket = keranjang.id_paket INNER JOIN kategori ON kategori.id_kategori = keranjang.id_kategori WHERE keranjang.id_user = '$id_user'";
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

    
    // Jika ID sudah ada dalam array $mergedItems, tambahkan jumlahnya
    if (isset($mergedItems[$id])) {
        $mergedItems[$id]['qty'] += $jumlah;
    } else {
        // Jika ID belum ada, tambahkan item baru ke array $mergedItems
        $mergedItems[$id] = array(
            'nama_paket' => $nama_paket,
            'harga' => $harga,
            'qty' => $jumlah,
            'nama_kategori' => $nama_kategori          
        );
    }
}


// Menampilkan hasil penggabungan item
foreach ($mergedItems as $id => $item) {
    
    $main_subtotal = 0;
    $nama_paket = $item['nama_paket'];
    $harga = $item['harga'];
    $jumlah = $item['qty'];
    $nama_kategori = $item['nama_kategori'];
    $ongkir = 5000;

         $subharga = $harga * $jumlah;
		    
        echo "	
            <td>$nomor</td>
			<td>$nama_kategori</td>
            <td>$nama_paket</td>
			<td>Rp.".number_format($harga)."</td>
            <td>$jumlah</td>
			<td>Rp.".number_format($subharga)."</td>
			<tr>";
            $main_subtotal = $main_subtotal + $subharga;
            $nomor ++;
            }
    ?>
     
        
    </table>
    <div class="row">
    <div style="width:400px;" class="center">			
				<div class="col-sm-6 text-left text-muted">Total Harga</div>
				<div class="col-sm-6 text-right">Rp. <?php echo $main_subtotal; ?></div>
				<div class="col-sm-6 text-left text-muted">Antar Jemput</div>
				<div class="col-sm-6 text-right">Rp. <?php echo number_format($ongkir) ?></div>
				<div class="col-sm-6 text-left text-20 text-muted">Biaya Keseluruhan</div>
				<div class="col-sm-6 text-20 text-right">Rp. <?php echo number_format($ongkir + $main_subtotal) ?></div>
				<div class="col-sm-12 text-25">
                <button type="submit" name="simpan" class="btn btn-success">Submit</button>
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

    $conn->query("INSERT INTO transaksi (kode_invoice, tgl, batas_waktu, biaya_tambahan, total_harga, keterangan, nama, email, no_telp, alamat, status, status_bayar, id_user) VALUES ('$kode_invoice', '$tgl', '$batas_waktu', '$ongkir', '$total_keseluruhan', '$keterangan', '$nama', '$email', '$telp', '$alamat', 'baru', 'belum', '$id_user')");

    $id_transaksi_new = $conn->insert_id;

        $conn->query("INSERT INTO detail_transaksi (id_transaksi, id_paket, nama_paket, nama_kategori, harga, qty) VALUES ('$id_transaksi_new', '$id', '$nama_paket', '$nama_kategori', '$harga', '$jumlah')");
    

    $conn->query("DELETE FROM keranjang WHERE keranjang.id_user = '$id_user'");
    unset($_SESSION["keranjang"][$id]);
    
    echo "<script>alert('Data Berhasil Ditambahkan')</script>";
    echo "<script>location='sukses.php?id=$id_transaksi_new';</script>";
}


?>



    
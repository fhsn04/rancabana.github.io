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
$title = 'Tambah Transaksi';
require 'koneksi.php';

$id_user = $_SESSION['user_id'];

error_reporting(0);
require 'navigasi.php';
?>

<?php if (isset($_SESSION['msg']) && $_SESSION['msg'] <> '') { ?>
        <div class="alert alert-success" role="alert" id="msg">
            <?= $_SESSION['msg']; ?>
                </div>
    <?php }
    $_SESSION['msg'] = ''; ?>
</div>
	

<?php 
$satuan = array();
$ambil = $conn->query("select * from kategori");
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
        <div class="row">
        <div class="col-sm-1 col-md-1">
			<div class="thumbnail">
            
			    <ul class="category-list">
				<label>Kategori Satuan</label>	

                <?php foreach ($satuan as $key => $value): ?>
				<li><a href="tambah_transaksi.php?id=<?php echo $value["id_kategori"] ?>"><?php echo $value["nama_kategori"] ?></li></a>
                <?php endforeach ?>
                
			    </ul>
		    </div>
            <div class="thumbnail">
            
			    <ul class="category-list">
				<label>Kategori Kiloan</label>	

                <?php foreach ($kiloan as $key => $value): ?>
				<li><a href="tambah_transaksi.php?id=<?php echo $value["id_kategori"] ?>"><?php echo $value["nama_kategori"] ?></li></a>
                <?php endforeach ?>
                
			    </ul>
		    </div>
            </div>


<?php 
$nomor=0;
$kategori = isset($_GET['id']) ? $_GET['id'] : '';
$title=$conn->query("SELECT * FROM kategori WHERE id_kategori = '$kategori'");
$datatitle=$title->fetch_assoc();
$query = "SELECT * FROM paket_cuci WHERE id_kategori = '$kategori'";

?>

<div class="col-sm-7 col-md-7 bg-white border-ccc">
<h3 class='text-center text-upper text-primary'><?php echo $datatitle["nama_kategori"] ?></h3><br>


        <div class="col-md-12">

            <form method="POST">
                <table class="table table-responsive table-bordered">
                    <thead>
                        <th>No</th>
                        <th>Nama Paket</th>
                        <th>Harga</th>
                        <th>Tambah</th>
                    </thead>

        <?php          
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
            while ($paket = mysqli_fetch_assoc($result)) {
                $nomor++;
        ?>
                    <tbody>
                        <td><?php echo $nomor ?></td>
                        <td><?php echo $paket['nama_paket']; ?></td>
                        <td><?= 'Rp ' . number_format($paket['harga']); ?></td>
                        <td><div class="form-group small">
                        <input type="hidden" name="id_paket" class="form-control form-control" value="<?php echo $paket['id_paket']; ?>" readonly>
                        <input type="hidden" name="id_kategori" class="form-control form-control" value="<?php echo $paket['id_kategori']; ?>" readonly>   
                        <input type="hidden" name="qty" class="form-control form-control" value="1" readonly> 
                                    <button name="tambah" class="btn btn-default">tambah</button>
                            </div>
                        </td>             
                    </tbody>
                    <?php }
                   
     	}?>
         
                </table>
            </form>
<?php
if(isset($_POST["tambah"])){
$id_user = $_SESSION['user_id'];
$id_paket = $_POST["id_paket"];
$id_kategori = $_POST["id_kategori"];
$qty = $_POST["qty"];

$conn->query("INSERT INTO keranjang (id_paket, id_kategori, qty, id_user) VALUES ('$id_paket', '$id_kategori', '$qty', '$id_user')");
      echo "<script>location='tambah_transaksi.php'</script>";
}

?>
        </div>
        </div>


        <div class="col-md-4">
                <div class="panel panel-primary">
                <div class="panel-body">
                    <h2 class="text-bs-primary text-center text-upper text-bold">Jumlah Barang Yang dipilih</h2>
                </div>
                <div class="panel-footer">
                    <table class="table">
                            <th>No</th>
                            <th>Item</th>
                            <th>Jenis Paket</th>
                            <th>Harga</th>      
                            <th>Jumlah</th>
                            <th>Total</th>
                            <th>Hapus</th>
                        <tr>

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
	$nomor = 1;
    
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
                    echo"                        
                            <td>$nomor</td>
                            <td>$nama_paket</td>
                            <td>$nama_kategori</td>
                            <td>$harga</td>
                            <td>$jumlah</td>
                            <td>Rp.".number_format($subharga)."</td>
                            <td><a href='hapus_keranjang.php?id=$id' class='btn btn-primary'><i class='fa fa-trash-o'><i></a></td>
                        <tr>";
                        $nomor++;
			            $main_subtotal = $main_subtotal + $subharga;
                }?>
                    </table>
        <hr/>
        <div style="width:400px;" class="float-right">
            <div class="row">
                <div class="col-sm-6 text-left text-muted">Total Harga</div>
                <div class="col-sm-6 text-right">Rp. <?php echo $main_subtotal; ?></div>
                <div class="col-sm-6 text-left text-muted">Antar Jemput</div>
                <div class="col-sm-6 text-right">Rp. <?php echo number_format($ongkir) ?></div>
                <div class="col-sm-6 text-left text-20 text-muted">Biaya Keseluruhan</div>
                <div class="col-sm-6 text-20 text-right">Rp. <?php echo number_format($ongkir + $main_subtotal) ?></div>
                <div class="col-sm-12 text-25">
                    <a href="checkout.php" class="btn btn-primary text-upper btn-block">continue</a>
                </div>
            </div>
        </div>

                </div>
                </div>
        </div>
    
    </div>
</div>

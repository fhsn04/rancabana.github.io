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

<br><br><br>
<div class="container">
    <div class="card">
        <table class="table">
        <th>No</th>
        <th>Item</th>
        <th>Jenis Paket</th>
        <th>Proses</th>
        <th>Harga</th>      
        <th>Jumlah</th>
        <th>Total</th>
        <th>Hapus</th>
        <tr>
        
<?php
$main_subtotal = 0;
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
    $proses = $row['proses'];
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
            'proses' => $proses,
            'nama_kategori' => $nama_kategori
        );
    }
}


// Menampilkan hasil penggabungan item
foreach ($mergedItems as $id => $item) {    
    
    $nama_paket = $item['nama_paket'];
    $harga = $item['harga'];
    $jumlah = $item['qty'];
    $nama_kategori = $item['nama_kategori'];
    $proses = $item['proses'];
    $ongkir = 5000;

         $subharga = $harga * $jumlah;
                     
            echo "
            <td>$nomor</td>
            <td>$nama_paket</td>
            <td>$nama_kategori</td>
            <td>$proses</td>
            <td>$harga</td>
            <td>$jumlah</td>
            <td>Rp.".number_format($subharga)."</td>
            <td><a href='hapus_keranjang.php?id=$id' class='btn btn-danger'><i class='fa fa-trash-o'><i></a></td>
            <tr>";
			$nomor++;
			$main_subtotal = $main_subtotal + $subharga;
        } 
        


        
?>

  
        </table>
        </div><br>

        <div style="width:400px;" class="card shadow-lg p-3 ">
            <div class="row">
                <div class="col-sm-6 text-left text-muted">Total Harga</div>
                <div class="col-sm-6 text-right">Rp. <?php echo number_format($main_subtotal); ?></div>
                <div class="col-sm-6 text-left text-muted">Antar Jemput</div>
                <div class="col-sm-6 text-right">Rp. <?php echo number_format($ongkir) ?></div>
                <div class="col-sm-6 text-left text-20 text-muted">Biaya Keseluruhan</div>
                <div class="col-sm-6 text-20 text-right">Rp. <?php echo number_format($ongkir + $main_subtotal) ?></div>
                <div class="col-sm-12 text-25 p-2">
                    <a href="checkout.php" class="btn btn-danger text-upper btn-block">continue</a>
                </div>
            </div>
        </div>
        </div> 
    </div>
    
    <div class="">
    <?php require_once("inc/footer-nav.php"); ?>
<?php require_once("inc/footer.php"); ?>

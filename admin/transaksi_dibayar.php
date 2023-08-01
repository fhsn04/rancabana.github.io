<!DOCTYPE html>
<html lang="en">
<head>
  <style> 

.link, 
.link:link,
.link:active,
.link:visited{
    padding : 6px 15px;
    height : 4px ;
    margin-left : 11px;
    margin-right : 5px;
    margin-bottom : 15px;
    border-radius : 4px ;
    color : white;
    background-color : #34df04;
    text-decoration : none;
    font-family : Arial,Helvetica, sans-serif ;
}

.form {
    width : 700px;
    text-align: center;
    background : #cbc8e2 ;
    margin : 80px auto ;
    padding : 30px 20px ;
    box-sizing : border-box ;
    border : 1px solid black ;
    border-radius : 16px ;
    font-family : Arial,Helvetica, sans-serif ;
</style>
<?php
$title = 'Pembayaran';
require 'koneksi.php';
require 'navigasi.php';

$id = $_GET['id'];
$query = "SELECT * from transaksi WHERE transaksi.id_transaksi = " . $id;
$transaksi = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($transaksi);

$sql = "SELECT * from transaksi RIGHT JOIN detail_transaksi ON detail_transaksi.id_transaksi = transaksi.id_transaksi WHERE transaksi.id_transaksi = " . $id;

?>

                                        <div class="form">                      
                                        <br>
                                        <h1>Pesanan Atas Nama</h1>
                                        <h2><strong> <?= $data['nama'] ?></strong></h2>
                                        <h1> Pembayaran Lunas</h1>
                                        <h3><strong>Kode Invoice <?= $data['kode_invoice'] ?></strong></h3>
                                        <?php
                                        $result = mysqli_query($conn, $sql);
                                        if (mysqli_num_rows($result) > 0) {
                                         while ($data2 = mysqli_fetch_assoc($result)) {                                        
                                        $subharga = $data2['harga'] * $data2['qty'];
                                        $ongkir = 5000;
                                        ?>
                                        <h3><strong><?= $data2['nama_paket'] ?> - <?= $data2['nama_kategori'] ?> - <?= $data2['qty'] ?> = Rp.<?= number_format($subharga) ?></strong></h4>
                                        <?php }
                                         }?>
                                          <h3><strong>Biaya Antar Jemput = Rp.<?= number_format($data['biaya_tambahan']); ?></strong></h3>
                                        <h3><strong>Total Pembayaran <?= 'Rp ' . number_format($data['total_harga']); ?></strong><br></h3></strong><br></h3>
                                        <a href="transaksi.php" class="link">Kembali Ke Menu Utama</a>
                                    </div>
                                </div>
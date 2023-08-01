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
$title = 'Data Laporan';
require 'koneksi.php';

require 'navigasi.php';
?>
                        <h4 class="card-title"><?= $title; ?></h4>
                        
<br>
                        </a>
                    <div class="container" align="center">
                        <h3>Tampilkan Berdasarkan Periode Tanggal Pembayaran</h3>
                    <form method="POST">
                        <table style="width:400px;">
                        <tr>
                            <td>Dari</td>
                            <td><input type="date" name="dari" required="required"></td>
                            <td>Sampai</td>
                            <td><input type="date" name="sampai" required="required"></td>
                            <td><button type="submit" name="filter" class="btn btn-primary">Filter</button></td>
                        </tr>
                        </table>
                    </form>
                    </div>


                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                  <br>
                                    <th>No</th>
                                    <th>Kode</th>
                                    <th>Nama Pelanggan</th>
                                    <th>Paket Order</th>
                                    <th>Kategori</th>
                                    <th>Proses</th>
                                    <th>Jumlah</th>
                                    <th>Harga</th>
                                    <th>Biaya tambahan</th>
                                    <th>Total Keseluruhan</th>
                                    <th>Status</th>
                                    <th>Status Pembayaran</th>
                                    <th>Tanggal Pembayaran</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                if(isset($_POST['filter'])){
                                    $dari = mysqli_real_escape_string($conn, $_POST['dari']);
                                    $sampai = mysqli_real_escape_string($conn, $_POST['sampai']);
                                    $data = mysqli_query($conn,"SELECT * from transaksi JOIN detail_transaksi ON transaksi.id_transaksi = detail_transaksi.id_transaksi WHERE tgl_pembayaran BETWEEN '$dari' AND '$sampai'");
                                }
                                else{
                                
                                    $data = mysqli_query($conn,"SELECT * from transaksi JOIN detail_transaksi ON transaksi.id_transaksi = detail_transaksi.id_transaksi");                                
                                }
                                if (mysqli_num_rows($data) > 0) {
                                    while ($trans = mysqli_fetch_assoc($data)) {
                                ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $trans['kode_invoice']; ?></td>
                                            <td><?= $trans['nama']; ?></td>
                                            <td><?= $trans['nama_paket']; ?></td>
                                            <td><?= $trans['nama_kategori']; ?></td>
                                            <td><?= $trans['proses']; ?></td>
                                            <td>Rp. <?= number_format($trans['harga']); ?></td>
                                            <td><?= $trans['qty']; ?></td>
                                            <td>Rp. <?= number_format($trans['biaya_tambahan']); ?></td>
                                            <td><?= 'Rp ' . number_format($trans['total_harga']); ?></td>
                                            <td><?= $trans['status']; ?></td>
                                            <td><?= $trans['status_bayar']; ?></td>
                                            <td><?= $trans['tgl_pembayaran']; ?></td>                                            
                                        </tr>
                                <?php }
                                }
                                ?>
                            </tbody>
                        </table>
                          <br>
                          <?php if (isset($dari, $sampai)) :?>
                          <a href="cetak.php?dari=<?=$dari ?> && sampai=<?= $sampai ?>" target="_blank" class="button">
                            <i class="fa fa-print"></i>
                            Cetak Laporan
                        <?php else : ?>
                            <a href="cetak.php" target="_blank" class="button">
                            <i class="fa fa-print"></i>
                            Cetak Laporan
                        <?php endif ?>
                            <a href="laporan.php" class="link">Kembali</a>
                    
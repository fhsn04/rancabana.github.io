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
$title = 'Data Transaksi';
require 'koneksi.php';

$query = "SELECT * from transaksi ORDER BY status  desc";
 $data = mysqli_query($conn, $query);

require 'navigasi.php';
?>
                        <h4 class="card-title"><?= $title; ?></h4>
                        <a href="tambah_transaksi.php" class="btn btn-primary">
                            <i class="fa fa-plus"></i>
                            Tambah Transaksi
                        </a>
                        <a href="konfirmasi.php" class="btn btn-primary">
                            <i class="fas fa-user-check"></i>
                            Konfirmasi Pembayaran
                        </a>
                        
                    <div class="table-responsive">
                        <table id="datatables" class="table table-responsive">
                            <thead>
                                <tr>
                                    <th class"align-left">No</th>
                                    <th>Kode</th>
                                    <th>Nama Pelanggan</th>
                                    <th>Status</th>
                                    <th>Pembayaran</th>
                                    <th>Total</th>
                                    <th style="width: 10%;">Aksi</th>
                                </tr><br>
                                <?php
                                $no = 1;
                                if (mysqli_num_rows($data) > 0) {
                                    while ($trans = mysqli_fetch_assoc($data)) {
                                ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $trans['kode_invoice']; ?></td>
                                            <td><?= $trans['nama']; ?></td>
                                            <td ><?= $trans['status']; ?></td>
                                            <td><?= $trans['status_bayar']; ?></td>
                                            <td><?= 'Rp ' . number_format($trans['total_harga']); ?></td>
                                            <td>

                                            <a href="detail.php?id=<?= $trans['id_transaksi']; ?>" ><button class="btn btn-warning">Detail</button></a>
                                        </tr> 
                                                                                                       
                                <?php }
                                }


                     
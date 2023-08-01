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
$title = 'Konfirmasi Pembayaran Uang Muka dan Berat';
require 'koneksi.php';

$data = mysqli_query($conn, "SELECT * FROM transaksi WHERE transaksi.status_bayar = 'belum' AND transaksi.uang_muka != '0' ORDER BY tgl DESC");


require 'navigasi.php';
?>
        <?php if (isset($_SESSION['msg']) && $_SESSION['msg'] <> '') { ?>
            <div class="alert alert-success" role="alert" id="msg">
                <?= $_SESSION['msg']; ?>
            </div>
        <?php }
        $_SESSION['msg'] = ''; ?>
                        <h3 class="card-title text-center text-bold"><?= $title; ?></h3>
                    </div>
                </div><br>
                    
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode</th>
                                    <th>Nama Pelanggan</th>
                                    <th>Ongkir</th>
                                    <th>Uang Muka</th>
                                    <th>Total Harga</th>
                                    <th>Pelunasan</th>
                                    <th>Resi Pembayaran</th>
                                    <th style="width: 5%;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                if (mysqli_num_rows($data) > 0) {
                                    while ($trans = mysqli_fetch_assoc($data)) {
                                ?>

                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $trans['kode_invoice']; ?></td>
                                            <td><?= $trans['nama']; ?></td>
                                            <td><?= 'Rp ' . number_format($trans['biaya_tambahan']); ?></td>
                                            <td><?= 'Rp ' . number_format($trans['uang_muka']); ?></td>
                                            <td><?= 'Rp ' . number_format($trans['total_harga']); ?></td>
                                            <td><?= 'Rp ' . number_format($trans['pelunasan']); ?></td>
                                            <td><a class='MagicZoom' href="../img/<?= $trans['resi_dp']; ?>" rel='zoom-id:zoom;opacity-reverse:true;'>
                                                <img src="../img/<?= $trans['resi_dp']; ?>" width="100" alt='' /> </a></td>
                                            <td>
                                                <form method="POST">
                                                <div class="form-button-action">
                                                    <a href="hitung_berat.php?id=<?= $trans['id_transaksi']; ?>" type="button" data-toggle="tooltip" title="" class="button" data-original-title="Detail" name="konfirm">
                                                        <i class="fa fa-edit"></i> Proses
                                                    </a>
                                                </div>
                                                </form>
                                            </td>
                                        </tr>
                                <?php }
                                }
                                ?>
                            </tbody>
                        </table>
                        <br><a href="konfirmasi.php" class="btn btn-warning">Kembali</a>

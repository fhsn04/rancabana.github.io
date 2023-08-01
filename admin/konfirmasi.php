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
$title = 'Konfirmasi Pembayaran';
require 'koneksi.php';

$data = mysqli_query($conn, "SELECT * FROM transaksi WHERE transaksi.status_bayar = 'belum' OR transaksi.status_bayar = 'dp' ORDER BY id_transaksi ASC");


require 'navigasi.php';
?>
        <?php if (isset($_SESSION['msg']) && $_SESSION['msg'] <> '') { ?>
            <div class="alert alert-success" role="alert" id="msg">
                <?= $_SESSION['msg']; ?>
            </div>
        <?php }
        $_SESSION['msg'] = ''; ?>
            <h4 class="card-title"><?= $title; ?></h4>
        </div>
    </div>
        <a href="konfirmasi_dp.php" class="btn btn-primary">Konfirmasi Pembayaran Uang Muka dan Berat</a><br><br>
    <div class="card-body">
        <div class="table-responsive">
            <table id="basic-datatables" class="display table table-striped table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Nama Pelanggan</th>
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
                                <td><?= 'Rp ' . number_format($trans['uang_muka']); ?></td>
                                <td><?= 'Rp ' . number_format($trans['total_harga']); ?></td>
                                <td><?= 'Rp ' . number_format($trans['pelunasan']); ?></td>
                                <td><a class='MagicZoom' href="../img/<?= $trans['resi_p']; ?>" rel='zoom-id:zoom;opacity-reverse:true;'>
                                    <img src="../img/<?= $trans['resi_p']; ?>" width="100" alt='' /> </a></td>
                                <td>
                                    <form method="POST">
                                    <div class="form-button-action">
                                        <a href="bayar.php?id=<?= $trans['id_transaksi']; ?>" type="button" data-toggle="tooltip" title="" class="button" data-original-title="Detail" name="konfirm">
                                            <i class="fa fa-edit"></i> Proses
                                    </form>
                                </td>
                            </tr>
                    <?php }
                    }
                    ?>
                </tbody>
            </table>
            <br><a href="transaksi.php" class="btn btn-warning">Kembali</a>
            

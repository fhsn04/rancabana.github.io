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
if (isset ($_GET['dari'], $_GET['sampai'])){
$dari = $_GET['dari'];
$sampai = $_GET['sampai'];
$query = "SELECT * from transaksi JOIN detail_transaksi ON transaksi.id_transaksi = detail_transaksi.id_transaksi WHERE tgl_pembayaran BETWEEN '$dari' AND '$sampai'";
$data = mysqli_query($conn, $query);
}
else{
$query = "SELECT * from transaksi JOIN detail_transaksi ON transaksi.id_transaksi = detail_transaksi.id_transaksi";
$data = mysqli_query($conn, $query);
}

setlocale(LC_ALL, 'id_id');
setlocale(LC_TIME, 'id_ID.utf8');
?>
<!DOCTYPE html>
<html>

<head>
    <title>Cetak Laporan</title>
    <link href="../css/tbl.css?version=<?= filemtime("../css/tbl.css")?>" rel="stylesheet">
</head>

<body>

    <center>
<?php if (!empty($dari OR $sampai)): ?>
        <h2>DATA LAPORAN TRANSAKSI LAUNDRY</h2>
        <h4>STATUS PEMBAYARAN LUNAS</h4>
        <h6>Periode : <?= $dari ?> s/d <?= $sampai ?></h6>
<?php else : ?>
        <h2>DATA LAPORAN TRANSAKSI LAUNDRY</h2>
        <h6><?= strftime('%A %d %B %Y') ?></h6>
<?php endif ?>
        <h6 class="mr-auto">Oleh : <?= $_SESSION['username']; ?></h6>
        <br>
    </center>
    <table class="table table-bordered" style="width: 100%;">
        <thead>
            <tr>
                <th style="width: 3%">No</th>
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
                    <td>Rp. <?= number_format($trans['total_harga']); ?></td>
                    <td><?= $trans['status']; ?></td>
                    <td><?= $trans['status_bayar']; ?></td>
                    <td><?= $trans['tgl_pembayaran']; ?></td>
                    </tr>
            <?php }
            }
            ?>
        </tbody>
    </table>

    <script>
        window.print();
    </script>

</body>

</html>
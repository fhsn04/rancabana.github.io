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
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
	<!-- 
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    
</head>
<?php
$title = 'Data Paket';
require 'koneksi.php';
require 'navigasi.php'; 
?>
<br>
<div class="row">
<div class="col-lg-4">
                        
                        <a href="tambah_paket.php" class="btn btn-primary">
                            <i class="fa fa-plus"></i>
                            Tambah Paket</a>
                            <div class="btn-group active">
		<a href="paket.php?proses=satuan" class="btn btn-danger">Satuan</a>
        <a href="paket.php?proses=kiloan" class="btn btn-danger">Kiloan</a>
	</div>

</div>
</div>
<?php 
$proses = $_GET['proses'];
if (isset($proses)){
$query = "SELECT * FROM paket_cuci LEFT JOIN kategori ON paket_cuci.id_kategori=kategori.id_kategori WHERE kategori.proses = '$proses' ORDER BY nama_kategori ASC";
$data = mysqli_query($conn, $query);
}else{
$query = "SELECT * FROM paket_cuci LEFT JOIN kategori ON paket_cuci.id_kategori=kategori.id_kategori ORDER BY nama_kategori ASC";
$data = mysqli_query($conn, $query);
}

if($proses == 'satuan'){
    echo "
<h1 class='text-center text-primary'>Data Paket Satuan</h1><hr>";
}
elseif($proses == 'kiloan'){
    echo "
<h1 class='text-center text-primary'>Data Paket kiloan</h1><hr>";
}
else{
    echo "
<h1 class='text-center text-primary'>Data Paket</h1><hr>"; 
}
?>
                        </a>
                        <table class="table table-responsive">
                            <thead>
                                <tr>
                                  <br>
                                    <th>No</th>
                                    <th>Foto</th>
                                    <th>Nama Paket</th>
                                    <th>Jenis</th>
                                    <th>Deskripsi</th>
                                    <th>Harga</th>
                                    <th style="width: 10%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                if (mysqli_num_rows($data) > 0) {
                                    while ($paket = mysqli_fetch_assoc($data)) {
                                ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><img src="../img/<?= $paket['p_foto']; ?>" width="50"></td>
                                            <td><?= $paket['nama_paket']; ?></td>
                                            <td><?= $paket['nama_kategori']; ?></td>
                                            <td><?= $paket['deskripsi']; ?></td>
                                            <td><?= 'Rp ' . number_format($paket['harga']); ?></td>
                                            </td>
                                            <td>
                                                <div class="form-button-action">
                                                    <a href="edit_paket.php?id=<?= $paket['id_paket']; ?>" button class="btn btn-warning">Edit</button>
                                                    </a>
                                                     <a href="hapus_paket.php?id=<?= $paket['id_paket']; ?>"><button class="btn btn-danger">Hapus</button>
                                         
                                                    </a> 
                                                </div>
                                            </td>
                                        </tr>
                                <?php }
                                }
                                ?>
                            </tbody>
                        </table>
<?php
?>
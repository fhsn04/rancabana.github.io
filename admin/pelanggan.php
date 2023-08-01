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


<link href="../css/tbl.css?version=<?= filemtime("../css/tbl.css")?>" rel="stylesheet">
</head>
<body>
<?php
$title = 'Data Pelanggan';
require 'koneksi.php';
require 'navigasi.php';
$query = 'SELECT * FROM pelanggan';
$data = mysqli_query($conn, $query);
?>
                        <h4 class="card-title"><?= $title; ?></h4>
<br>
                        </a>
                        <table id="basic-datatables" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                  <br>
                                    <th style="width: 7%">No</th>
                                    <th>Nama</th>
                                    <th >email</th>
                                    <th >No Telp</th>
                                    <th >No KTP</th>
                                    <th >Alamat</th>
                                    <th >Jenis Kelamin</th>
                                    <th >Aksi</th>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                if (mysqli_num_rows($data) > 0) {
                                    while ($plg = mysqli_fetch_assoc($data)) {
                                ?>

                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $plg['nama_pelanggan']; ?></td>
                                            <td><?= $plg['email_pelanggan']; ?></td>
                                            <td><?= $plg['telp_pelanggan']; ?></td>
                                            <td><?= $plg['no_ktp']; ?></td>
                                            <td><?= $plg['alamat_pelanggan']; ?></td>
                                            <td><?php if ($plg['jenis_kelamin'] == 'L') {
                                                    echo "Laki-laki";
                                                } else {
                                                    echo "Perempuan";
                                                } ?>
                                            </td>
                                            <td>
                                                <div class="form-button-action">
                                                    <a href="hapus_pelanggan.php?id=<?= $plg['id_pelanggan']; ?>"><button class="button"><i class="fa fa-trash"> Hapus</i></button></a>
                                                    </a>
                                                </div>
                                               
                                            </td>
                                        </tr>
                                        
                                <?php }
                                }
                                ?>
                            </tbody>
                        </table>

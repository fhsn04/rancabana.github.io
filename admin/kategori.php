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
<body>
  
<?php
require 'koneksi.php';
$title = 'Data Kategori' ;
require 'navigasi.php';
$query = "SELECT * FROM kategori";
$data = mysqli_query($conn, $query);
?>

                       
                         <h4 class="card-title"><?= $title; ?></h4>
                        <a href="tambah_kategori.php" class="button">
                            <i class="fa fa-plus"></i>
                            Tambah Kategori
<br>
                        </a>
                        <table id="basic-datatables" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                  <br>
                                    <th>No</th>
                                    <th>kategori</th>
                                    <th>Jenis Layanan</th>
                                    <th>Deskripsi</th>
                                    <th>Foto</th>
                                    <th style="width: 13%;">Aksi</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                              
                                <?php
                                $no = 1;
                                if (mysqli_num_rows($data) > 0) {
                                    while ($kategori = mysqli_fetch_assoc($data)) {
                                ?>
                                        <tr>                                          
                                            <td><?= $no++; ?></td>
                                            <td><?= $kategori['nama_kategori']; ?></td>
                                            <td><?= $kategori['proses']; ?></td>
                                            <td><?= $kategori['des_kategori']; ?></td>
                                            <td><img src="../img/<?= $kategori['foto_kategori']; ?>" width="100"></td>                                      
                                        
                                        <td>
                                                <div class="form-button-action">
                                                    <a href="edit_kategori.php?id=<?= $kategori['id_kategori']; ?>"><button class="btn btn-warning">Edit</button>
                                                    </a>
                                                     <a href="hapus_kategori.php?id=<?= $kategori['id_kategori']; ?>"><button class="btn btn-danger">Hapus</button>
                                         
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
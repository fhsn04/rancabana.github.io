<!DOCYTPE html>
<html>
<style>
form {
  background-color :  white;
  margin-top: 100px;
	margin-bottom: 100px;
	margin-right: 150px;
	margin-left: 60px
			
}
label {
  padding: 12px 12px 12px 0;
  display: inline-block;
  font-size : 11pt;
}
input[type=text], select, textarea{
  width: 100%;
  padding: 20px;
  border: 1px solid #ccc
}
button {
  padding : 8px 16px;
  margin-left : 20px;
  margin-right : 10px;
  margin-bottom : 20px;
  border-radius : 4px ;
  color : white;
  background-color : #34df04 ;
  text-decoration : none;
  font-family : Arial,Helvetica, sans-serif ;
}

/* Style the submit button */
input[type=submit] {
  background-color: #04AA6D;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  float: right;
  
}

/* Style the container */
.container {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}

/* Floating column for labels: 25% width */
.col-25 {
  float: left;
  width: 25%;
  margin-top: 6px;
}

/* Floating column for inputs: 75% width */
.col-75 {
  float: left;
  width: 75%;
  margin-top: 6px;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}
.link, 
.link:link,
.link:active,
.link:visited{
    padding : 7px 16px;
    height : 4px ;
    margin-left : 12px;
    margin-right : 5px;
    margin-bottom : 15px;
    border-radius : 4px ;
    color : white;
    background-color : #2f1c94;
    text-decoration : none;
    font-family : Arial,Helvetica, sans-serif ;
}
 
.link:hover{
    background: #2f1c94;
}

/* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 600px) {
  .col-25, .col-75, input[type=submit] {
    width: 100%;
    margin-top: 0;
  }
  </style
<?php
$title = 'Tambah Data Kategori';
require 'koneksi.php';

if (isset($_POST['btn-simpan'])) {
    $nama = $_POST['nama_kategori'];
    $des_kategori = $_POST['des_kategori'];
    $foto_kategori = $_FILES['foto_kategori']['name'];
    $lokasi = $_FILES['foto_kategori']['tmp_name'];
    move_uploaded_file($lokasi, "../img/".$foto_kategori);

    $query = "INSERT INTO kategori (nama_kategori, des_kategori, foto_kategori) values ('$nama', '$des_kategori', '$foto_kategori')";
    $insert = mysqli_query($conn, $query);
    if ($insert == 1) {
        $_SESSION['msg'] = 'Berhasil Menyimpan Data';
        header('location: kategori.php');
    } else {
        $_SESSION['msg'] = 'Gagal menambahkan data baru!!!';
        header('location: kategori.php');
    }
}

require 'navigasi.php';
?>
                        </div>
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="largeInput">Nama Kategori</label>
                                <input type="text" name="nama_kategori" class="form-control form-control" id="defaultInput" placeholder="Kategori...">
                            </div>
                            <div class="form-group">
                                <label for="largeInput">Deskripsi</label>
                                <input type="text" name="des_kategori" class="form-control form-control" id="defaultInput" placeholder="Kategori...">
                            </div>
                            <div class="form-group">
                                <label for="largeInput">Foto</label>
                                <input type="file" name="foto_kategori" class="form-control form-control" id="defaultInput">
                            </div>
                            <div class="button">
                                <button type="submit" name="btn-simpan" class="btn btn-success">Submit</button>
                                <!-- <button class="btn btn-danger">Cancel</button> -->
                                <a href="javascript:void(0)" onclick="window.history.back();" class="link">Batal</a>
                            </div>
                    </form>
              
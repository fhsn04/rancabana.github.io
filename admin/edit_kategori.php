<!DOCYTPE html>
<html>
<style>
form {
    background-color :  transparen;
    box-sizing : border-box;
	width: 100%;
	padding: 10px;
	font-size: 11pt;
	margin-bottom: 20px;
}

  input[type=text], select, textarea{
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  resize: vertical;
  
}

/* Style the label to display next to the inputs */
label {

  padding: 12px 12px 12px 0;
  display: inline-block;
  font-size : 11pt;
 
}

button {
    padding : 8px 16px;
            margin-left : 20px;
            margin-right : 10px;
            margin-bottom : 20px;
            border-radius : 4px ;
            color : white;
            background-color : #90EE90;
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
select {
  width: 100%;
  min-width: 15ch;
  max-width: 30ch;
  border: 1px solid var(--select-border);
  border-radius: 0.25em;
  padding: 0.25em 0.5em;
  font-size: 1.25rem;
  cursor: pointer;
  line-height: 1.1;
  background-color: #40E0D0;
  background-image: linear-gradient(to top, #f9f9f9, #fff 33%);
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
.card-body {
    width : 350px;
    background : white ;
    margin : 80px auto ;
    padding : 30px 20px ;
    box-sizing : border-box ;
    border : 1px solid black ;
    border-radius : 16px ;
}
.btn {
    padding : 8px 16px;
    height : 5px ;
            margin-left : 20px;
            margin-right : 10px;
            margin-bottom : 20px;
            border-radius : 4px ;
            color : white;
            background-color : #D3D3D3;
            text-decoration : none;
            font-family : Arial,Helvetica, sans-serif ;
}

/* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 600px) {
  .col-25, .col-75, input[type=submit] {
    width: 100%;
    margin-top: 0;
  }
  </style>
<?php
$title = 'Edit Data Kategori';
require 'koneksi.php';

$id = $_GET['id'];
$query = "SELECT * FROM kategori WHERE id_kategori = '$id'";
$queryedit = mysqli_query($conn, $query);

if (isset($_POST['btn-simpan'])) {
    $nama_kategori = $_POST['nama_kategori'];
    $des_kategori = $_POST['des_kategori'];
    $foto_kategori = $_FILES['foto_kategori']['name'];
    $lokasi = $_FILES['foto_kategori']['tmp_name'];

    if (!empty($lokasi)){
        move_uploaded_file($lokasi, "../img/$foto_kategori");

    $query = "UPDATE kategori SET nama_kategori = '$nama_kategori', des_kategori = '$des_kategori', foto_kategori = '$foto_kategori' WHERE id_kategori = " . $_GET['id'];
    $update = mysqli_query($conn, $query); 
}
else
{
    $query = "UPDATE kategori SET nama_kategori = '$nama_kategori', des_kategori = '$des_kategori' WHERE id_kategori = " . $_GET['id'];
    $update = mysqli_query($conn, $query);
  
}
    
    echo "<script>alert('Data Berhasil Dirubah')</script>";
    echo "<script>location='kategori.php'</script>";
}

require 'navigasi.php';
?>

                
<?php while ($edit = mysqli_fetch_assoc($queryedit)) { ?>   
        <div class="row">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title"><?= $title; ?>
                            : <strong><?= $edit['nama_kategori']; ?></strong></div>
                    </div>
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="largeInput">Nama Kategori</label>
                                <input type="text" name="nama_kategori" class="form-control form-control" id="defaultInput" value="<?= $edit['nama_kategori']; ?>" placeholder="Kategori...">
                            </div>
                            <div class="form-group">
                                <label for="largeInput">Deskripsi</label>
                                <input type="text" name="des_kategori" class="form-control form-control" id="defaultInput" value="<?= $edit['des_kategori']; ?>" placeholder="Deskripsi..." >
                            </div>
                            <div class="form-group">
                                    <img src="../img/<?= $paket['foto_kategori']; ?>" width="80">
                                </div>
                                <div class="form-group">
                                    <label for="largeInput">Ganti Foto</label>
                                    <input type="file" name="foto_kategori"  class="form-control form-control" id="defaultInput">
                                </div>
                    <div class="card-action">
                        <button type="submit" name="btn-simpan" class="btn-succes">Submit</button>
                        <!-- <button class="button">Cancel</button> -->
                        <br><a href="javascript:void(0)" onclick="window.history.back();" class="btn btn-danger">Batal</a>
                    </div>
                    </form>
           </html>
           <?php } ?>
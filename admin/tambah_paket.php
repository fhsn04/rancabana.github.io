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

label {

  padding: 12px 12px 12px 0;
  display: inline-block;
  font-size : 11pt;
 
}

button {
    padding : 8px 16px;
            margin-left : 19px;
            margin-right : 10px;
            margin-bottom : 20px;
            border-radius : 4px ;
            color : white;
            background-color : #90EE90;
            text-decoration : none;
            font-family : Arial,Helvetica, sans-serif ;
}

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

.container {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}

.col-25 {
  float: left;
  width: 25%;
  margin-top: 6px;
}


.col-75 {
  float: left;
  width: 75%;
  margin-top: 6px;
}

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
.link, 
.link:link,
.link:active,
.link:visited{
    padding : 7px 15px;
    height : 4px ;
    margin-left : 19px;
    margin-right : 5px;
    margin-bottom : 15px;
    border-radius : 4px ;
    color : white;
    background-color : #D3D3D3;
    text-decoration : none;
    font-family : Arial,Helvetica, sans-serif ;
}
 
           
}

@media screen and (max-width: 600px) {
  .col-25, .col-75, input[type=submit] {
    width: 100%;
    margin-top: 0;
  }
</style>

<?php
$title = 'Tambah Data Paket';
require 'koneksi.php';

$query = "SELECT * FROM paket_cuci";
$data = mysqli_query($conn, $query);

if (isset($_POST['btn-simpan'])) {
    $nama = $_POST['nama_paket'];
    $id_kategori = $_POST['id_kategori'];
    $desk = $_POST['deskripsi'];
    $harga = $_POST['harga'];
    $p_foto = $_FILES['p_foto']['name'];
    $lokasi = $_FILES['p_foto']['tmp_name'];
    move_uploaded_file($lokasi, "../img/".$p_foto);

    $query = "INSERT INTO paket_cuci (nama_paket, deskripsi, harga,  p_foto, id_kategori) values ('$nama', '$desk','$harga', '$p_foto', '$id_kategori')";
    $insert = mysqli_query($conn, $query);
    if ($insert == 1) {
      echo "<script>alert('Data Berhasil Ditambahkan')</script>";
      echo "<script>location='paket.php'</script>";
    } else {
      echo "<script>alert('Gagal menambahkan data baru')</script>";
      echo "<script>location='paket.php'</script>";
    }
}

require 'navigasi.php'
?>
<?php
$datakategori = array();
$ambil = $conn->query("select * from kategori");
while ($tiap = $ambil->fetch_assoc())
{
  $datakategori[] = $tiap;
}
?>

                        <div class="card-title"><?= $title; ?></div>
                    </div>
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="card-body">
                              <div class="form-group">
                                    <label for="defaultSelect">Paket</label>
                                    <br>
                                    <select name="nama_paket" class="form-control form-control" id="defaultSelect">
                                    <option value="Kaos/Celana-Pendek">Kaos/Celana-Pendek</option>
                                    <option value="Selimut/Bedcover">Selimut/Bedcover</option>
                                    <option value="Karpet Berat">Karpet Berat</option>
                                    <option value="Sepatu">Sepatu</option>
                                    <option value="Levis/Sweater">Levis/Sweater</option>
                                    <option value="Gaun/Jas">Gaun/Jas</option>
                            </select>
                            </div>
                            <div class="form-group">
                                    <label for="defaultSelect">Kategori</label>
                                    <br>
                                    <select name="id_kategori" class="form-control form-control" id="defaultSelect">
                                    <option value="">Pilih Kategori</option>
                                    <?php foreach ($datakategori as $key => $value): ?>
                                    <option value="<?php echo $value["id_kategori"] ?>"><?php echo $value["nama_kategori"] ?></option>
                                    <?php endforeach ?>
                            </select>
                            </div>
                            <div class="form-group">
                                <label for="largeInput">Deskripsi</label>
                                <input type="text" name="deskripsi" class="form-control form-control" id="defaultInput" placeholder="deskripsi...">
                            </div>                            
                            <div class="form-group">
                                <label for="">Harga</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">Rp</span>
                                    </div>
                                    <input type="text" class="form-control" name="harga" aria-describedby="basic-addon1">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="largeInput">Foto</label>
                                <input type="file" name="p_foto" class="form-control form-control" id="defaultInput">
                            </div>
                            <div class="card-action">
                                <button type="submit" name="btn-simpan" class="btn">Submit</button>
                                <!-- <button class="btn btn-danger">Cancel</button> -->
                                <a href="javascript:void(0)" onclick="window.history.back();" class="link">Batal</a>
                            </div>
                    </form>
                </div>
            
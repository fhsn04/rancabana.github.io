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
            margin-left : 19px;
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

/* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 600px) {
  .col-25, .col-75, input[type=submit] {
    width: 100%;
    margin-top: 0;
  }
  </style>
<?php
$title = 'Edit Data Paket';
require 'koneksi.php';

$id = $_GET['id'];
$query = "SELECT * FROM paket_cuci WHERE id_paket = '$id'";
$queryedit = mysqli_query($conn, $query);

if (isset($_POST['btn-simpan'])) {
    $nama = $_POST['nama_paket'];
    $id_kategori = $_POST['id_kategori'];
    $harga = $_POST['harga'];
    $p_foto = $_FILES['p_foto']['name'];
    $lokasi = $_FILES['p_foto']['tmp_name'];


    if (!empty($lokasi)){
        move_uploaded_file($lokasi, "../img/$p_foto");

    $query = "UPDATE paket_cuci SET nama_paket = '$nama', harga = '$harga', p_foto = '$p_foto', id_kategori = '$id_kategori' WHERE id_paket = '$id'";
    $update = mysqli_query($conn, $query);    
    }
    else
    {
        $query = "UPDATE paket_cuci SET nama_paket = '$nama', harga = '$harga', id_kategori = '$id_kategori' WHERE id_paket = '$id'";
        $update = mysqli_query($conn, $query);
      
    }
        
        echo "<script>alert('Data Berhasil Dirubah')</script>";
        echo "<script>location='paket.php'</script>";
}

require 'navigasi.php';
?>
<?php
$datakategori = array();
$ambil = $conn->query("select * from kategori");
while ($tiap = $ambil->fetch_assoc())
{
  $datakategori[] = $tiap;
}
?>
                   
                
        
                    <?php while ($edit = mysqli_fetch_assoc($queryedit)) { ?>
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
                                    <option value="<?php echo $value["id_kategori"] ?>" <?php if($edit["id_kategori"]==$value["id_kategori"]){ echo "selected";} ?> >
                                    <?php echo $value["nama_kategori"] ?></option>
                                    <?php endforeach ?>
                            </select>
                            </div>
                                <div class="form-group">
                                    <label for="">Harga</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">Rp</span>
                                        </div>
                                        <input type="text" class="form-control" name="harga" aria-describedby="basic-addon1" value="<?= $edit['harga']; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                   <label for="largeInput">Deskripsi</label>
                                   <input type="text" value="<?= $edit['deskripsi']; ?>" name="deskripsi" class="form-control form-control" id="defaultInput" placeholder="deskripsi...">
                                </div>  
                                <div class="form-group">
                                    <img src="../img/<?= $paket['p_foto']; ?>" width="80">
                                </div>
                                <div class="form-group">
                                    <label for="largeInput">Ganti Foto</label>
                                    <input type="file" name="p_foto"  class="form-control form-control" id="defaultInput">
                                </div>
                                <div class="card-action">
                                    <button type="submit" name="btn-simpan" class="btn btn-success">Submit</button>
                                    <!-- <button class="btn btn-danger">Cancel</button> -->
                                    <br><a href="javascript:void(0)" onclick="window.history.back();" class="link">Batal</a>
                                </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>
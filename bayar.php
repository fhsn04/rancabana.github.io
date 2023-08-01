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

@media screen and (max-width: 600px) {
  .col-25, .col-75, input[type=submit] {
    width: 100%;
    margin-top: 0;
  }
  </style>

<?php
session_start();
require_once("koneksi.php");


$id = $_GET['id'];
$id_pelanggan = $_SESSION["pelanggan"]["id_pelanggan"];  

$query = "SELECT * FROM detail_transaksi LEFT JOIN transaksi ON transaksi.id_transaksi = detail_transaksi.id_transaksi WHERE transaksi.id_pelanggan = '$id_pelanggan' AND detail_transaksi.id_transaksi = '$id'";
$transaksi = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($transaksi);
$proses = $data['proses'];
$resi_dp = $data['resi_dp'];
$resi_p = $data['resi_p'];
$total_harga = $data['total_harga'];
$status_bayar = $data['status_bayar'];
if ($data['id_pelanggan']!=($id_pelanggan)){
    echo "<script>alert('data tidak sesuai')</script>";
    echo "<script>location='index.php'</script>";
}
if ($status_bayar == 'belum' AND !empty($resi_dp OR $resi_p)) {
  echo "<script>alert('sudah mengirimkan bukti pembayaran, menunggu konfirmasi admin')</script>";
  echo "<script>location='riwayat.php'</script>";
}else if ($status_bayar == 'dp' AND empty($resi_p)){

$sql = "SELECT * from transaksi RIGHT JOIN detail_transaksi ON detail_transaksi.id_transaksi = transaksi.id_transaksi WHERE transaksi.id_pelanggan = '$id_pelanggan' AND transaksi.id_transaksi = '$id'";

if (isset($_POST['btn-simpan'])){
$r_foto = $_FILES['r_foto']['name'];
$lokasi = $_FILES['r_foto']['tmp_name'];
move_uploaded_file($lokasi, "img/".$r_foto);

if($proses=='kiloan' OR $status_bayar=='belum'){
  $query = "UPDATE transaksi SET resi_dp = '$r_foto' WHERE id_transaksi ='$id'";
  $insert = mysqli_query($conn, $query);
}
elseif($status_bayar=='dp'){
  $query = "UPDATE transaksi SET resi_p = '$r_foto' WHERE id_transaksi ='$id'";
  $insert = mysqli_query($conn, $query);
}
else{
  $query = "UPDATE transaksi SET resi_p = '$r_foto' WHERE id_transaksi ='$id'";
  $insert = mysqli_query($conn, $query);
}

if ($insert==1){
    echo "<script>alert('resi berhasil dikirim, menunggu konfirmasi admin')</script>";
    echo "<script>location='riwayat.php'</script>";
}else{
    echo "<script>alert('cek kembali data')</script>";
    echo "<script>location='bayar.php'</script>";
}
}
}
?>

<div class="container">
<div class="row">
            <div class="center">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title"></div>
                    </div>
                    <form action="bayar.php?id=<?= $data['id_transaksi']; ?>" id="form-submit" method="POST" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="largeInput">Kode Invoice</label>
                                <input type="text" name="kode_invoice" class="form-control form-control" id="defaultInput" value="<?= $data['kode_invoice']; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="largeInput">Nama Pelanggan</label>
                                <input type="text" name="nama_pelanggan" class="form-control form-control" id="defaultInput" value="<?= $data['nama']; ?>" readonly>
                            </div>
                            <div class="form-group">
                            <?php if ($total_harga !=0) :?>
                               <label for="largeInput">Uang Muka</label>
                                <input type="text" name="total_harga" class="form-control form-control" id="defaultInput" value="<?= 'Rp ' . number_format($data['pelunasan']); ?>" readonly>
                            <?php else :?>
                                <label for="largeInput">Total Yang Harus Dibayarkan</label>
                                <input type="text" name="total_harga" class="form-control form-control" id="defaultInput" value="<?= 'Rp ' . number_format($data['uang_muka']); ?>" readonly>
                            <?php endif ?>
                            </div>
                            <div class="form-group">
                                <label for="largeInput">Resi Pembayaran</label>
                                <input type="file" name="r_foto" class="form-control form-control" id="defaultInput">
                            </div><br>
                            <div class="card-action">
                                <button type="submit" name="btn-simpan" class="btn btn-success">Submit</button>
                                <!-- <button class="btn btn-danger">Cancel</button> -->
                                <a href="javascript:void(0)" onclick="window.history.back();" class="link">Batal</a>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

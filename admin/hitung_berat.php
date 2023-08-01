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
require 'navigasi.php';
?>
<div class="container-fluid">
    <h1 class="text-center">Konfirmasi Pembayaran</h1><hr><br>
 
    <div class="row">
    <div class="thumbnail col-md-8">
    <form method="POST">
    <table class="table">
            <tr>
                <th>No</th>
                <th>Item</th>
                <th>Kategori</th>
                <th>Proses</th>
                <th>Harga</th>
                <th>Jumlah/Berat</th>
                <th>Total</th>
            </tr>
            <?php
            $no = 1;
            $id_transaksi = $_GET['id'];
            $main_subtotal=0;
            $query = "SELECT * FROM detail_transaksi LEFT JOIN transaksi ON transaksi.id_transaksi = detail_transaksi.id_transaksi WHERE detail_transaksi.id_transaksi = '$id_transaksi'";            
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) > 0) {
                while ($data = mysqli_fetch_assoc($result)) {
                $subtotal= $data['harga'] * $data['qty'];                
                $ongkir= $data['biaya_tambahan'];
                $main_subtotal= $main_subtotal + $subtotal; 
                {
                    $datas[] = $data;
                }
            ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $data['nama_paket']; ?></td>
                <td><?= $data['nama_kategori']; ?></td>
                <td><?= $data['proses']; ?></td>
                <td>Rp. <?= number_format($data['harga']); ?></td>
                <td><input type="number" name="qty" value="<?= $data['qty']; ?>"></input>
                <input type="hidden" name="id_detail" value="<?= $data['id_detail']; ?>"></input>                    
                </td>
                <td>Rp. <?= number_format($subtotal); ?></td>
                
            </tr>
            <?php }
        }?>        
            <th colspan='5'"></th>
            <th>Total Harga</th>    
            <th>Rp. <?= number_format($main_subtotal); ?></th>           
    </table>
    <button name="update" class="btn btn-primary">Hitung</button>
    <button name="simpan" class="btn btn-danger">Simpan</button>
    </form>
    </div>
    <?php
        if(isset($_POST['update'])){
            $qty= $_POST['qty'];
            $id_detail = $_POST['id_detail'];            

            $total_keseluruhan = $main_subtotal + $ongkir;
            $sql = "UPDATE detail_transaksi SET qty = '$qty' WHERE id_detail = '$id_detail' AND id_transaksi = '$id_transaksi'";
            $update = mysqli_query($conn, $sql);

            echo "<script>location='hitung_berat.php?id=$id_transaksi'</script>";
        }
        ?>
        <!-- hitung total keseluruhan dan total pelunasan     -->
        <?php 
        if (isset($_POST['simpan'])){
            foreach ($datas as $key => $item){ 
                $harga = $item['harga'];
                $jumlah = $item['qty'];
            $sql2 = "UPDATE transaksi SET total_harga = '$main_subtotal' WHERE id_transaksi = '$id_transaksi'";
            $update2 = mysqli_query($conn, $sql2);            
                   
            echo "<script>location='hitung_berat.php?id=$id_transaksi'</script>";
        }
    }
        ?>
        
        <div class="col-md-3 pull-right">            
            <div style="width:400px;">
			<div class="row">
            <?php
            $data2 = array();
            $main_subtotal=0;
            $query2 = $conn ->query("SELECT * FROM detail_transaksi LEFT JOIN transaksi ON transaksi.id_transaksi = detail_transaksi.id_transaksi WHERE detail_transaksi.id_transaksi = '$id_transaksi'");
            while ($tiap = $query2->fetch_assoc())
            {
            $data2[] = $tiap;
            }
            foreach ($data2 as $key => $item){
                $total_harga = $item['total_harga'];
                $dp = $item['uang_muka'];
                $harga = $item['harga'];
                $jumlah = $item['qty'];
                $ongkir = $item['biaya_tambahan'];
                $pelunasan = $total_harga - $item['uang_muka'];
                $resi = $item ['resi_p'];
            }
            ?>  <form  method="post">
                <h3>Rincian Harga</h3>
				<div class="col-sm-6 text-left text-20 text-muted">Biaya Keseluruhan</div>
				<div class="col-sm-6 text-20 text-right">Rp. <?php echo number_format($total_harga) ?></div>
                <div class="col-sm-6 text-left text-muted">Uang Muka</div>
				<div class="col-sm-6 text-right">Rp. <?= number_format($dp); ?></div>
                <div class="col-sm-6 text-left text-muted">Biaya Yang Harus Dilunasi</div>
				<div class="col-sm-6 text-right">Rp. <?= number_format($pelunasan); ?></div>
                <div class="thumbnail"><a class='MagicZoom' href="../img/<?= $resi; ?>" rel='zoom-id:zoom;opacity-reverse:true;'><img src="../img/<?= $resi; ?>" width="100" alt='' /> </a></div></div>
                <button style="width:200px;" type="submit" name="konfirmasi" class="btn btn-primary pull-right">Konfirmasi</button>
                </form>
                <?php
                if (isset($_POST['konfirmasi'])){
                $conn->query("UPDATE transaksi SET pelunasan = $pelunasan, status_bayar = 'dp' WHERE id_transaksi = '$id_transaksi'");
                echo "<script>alert('data berhasil di update')</script>";
                echo "<script>location='konfirmasi.php'</script>";
                }
                ?>

			</div>
		    </div>
        </div>

    </div>
</div>
  
   
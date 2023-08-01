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
$title = 'Detail Pembayaran';
require 'koneksi.php';

$status = [
    'baru',
    'dijemput',
    'proses',
    'selesai',
    'dikirim'
];

$id = $_GET['id'];
$query = "SELECT * from transaksi WHERE transaksi.id_transaksi = " . $id;
$transaksi = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($transaksi);

$sql = "SELECT * from transaksi RIGHT JOIN detail_transaksi ON detail_transaksi.id_transaksi = transaksi.id_transaksi WHERE transaksi.id_transaksi = " . $id;

if (isset($_POST['simpan'])) {
    $status = $_POST['status'];

    $query = "UPDATE transaksi SET status = '$status' WHERE id_transaksi = '$id'";
    $update = mysqli_query($conn, $query);
    if ($update == 1) {
        echo "<script>alert('status berhasil diupdate')</script>";
        echo "<script>location='transaksi.php'</script>";

    } else {
        $_SESSION['msg'] = 'Gagal Mengubah Status Transaksi!!!';
        header('location:detail.php');
    }
}

require 'navigasi.php';
?>
            <?php if (isset($_SESSION['msg']) && $_SESSION['msg'] <> '') { ?>
                <div class="alert alert-success" role="alert" id="msg">
                    <?= $_SESSION['msg']; ?>
                </div>
            <?php }
            $_SESSION['msg'] = ''; ?>
        </div>

        <div class="border-ccc padding-10 order-container">
				<div class="float-left">
					<strong>Id Transaksi: <?= $data['id_transaksi']; ?></strong><br>
					<strong>tanggal pembayaran: <?= $data['tgl']; ?></strong><br>
                    <strong>tanggal pembayaran: <?= $data['tgl_pembayaran']; ?></strong>
                </div></br><hr>
                <div class="row">
                    <div align="center">
                    <div class="col-md-5">
                    <table class="table size-40% table table-bordered">
                    <tr>
                        <th>No</th>
                        <th>Order</th>
                        <th>Kategori</th>
                        <th>Jenis Layanan</th>
                        <th>Harga</th>
                        <th>Jumlah Pcs</th>
                        <th>Total</th>
                    </tr>
                    <?php
                        $no=1;
                        $mainsubharga=0;
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                        while ($data2 = mysqli_fetch_assoc($result)) {                                        
                        $subharga = $data2['harga'] * $data2['qty'];
                        $mainsubharga += $subharga ;
                    ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $data2['nama_paket']; ?></td>
                        <td><?= $data2['nama_kategori']; ?></td>
                        <td><?= $data2['proses']; ?></td>
                        <td>Rp.<?= number_format($data2['harga']); ?></td>
                        <td><?= $data2['qty']; ?></td>
                        <td>Rp.<?= number_format($subharga); ?></td>
                    </tr>                      
                    <?php }
                    }?>
                    </table>
                    </div>
                    
                    <div class="col-md-7">
                    <table class="table size-40% table table-bordered">
                    <tr>
                        <th>Nama Pelanggan</th>
                        <th>Email</th>
                        <th>No Telpon</th>
                        <th>Alamat</th>
                        <th>Biaya Antar/Jemput</th>
                        <th>Resi Pembayaran</th>
                        <th>Status</th>
                    </tr>
                    <tr>
                    
                        <td><?= $data['nama']; ?></td>
                        <td><?= $data['email']; ?></td>
                        <td><?= $data['no_telp']; ?></td>
                        <td><?= $data['alamat']; ?></td>
                        <td>Rp.<?= number_format($data['biaya_tambahan']); ?></td>
                        <td><a class='MagicZoom' href="../img/<?= $data['resi_p']; ?>" rel='zoom-id:zoom;opacity-reverse:true;'>
                            <img src="../img/<?= $data['resi_p']; ?>" width="100" alt='' /> </a></td>
                        <td>
                         <form method="POST">                    
                            <div class="form-group">
                                <select name="status" class="form-control form-control" value="<?php echo $data['status']; ?>">
                                    <?php foreach ($status as $key) : ?>
                                        <?php if ($key == $data2['status']) : ?>
                                            <option value="<?= $key ?>" selected><?= $key ?></option>
                                        <?php endif ?>
                                        <option value="<?= $key ?>"><?= $key ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <button name="simpan" class="text-primary text-center"><i class="fa fa-edit"></i>Update Status</button>
                        </form>
                        </td>
                        
                    </tr>
                    </table>
                    <h2 class="text-warning text-right"> total harga barang yang di order = Rp.<?= number_format($mainsubharga); ?> </h2>
                <h2 class="text-warning text-right"> total biaya keseluruhan = Rp.<?= number_format($data['total_harga']); ?> </h2>
                
                </div>
                </div>
                
                </div>                
                
        </div>
                